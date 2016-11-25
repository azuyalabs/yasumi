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
use CachingIterator;
use DOMDocument;
use Exception;
use GuzzleHttp\Client;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ZipArchive;

/**
 * Class BuildLocaleListCommand
 *
 * @package Yasumi\bin
 */
class BuildLocaleListCommand extends Command
{

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this->setName('cldr')->setDescription('CLDR tool.')->addArgument('version', InputArgument::OPTIONAL,
            'The version (number) of the CLDR to be used')->addOption('build-locales', null, InputOption::VALUE_NONE,
            'Builds list of all official locales.')->addOption('export-subdivisions', null, InputOption::VALUE_NONE,
            'Export list of all subdivisions.');
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
        $output->writeln('<info>CLDR Tool</info>');

        if (! class_exists('ZipArchive')) {
            throw new RuntimeException('The Zip PHP extension is not installed. Please install it and try again.');
        }

        // Get version number from user, otherwise use default
        $version = $input->getArgument('version');
        if (is_null($version) || ! is_numeric($version)) {
            $version = 29;
        }

        // Download the selected CLDR file if not exists
        if (! is_readable($zipFile = __DIR__ . '/cldr_' . $version . '.zip')) {
            if ($output->isVerbose()) {
                $output->writeln('<comment>Downloading CLDR version ' . $version . '...</comment>');
            }

            $response = (new Client())->get("http://unicode.org/Public/cldr/$version/core.zip");
            file_put_contents($zipFile, $response->getBody());
        }

        // Extract CLDR to temporary folder if not exists
        if (! is_readable($CLDR_Directory = __DIR__ . '/_cldr')) {
            if ($output->isVerbose()) {
                $output->writeln('<comment>Extracting CLDR...</comment>');
            }
            $this->extract($zipFile, $CLDR_Directory);
        }

        // Option to export the subdivision (countries/states) to PHP file
        if ($input->getOption('export-subdivisions')) {
            $this->exportSubdivisions($CLDR_Directory, $output);
        }

        // Option to export a list of all locales to PHP file
        if ($input->getOption('build-locales')) {
            $this->buildLocaleList($CLDR_Directory, $output);
        }
    }

    /**
     * Extract the zip file into the given directory.
     *
     * @param string $zipFile
     * @param string $directory
     *
     * @return $this
     */
    protected function extract($zipFile, $directory)
    {
        $archive = new ZipArchive();
        $archive->open($zipFile);
        $archive->extractTo($directory);
        $archive->close();

        return $this;
    }

    /**
     * Renders a list of providers to be used in the README file.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function exportSubdivisions($CLDR_Directory, OutputInterface $output)
    {
        $output->write('<comment>Exporting Subdivisons...</comment>');

        $main = new DOMDocument();
        $main->load($CLDR_Directory . '/common/main/en.xml');

        $subdivisionRow = '';
        foreach ($main->getElementsByTagName("territory") as $subdivison) {
            // Skip entries with an alternative entry
            if ($subdivison->getAttribute('alt')) {
                continue;
            }
            $id = $subdivison->getAttribute('type');
            $subdivisionRow .= str_repeat(' ', 4) . "'$id' => '$subdivison->nodeValue'," . PHP_EOL;
        }


        $main->load($CLDR_Directory . '/common/subdivisions/en.xml');
        foreach ($main->getElementsByTagName("subdivision") as $subdivison) {
            $id = $subdivison->getAttribute('type');
            $subdivisionRow .= str_repeat(' ', 4) . "'$id' => '$subdivison->nodeValue'," . PHP_EOL;
        }

        $template = <<<EOD
<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

// List of possible locales. This list is used in case the 'intl' extension is not loaded/available.
return [
$subdivisionRow
];

EOD;

        // Write results to locales.php file
        file_put_contents(__DIR__ . '/subdivisions.php', $template);

        $output->writeln('<comment> completed.</comment>');
    }

    /**
     * Builds list of all official locales (into PHP file).
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @throws Exception
     */
    private function buildLocaleList($CLDR_Directory, OutputInterface $output)
    {
        // Retrieve the locales from the file list in common/main
        $locales = scandir($src = $CLDR_Directory . '/common/main');
        if ($locales === false) {
            throw new Exception("Failed to retrieve the file list of $src");
        }

        // Sort the found locales alphabetically (ascending)
        sort($locales);

        $localeRow = '';
        $it        = new CachingIterator(new ArrayIterator($locales));
        foreach ($it as $locale) {

            // Filter out all locales that have an unspecified region where the language is used, or some predefined
            // locales that seem not real locales.
            if (in_array($locale, [
                'en-001',
                'en_US_POSIX.xml',
                'yi_001.xml',
                'vo_001.xml',
                'prg_001.xml',
                'eo_001.xml',
                'es_419.xml',
                'en_001.xml',
                'en_150.xml',
                'ar_001.xml'
            ])) {
                continue;
            }

            // Skip locales that have an unspecified region
            if (strpos($locale, '_') === false) {
                continue;
            }

            // Strip extension from name
            $locale = substr($locale, 0, strpos($locale, '.xml'));

            $localeRow .= str_repeat(' ', 4) . "'$locale',";
            if ($it->hasNext()) {
                $localeRow .= PHP_EOL;
            }
        }

        $template = <<<EOD
<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

// List of possible locales. This list is used in case the 'intl' extension is not loaded/available.
return [
$localeRow
];

EOD;
        // Write results to locales.php file
        file_put_contents(__DIR__ . '/../src/Yasumi/data/locales.php', $template);

        $output->writeln('<info>Locales file built successfully.</info>');
    }
}
