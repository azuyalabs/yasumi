<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com> *
 */
namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Trait ChristianHolidays.
 *
 * Trait containing common holidays that are celebrated in christian environments.
 */
trait ChristianHolidays
{
    /**
     * Easter.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @link http://en.wikipedia.org/wiki/Easter Source: Wikipedia.
     *
     * @param int    $year     the year for which Easter need to be created
     * @param string $timezone the timezone in which Easter is celebrated
     * @param string $locale   the locale for which Easter need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function easter($year, $timezone, $locale)
    {
        return new Holiday('easter', [], $easter = $this->calculateEaster($year, $timezone), $locale);
    }

    /**
     * Calculates the date for Easter.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st.
     *
     * This function uses the standard PHP 'easter_days'.
     *
     * @see easter_days
     *
     * @param int    $year     the year for which Easter needs to be calculated
     * @param string $timezone the timezone in which Easter is celebrated
     *
     * @return \DateTime date of Easter
     */
    protected function calculateEaster($year, $timezone)
    {
        $easter = new DateTime("$year-3-21", new DateTimeZone($timezone));
        $easter->add(new DateInterval('P' . \easter_days($year) . 'D'));

        return $easter;
    }

    /**
     * Easter Monday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @link http://en.wikipedia.org/wiki/Easter Source: Wikipedia.
     *
     * @param int    $year     the year for which Easter Monday need to be created
     * @param string $timezone the timezone in which Easter Monday is celebrated
     * @param string $locale   the locale for which Easter Monday need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function easterMonday($year, $timezone, $locale)
    {
        return new Holiday('easterMonday', [], $this->calculateEaster($year, $timezone)->add(new DateInterval('P1D')),
            $locale);
    }

    /**
     * Ascension Day.
     *
     * Ascension Day commemorates the bodily Ascension of Jesus into heaven. It is one of the ecumenical feasts of
     * Christian churches. Ascension Day is traditionally celebrated on a Thursday, the fortieth day of Easter although
     * some Catholic provinces have moved the observance to the following Sunday.
     *
     * @link http://en.wikipedia.org/wiki/Feast_of_the_Ascension Source: Wikipedia.
     *
     * @param int    $year     the year for which Ascension need to be created
     * @param string $timezone the timezone in which Ascension is celebrated
     * @param string $locale   the locale for which Ascension need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function ascensionDay($year, $timezone, $locale)
    {
        return new Holiday('ascensionDay', [], $this->calculateEaster($year, $timezone)->add(new DateInterval('P39D')),
            $locale);
    }

    /**
     * Pentecost (Whitsunday).
     *
     * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus
     * Christ. It is celebrated 49 days after Easter and always takes place on Sunday.
     *
     * @param int    $year     the year for which Pentecost need to be created
     * @param string $timezone the timezone in which Pentecost is celebrated
     * @param string $locale   the locale for which Pentecost need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function pentecost($year, $timezone, $locale)
    {
        return new Holiday('pentecost', [], $this->calculateEaster($year, $timezone)->add(new DateInterval('P49D')),
            $locale);
    }

    /**
     * Pentecost (Whitmonday).
     *
     * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus
     * Christ. It is celebrated 49 days after Easter and always takes place on Sunday.
     *
     * @param int    $year     the year for which Pentecost (Whitmonday) need to be created
     * @param string $timezone the timezone in which Pentecost (Whitmonday) is celebrated
     * @param string $locale   the locale for which Pentecost (Whitmonday) need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function pentecostMonday($year, $timezone, $locale)
    {
        return new Holiday('pentecostMonday', [],
            $this->calculateEaster($year, $timezone)->add(new DateInterval('P50D')), $locale);
    }

    /**
     * Christmas Day.
     *
     * Christmas or Christmas Day (Old English: Crīstesmæsse, meaning "Christ's Mass") is an annual festival
     * commemorating the birth of Jesus Christ, observed most commonly on December 25 as a religious and cultural
     * celebration among billions of people around the world.
     *
     * @param int    $year     the year for which Christmas Day need to be created
     * @param string $timezone the timezone in which Christmas Day is celebrated
     * @param string $locale   the locale for which Christmas Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function christmasDay($year, $timezone, $locale)
    {
        return new Holiday('christmasDay', [], new DateTime("$year-12-25", new DateTimeZone($timezone)), $locale);
    }

    /**
     * Second Christmas Day / Boxing Day
     *
     * Christmas or Christmas Day (Old English: Crīstesmæsse, meaning "Christ's Mass") is an annual festival
     * commemorating the birth of Jesus Christ, observed most commonly on December 25 as a religious and cultural
     * celebration among billions of people around the world.
     *
     * @param int    $year     the year for which the Second Christmas Day / Boxing Day need to be created
     * @param string $timezone the timezone in which the Second Christmas Day / Boxing Day is celebrated
     * @param string $locale   the locale for which the Second Christmas Day / Boxing Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function secondChristmasDay($year, $timezone, $locale)
    {
        return new Holiday('secondChristmasDay', [], new DateTime("$year-12-26", new DateTimeZone($timezone)), $locale);
    }

    /**
     * All Saints' Day.
     *
     * All Saints' Day, also known as All Hallows, Solemnity of All Saints, or Feast of All Saints is a solemnity
     * celebrated on 1 November by the Catholic Church and various Protestant denominations in honour of all the saints.
     *
     * @param int    $year     the year for which All Saints' Day need to be created
     * @param string $timezone the timezone in which All Saints' Day is celebrated
     * @param string $locale   the locale for which All Saints' Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function allSaintsDay($year, $timezone, $locale)
    {
        return new Holiday('allSaintsDay', [], new DateTime("$year-11-1", new DateTimeZone($timezone)), $locale);
    }

    /**
     * Day of the Assumption of Mary.
     *
     * The Assumption of the Virgin Mary into Heaven, informally known as the Assumption, was the bodily taking up
     * of the Virgin Mary into Heaven at the end of her earthly life. In the churches that observe it, the
     * Assumption is a major feast day, commonly celebrated on August 15.
     *
     * @param int    $year     the year for which the day of the Assumption of Mary need to be created
     * @param string $timezone the timezone in which the day of the Assumption of Mary is celebrated
     * @param string $locale   the locale for which the day of the Assumption of Mary need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function assumptionOfMary($year, $timezone, $locale)
    {
        return new Holiday('assumptionOfMary', [], new DateTime("$year-8-15", new DateTimeZone($timezone)), $locale);
    }

    /**
     * Good Friday.
     *
     * Good Friday is a Christian religious holiday commemorating the crucifixion of Jesus Christ and his death at
     * Calvary. The holiday is observed during Holy Week as part of the Paschal Triduum on the Friday preceding Easter
     * Sunday, and may coincide with the Jewish observance of Passover.
     *
     * @param int    $year     the year for which Good Friday need to be created
     * @param string $timezone the timezone in which Good Friday is celebrated
     * @param string $locale   the locale for which Good Friday need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function goodFriday($year, $timezone, $locale)
    {
        return new Holiday('goodFriday', [], $this->calculateEaster($year, $timezone)->sub(new DateInterval('P2D')),
            $locale);
    }

    /**
     * Epiphany.
     *
     * Epiphany is a Christian feast day that celebrates the revelation of God the Son as a human being in Jesus Christ.
     * The traditional date for the feast is January 6. However, since 1970, the celebration is held in some countries
     * on the Sunday after January 1. Eastern Churches following the Julian Calendar observe the Theophany feast on what
     * for most countries is January 19 because of the 13-day difference today between that calendar and the generally
     * used Gregorian calendar.
     *
     * @link http://en.wikipedia.org/wiki/Epiphany_(holiday) Source: Wikipedia.
     *
     * @param int    $year     the year for which Epiphany need to be created
     * @param string $timezone the timezone in which Epiphany is celebrated
     * @param string $locale   the locale for which Epiphany need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function epiphany($year, $timezone, $locale)
    {
        return new Holiday('epiphany', [], new DateTime("$year-1-6", new DateTimeZone($timezone)), $locale);
    }

    /**
     * Ash Wednesday.
     *
     * Ash Wednesday, a day of fasting, is the first day of Lent in Western Christianity. It occurs 46 days (40 fasting
     * days, if the 6 Sundays, which are not days of fast, are excluded) before Easter and can fall as early as 4
     * February or as late as 10 March.
     *
     * @link http://en.wikipedia.org/wiki/Ash_Wednesday Source: Wikipedia.
     *
     * @param int    $year     the year for which Ash Wednesday need to be created
     * @param string $timezone the timezone in which Ash Wednesday is celebrated
     * @param string $locale   the locale for which Ash Wednesday need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function ashWednesday($year, $timezone, $locale)
    {
        return new Holiday('ashWednesday', [], $this->calculateEaster($year, $timezone)->sub(new DateInterval('P46D')),
            $locale);
    }
}