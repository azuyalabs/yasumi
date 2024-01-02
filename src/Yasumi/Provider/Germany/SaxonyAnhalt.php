<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Saxony-Anhalt (Germany).
 *
 * Saxony-Anhalt (German: Sachsen-Anhalt) is a landlocked federal state of Germany surrounded by the federal states of
 * Lower Saxony, Brandenburg, Saxony and Thuringia. Its capital is Magdeburg and its largest city is Halle (Saale).
 * Saxony-Anhalt covers an area of 20,447.7 square kilometres (7,894.9 sq mi)[4] and has a population of 2.34 million.
 *
 * @see https://en.wikipedia.org/wiki/Saxony-Anhalt
 */
class SaxonyAnhalt extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-ST';

    /**
     * Initialize holidays for Saxony-Anhalt (Germany).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->calculateReformationDay();
    }

    /**
     * For the German state of Saxony-Anhalt, Reformation Day was celebrated since 1517.
     * Note: In 2017 all German states will celebrate Reformation Day for its 500th anniversary.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateReformationDay(): void
    {
        if ($this->year < 1517) {
            return;
        }

        $this->addHoliday($this->reformationDay($this->year, $this->timezone, $this->locale));
    }
}
