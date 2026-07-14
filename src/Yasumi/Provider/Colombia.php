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
 * Provider for all holidays in Colombia.
 *
 * Colombia observes 18 public holidays. Ten of them are "Emiliani" holidays:
 * when the canonical date falls on a day other than Monday they are moved
 * to the following Monday (Ley 51 of 1983, known as "Ley Emiliani").
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Colombia
 */
class Colombia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /** Year in which Colombia declared independence from Spain. */
    public const INDEPENDENCE_YEAR = 1810;

    /** Year of the Battle of Boyacá, which secured independence. */
    public const BATTLE_OF_BOYACA_YEAR = 1819;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
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

        // Fixed holidays (always on their canonical date)
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        $this->addIndependenceDay();
        $this->addBattleOfBoyacaDay();

        // Emiliani holidays (moved to the following Monday when not on a Monday)
        $this->addEpiphany();
        $this->addStJosephsDay();
        $this->addAscensionDay();
        $this->addCorpusChristi();
        $this->addSacredHeartDay();
        $this->addSaintsPeterAndPaulDay();
        $this->addAssumptionOfMary();
        $this->addColumbusDay();
        $this->addAllSaintsDay();
        $this->addIndependenceOfCartagenaDay();
        $this->addRosaryOfChiquinquiraDay();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Colombia',
            'https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=4954',
            'https://www.secretariasenado.gov.co/senado/basedoc/ley_0051_1983.html',
            'https://www.dian.gov.co/dian/entidad/Paginas/Calendario-Tributario.aspx',
        ];
    }

    /**
     * Moves a date to the following Monday if it does not already fall on a Monday.
     *
     * This rule is established by Ley 51 of 1983 (Ley Emiliani) and applies to
     * ten specific public holidays in Colombia.
     *
     * @see https://www.secretariasenado.gov.co/senado/basedoc/ley_0051_1983.html
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
     * Epiphany (Emiliani).
     *
     * Known in Colombia as "Día de los Reyes Magos". Observed on the first
     * Monday on or after 6 January.
     *
     * @see https://en.wikipedia.org/wiki/Epiphany_(holiday)
     *
     * @throws \Exception
     */
    protected function addEpiphany(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-01-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'epiphany',
            ['es' => 'Día de los Reyes Magos', 'en' => 'Epiphany'],
            $date,
            $this->locale
        ));
    }

    /**
     * St. Joseph's Day (Emiliani).
     *
     * "Día de San José". Observed on the first Monday on or after 19 March.
     *
     * @throws \Exception
     */
    protected function addStJosephsDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-03-19", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'stJosephsDay',
            ['es' => 'Día de San José'],
            $date,
            $this->locale
        ));
    }

    /**
     * Ascension Day (Emiliani).
     *
     * "Ascensión del Señor". Observed on the Monday following the canonical
     * Thursday (Easter + 39 days).
     *
     * @throws \Exception
     */
    protected function addAscensionDay(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);
        $canonical = (clone $easter)->add(new \DateInterval('P39D'));
        $date = $this->nextMonday(\DateTime::createFromInterface($canonical));

        $this->addHoliday(new Holiday(
            'ascensionDay',
            ['es' => 'Ascensión del Señor', 'en' => 'Ascension Day'],
            $date,
            $this->locale
        ));
    }

    /**
     * Corpus Christi (Emiliani).
     *
     * "Corpus Christi". Observed on the Monday following the canonical
     * Thursday (Easter + 60 days).
     *
     * @throws \Exception
     */
    protected function addCorpusChristi(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);
        $canonical = (clone $easter)->add(new \DateInterval('P60D'));
        $date = $this->nextMonday(\DateTime::createFromInterface($canonical));

        $this->addHoliday(new Holiday(
            'corpusChristi',
            ['es' => 'Corpus Christi', 'en' => 'Corpus Christi'],
            $date,
            $this->locale
        ));
    }

    /**
     * Sacred Heart of Jesus (Emiliani).
     *
     * "Sagrado Corazón de Jesús". Observed on the Monday following the canonical
     * Friday (Easter + 68 days).
     *
     * @throws \Exception
     */
    protected function addSacredHeartDay(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);
        $canonical = (clone $easter)->add(new \DateInterval('P68D'));
        $date = $this->nextMonday(\DateTime::createFromInterface($canonical));

        $this->addHoliday(new Holiday(
            'sacredHeartDay',
            ['es' => 'Sagrado Corazón de Jesús', 'en' => 'Sacred Heart of Jesus'],
            $date,
            $this->locale
        ));
    }

    /**
     * Saints Peter and Paul Day (Emiliani).
     *
     * "San Pedro y San Pablo". Observed on the first Monday on or after 29 June.
     *
     * @throws \Exception
     */
    protected function addSaintsPeterAndPaulDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-06-29", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'saintsPeterAndPaulDay',
            ['es' => 'San Pedro y San Pablo', 'en' => 'Saints Peter and Paul Day'],
            $date,
            $this->locale
        ));
    }

    /**
     * Independence Day.
     *
     * "Día de la Independencia". Commemorates the Declaration of Independence
     * on 20 July 1810. Fixed date, not subject to the Emiliani rule.
     *
     * @see https://en.wikipedia.org/wiki/Colombian_Declaration_of_Independence
     *
     * @throws \Exception
     */
    protected function addIndependenceDay(): void
    {
        if ($this->year >= self::INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['es' => 'Día de la Independencia', 'en' => 'Independence Day'],
                new \DateTime("{$this->year}-07-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Battle of Boyacá Day.
     *
     * "Batalla de Boyacá". Commemorates the decisive battle of 7 August 1819
     * that secured Colombian independence. Fixed date, not subject to the Emiliani rule.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Boyac%C3%A1
     *
     * @throws \Exception
     */
    protected function addBattleOfBoyacaDay(): void
    {
        if ($this->year >= self::BATTLE_OF_BOYACA_YEAR) {
            $this->addHoliday(new Holiday(
                'battleOfBoyacaDay',
                ['es' => 'Batalla de Boyacá', 'en' => 'Battle of Boyacá Day'],
                new \DateTime("{$this->year}-08-07", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Assumption of Mary (Emiliani).
     *
     * "Asunción de la Virgen". Observed on the first Monday on or after 15 August.
     *
     * @throws \Exception
     */
    protected function addAssumptionOfMary(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-08-15", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'assumptionOfMary',
            ['es' => 'Asunción de la Virgen', 'en' => 'Assumption of Mary'],
            $date,
            $this->locale
        ));
    }

    /**
     * Columbus Day / Day of Race (Emiliani).
     *
     * "Día de la Raza". Observed on the first Monday on or after 12 October.
     *
     * @see https://en.wikipedia.org/wiki/Columbus_Day
     *
     * @throws \Exception
     */
    protected function addColumbusDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-10-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'columbusDay',
            ['es' => 'Día de la Raza', 'en' => 'Columbus Day'],
            $date,
            $this->locale
        ));
    }

    /**
     * All Saints' Day (Emiliani).
     *
     * "Día de Todos los Santos". Observed on the first Monday on or after 1 November.
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
     * Independence of Cartagena (Emiliani).
     *
     * "Independencia de Cartagena". Commemorates the independence of Cartagena
     * on 11 November 1811. Observed on the first Monday on or after 11 November.
     *
     * @see https://en.wikipedia.org/wiki/Cartagena,_Colombia#Independence
     *
     * @throws \Exception
     */
    protected function addIndependenceOfCartagenaDay(): void
    {
        $date = $this->nextMonday(new \DateTime("{$this->year}-11-11", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'independenceOfCartagenaDay',
            ['es' => 'Independencia de Cartagena', 'en' => 'Independence of Cartagena'],
            $date,
            $this->locale
        ));
    }

    /**
     * Day of Our Lady of the Rosary of Chiquinquirá (Emiliani).
     *
     * "Día de la Virgen de Chiquinquirá". Established as a national holiday in 2026
     * via Law (Ley de junio 2026). Observed on the first Monday on or after 9 July.
     *
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_Colombia
     * @see https://www.mininterior.gov.co/noticias/gobierno-sanciona-ley-que-convierte-el-9-de-julio-en-nuevo-festivo-nacional/
     *
     * @throws \Exception
     */
    protected function addRosaryOfChiquinquiraDay(): void
    {
        if ($this->year >= 2026) {
            $date = $this->nextMonday(new \DateTime("{$this->year}-07-09", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'rosaryOfChiquinquiraDay',
                ['es' => 'Día de la Virgen de Chiquinquirá', 'en' => 'Day of Our Lady of the Rosary of Chiquinquirá'],
                $date,
                $this->locale
            ));
        }
    }
}
