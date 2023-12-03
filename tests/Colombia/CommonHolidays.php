<?php

declare(strict_types=1);

namespace Yasumi\Provider;

/**
 * Trait for common holidays in Colombia.
 */
trait CommonHolidays
{
    use ChristianHolidays;

    /*
     * New Year's Day
     *
     * New Year's Day is a public holiday in Colombia that celebrates the beginning of the new year.
     * It is observed on January 1st.
     */
    private function newYearsDay(int $year, string $timezone, string $locale): Holiday
    {
        return new Holiday(
            'newYearsDay',
            ['es' => 'Año Nuevo'],
            new \DateTime("{$year}-01-01", new \DateTimeZone($timezone)),
            $locale
        );
    }

    /*
     * Independence Day
     *
     * Independence Day is a national holiday in Colombia that commemorates the independence of Colombia from Spain.
     * It is observed on July 20th.
     */
    private function independenceDay(int $year, string $timezone, string $locale): Holiday
    {
        return new Holiday(
            'independenceDay',
            ['es' => 'Día de la Independencia'],
            new \DateTime("{$year}-07-20", new \DateTimeZone($timezone)),
            $locale
        );
    }

    /*
     * Christmas Day
     *
     * Christmas Day is a public holiday in Colombia that celebrates the birth of Jesus Christ.
     * It is observed on December 25th.
     */
    private function christmasDay(int $year, string $timezone, string $locale): Holiday
    {
        return new Holiday(
            'christmasDay',
            ['es' => 'Navidad'],
            new \DateTime("{$year}-12-25", new \DateTimeZone($timezone)),
            $locale
        );
    }
}
