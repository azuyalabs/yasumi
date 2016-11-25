<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\bin;

use ArrayIterator;
use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Yasumi\Yasumi;

/**
 * Command for performing code checks.
 *
 * @package Yasumi\bin
 */
class CodeCheckCommand extends Command
{
    /**
     * @var integer variable holding the number of counted issues
     */
    private static $issues;

    /**
     * @var integer variable holding the number of defined unit tests
     */
    private static $test_count;

    /**
     * @var integer variable holding the number of providerss
     */
    private static $provider_count;

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        self::$issues['missing_interfaces'] = 0;
        self::$issues['missing_constants']  = 0;
        self::$test_count                   = 0;

        $this->setName('check')->setDescription('Performs some quality checks on the source code and unit tests.')->addOption('providerlist',
            null, InputOption::VALUE_NONE,
            'Print list of providers to be used for the README.md file.')->addOption('testsuitelist', null,
            InputOption::VALUE_NONE, 'Print list of testsuites to be used for the README.md file.');
        ;
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Performing code check on Yasumi...</info>');
        $this->checkUnitTests($output);
        $this->checkSource($output);


        if ($input->getOption('providerlist')) {
            $this->outputProviderList($output);
        }

        if ($input->getOption('testsuitelist')) {
            $this->outputProviderTestSuiteList($output);
        }

        // Output summary
        $output->writeln(sprintf('<comment>Number of providers: %d</comment>', self::$provider_count));
        $output->writeln(sprintf('<comment>Number of tests: %d</comment>', self::$test_count));
        $output->writeln(sprintf('<comment>Number of tests missing required interfaces: %d</comment>',
            self::$issues['missing_interfaces']));
        $output->writeln(sprintf('<comment>Number of classes missing required constants: %d</comment>',
            self::$issues['missing_constants']));
        $output->writeln('');
        $output->writeln('<info>Check completed successfully.</info>');
    }

    /**
     * Executes the checks for the unit tests.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function checkUnitTests(OutputInterface $output)
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../tests')->exclude('Base')->name('*.php')->notName('YasumiBase.php')->notName('YasumiTestCaseInterface.php');

        // Loop through the test files
        foreach ($finder as $file) {
            $reflection = new ReflectionClass('Yasumi\\tests\\' . str_replace('/', '\\',
                    $file->getRelativePath()) . '\\' . $file->getBasename('.php'));

            // Count the number tests
            $methods = $reflection->getMethods();
            array_walk($methods, function ($k) {
                if (substr($k->getName(), 0, 4) === 'test') {
                    self::$test_count++;
                }
            });

            $this->checkMissingConstants($reflection, ['REGION', 'TIMEZONE', 'LOCALE'], $file, $output);
            $this->checkMissingInterfaces($reflection, $output, $file);
        }
    }

    /**
     * Executes the checks for source code (provider classes only).
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function checkSource(OutputInterface $output)
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../src/Yasumi/Provider')->name('*.php')->notName('AbstractProvider.php')->notName('ChristianHolidays.php')->notName('CommonHolidays.php');

        // Loop through the source files
        foreach ($finder as $file) {
            self::$provider_count++;
            $path = 'Yasumi\Provider\\';
            if (! empty($file->getRelativePath())) {
                $path .= $file->getRelativePath() . '\\';
            }

            $this->checkMissingConstants(new ReflectionClass($path . $file->getBasename('.php')), ['ID'], $file,
                $output);
        }
    }

    /**
     * Checks for missing constants in various classes
     *
     * All unit test classes (providers) should have at least the following constants defined: REGION, TIMEZONE, LOCALE.
     * All provider classes should have at least the following constants: CODE
     *
     * @param \ReflectionClass                                  $class
     * @param array                                             $requiredConstants
     * @param \Symfony\Component\Finder\SplFileInfo             $file
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function checkMissingConstants(
        ReflectionClass $class,
        array $requiredConstants,
        SplFileInfo $file,
        OutputInterface $output
    ) {
        $missingConstants = (array_diff(($requiredConstants), array_keys($class->getConstants())));

        if (sizeof($missingConstants) > 0) {
            self::$issues['missing_constants']++;
            if ($output->isVerbose()) {
                $output->writeln(sprintf('<fg=red>Class %s is missing the following required class constants: %s.</>',
                    $this->getClassIdentifier($file), implode(', ', $missingConstants)));
            }
        }
    }

    /**
     * Checks whether all relevant tests classes implement the YasumiTestCaseInterface
     *
     * @param \ReflectionClass                                  $class
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param \Symfony\Component\Finder\SplFileInfo             $file
     */
    private function checkMissingInterfaces(ReflectionClass $class, OutputInterface $output, SplFileInfo $file)
    {
        $requiredInterfaces = ['Yasumi\tests\YasumiTestCaseInterface'];
        $missingInterfaces  = (array_diff(($requiredInterfaces), array_values($class->getInterfaceNames())));

        // Don't check test classes related to its own provider; these are not implementing the YasumiTestCaseInterface
        $baseClassName = basename($file->getRelativePath());
        $testClasses   = [$baseClassName . 'BaseTestCase', $baseClassName . 'Test'];

        if (in_array($file->getBasename('.php'), $testClasses)) {
            return;
        }

        if (sizeof($missingInterfaces) > 0) {
            self::$issues['missing_interfaces']++;
            if ($output->isVerbose()) {
                $output->writeln(sprintf('<fg=red>TestCase `%s` is missing the following required interfaces: %s.</>',
                    $this->getClassIdentifier($file), implode(', ', $missingInterfaces)));
            }
        }
    }

    /**
     * Creates a identifier for the provider class
     *
     * @param \Symfony\Component\Finder\SplFileInfo $file
     *
     * @return string
     */
    private function getClassIdentifier(SplFileInfo $file)
    {
        $path = '';
        if (! empty($file->getRelativePath())) {
            $path .= $file->getRelativePath() . ':';
        }

        return $path . $file->getBasename('.php');
    }

    /**
     * Renders a list of providers to be used in the README file.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function outputProviderList(OutputInterface $output)
    {
        $holidays = Yasumi::getProviders();
        sort($holidays);

        $providerRow = '';
        $it          = new ArrayIterator($holidays);
        foreach ($it as $provider) {
            $current = explode('/', $provider);

            if ($it->offsetExists($it->key() + 1)) {
                $previous = $it->offsetGet($it->key() + 1);
                $parts    = explode('/', $previous);

                if (isset($parts[1]) && $current[0] == $parts[0]) {
                    $sub_region[] = $this->translateProviderName($previous);
                    continue;
                }

                if (! empty($sub_region)) {
                    $providerRow .= "* " . $this->translateProviderName($current[0]) . " (including the sub-regions " . implode(', ',
                            $sub_region) . ')' . PHP_EOL;
                    $sub_region = [];
                } else {
                    $providerRow .= '* ' . $this->translateProviderName($provider) . PHP_EOL;
                }
            } else {
                $providerRow .= '* ' . $this->translateProviderName($provider) . PHP_EOL;
            }
        }

        $output->writeln($providerRow);
    }

    /**
     * Renders a list of provider test suites to be used in the README file.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function outputProviderTestSuiteList(OutputInterface $output)
    {
        $holidays = Yasumi::getProviders();
        sort($holidays);

        // Find out longest holiday provider string
        $maxLen = 0;
        array_walk($holidays, function ($value) use (&$maxLen) {
            $current = explode('/', $value);
            if (strlen($current[0]) > $maxLen) {
                $maxLen = strlen($current[0]);
            }
        });

        $providerRow = '* "Base"        : For testing the base functionality of Yasumi' . PHP_EOL;
        $it          = new ArrayIterator($holidays);
        foreach ($it as $provider) {
            $current = explode('/', $provider);
            if (isset($current[1])) {
                continue;
            }

            $spaces = str_repeat(' ', $maxLen - strlen($provider) + 1);

            $providerRow .= "* \"$provider\"$spaces: For separately testing the $provider Holiday Provider" . PHP_EOL;
        }

        $output->writeln($providerRow);
    }

    /**
     * Retrieves the translated name of the given subdivision (country or state)
     *
     * @param $provider string a subdivision (country or state)
     *
     * @return string the translated name of the given subdivision (country or state)
     */
    private function translateProviderName($provider)
    {
        $names = require __DIR__ . '/subdivisions.php';

        $reflection = new ReflectionClass('Yasumi\\Provider\\' . str_replace('/', '\\', $provider));
        $id         = $reflection->getConstant('ID');

        $name = $id;
        if (array_key_exists($id, $names)) {
            $name = $names[$id];
        }

        return $name;
    }
}
