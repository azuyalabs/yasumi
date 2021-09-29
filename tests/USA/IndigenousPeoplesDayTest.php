<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Cameron Macfarlane <cammac1984@gmail.com>
 */

namespace Yasumi\tests\USA;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Indigenous Peoples' Day in the USA.
 */
class IndigenousPeoplesDayTest extends USABaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'indigenousPeoplesDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1992;

    /**
     * Tests Indigenous Peoples' Day on or after 2014. Indigenous Peoples' Day was established in 1992 on October 11th, but has been fixed to
     * the second Monday in October since 2014.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIndigenousPeoplesDayOnAfter2014(): void
    {
        $year = $this->generateRandomYear(2014);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("second monday of october $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Indigenous Peoples' Day between 1992 and 2013. Indigenous Peoples' Day was established in 1992 on October 11th, but has been
     * fixed to the second Monday in October since 2014.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIndigenousPeoplesDayBetween1992And2013(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2013);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-10-12", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Indigenous Peoples' Day before 1992. Indigenous Peoples' Day was established in 1992 on October 11th, but has been fixed to
     * the second Monday in October since 2014.
     *
     * @throws ReflectionException
     */
    public function testIndigenousPeoplesDayBefore1992(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Indigenous Peoples\' Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws ReflectionException
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

