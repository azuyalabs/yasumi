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

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Lower Saxony (Germany).
 *
 * Lower Saxony (German: Niedersachsen) is a German state (Bundesland) situated in northwestern Germany and is second
 * in area, with 47,624 square kilometres (18,388 sq mi), and fourth in population (8 million) among the sixteen Länder
 * of Germany. In rural areas Northern Low Saxon, a dialect of Low German, and Saterland Frisian, a variety of Frisian,
 * are still spoken, but the number of speakers is declining.
 *
 * @see https://en.wikipedia.org/wiki/Lower_Saxony
 */
class LowerSaxony extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-NI';

    /**
     * Initialize holidays for Lower Saxony (Germany).
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
        $this->calculateReformationDay();
    }

    /**
     * For the German state of Lower Saxony, Reformation Day is celebrated since 2018.
     * Note: In 2017 all German states will celebrate Reformation Day for its 500th anniversary.
     *
     * @see https://www.zeit.de/gesellschaft/zeitgeschehen/2018-06/reformationstag-niedersachsen-neuer-feiertag
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateReformationDay(): void
    {
        if ($this->year < 2018) {
            return;
        }
        $this->addHoliday($this->reformationDay($this->year, $this->timezone, $this->locale));
    }
}
