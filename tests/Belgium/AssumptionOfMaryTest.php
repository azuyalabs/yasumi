<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Belgium;

use DateTime;

/**
 * Class for testing the day of the Assumption of Mary in Belgium.
 *
 * The Assumption of the Virgin Mary into Heaven, informally known as the Assumption, was the bodily taking up of the
 * Virgin Mary into Heaven at the end of her earthly life. In the churches that observe it, the Assumption is a major
 * feast day, commonly celebrated on August 15.
 */
class AssumptionOfMaryTest extends BelgiumBaseTestCase
{
    /**
     * Tests the day of the Assumption of Mary.
     *
     * @dataProvider AssumptionOfMaryDataProvider
     *
     * @param int      $year     the year for which the day of the Assumption of Mary needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testAssumptionOfMary($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'assumptionOfMary', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of the day of the Assumption of Mary.
     *
     * @return array list of test dates for the day of the Assumption of Mary
     */
    public function AssumptionOfMaryDataProvider()
    {
        return $this->generateRandomDates(8, 15, self::TIMEZONE);
    }
}
