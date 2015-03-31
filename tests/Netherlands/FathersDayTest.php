<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Yasumi\Tests\Netherlands\NetherlandsBaseTestCase;

/**
 * Class for testing Father's Day.
 *
 * Father's Day is a celebration honoring fathers and celebrating fatherhood, paternal bonds, and the influence of
 * fathers in society. In the Netherlands, Father's Day (Dutch: Vaderdag) is celebrated on the third Sunday of June and
 * is not a public holiday.
 */
class FathersDayTest extends NetherlandsBaseTestCase
{

    /**
     * Tests Father's Day.
     */
    public function testFathersDay()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::COUNTRY, 'fathersDay', $year,
            new DateTime("third sunday of june $year", new DateTimeZone(self::TIMEZONE)));
    }


}
