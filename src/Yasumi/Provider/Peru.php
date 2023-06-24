<?php

declare(strict_types=1);

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Peru.
 */
class Peru extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'PE';

    /**
     * Initialize holidays for Peru.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Lima';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Additional holidays
        $this->calculateIndependenceDay();
        $this->calculateLaborDay();
        $this->calculateBattleOfAngamos();
        $this->calculateAllSaintsDay();
        $this->calculateImmaculateConception();
        $this->calculateDayOfTheCombatants();
        $this->calculateTeachersDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Peru',
        ];
    }

    /**
     * Labor Day
     *
     * Labor Day is a public holiday in Peru that celebrates the achievements of workers.
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
     * Independence Day is a national holiday in Peru that commemorates the anniversary of the country's independence from Spain.
     * It is observed on July 28th and 29th.
     *
     * @see https://en.wikipedia.org/wiki/Peruvian_War_of_Independence
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year >= 1821) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['es' => 'Día de la Independencia'],
                new \DateTime("{$this->year}-07-28", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['es' => 'Celebración Día de la Independencia'],
                new \DateTime("{$this->year}-07-29", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Battle of Angamos
     *
     * The Battle of Angamos is a public holiday in Peru that commemorates the Battle of Angamos,
     * which was a key battle in the War of the Pacific.
     * It is observed on October 8th.
     */
    private function calculateBattleOfAngamos(): void
    {
        if ($this->year >= 1879) {
            $this->addHoliday(new Holiday(
                'battleOfAngamos',
                ['es' => 'Combate de Angamos'],
                new \DateTime("{$this->year}-10-08", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * All Saints' Day
     *
     * All Saints' Day is a Christian solemnity celebrated to honor all the saints, known and unknown.
     * It is observed on November 1st.
     */
    private function calculateAllSaintsDay(): void
    {
        if ($this->year >= 1753) {
            $this->addHoliday(new Holiday(
                'allSaintsDay',
                ['es' => 'Día de Todos los Santos'],
                new \DateTime("{$this->year}-11-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Immaculate Conception
     *
     * The Feast of the Immaculate Conception celebrates the belief in the Immaculate Conception of the Virgin Mary.
     * It is observed on December 8th.
     */
    private function calculateImmaculateConception(): void
    {
        if ($this->year >= 1753) {
            $this->addHoliday(new Holiday(
                'immaculateConception',
                ['es' => 'Día de la Inmaculada Concepción'],
                new \DateTime("{$this->year}-12-08", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Day of the Combatants
     *
     * The Day of the Combatants (Día del Combate) commemorates the Battle of Arica during the War of the Pacific.
     * It is observed on June 7th.
     */
    private function calculateDayOfTheCombatants(): void
    {
        if ($this->year >= 1880) {
            $this->addHoliday(new Holiday(
                'dayOfTheCombatants',
                ['es' => 'Día del Combate'],
                new \DateTime("{$this->year}-06-07", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Teachers' Day
     *
     * Teachers' Day (Día del Maestro) is a day to honor and appreciate teachers in Peru.
     * It is observed on July 6th.
     */
    private function calculateTeachersDay(): void
    {
        if ($this->year >= 1953) {
            $this->addHoliday(new Holiday(
                'teachersDay',
                ['es' => 'Día del Maestro'],
                new \DateTime("{$this->year}-07-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
