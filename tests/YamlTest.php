<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;
use Yasumi\ProviderInterface;
use Yasumi\Yasumi;

/**
 * Class YamlTestCase.
 *
 * Tests holidays against YAML files containing all holidays for specific years.
 */
class YamlTestCase extends TestCase
{
    /**
     * @dataProvider provideProvider
     *
     * @param string $class holiday provider name
     */
    public function testProvider(string $class)
    {
        $dump = !empty(\getenv('DUMP_YAML'));

        foreach (\glob(__DIR__ . '/' . $class . '/*.yaml') as $file) {
            $this->handleProviderLocale($class, $file, $dump);
        }
    }

    /**
     * Provides test data for testProvider().
     */
    public function provideProvider(): array
    {
        return \array_map(function ($class) {
            return [$class];
        }, Yasumi::getProviders());
    }

    /**
     * Handles testing the specified provider against the specified YAML file.
     *
     * @param string $class holiday provider name
     * @param string $file  YAML file containing expected translations
     * @param bool   $dump  whether to update the YAML file
     */
    private function handleProviderLocale(string $class, string $file, bool $dump): void
    {
        $locale = \basename($file, '.yaml');

        $expected = (array) Yaml::parseFile($file, Yaml::PARSE_DATETIME);

        $actual = $this->getActual($class, $locale, $expected);

        if ($dump) {
            $this->dumpYaml($file, $actual);
        } else {
            $this->assertEquals($expected, $actual);
        }
    }

    /**
     * Returns actual data for specified provider class and locale.
     *
     * @param  string $class    holiday provider name
     * @param  string $locale   locale
     * @param  array $expected the expected data from the YAML file
     *
     * @return array actual data that is to be compared against YAML file
     */
    private function getActual(string $class, string $locale, array $expected): array
    {
        $actual = [];

        foreach ($expected as $year => $items) {
            $provider = Yasumi::create($class, $year, $locale);

            $actual[$year] = $this->getActualYear($provider, $items);
        }

        // Sort by year.
        \ksort($actual);

        return $actual;
    }

    /**
     * Returns actual data for a specified provider.
     *
     * @param  ProviderInterface $provider
     * @param  array             $expected the expected data from the YAML file
     *
     * @return array actual data for specified year
     */
    private function getActualYear(ProviderInterface $provider, array $expected): array
    {
        $actual = $this->findYearComments($expected);

        foreach ($provider->getHolidays() as $holiday) {
            $date = $holiday->format('Y-m-d');
            $item = [
                'date' => new \DateTime($holiday->format('Y-m-d'), new \DateTimeZone('UTC')),
                'name' => $holiday->getName(),
                'type' => $holiday->getType(),
            ];

            $item += $this->findItem($expected, $item);

            $actual[] = $item;
        }

        \usort($actual, [__CLASS__, 'sortCallback']);

        return $actual;
    }

    /**
     * Finds items representing comments no related to a specific holiday.
     *
     * @param array $expected array of holiday items
     *
     * @return array all matching items
     */
    private function findYearComments(array $expected): array
    {
        return \array_filter($expected, function ($item) {
            return !isset($item['date']);
        });
    }

    /**
     * Returns matching item from array of items.
     *
     * @param array $haystack array of holiday items
     * @param array $needle   holiday item to look for
     *
     * @return array The matching item, or an empty array
     */
    private function findItem(array $haystack, array $needle): array
    {
        foreach ($haystack as $item) {
            if (($item['date'] ?? null) == $needle['date'] &&
                ($item['name'] ?? null) === $needle['name']
            ) {
                return $item;
            }
        }

        return [];
    }

    /**
     * Sort callback function for sorting holidays within a year.
     */
    private static function sortCallback(array $item1, array $item2): int
    {
        if (isset($item1['date'], $item2['date'])) {
            return $item1['date'] <=> $item2['date'] ?: $item1['name'] <=> $item2['name'];
        } else {
            return isset($item1['date']) <=> isset($item2['date']);
        }
    }

    /**
     * Writes YAML file.
     *
     * @param  string $file     file name to write to
     * @param  array  $expected data to write
     */
    private function dumpYaml(string $file, array $expected): void
    {
        $yaml = Yaml::dump($expected, PHP_INT_MAX, 2);
        $yaml = \str_replace("  -\n    ", "  - ", $yaml);
        $yaml = \str_replace('T00:00:00+00:00', '', $yaml);

        \file_put_contents($file, $yaml);
    }
}
