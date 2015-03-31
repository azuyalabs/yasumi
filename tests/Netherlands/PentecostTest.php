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
 * Class for testing Pentecost.
 *
 * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus Christ.
 * It is celebrated 49 days after Easter and always takes place on Sunday.
 */
class PentecostTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Pentecost.
     */
    public function testPentecost()
    {
        $year = 2020;
        $this->assertHoliday(self::COUNTRY, 'pentecost', $year,
            new DateTime("$year-5-31", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Pentecost Monday.
     */
    public function testPentecostMonday()
    {
        $year = 2020;
        $this->assertHoliday(self::COUNTRY, 'pentecostMonday', $year,
            new DateTime("$year-6-1", new DateTimeZone(self::TIMEZONE)));
    }
}
