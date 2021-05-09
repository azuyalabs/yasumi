<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider\Spain;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Spain;

/**
 * Provider for all holidays in the Valencian Community (Spain).
 *
 * The Valencian Community is the constitution of the Valencian Country as an autonomous community of Spain. It is the
 * fourth most populated after Andalusia, Catalonia and Madrid with more than 5.1 million inhabitants. It is often
 * homonymously identified with its capital València, which is the third largest city of Spain. It is located along the
 * Mediterranean coast in the south-east of the Iberian peninsula. It borders with Catalonia to the north, Aragon and
 * Castile–La Mancha to the west, and Murcia to the south. It is formed by the provinces of Castelló, València and
 * Alacant.
 *
 * @see https://en.wikipedia.org/wiki/Valencian_Community
 */
class ValencianCommunity extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-VC';

    /**
     * Initialize holidays for the Valencian Community (Spain).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateValencianCommunityDay();
    }

    /**
     * Calculates the Day of the Valencian Community.
     *
     * The Day of the Valencian Community (Día de la Comunidad Valenciana) marks the anniversary of King James I of
     * Aragon's capture of the city of Valencia from Moorish forces in 1238. It is also the Day of Saint Dionysius,
     * a traditional festival for lovers.
     *
     * The Valencian Community is an autonomous community on the eastern coast of Spain. It has land borders with the
     * autonomous communities of Catalonia, Aragon, Castile-La Mancha, and Mercia. The Balearic Islands are close by in
     * the Mediterranean. The Valencia region gained some autonomy in 1977 and full autonomy in 1982.
     *
     * @see https://www.timeanddate.com/holidays/spain/the-valencian-community-day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateValencianCommunityDay(): void
    {
        if ($this->year >= 1239) {
            $this->addHoliday(new Holiday(
                'valencianCommunityDay',
                [
                    'ca' => 'Diada Nacional del País Valencià',
                    'es' => 'Día de la Comunidad Valenciana',
                ],
                new DateTime("$this->year-10-9", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
