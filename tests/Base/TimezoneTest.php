<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use Yasumi\Provider\AbstractProvider;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class TimezoneTest.
 *
 * Verifies that holiday providers only use canonical timezone identifiers. PHP keeps a second set of
 * identifiers (e.g. 'Europe/Kiev', 'Australia/ACT') around as links for backward compatibility only, and
 * their use is discouraged. Depending on how PHP was compiled and which tzdata is present on the host
 * system, these links may be absent altogether, resulting in a "Unknown or bad timezone" error.
 *
 * @see https://www.php.net/manual/en/timezones.others.php
 * @see https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
 */
class TimezoneTest extends TestCase
{
    use YasumiBase;

    /**
     * @param string $class    the provider
     * @param string $timezone the timezone identifier used by the provider
     * @param string $source   where the timezone identifier originates from
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('timezoneProvider')]
    public function testTimezoneIsCanonical(string $class, string $timezone, string $source): void
    {
        self::assertTrue(
            \in_array($timezone, \DateTimeZone::listIdentifiers(), true),
            sprintf(
                'Provider "%s" uses timezone "%s" (%s). PHP only lists this identifier for backward '
                . 'compatibility purposes and its use is discouraged; use its canonical name instead.',
                $class,
                $timezone,
                $source
            )
        );
    }

    /**
     * Provides test data for testTimezoneIsCanonical().
     *
     * @return array<string, array{string, string, string}> list of timezone identifiers per provider
     *
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function timezoneProvider(): array
    {
        $tests = [];

        foreach (Yasumi::getProviders() as $class) {
            $provider = Yasumi::create($class, static::generateRandomYear());

            /** @var string $declared */
            $declared = (new \ReflectionProperty(AbstractProvider::class, 'timezone'))->getValue($provider);

            $timezones = [$declared => 'declared timezone'];

            foreach ($provider->getHolidays() as $holiday) {
                $timezone = $holiday->getTimezone();

                if (false === $timezone) {
                    continue;
                }

                $timezones[$timezone->getName()] ??= sprintf('holiday "%s"', $holiday->getKey());
            }

            foreach ($timezones as $timezone => $source) {
                $tests["{$class} - {$timezone}"] = [$class, (string) $timezone, $source];
            }
        }

        return $tests;
    }
}
