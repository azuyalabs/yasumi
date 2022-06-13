<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\France;

use DateTime;
use DateTimeZone;
use Exception;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Pentecost Monday in France.
 *
 * Until 2004, Pentecost Monday was an official holiday. Since 2004, the holiday is considered a 'working holiday',
 * imposed by law to be by default on Pentecost Monday. Pentecost Monday is still a holiday (but a working holiday).
 *
 * @see: https://en.wikipedia.org/wiki/Journ%C3%A9e_de_solidarit%C3%A9_envers_les_personnes_%C3%A2g%C3%A9es
 * @see: https://fr.wikipedia.org/w/index.php?title=Journ%C3%A9e_de_solidarit%C3%A9_envers_les_personnes_%C3%A2g%C3%A9es_et_handicap%C3%A9es&tableofcontents=0
 */
class PentecostMondayTest extends FranceBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'pentecostMonday';

    public const EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY = 2004;

    /**
     * Tests Pentecost Monday.
     *
     * @throws Exception
     */
    public function testPentecostMonday(): void
    {
        $year = 1977;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-5-30", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of Pentecost Monday.
     *
     * @throws Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Lundi de Pentecôte']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(null, self::EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY - 1),
            Holiday::TYPE_OFFICIAL
        );

        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY),
            Holiday::TYPE_OBSERVANCE
        );
    }
}
