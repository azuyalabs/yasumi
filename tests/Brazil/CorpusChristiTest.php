<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Dorian Neto <doriansampaioneto@gmail.com>
 */

namespace Yasumi\Tests\Brazil;

use DateTime;
use DateInterval;
use Yasumi\Provider\ChristianHolidays;

/**
 * Class for testing Corpus Christi in the Brazil.
 */
class CorpusChristiTest extends BrazilBaseTestCase
{
    use ChristianHolidays;

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'corpusChristi';

    /**
     * Tests Corpus Christi.
     */
    public function testCorpusChristi()
    {
        $year = 1997;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, 
            $this->calculateEaster($year, self::TIMEZONE)->add(new DateInterval('P60D')));
    }

    /**
     * Tests translated name of Corpus Christi.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pt_BR' => 'Corpus Christi']);
    }
}
