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
        $this->addHoliday($this->constitutionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->laborDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->independenceDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->revolutionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Additional holidays
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
