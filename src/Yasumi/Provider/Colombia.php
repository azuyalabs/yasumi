<?php

declare(strict_types=1);

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Colombia.
 */
class Colombia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CO';

    /**
     * Initialize holidays for Colombia.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Bogota';

        // Add common holidays
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Add custom Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        
        // Calculate other holidays
        $this->calculateEpiphany();
        $this->calculateIndependenceOfCartagena();
        $this->calculateIndependenceDay();
        $this->calculateLabourDay();
        $this->calculateAscensionDay();
        $this->calculateCorpusChristi();
        $this->calculateSacredHeart();
        $this->calculateBattleOfBoyaca();
        $this->calculateDiscoveryOfAmerica();
        $this->calculateAllSaintsDay();
        $this->calculateImmaculateConception();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Colombia',
        ];
    }

    /*
     * Independence Day.
     *
     * The Independence Day is a national holiday of Colombia celebrated on July 20th. The date commemorates the
     * declaration of independence of Colombia from Spain on July 20th, 1810.
     *
     * @see https://en.wikipedia.org/wiki/Colombian_Declaration_of_Independence
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year >= 1810) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['es' => 'Día de la Independencia de Colombia'],
                new \DateTime("{$this->year}-07-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
    
    /*
     * Epiphany.
     *
     * The Epiphany, also known as Three Kings' Day, is a Christian feast day that celebrates the revelation of God in
     * human form in the person of Jesus Christ. It is observed on January 6th.
     */
    private function calculateEpiphany(): void
    {
        if ($this->year >= 1753) {
            $this->addHoliday(new Holiday(
                'epiphany',
                ['es' => 'Día de Reyes'],
                new \DateTime("{$this->year}-01-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Labour Day.
     *
     * Labour Day, also known as International Workers' Day, is a day to celebrate the achievements of workers.
     * It is observed on May 1st.
     */
    private function calculateLabourDay(): void
    {
        if ($this->year >= 1900) {
            $this->addHoliday(new Holiday(
                'labourDay',
                ['es' => 'Día del Trabajo'],
                new \DateTime("{$this->year}-05-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Ascension Day.
     *
     * Ascension Day commemorates Jesus Christ's ascension to heaven after his resurrection.
     * It is observed 40 days after Easter.
     */
    private function calculateAscensionDay(): void
    {
        if ($this->year >= 1753) {
            $easter = $this->calculateEaster($this->year, $this->timezone);
            $date = $easter->add(new \DateInterval('P40D'));
            $this->addHoliday(new Holiday(
                'ascensionDay',
                ['es' => 'Día de la Ascensión'],
                $date,
                $this->locale
            ));
        }
    }

    /*
     * Corpus Christi.
     *
     * Corpus Christi is a Christian feast that celebrates the presence of the body and blood of Jesus Christ
     * in the Eucharist. It is observed on the Thursday after Trinity Sunday, which is 60 days after Easter.
     */
    private function calculateCorpusChristi(): void
    {
        if ($this->year >= 1753) {
            $easter = $this->calculateEaster($this->year, $this->timezone);
            $date = $easter->add(new \DateInterval('P60D'));
            $this->addHoliday(new Holiday(
                'corpusChristi',
                ['es' => 'Corpus Christi'],
                $date,
                $this->locale
            ));
        }
    }

    /*
     * Sacred Heart.
     *
     * The Feast of the Most Sacred Heart of Jesus is a solemnity in the liturgical calendar of the Roman Catholic Church.
     * It is celebrated on the Friday after the octave of Corpus Christi, which is 68 days after Easter.
     */
    private function calculateSacredHeart(): void
    {
        if ($this->year >= 1753) {
            $easter = $this->calculateEaster($this->year, $this->timezone);
            $date = $easter->add(new \DateInterval('P68D'));
            $this->addHoliday(new Holiday(
                'sacredHeart',
                ['es' => 'Sagrado Corazón'],
                $date,
                $this->locale
            ));
        }
    }

    /*
     * Battle of Boyaca.
     *
     * The Battle of Boyaca is a public holiday in Colombia that commemorates the Battle of Boyaca,
     * which was a key battle in the wars of independence of Colombia.
     * It is observed on August 7th.
     */
    private function calculateBattleOfBoyaca(): void
    {
        if ($this->year >= 1819) {
            $this->addHoliday(new Holiday(
                'battleOfBoyaca',
                ['es' => 'Batalla de Boyacá'],
                new \DateTime("{$this->year}-08-07", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * Discovery of America.
     *
     * Discovery of America Day commemorates Christopher Columbus' arrival in the Americas on October 12, 1492.
     * It is observed on October 12th.
     */
    private function calculateDiscoveryOfAmerica(): void
    {
        if ($this->year >= 1492) {
            $this->addHoliday(new Holiday(
                'discoveryOfAmerica',
                ['es' => 'Día de la Raza'],
                new \DateTime("{$this->year}-10-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
     * All Saints' Day.
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

    /**
     * Independence Day Cartagena.
     *
     * Independence Day of Cartagena is a national holiday that commemorates the independence of Colombia from Spain.
     * It is observed on November 11th.
     */
    private function calculateIndependenceOfCartagena(): void
    {
        $this->addHoliday(new Holiday(
            'independenceOfCartagena',
            ['es' => 'Independencia de Cartagena'],
            new \DateTime("{$this->year}-11-11", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /*
     * Immaculate Conception.
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
}
