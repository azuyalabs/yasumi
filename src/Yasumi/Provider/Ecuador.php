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
 * Provider for all holidays in Ecuador.
 *
 * Ecuador observes 11 national holidays established by Article 65 of the
 * Código del Trabajo and the Ley Orgánica Reformatoria a la Ley Orgánica del
 * Servicio Público y al Código del Trabajo (R.O. Suplemento No. 906,
 * 20 December 2016).
 *
 * Transfer rules (Reforma 2016):
 * - Tuesday  → previous Monday
 * - Wednesday, Thursday, Saturday → following Friday
 * - Sunday   → following Monday
 * - Monday or Friday: no transfer
 *
 * Exceptions — never transferred:
 * - 1 January (Año Nuevo)
 * - Carnival Tuesday (always falls on Tuesday by definition)
 * - 25 December (Navidad)
 * Good Friday is movable by Easter and is never subject to further transfer.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Ecuador
 */
class Ecuador extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /** Year Ecuador declared the First Cry of Independence (10 August 1809). */
    public const FIRST_CRY_OF_INDEPENDENCE_YEAR = 1809;

    /** Year of the Battle of Pichincha (24 May 1822). */
    public const BATTLE_OF_PICHINCHA_YEAR = 1822;

    /** Year of the Independence of Guayaquil (9 October 1820). */
    public const INDEPENDENCE_OF_GUAYAQUIL_YEAR = 1820;

    /** Year of the Independence of Cuenca (3 November 1820). */
    public const INDEPENDENCE_OF_CUENCA_YEAR = 1820;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
     */
    public const ID = 'EC';

    /**
     * Initialize holidays for Ecuador.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Guayaquil';

        // Fixed holidays — never transferred
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Good Friday — Easter-relative, no additional transfer rule
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));

        // Carnival — Monday and Tuesday before Ash Wednesday (Easter − 48 and − 47 days)
        $this->addCarnivalHolidays();

        // Transferable national holidays
        $this->addInternationalWorkersDay();
        $this->addBattleOfPichinchaDay();
        $this->addFirstCryOfIndependenceDay();
        $this->addIndependenceOfGuayaquilDay();
        $this->addDayOfTheDeadDay();
        $this->addIndependenceOfCuencaDay();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Ecuador',
            'https://www.ccq.ec/wp-content/uploads/2017/06/Consulta-Laboral-Diciembre-2016.pdf',
            'https://boletincontable.com/2016/12/21/ley-organica-reformatoria-a-la-ley-organica-del-servicio-publico-y-al-codigo-del-trabajo/',
            'https://www.turismo.gob.ec/wp-content/uploads/2025/08/Calendario-feriados-nacionales-2025-2030.pdf',
        ];
    }

    /**
     * Applies the Ecuadorian transfer rule (Reforma 2016, Art. 65 CT).
     *
     * - Tuesday  → previous Monday
     * - Wednesday, Thursday, Saturday → following Friday
     * - Sunday   → following Monday
     * - Monday or Friday: unchanged
     */
    protected function applyTransferRule(\DateTime $date): \DateTime
    {
        $result = clone $date;
        $dayOfWeek = (int) $result->format('w'); // 0=Sun, 1=Mon … 6=Sat

        switch ($dayOfWeek) {
            case 2: // Tuesday → Monday
                $result->sub(new \DateInterval('P1D'));
                break;
            case 3: // Wednesday → Friday
                $result->add(new \DateInterval('P2D'));
                break;
            case 4: // Thursday → Friday
                $result->add(new \DateInterval('P1D'));
                break;
            case 6: // Saturday → Friday
                $result->sub(new \DateInterval('P1D'));
                break;
            case 0: // Sunday → Monday
                $result->add(new \DateInterval('P1D'));
                break;
        }

        return $result;
    }

    /**
     * Carnival Monday and Carnival Tuesday.
     *
     * Carnival falls on the Monday and Tuesday immediately before Ash Wednesday
     * (Easter − 48 and − 47 days respectively). Carnival Monday may be subject
     * to the standard transfer rule, but since it always falls on a Monday by
     * definition, no transfer occurs. Carnival Tuesday is explicitly exempt from
     * the transfer rule.
     *
     * @throws \Exception
     */
    protected function addCarnivalHolidays(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);

        $carnivalMonday = (clone $easter)->sub(new \DateInterval('P48D'));

        if (! $carnivalMonday instanceof \DateTime) {
            throw new \RuntimeException(sprintf('unable to perform a date subtraction for %s:carnivalMonday', self::class));
        }

        $this->addHoliday(new Holiday(
            'carnavalMonday',
            ['es' => 'Lunes de Carnaval', 'en' => 'Carnival Monday'],
            $carnivalMonday,
            $this->locale
        ));

        $carnivalTuesday = (clone $easter)->sub(new \DateInterval('P47D'));

        if (! $carnivalTuesday instanceof \DateTime) {
            throw new \RuntimeException(sprintf('unable to perform a date subtraction for %s:carnivalTuesday', self::class));
        }

        $this->addHoliday(new Holiday(
            'carnavalTuesday',
            ['es' => 'Martes de Carnaval', 'en' => 'Carnival Tuesday'],
            $carnivalTuesday,
            $this->locale
        ));
    }

    /**
     * International Workers' Day — 1 May (transferable).
     *
     * @throws \Exception
     */
    protected function addInternationalWorkersDay(): void
    {
        $date = $this->applyTransferRule(new \DateTime("{$this->year}-05-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'internationalWorkersDay',
            [],
            $date,
            $this->locale
        ));
    }

    /**
     * Battle of Pichincha — 24 May (transferable).
     *
     * Commemorates the Battle of Pichincha on 24 May 1822, which secured
     * Ecuador's independence from Spain.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Pichincha
     *
     * @throws \Exception
     */
    protected function addBattleOfPichinchaDay(): void
    {
        if ($this->year >= self::BATTLE_OF_PICHINCHA_YEAR) {
            $date = $this->applyTransferRule(new \DateTime("{$this->year}-05-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'battleOfPichinchaDay',
                ['es' => 'Batalla del Pichincha', 'en' => 'Battle of Pichincha'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * First Cry of Independence — 10 August (transferable).
     *
     * Commemorates the Primer Grito de Independencia of 10 August 1809,
     * the first declaration of independence in Spanish-speaking South America.
     *
     * @see https://en.wikipedia.org/wiki/Primer_Grito_de_Independencia_(Ecuador)
     *
     * @throws \Exception
     */
    protected function addFirstCryOfIndependenceDay(): void
    {
        if ($this->year >= self::FIRST_CRY_OF_INDEPENDENCE_YEAR) {
            $date = $this->applyTransferRule(new \DateTime("{$this->year}-08-10", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'firstCryOfIndependenceDay',
                ['es' => 'Primer Grito de Independencia', 'en' => 'First Cry of Independence'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Independence of Guayaquil — 9 October (transferable).
     *
     * Commemorates the Independence of Guayaquil on 9 October 1820.
     *
     * @see https://en.wikipedia.org/wiki/Independence_of_Guayaquil
     *
     * @throws \Exception
     */
    protected function addIndependenceOfGuayaquilDay(): void
    {
        if ($this->year >= self::INDEPENDENCE_OF_GUAYAQUIL_YEAR) {
            $date = $this->applyTransferRule(new \DateTime("{$this->year}-10-09", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'independenceOfGuayaquilDay',
                ['es' => 'Independencia de Guayaquil', 'en' => 'Independence of Guayaquil'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Day of the Dead — 2 November (transferable).
     *
     * All Souls' Day, commemorating the faithful departed.
     *
     * @throws \Exception
     */
    protected function addDayOfTheDeadDay(): void
    {
        $date = $this->applyTransferRule(new \DateTime("{$this->year}-11-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

        $this->addHoliday(new Holiday(
            'dayOfTheDead',
            ['es' => 'Día de Difuntos', 'en' => 'Day of the Dead'],
            $date,
            $this->locale
        ));
    }

    /**
     * Independence of Cuenca — 3 November (transferable).
     *
     * Commemorates the Independence of Cuenca on 3 November 1820.
     *
     * @see https://en.wikipedia.org/wiki/Cuenca,_Ecuador
     *
     * @throws \Exception
     */
    protected function addIndependenceOfCuencaDay(): void
    {
        if ($this->year >= self::INDEPENDENCE_OF_CUENCA_YEAR) {
            $date = $this->applyTransferRule(new \DateTime("{$this->year}-11-03", DateTimeZoneFactory::getDateTimeZone($this->timezone)));

            $this->addHoliday(new Holiday(
                'independenceOfCuencaDay',
                ['es' => 'Independencia de Cuenca', 'en' => 'Independence of Cuenca'],
                $date,
                $this->locale
            ));
        }
    }
}
