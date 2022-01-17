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

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Trait ChristianHolidays.
 *
 * Trait containing base Christian Western churches calendar based holidays.
 */
trait ChristianHolidays
{
    /**
     * Corpus Christi.
     *
     * The Feast of Corpus Christi (Latin for Body of Christ), also known as Corpus Domini, is a Latin Rite liturgical
     * solemnity celebrating the tradition and belief in the body and blood of Jesus Christ and his Real Presence in the
     * Eucharist. The feast is liturgically celebrated on the Thursday after Trinity Sunday or, "where the Solemnity of
     * The Most Holy Body and Blood of Christ is not a holy day of obligation, it is assigned to the Sunday after the
     * Most Holy Trinity as its proper day". This is 60 days after Easter.
     *
     * @param int    $year     the year for which Corpus Christi need to be created
     * @param string $timezone the timezone in which Corpus Christi is celebrated
     * @param string $locale   the locale for which Corpus Christi need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default a type of 'other' is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function corpusChristi(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OTHER
    ): Holiday {
        return new Holiday(
            'corpusChristi',
            [],
            $this->calculateEaster($year, $timezone)->add(new DateInterval('P60D')),
            $locale,
            $type
        );
    }

    /**
     * All Saints' Day.
     *
     * All Saints' Day, also known as All Hallows, Solemnity of All Saints, or Feast of All Saints is a solemnity
     * celebrated on 1 November by the Catholic Church and various Protestant denominations, and on the first Sunday
     * after Pentecost in Eastern Catholicism and Eastern Orthodoxy, in honour of all the saints, known and unknown.
     * The liturgical celebration begins at Vespers on the evening of 31 October and ends at the close of 1 November.
     *
     * @see https://en.wikipedia.org/wiki/All_Saints%27_Day
     *
     * @param int    $year     the year for which All Saints' Day need to be created
     * @param string $timezone the timezone in which All Saints' Day is celebrated
     * @param string $locale   the locale for which All Saints' Day need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function allSaintsDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday('allSaintsDay', [], new DateTime("$year-11-1", DateTimeZoneFactory::getDateTimeZone($timezone)), $locale, $type);
    }

    /**
     * Day of the Assumption of Mary.
     *
     * The Assumption of the Virgin Mary into Heaven, informally known as the Assumption, was the bodily taking up
     * of the Virgin Mary into Heaven at the end of her earthly life. In the churches that observe it, the
     * Assumption is a major feast day, commonly celebrated on August 15.
     *
     * @see https://en.wikipedia.org/wiki/Assumption_of_Mary
     *
     * @param int    $year     the year for which the day of the Assumption of Mary need to be created
     * @param string $timezone the timezone in which the day of the Assumption of Mary is celebrated
     * @param string $locale   the locale for which the day of the Assumption of Mary need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function assumptionOfMary(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'assumptionOfMary',
            [],
            new DateTime("$year-8-15", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
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
     * @param string $locale   the locale for which Good Friday need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function goodFriday(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'goodFriday',
            [],
            $this->calculateEaster($year, $timezone)->sub(new DateInterval('P2D')),
            $locale,
            $type
        );
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
     * @see https://en.wikipedia.org/wiki/Epiphany_(holiday)
     *
     * @param int    $year     the year for which Epiphany need to be created
     * @param string $timezone the timezone in which Epiphany is celebrated
     * @param string $locale   the locale for which Epiphany need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function epiphany(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday('epiphany', [], new DateTime("$year-1-6", DateTimeZoneFactory::getDateTimeZone($timezone)), $locale, $type);
    }

    /**
     * St. Joseph's Day.
     *
     * Saint Joseph's Day, March 19, the Feast of St. Joseph is in Western Christianity the principal feast day of Saint
     * Joseph, husband of the Blessed Virgin Mary. He is the foster-father of Jesus Christ. March 19 was dedicated to
     * Saint Joseph in several Western calendars by the 10th century, and this custom was established in Rome by 1479.
     * Pope St. Pius V extended its use to the entire Roman Rite by his Apostolic Constitution Quo primum
     * (July 14, 1570). Since 1969, Episcopal Conferences may, if they wish, transfer it to a date outside Lent.
     *
     * @see https://en.wikipedia.org/wiki/St_Joseph's_Day
     *
     * @param int    $year     the year for which St. Joseph's Day need to be created
     * @param string $timezone the timezone in which St. Joseph's Day is celebrated
     * @param string $locale   the locale for which St. Joseph's Day need to be displayed in.
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function stJosephsDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday('stJosephsDay', [], new DateTime("$year-3-19", DateTimeZoneFactory::getDateTimeZone($timezone)), $locale, $type);
    }

    /**
     * St. George's Day.
     *
     * Saint George's Day is the feast day of Saint George. It is celebrated by various Christian Churches and by the
     * several nations, kingdoms, countries, and cities of which Saint George is the patron saint. Saint George's Day is
     * celebrated on 23 April, the traditionally accepted date of Saint George's death in 303 AD. For Eastern Orthodox
     * Churches (which use the Julian calendar), '23 April' currently falls on 6 May of the Gregorian calendar.
     *
     * @see https://en.wikipedia.org/wiki/St_George%27s_Day
     *
     * @param int    $year     the year for which St. George's Day need to be created
     * @param string $timezone the timezone in which St. George's Day is celebrated
     * @param string $locale   the locale for which St. George's Day need to be displayed in.
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function stGeorgesDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday('stGeorgesDay', [], new DateTime("$year-4-23", DateTimeZoneFactory::getDateTimeZone($timezone)), $locale, $type);
    }

    /**
     * Calculate the Easter date for Orthodox churches.
     *
     * @param int    $year     the year for which Easter needs to be calculated
     * @param string $timezone the timezone in which Easter is celebrated
     *
     * @return \DateTime|\DateTimeImmutable date of Orthodox Easter
     *
     * @throws \Exception
     *
     * @see https://en.wikipedia.org/wiki/Computus#Meeus.27s_Julian_algorithm
     * @see https://www.php.net/manual/en/function.easter-date.php#83794
     */
    protected function calculateOrthodoxEaster(int $year, string $timezone): \DateTimeInterface
    {
        $a = $year % 4;
        $b = $year % 7;
        $c = $year % 19;
        $d = (19 * $c + 15) % 30;
        $e = (2 * $a + 4 * $b - $d + 34) % 7;
        $month = floor(($d + $e + 114) / 31);
        $day = (($d + $e + 114) % 31) + 1;

        return (new DateTime("$year-$month-$day", DateTimeZoneFactory::getDateTimeZone($timezone)))->add(new DateInterval('P13D'));
    }

    /**
     * Calculates the day of the reformation.
     *
     * Reformation Day is a religious holiday celebrated on October 31, alongside All Hallows' Eve, in remembrance
     * of the Reformation. It is celebrated among various Protestants, especially by Lutheran and Reformed church
     * communities.
     * It is a civic holiday in the German states of Brandenburg, Mecklenburg-Vorpommern, Saxony, Saxony-Anhalt and
     * Thuringia. Slovenia celebrates it as well due to the profound contribution of the Reformation to that nation's
     * cultural development, although Slovenes are mainly Roman Catholics. With the increasing influence of
     * Protestantism in Latin America (particularly newer groups such as various Evangelical Protestants, Pentecostals
     * or Charismatics), it has been declared a national holiday in Chile in 2009.
     *
     * @see https://en.wikipedia.org/wiki/Reformation_Day
     * @see https://de.wikipedia.org/wiki/Reformationstag#Ursprung_und_Geschichte
     *
     * @param int    $year     the year for which St. John's Day need to be created
     * @param string $timezone the timezone in which St. John's Day is celebrated
     * @param string $locale   the locale for which St. John's Day need to be displayed in.
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function reformationDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'reformationDay',
            [],
            new DateTime("$year-10-31", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Calculates the date for Easter.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st.
     *
     * This function uses the standard PHP 'easter_days' function if the calendar extension is enabled. In case the
     * calendar function is not enabled, a fallback calculation has been implemented that is based on the same
     * 'easter_days' c function.
     *
     * Note: In calendrical calculations, frequently operations called integer division are used.
     *
     * @param int    $year     the year for which Easter needs to be calculated
     * @param string $timezone the timezone in which Easter is celebrated
     *
     * @return \DateTime|\DateTimeImmutable date of Easter
     *
     * @throws \Exception
     *
     * @see  easter_days
     * @see https://github.com/php/php-src/blob/c8aa6f3a9a3d2c114d0c5e0c9fdd0a465dbb54a5/ext/calendar/easter.c
     * @see http://www.gmarts.org/index.php?go=415#EasterMallen
     * @see https://www.tondering.dk/claus/cal/easter.php
     */
    protected function calculateEaster(int $year, string $timezone): \DateTimeInterface
    {
        if (\extension_loaded('calendar')) {
            $easterDays = easter_days($year);
        } else {
            $golden = ($year % 19) + 1; // The Golden Number

            // The Julian calendar applies to the original method from 326AD. The Gregorian calendar was first
            // introduced in October 1582 in Italy. Easter algorithms using the Gregorian calendar apply to years
            // 1583 AD to 4099 (A day adjustment is required in or shortly after 4100 AD).
            // After 1752, most western churches have adopted the current algorithm.
            if ($year <= 1752) {
                $dom = ($year + (int) ($year / 4) + 5) % 7; // The 'Dominical number' - finding a Sunday
                if ($dom < 0) {
                    $dom += 7;
                }

                $pfm = (3 - (11 * $golden) - 7) % 30; // Uncorrected date of the Paschal full moon
            } else {
                $dom = ($year + (int) ($year / 4) - (int) ($year / 100) + (int) ($year / 400)) % 7; // The 'Dominical number' - finding a Sunday
                if ($dom < 0) {
                    $dom += 7;
                }

                $solar = (int) (($year - 1600) / 100) - (int) (($year - 1600) / 400); // The solar correction
                $lunar = (int) (((int) (($year - 1400) / 100) * 8) / 25); // The lunar correction

                $pfm = (3 - (11 * $golden) + $solar - $lunar) % 30; // Uncorrected date of the Paschal full moon
            }

            if ($pfm < 0) {
                $pfm += 30;
            }

            // Corrected date of the Paschal full moon, - days after 21st March
            if ((29 === $pfm) || (28 === $pfm && $golden > 11)) {
                --$pfm;
            }

            $tmp = (4 - $pfm - $dom) % 7;
            if ($tmp < 0) {
                $tmp += 7;
            }

            $easterDays = $pfm + $tmp + 1; // Easter as the number of days after 21st March
        }

        $easter = new DateTime("$year-3-21", DateTimeZoneFactory::getDateTimeZone($timezone));
        $easter->add(new DateInterval('P'.$easterDays.'D'));

        return $easter;
    }

    /**
     * Easter.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @see https://en.wikipedia.org/wiki/Easter
     *
     * @param int    $year     the year for which Easter need to be created
     * @param string $timezone the timezone in which Easter is celebrated
     * @param string $locale   the locale for which Easter need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function easter(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday('easter', [], $this->calculateEaster($year, $timezone), $locale, $type);
    }

    /**
     * Pentecost (Whitsunday).
     *
     * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus
     * Christ. It is celebrated 49 days after Easter and always takes place on Sunday.
     *
     * @param int    $year     the year for which Pentecost need to be created
     * @param string $timezone the timezone in which Pentecost is celebrated
     * @param string $locale   the locale for which Pentecost need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function pentecost(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'pentecost',
            [],
            $this->calculateEaster($year, $timezone)->add(new DateInterval('P49D')),
            $locale,
            $type
        );
    }

    /**
     * Easter Monday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @see https://en.wikipedia.org/wiki/Easter
     *
     * @param int    $year     the year for which Easter Monday need to be created
     * @param string $timezone the timezone in which Easter Monday is celebrated
     * @param string $locale   the locale for which Easter Monday need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function easterMonday(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'easterMonday',
            [],
            $this->calculateEaster($year, $timezone)->add(new DateInterval('P1D')),
            $locale,
            $type
        );
    }

    /**
     * Ascension Day.
     *
     * Ascension Day commemorates the bodily Ascension of Jesus into heaven. It is one of the ecumenical feasts of
     * Christian churches. Ascension Day is traditionally celebrated on a Thursday, the fortieth day of Easter although
     * some Catholic provinces have moved the observance to the following Sunday.
     *
     * @see https://en.wikipedia.org/wiki/Feast_of_the_Ascension
     *
     * @param int    $year     the year for which Ascension need to be created
     * @param string $timezone the timezone in which Ascension is celebrated
     * @param string $locale   the locale for which Ascension need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function ascensionDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'ascensionDay',
            [],
            $this->calculateEaster($year, $timezone)->add(new DateInterval('P39D')),
            $locale,
            $type
        );
    }

    /**
     * Pentecost (Whitmonday).
     *
     * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus
     * Christ. It is celebrated 49 days after Easter and always takes place on Sunday.
     *
     * @param int    $year     the year for which Pentecost (Whitmonday) need to be created
     * @param string $timezone the timezone in which Pentecost (Whitmonday) is celebrated
     * @param string $locale   the locale for which Pentecost (Whitmonday) need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function pentecostMonday(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'pentecostMonday',
            [],
            $this->calculateEaster($year, $timezone)->add(new DateInterval('P50D')),
            $locale,
            $type
        );
    }

    /**
     * Christmas Eve.
     *
     * Christmas Eve refers to the evening or entire day preceding Christmas Day, a widely celebrated festival
     * commemorating the birth of Jesus of Nazareth.[4] Christmas Day is observed around the world, and Christmas Eve is
     * widely observed as a full or partial holiday in anticipation of Christmas Day. Together, both days are considered
     * one of the most culturally significant celebrations in Christendom and Western society.
     *
     * @see https://en.wikipedia.org/wiki/Christmas_Eve
     *
     * @param int    $year     the year for which Christmas Eve needs to be created
     * @param string $timezone the timezone in which Christmas Eve is celebrated
     * @param string $locale   the locale for which Christmas Eve need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default observance is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function christmasEve(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OBSERVANCE
    ): Holiday {
        return new Holiday(
            'christmasEve',
            [],
            new DateTime("$year-12-24", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
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
     * @param string $locale   the locale for which Christmas Day need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function christmasDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'christmasDay',
            [],
            new DateTime("$year-12-25", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Second Christmas Day / Boxing Day.
     *
     * Christmas or Christmas Day (Old English: Crīstesmæsse, meaning "Christ's Mass") is an annual festival
     * commemorating the birth of Jesus Christ, observed most commonly on December 25 as a religious and cultural
     * celebration among billions of people around the world.
     *
     * @param int    $year     the year for which the Second Christmas Day / Boxing Day need to be created
     * @param string $timezone the timezone in which the Second Christmas Day / Boxing Day is celebrated
     * @param string $locale   the locale for which the Second Christmas Day / Boxing Day need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function secondChristmasDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'secondChristmasDay',
            [],
            new DateTime("$year-12-26", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Ash Wednesday.
     *
     * Ash Wednesday, a day of fasting, is the first day of Lent in Western Christianity. It occurs 46 days (40 fasting
     * days, if the 6 Sundays, which are not days of fast, are excluded) before Easter and can fall as early as 4
     * February or as late as 10 March.
     *
     * @see https://en.wikipedia.org/wiki/Ash_Wednesday
     *
     * @param int    $year     the year for which Ash Wednesday need to be created
     * @param string $timezone the timezone in which Ash Wednesday is celebrated
     * @param string $locale   the locale for which Ash Wednesday need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function ashWednesday(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'ashWednesday',
            [],
            $this->calculateEaster($year, $timezone)->sub(new DateInterval('P46D')),
            $locale,
            $type
        );
    }

    /**
     * Immaculate Conception.
     *
     * The Feast of the Immaculate Conception celebrates the solemn belief in the Immaculate Conception of the Blessed
     * Virgin Mary. It is universally celebrated on December 8, nine months before the feast of the Nativity of Mary,
     * which is celebrated on September 8. It is one of the most important Marian feasts celebrated in the liturgical
     * calendar of the Roman Catholic Church.
     *
     * @see https://en.wikipedia.org/wiki/Feast_of_the_Immaculate_Conception
     *
     * @param int    $year     the year for which Immaculate Conception need to be created
     * @param string $timezone the timezone in which Immaculate Conception is celebrated
     * @param string $locale   the locale for which Immaculate Conception need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function immaculateConception(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'immaculateConception',
            [],
            new DateTime("$year-12-8", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * St. Stephen's Day.
     *
     * St. Stephen's Day, or the Feast of St. Stephen, is a Christian saint's day to commemorate Saint Stephen, the
     * first Christian martyr or protomartyr, celebrated on 26 December in the Western Church and 27 December in the
     * Eastern Church. Many Eastern Orthodox churches adhere to the Julian calendar and mark St. Stephen's Day on 27
     * December according to that calendar, which places it on 8 January of the Gregorian calendar used in secular
     * contexts.
     *
     * @see https://en.wikipedia.org/wiki/St._Stephen%27s_Day
     *
     * @param int    $year     the year for which St. Stephen's Day need to be created
     * @param string $timezone the timezone in which St. Stephen's Day is celebrated
     * @param string $locale   the locale for which St. Stephen's Day need to be displayed in.
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function stStephensDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'stStephensDay',
            [],
            new DateTime("$year-12-26", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Maundy Thursday.
     *
     * Maundy Thursday (also known as Holy Thursday, Covenant Thursday, Great and Holy Thursday, Sheer Thursday, and
     * Thursday of Mysteries) is the Christian holy day falling on the Thursday before Easter. It commemorates the
     * Maundy and Last Supper of Jesus Christ with the Apostles as described in the Canonical gospels. It is the fifth
     * day of Holy Week, and is preceded by Holy Wednesday and followed by Good Friday.
     *
     * @see https://en.wikipedia.org/wiki/Maundy_Thursday
     *
     * @param int    $year     the year for which Maundy Thursday need to be created
     * @param string $timezone the timezone in which Maundy Thursday is celebrated
     * @param string $locale   the locale for which Maundy Thursday need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function maundyThursday(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'maundyThursday',
            [],
            $this->calculateEaster($year, $timezone)->sub(new DateInterval('P3D')),
            $locale,
            $type
        );
    }

    /**
     * St. John's Day.
     *
     * The Nativity of John the Baptist (or Birth of John the Baptist, or Nativity of the Forerunner) is a Christian
     * feast day celebrating the birth of John the Baptist, a prophet who foretold the coming of the Messiah in the
     * person of Jesus, whom he later baptised. The Nativity of John the Baptist on June 24 comes three months after the
     * celebration on March 25 of the Annunciation, when the angel Gabriel told Mary that her cousin Elizabeth was in
     * her sixth month of pregnancy.
     *
     * @see https://en.wikipedia.org/wiki/Nativity_of_St_John_the_Baptist
     *
     * @param int    $year     the year for which St. John's Day need to be created
     * @param string $timezone the timezone in which St. John's Day is celebrated
     * @param string $locale   the locale for which St. John's Day need to be displayed in.
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function stJohnsDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday('stJohnsDay', [], new DateTime("$year-06-24", DateTimeZoneFactory::getDateTimeZone($timezone)), $locale, $type);
    }

    /**
     * Annunciation.
     *
     * The Annunciation, also referred to as the Annunciation to the Blessed Virgin Mary, the Annunciation of Our
     * Lady or the Annunciation of the Lord, is the Christian celebration of the announcement by the angel Gabriel to
     * the Virgin Mary that she would conceive and become the mother of Jesus, the Son of God, marking his Incarnation.
     * Many Christians observe this event with the Feast of the Annunciation on 25 March, an approximation of the
     * northern vernal equinox nine full months before Christmas, the ceremonial birthday of Jesus.
     *
     * @see https://en.wikipedia.org/wiki/Annunciation
     *
     * @param int    $year     the year for which the Annunciation needs to be created
     * @param string $timezone the timezone in which the Annunciation is celebrated
     * @param string $locale   the locale for which the Annunciation need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function annunciation(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'annunciation',
            [],
            new DateTime("$year-03-25", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }
}
