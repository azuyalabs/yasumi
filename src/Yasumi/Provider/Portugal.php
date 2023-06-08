<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
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
 * Holidays for Portugal.
 */
class Portugal extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'PT';

    /**
     * Initialize holidays for Portugal.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Lisbon';

        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->calculateCarnationRevolutionDay();
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->calculateCorpusChristi();
        $this->calculatePortugalDay();
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->calculatePortugueseRepublicDay();
        $this->calculateAllSaintsDay();
        $this->calculateRestorationOfIndependenceDay();
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Portugal',
            'https://pt.wikipedia.org/wiki/Feriados_em_Portugal',
        ];
    }

    /**
     * Carnation Revolution (25th of April 1974) / Revolução dos Cravos (25 de Abril 1974).
     *
     * The Carnation Revolution (Portuguese: Revolução dos Cravos), also referred to as the 25 April (Portuguese: 25 de
     * Abril), was initially a military coup in Lisbon, Portugal, on 25 April 1974 which overthrew the regime of the
     * Estado Novo. The revolution started as a military coup organized by the Armed Forces Movement (Portuguese:
     * Movimento das Forças Armadas, MFA) composed of military officers who opposed the regime, but the movement was
     * soon coupled with an unanticipated and popular campaign of civil resistance. This movement would lead to the
     * fall of the Estado Novo and the withdrawal of Portugal from its African colonies and East Timor. The name
     * "Carnation Revolution" comes from the fact that almost no shots were fired and when the population took to the
     * streets to celebrate the end of the dictatorship and war in the colonies, carnations were put into the muzzles
     * of rifles and on the uniforms of the army men. In Portugal, the 25th of April is a national holiday, known as
     * Freedom Day (Portuguese: Dia da Liberdade), to celebrate the event.
     *
     * @see https://en.wikipedia.org/wiki/Carnation_Revolution
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateCarnationRevolutionDay(): void
    {
        if ($this->year >= 1974) {
            $this->addHoliday(new Holiday(
                '25thApril',
                ['pt' => 'Dia da Liberdade'],
                new \DateTime("$this->year-04-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OFFICIAL
            ));
        }
    }

    /**
     * In Portugal, between 2013 andd 2015 (inclusive) this holiday did not happen due to government deliberation.
     * It was restored in 2016.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateCorpusChristi(): void
    {
        if ($this->year <= 2012 || $this->year >= 2016) {
            $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
        }
    }

    /**
     * Day of Portugal, Camões and the Portuguese Communities / Dia de Portugal, de Camões e das Comunidades Portuguesas.
     *
     * The Wikipedia article mentions that this holiday changed names during the Portuguese dictatorship that ran
     * between 1933 and 1974 (ended with the Carnation Revolution). This is the name that is currently standing.
     *
     * Portugal Day, officially Day of Portugal, Camões, and the Portuguese Communities (Portuguese: Dia de Portugal,
     * de Camões e das Comunidades Portuguesas), is Portugal's National Day celebrated annually on 10 June. Although
     * officially observed only in Portugal, Portuguese citizens and emigrants throughout the world celebrate this
     * holiday. The date commemorates the death of national literary icon Luís de Camões on 10 June 1580.
     *
     * @see https://en.wikipedia.org/wiki/Portugal_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculatePortugalDay(): void
    {
        if ($this->year <= 1932 || $this->year >= 1974) {
            $this->addHoliday(new Holiday(
                'portugalDay',
                ['pt' => 'Dia de Portugal'],
                new \DateTime("$this->year-06-10", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Establishment of the Portuguese Republic / Implantação da República Portuguesa.
     *
     * The establishment of the Portuguese Republic was the result of a coup d'état organised by the Portuguese
     * Republican Party which, on 5 October 1910, deposed the constitutional monarchy and established a republican
     * regime in Portugal. The subjugation of the country to British colonial interests, the royal family's
     * expenses, the power of the Church, the political and social instability, the system of alternating power of the
     * two political parties (Progressive and Regenerador), João Franco's dictatorship, an apparent inability to adapt
     * to modern times – all contributed to an unrelenting erosion of the Portuguese monarchy. The proponents of the
     * republic, particularly the Republican Party, found ways to take advantage of the situation. The Republican Party
     * presented itself as the only one that had a programme that was capable of returning to the country its lost
     * status and place Portugal on the way of progress.
     *
     * The holiday was revoked in 2013 due to government deliberation. It was restored in 2016.
     *
     * @see https://en.wikipedia.org/wiki/5_October_1910_revolution
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculatePortugueseRepublicDay(): void
    {
        if (($this->year >= 1910 && $this->year <= 2012) || $this->year >= 2016) {
            $this->addHoliday(new Holiday(
                'portugueseRepublic',
                ['pt' => 'Implantação da República Portuguesa'],
                new \DateTime("$this->year-10-05", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * In Portugal, between 2013 and 2015 (inclusive) this holiday did not happen due to government deliberation.
     * It was restored in 2016.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateAllSaintsDay(): void
    {
        if ($this->year <= 2012 || $this->year >= 2016) {
            $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        }
    }

    /**
     * Restoration of Independence / Reguesstauração da Independência.
     *
     * There is no Wikipedia article referencing this holiday directly so we are using the War that motivated the
     * holiday instead until we can find something better.
     *
     * The Portuguese Restoration War (Portuguese: Guerra da Restauração; Spanish: Guerra de Restauración portuguesa)
     * was the name given by nineteenth-century 'romantic' historians to the war between Portugal and Spain that began
     * with the Portuguese revolution of 1640 and ended with the Treaty of Lisbon in 1668. The revolution of 1640 ended
     * the 60-year rule of Portugal by the Spanish Habsburgs. The period from 1640 to 1668 was marked by periodic
     * skirmishes between Portugal and Spain, as well as short episodes of more serious warfare, much of it occasioned
     * by Spanish and Portuguese entanglements with non-Iberian powers. Spain was involved in the Thirty Years' War
     * until 1648 and the Franco–Spanish War until 1659, while Portugal was involved in the Dutch–Portuguese War until
     * 1663. In the seventeenth century and afterwards, this period of sporadic conflict was simply known, in Portugal
     * and elsewhere, as the Acclamation War. The war established the House of Braganza as Portugal's new ruling
     * dynasty, replacing the House of Habsburg. This ended the so-called Iberian Union.
     *
     * The holiday was revoked in 2013 due to government deliberation. It was restored in 2016.
     *
     * @see https://pt.wikipedia.org/wiki/Restauração_da_Independência (portuguese link)
     * @see https://pt.wikipedia.org/wiki/Guerra_da_Restauração (english link)
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateRestorationOfIndependenceDay(): void
    {
        // The Wikipedia article mentions that this has been a holiday since the second of half of the XIX century.
        if (($this->year >= 1850 && $this->year <= 2012) || $this->year >= 2016) {
            $this->addHoliday(new Holiday(
                'restorationOfIndependence',
                ['pt' => 'Restauração da Independência'],
                new \DateTime("$this->year-12-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OFFICIAL
            ));
        }
    }
}
