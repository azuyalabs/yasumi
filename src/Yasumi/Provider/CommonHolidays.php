<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Trait CommonHolidays.
 *
 * Trait containing commonly known holidays that are celebrated in all / many countries in the world.
 */
trait CommonHolidays
{
    /**
     * New Year's Day.
     *
     * New Year's Day is observed on January 1, the first day of the year on the modern Gregorian calendar as well as
     * the Julian calendar. As a date in the Gregorian calendar of Christendom, New Year's Day liturgically marked the
     * Feast of the Circumcision of Christ, and is still observed as such in the Anglican Church and Lutheran Church.
     * In present day, with most countries now using the Gregorian calendar as their de facto calendar, New Year's Day
     * is probably the most celebrated public holiday, often observed with fireworks at the stroke of midnight as the
     * new year starts in each time zone.
     *
     * @link http://en.wikipedia.org/wiki/New_Year%27s_Day Source: Wikipedia.
     *
     * @param int    $year     the year for which New Year's Day need to be created
     * @param string $timezone the timezone in which New Year's Day is celebrated
     * @param string $locale   the locale for which New Year's Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function newYearsDay($year, $timezone, $locale)
    {
        return new Holiday('newYearsDay', [], new DateTime("$year-1-1", new DateTimeZone($timezone)), $locale);
    }

    /**
     * International Workers' Day.
     *
     * International Workers' Day, also known as Labour Day in some places, is a celebration of laborers and the working
     * classes that is promoted by the international labor movement, Anarchists, Socialists, and Communists and occurs
     * every year on May Day, 1 May, an ancient European spring holiday. 1 May was chosen as the date for International
     * Workers' Day by the Socialists and Communists of the Second International to commemorate the Haymarket affair in
     * Chicago that occurred on 4 May, 1886.
     *
     * @link http://en.wikipedia.org/wiki/International_Workers%27_Day Source: Wikipedia.
     *
     * @param int    $year     the year for which International Workers' Day need to be created
     * @param string $timezone the timezone in which International Workers' Day is celebrated
     * @param string $locale   the locale for which International Workers' Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function internationalWorkersDay($year, $timezone, $locale)
    {
        return new Holiday('internationalWorkersDay', [], new DateTime("$year-5-1", new DateTimeZone($timezone)),
            $locale);
    }

    /**
     * Valentine's Day
     *
     * Valentine's Day, also known as Saint Valentine's Day or the Feast of Saint Valentine, is a celebration observed
     * on February 14 each year. It is celebrated in many countries around the world, although it is not a public
     * holiday in most of them. In 18th-century England, it evolved into an occasion in which lovers expressed their
     * love for each other by presenting flowers, offering confectionery, and sending greeting cards (known as
     * "valentines").
     *
     * @link http://en.wikipedia.org/wiki/Valentine%27s_Day Source: Wikipedia.
     *
     * @param int    $year     the year for which Valentine's Day need to be created
     * @param string $timezone the timezone in which Valentine's Day is celebrated
     * @param string $locale   the locale for which Valentine's Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function valentinesDay($year, $timezone, $locale)
    {
        return new Holiday('valentinesDay', [], new DateTime("$year-2-14", new DateTimeZone($timezone)), $locale);
    }

    /**
     * World Animal Day
     *
     * World Animal Day is an international day of action for animal rights and welfare celebrated annually on October
     * 4, the Feast Day of St Francis of Assisi, the patron saint of animals. It started in 1931 at a convention of
     * ecologists in Florence, Italy who wished to highlight the plight of endangered species.
     *
     * @link http://en.wikipedia.org/wiki/World_Animal_Day Source: Wikipedia.
     *
     * @param int    $year     the year for which World Animal Day need to be created
     * @param string $timezone the timezone in which World Animal Day is celebrated
     * @param string $locale   the locale for which World Animal Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function worldAnimalDay($year, $timezone, $locale)
    {
        return new Holiday('worldAnimalDay', [], new DateTime("$year-10-4", new DateTimeZone($timezone)), $locale);
    }

    /**
     * St. Martin's Day.
     *
     * St. Martin's Day, also known as the Feast of St. Martin, Martinstag or Martinmas, the Feast of St Martin of Tours
     * or Martin le Miséricordieux, is a time for feasting celebrations. This is the time when autumn wheat seeding was
     * completed, and the annual slaughter of fattened cattle produced "Martinmas beef". Historically, hiring fairs were
     * held where farm laborers would seek new posts. November 11 is the feast day of St. Martin of Tours, who started
     * out as a Roman soldier.
     *
     * @link http://en.wikipedia.org/wiki/St._Martin%27s_Day Source: Wikipedia.
     *
     * @param int    $year     the year for which St. Martin's Day need to be created
     * @param string $timezone the timezone in which St. Martin's Day is celebrated
     * @param string $locale   the locale for which St. Martin's Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function stMartinsDay($year, $timezone, $locale)
    {
        return new Holiday('stMartinsDay', [], new DateTime("$year-11-11", new DateTimeZone($timezone)), $locale);
    }

    /**
     * Father's Day.
     *
     * Father's Day is a celebration honoring fathers and celebrating fatherhood, paternal bonds, and the influence of
     * fathers in society. Many countries celebrate it on the third Sunday of June, though it is also celebrated widely
     * on other days by many other countries. Father's Day was created to complement Mother's Day, a celebration that
     * honors mothers and motherhood.
     *
     * @link http://en.wikipedia.org/wiki/Father%27s_Day Source: Wikipedia.
     *
     * @param int    $year     the year for which Father's Day need to be created
     * @param string $timezone the timezone in which Father's Day is celebrated
     * @param string $locale   the locale for which Father's Day need to be displayed in.
     *
     * @return \Yasumi\Holiday
     */
    public function fathersDay($year, $timezone, $locale)
    {
        return new Holiday('fathersDay', [], new DateTime("third sunday of june $year", new DateTimeZone($timezone)),
            $locale);
    }
}