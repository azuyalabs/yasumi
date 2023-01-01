<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\USA;

use Yasumi\Exception\MissingTranslationException;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;
use Yasumi\Yasumi;

/**
 * Class for testing Veterans Day in the USA.
 */
class VeteransDayTest extends USABaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'veteransDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1919;

    /**
     * Tests Veterans Day on or after 1919. Veterans Day was established in 1919 on November 11.
     *
     * @throws \Exception
     */
    public function testVeteransDayOnAfter1919(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-11-11", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Veterans Day on or after 1919 when substituted on Monday (when Veterans Day falls on Sunday).
     *
     * @throws \Exception
     */
    public function testVeteransDayOnAfter1919SubstitutedMonday(): void
    {
        $year = 2018;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:veteransDay',
            $year,
            new \DateTime("$year-11-12", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Veterans Day on or after 1919 when substituted on Friday (when Veterans Day falls on Saturday).
     *
     * @throws \Exception
     */
    public function testVeteransDayOnAfter1919SubstitutedFriday(): void
    {
        $year = 2017;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:veteransDay',
            $year,
            new \DateTime("$year-11-10", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Veterans Day before 1919. Veterans Day was established in 1919 on November 11.
     *
     * @throws \Exception
     */
    public function testVeteransDayBefore1919(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests name of Veterans Day before 1954. Veterans Day was named 'Armistice Day' before 1954.
     *
     * @throws MissingTranslationException
     */
    public function testVeteransDayNameBefore1954(): void
    {
        try {
            $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1953);
        } catch (\Exception $e) {
        }

        $holidays = Yasumi::create(self::REGION, $year);
        $holiday = $holidays->getHoliday(self::HOLIDAY);
        self::assertEquals('Armistice Day', $holiday->getName());
    }

    /**
     * Tests name of Veterans Day after 1954. Veterans Day was named 'Armistice Day' before 1954.
     *
     * @throws MissingTranslationException
     */
    public function testVeteransDayNameAfter1954(): void
    {
        try {
            $year = $this->generateRandomYear(1954);
        } catch (\Exception $e) {
        }

        $holidays = Yasumi::create(self::REGION, $year);
        $holiday = $holidays->getHoliday(self::HOLIDAY);
        self::assertEquals('Veterans Day', $holiday->getName());
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1954),
            [self::LOCALE => 'Veterans Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
