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

namespace Yasumi\Provider\Spain;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Spain;

/**
 * Provider for all holidays in the Community Of Madrid (Spain).
 *
 * The Community of Madrid is one of the seventeen autonomous communities (regions) of Spain. It is located at the
 * centre of the country, the Iberian Peninsula, and the Castilian Central Plateau (Meseta Central). It is conterminous
 * with the province of Madrid, making it "uniprovincial", or a community with only one province. Its capital is the
 * city of Madrid, which is also the national capital of Spain. It is bounded to the south and east by Castile–La Mancha
 * and to the north and west by Castile and León.
 *
 * @see https://en.wikipedia.org/wiki/Community_of_Madrid
 */
class CommunityOfMadrid extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-MD';

    /**
     * Initialize holidays for the Community Of Madrid (Spain).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateDosdeMayoUprisingDay();
    }

    /**
     * Calculates the day of Dos de Mayo Uprising.
     *
     * The Dos de Mayo of 1808, was a rebellion by the people of Madrid against the occupation of the city by French
     * troops, provoking a brutal repression by the French Imperial forces and triggering the Peninsular War.
     * The 2 May is now a public holiday in the Community of Madrid. The place where the artillery barracks of Monteleón
     * was located is now a square called the Plaza Dos de Mayo, and the district surrounding the square is known as
     * Malasaña in memory of one of the heroines of the revolt, the teenager Manuela Malasaña, who was executed by
     * French troops in the aftermath of the revolt.
     *
     * @see https://en.wikipedia.org/wiki/Dos_de_Mayo_Uprising
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateDosdeMayoUprisingDay(): void
    {
        $this->addHoliday(new Holiday(
            'dosdeMayoUprisingDay',
            ['es' => 'Fiesta de la Comunidad de Madrid'],
            new \DateTime("$this->year-5-2", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
