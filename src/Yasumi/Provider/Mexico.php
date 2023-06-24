<?php

declare(strict_types=1);

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Mexico.
 */
class Mexico extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'MX';

    /**
     * Initialize holidays for Mexico.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Mexico_City';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Additional holidays
        $this->calculateIndependenceDay();
        $this->calculateRevolutionDay();
        $this->calculateConstitutionDay();
        $this->calculateLaborDay();
        $this->calculateBenitoJuarezBirthday();
        $this->calculateDayOfTheDead();
        $this->calculateVirginOfGuadalupe();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Mexico',
        ];
    }

    /**
     * Constitution Day
     *
     * Constitution Day is a national holiday in Mexico that commemorates the anniversary of the promulgation of the Mexican Constitution.
     * It is observed on February 5th.
     *
     * @see https://en.wikipedia.org/wiki/Constitution_of_Mexico
     */
    private function calculateConstitutionDay(): void
    {
        if ($this->year >= 1917) {
            $this->addHoliday(new Holiday(
                'constitutionDay',
                ['es' => 'Día de la Constitución'],
                new \DateTime("{$this->year}-02-05", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Labor Day
     *
     * Labor Day, also known as International Workers' Day, is a public holiday in Mexico that celebrates the achievements of workers.
     * It is observed on May 1st.
     *
     * @see https://en.wikipedia.org/wiki/International_Workers%27_Day
     */
    private function calculateLaborDay(): void
    {
        $this->addHoliday(new Holiday(
            'laborDay',
            ['es' => 'Día del Trabajo'],
            new \DateTime("{$this->year}-05-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Independence Day
     *
     * Independence Day is a national holiday in Mexico that commemorates the anniversary of the country's independence from Spain.
     * It is observed on September 16th.
     *
     * @see https://en.wikipedia.org/wiki/Grito_de_Dolores
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year >= 1810) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['es' => 'Día de la Independencia'],
                new \DateTime("{$this->year}-09-16", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Revolution Day
     *
     * Revolution Day is a national holiday in Mexico that commemorates the anniversary of the Mexican Revolution.
     * It is observed on November 20th.
     *
     * @see https://en.wikipedia.org/wiki/Mexican_Revolution
     */
    private function calculateRevolutionDay(): void
    {
        if ($this->year >= 1910) {
            $this->addHoliday(new Holiday(
                'revolutionDay',
                ['es' => 'Día de la Revolución'],
                new \DateTime("{$this->year}-11-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Benito Juárez's Birthday
     *
     * Benito Juárez's Birthday (Natalicio de Benito Juárez) commemorates the birth of Benito Juárez,
     * a former President of Mexico. It is observed on March 21st.
     */
    private function calculateBenitoJuarezBirthday(): void
    {
        if ($this->year >= 1806) {
            $this->addHoliday(new Holiday(
                'benitoJuarezBirthday',
                ['es' => 'Natalicio de Benito Juárez'],
                new \DateTime("{$this->year}-03-21", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Day of the Dead
     *
     * The Day of the Dead (Día de los Muertos) is a Mexican holiday that honors and remembers
     * deceased loved ones. It is observed on November 2nd.
     */
    private function calculateDayOfTheDead(): void
    {
        if ($this->year >= 1800) {
            $this->addHoliday(new Holiday(
                'dayOfTheDead',
                ['es' => 'Día de los Muertos'],
                new \DateTime("{$this->year}-11-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Virgin of Guadalupe
     *
     * The Virgin of Guadalupe (Día de la Virgen de Guadalupe) is a celebration of the Virgin Mary,
     * who is the patron saint of Mexico. It is observed on December 12th.
     */
    private function calculateVirginOfGuadalupe(): void
    {
        if ($this->year >= 1531) {
            $this->addHoliday(new Holiday(
                'virginOfGuadalupe',
                ['es' => 'Día de la Virgen de Guadalupe'],
                new \DateTime("{$this->year}-12-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
