<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Peru.
 *
 * Peru observes 16 public holidays established by the Decreto Legislativo N° 713
 * (Ley de Descansos Remunerados, Art. 6), as amended through 2023.
 *
 * Per Art. 7 of DL 713, the following holidays are always observed on their
 * canonical date: Año Nuevo, Jueves Santo, Viernes Santo, Día del Trabajo,
 * Fiestas Patrias (28 and 29 July) and Navidad. All other holidays are moved
 * to the following Monday when they fall on a day other than Monday.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Peru
 */
class Peru extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /** Year Peru declared independence (28 July 1821). */
    public const INDEPENDENCE_YEAR = 1821;

    /** Year of the Battle of Junín (6 August 1824). */
    public const BATTLE_OF_JUNIN_YEAR = 1824;

    /** Year of the Battle of Ayacucho (9 December 1824). */
    public const BATTLE_OF_AYACUCHO_YEAR = 1824;

    /** Year of the Battle of Arica and Flag Day (7 June 1880). */
    public const BATTLE_OF_ARICA_YEAR = 1880;

    /** Year of the Battle of Angamos (8 October 1879). */
    public const BATTLE_OF_ANGAMOS_YEAR = 1879;

    /** Year the Peruvian Air Force was established (20 May 1929). */
    public const AIR_FORCE_YEAR = 1929;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
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

        // Fixed holidays (Art. 7 DL 713 — always on canonical date)
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        $this->addIndependenceDay();
        $this->addIndependenceCelebrationDay();

        // Movable holidays (Art. 7 DL 713 — observed on following Monday when not on Monday)
        $this->addBattleOfAricaDay();
        $this->addSaintPeterAndPaulDay();
        $this->addAirForceDay();
        $this->addBattleOfJuninDay();
        $this->addSaintRoseOfLimaDay();
        $this->addBattleOfAngamosDay();
        $this->addAllSaintsDay();
        $this->addImmaculateConceptionDay();
        $this->addBattleOfAyacuchoDay();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Peru',
            'https://cdn.gacetajuridica.com.pe/laley/DECRETO%20LEGISLATIVO%20N%C2%BA%20713.pdf',
            'https://busquedas.elperuano.pe/dispositivo/NL/2187453-1',
            'https://nubecont.com/blog/noticias-tributarias/modificacion-del-decreto-legislativo-713-declaracion-del-23-de-julio-como-feriado-nacional-por-dia-de-la-fuerza-aerea-del-peru',
        ];
    }

    /**
     * Moves a holiday to the following Monday when it does not fall on a Monday.
     *
     * Per Art. 7 of Decreto Legislativo N° 713, certain holidays are observed
     * on the Monday immediately following their canonical date.
     */
    protected function nextMonday(\DateTime $date): \DateTime
    {
        $result = clone $date;
        $dayOfWeek = (int) $result->format('w'); // 0 = Sunday, 1 = Monday

        if (1 !== $dayOfWeek) {
            $daysUntilMonday = (8 - $dayOfWeek) % 7;
            if (0 === $daysUntilMonday) {
                $daysUntilMonday = 7;
            }
            $result->add(new \DateInterval("P{$daysUntilMonday}D"));
        }

        return $result;
    }

    /**
     * Independence Day — 28 July (Día 1 of Fiestas Patrias).
     *
     * Commemorates the Proclamation of Independence on 28 July 1821.
     * Fixed date, not subject to the movable rule.
     *
     * @see https://en.wikipedia.org/wiki/Peruvian_War_of_Independence
     *
     * @throws \Exception
     */
    protected function addIndependenceDay(): void
    {
        if ($this->year >= self::INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['es' => 'Día de la Independencia', 'en' => 'Independence Day'],
                new \DateTime("{$this->year}-07-28", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Independence Celebration Day — 29 July (Día 2 of Fiestas Patrias).
     *
     * The second day of the Fiestas Patrias celebrations, established alongside
     * Independence Day. Fixed date, not subject to the movable rule.
     *
     * @throws \Exception
     */
    protected function addIndependenceCelebrationDay(): void
    {
        if ($this->year >= self::INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday(
                'independenceCelebrationDay',
                ['es' => 'Día de la Gran Parada Militar', 'en' => 'Independence Celebration Day'],
                new \DateTime("{$this->year}-07-29", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Battle of Arica and Flag Day — 7 June (movable).
     *
     * Commemorates the Battle of Arica of 7 June 1880 and the Día de la Bandera.
     * Established as a national holiday by Ley N° 31788 (2023).
     * Observed on the following Monday when not on a Monday.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Arica
     *
     * @throws \Exception
     */
    protected function addBattleOfAricaDay(): void
    {
        if ($this->year >= self::BATTLE_OF_ARICA_YEAR) {
            $date = $this->nextMonday(new \DateTime("{$this->year}-06-07", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'battleOfAricaDay',
                ['es' => 'Batalla de Arica y Día de la Bandera', 'en' => 'Battle of Arica and Flag Day'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Saint Peter and Saint Paul Day — 29 June (movable).
     *
     * Feast of Saints Peter and Paul. Observed on the following Monday
     * when not on a Monday.
     *
     * @throws \Exception
     */
    protected function addSaintPeterAndPaulDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-06-29", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'saintPeterAndPaulDay',
            ['es' => 'San Pedro y San Pablo', 'en' => 'Saint Peter and Saint Paul Day'],
            $date,
            $this->locale
        ));
    }

    /**
     * Air Force Day — 23 July (movable).
     *
     * Commemorates the heroic sacrifice of Captain FAP José Abelardo Quiñones
     * Gonzales on 23 July 1941. Declared a national holiday by Ley N° 31822 (2023).
     * Observed on the following Monday when not on a Monday.
     *
     * @throws \Exception
     */
    protected function addAirForceDay(): void
    {
        if ($this->year >= self::AIR_FORCE_YEAR) {
            $date = $this->nextMonday(new \DateTime("{$this->year}-07-23", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'airForceDay',
                ['es' => 'Día de la Fuerza Aérea del Perú', 'en' => 'Air Force Day'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Battle of Junín — 6 August (movable).
     *
     * Commemorates the Battle of Junín of 6 August 1824. Declared a national
     * holiday by Ley N° 31350 (2022). Observed on the following Monday when
     * not on a Monday.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Jun%C3%ADn
     *
     * @throws \Exception
     */
    protected function addBattleOfJuninDay(): void
    {
        if ($this->year >= self::BATTLE_OF_JUNIN_YEAR) {
            $date = $this->nextMonday(new \DateTime("{$this->year}-08-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'battleOfJuninDay',
                ['es' => 'Batalla de Junín', 'en' => 'Battle of Junín'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Saint Rose of Lima — 30 August (movable).
     *
     * Feast day of Saint Rose of Lima, patroness of Peru and the Americas.
     * Observed on the following Monday when not on a Monday.
     *
     * @see https://en.wikipedia.org/wiki/Rose_of_Lima
     *
     * @throws \Exception
     */
    protected function addSaintRoseOfLimaDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-08-30", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'saintRoseOfLimaDay',
            ['es' => 'Santa Rosa de Lima', 'en' => 'Saint Rose of Lima'],
            $date,
            $this->locale
        ));
    }

    /**
     * Battle of Angamos — 8 October (movable).
     *
     * Commemorates the naval Battle of Angamos of 8 October 1879 during the
     * War of the Pacific. Observed on the following Monday when not on a Monday.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Angamos
     *
     * @throws \Exception
     */
    protected function addBattleOfAngamosDay(): void
    {
        if ($this->year >= self::BATTLE_OF_ANGAMOS_YEAR) {
            $date = $this->nextMonday(new \DateTime("{$this->year}-10-08", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'battleOfAngamosDay',
                ['es' => 'Combate de Angamos', 'en' => 'Battle of Angamos'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * All Saints' Day — 1 November (movable).
     *
     * Observed on the following Monday when not on a Monday.
     *
     * @throws \Exception
     */
    protected function addAllSaintsDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-11-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'allSaintsDay',
            ['es' => 'Día de Todos los Santos'],
            $date,
            $this->locale
        ));
    }

    /**
     * Immaculate Conception — 8 December (movable).
     *
     * Observed on the following Monday when not on a Monday.
     *
     * @throws \Exception
     */
    protected function addImmaculateConceptionDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-12-08", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'immaculateConceptionDay',
            ['es' => 'Inmaculada Concepción', 'en' => 'Immaculate Conception'],
            $date,
            $this->locale
        ));
    }

    /**
     * Battle of Ayacucho — 9 December (movable).
     *
     * Commemorates the decisive Battle of Ayacucho of 9 December 1824 that
     * ended Spanish colonial rule in South America. Observed on the following
     * Monday when not on a Monday.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Ayacucho
     *
     * @throws \Exception
     */
    protected function addBattleOfAyacuchoDay(): void
    {
        if ($this->year >= self::BATTLE_OF_AYACUCHO_YEAR) {
            $date = $this->nextMonday(new \DateTime("{$this->year}-12-09", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'battleOfAyacuchoDay',
                ['es' => 'Batalla de Ayacucho', 'en' => 'Battle of Ayacucho'],
                $date,
                $this->locale
            ));
        }
    }
}
