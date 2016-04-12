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

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Trait ChristianHolidaysJulianCalendar
 *
 * Trait containing common holidays that are celebrated in christian environments for julian calendar.
 */
trait ChristianHolidaysJulianCalendar
{
    use ChristianHolidays;

    /**
     * {@inheritdoc}
     */
    public function christmasEve($year, $timezone, $locale, $type = Holiday::TYPE_OBSERVANCE)
    {
        return new Holiday('christmasEve', [], new DateTime("$year-01-06", new DateTimeZone($timezone)), $locale,
            $type);
    }

    /**
     * {@inheritdoc}
     */
    public function christmasDay($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('christmasDay', [], new DateTime("$year-01-07", new DateTimeZone($timezone)), $locale,
            $type);
    }

    /**
     * {@inheritdoc}
     */
    public function secondChristmasDay($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('secondChristmasDay', [], new DateTime("$year-01-08", new DateTimeZone($timezone)), $locale,
            $type);
    }

    /**
     * {@inheritdoc}
     */
    public function allSaintsDay($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('allSaintsDay', [], $this->calculateEaster($year, $timezone)->add(new DateInterval('P56D')),
            $locale, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function assumptionOfMary($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('assumptionOfMary', [], new DateTime("$year-8-28", new DateTimeZone($timezone)), $locale,
            $type);
    }

    /**
     * {@inheritdoc}
     */
    public function epiphany($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('epiphany', [], new DateTime("$year-1-19", new DateTimeZone($timezone)), $locale, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function stStephensDay($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('stStephensDay', [], new DateTime("$year-01-09", new DateTimeZone($timezone)), $locale,
            $type);
    }

    /**
     * {@inheritdoc}
     */
    public function stGeorgesDay($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('stGeorgesDay', [], new DateTime("$year-5-06", new DateTimeZone($timezone)), $locale, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function stJohnsDay($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('stJohnsDay', [], new DateTime("$year-07-07", new DateTimeZone($timezone)), $locale, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function annunciation($year, $timezone, $locale, $type = Holiday::TYPE_NATIONAL)
    {
        return new Holiday('annunciation', [], new DateTime("$year-04-07", new DateTimeZone($timezone)), $locale, $type);
    }

    /**
     * {@inheritdoc}
     */
    protected function calculateEaster($year, $timezone)
    {
        $a     = $year % 4;
        $b     = $year % 7;
        $c     = $year % 19;
        $d     = (19 * $c + 15) % 30;
        $e     = (2 * $a + 4 * $b - $d + 34) % 7;
        $month = floor(($d + $e + 114) / 31);
        $day   = (($d + $e + 114) % 31) + 1;

        $easter = new DateTime(date("M-d-Y", mktime(0, 0, 0, $month, $day + 13, $year)), new DateTimeZone($timezone));

        return $easter;
    }
}
