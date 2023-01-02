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

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Mecklenburg-Western Pomerania (Germany).
 *
 * Mecklenburg-Vorpommern (also known as Mecklenburg-Western Pomerania in English) is a federated state in northern
 * Germany. The capital city is Schwerin. The state was formed through the merger of the historic regions of Mecklenburg
 * and Vorpommern after the Second World War, dissolved in 1952 and recreated at the time of the German reunification in
 * 1990.
 *
 * @see https://en.wikipedia.org/wiki/Mecklenburg-Vorpommern
 */
class MecklenburgWesternPomerania extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-MV';

    /**
     * Initialize holidays for Mecklenburg-Western Pomerania (Germany).
     *
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
     * For the German state of Mecklenburg-Western Pomerania, Reformation Day was celebrated since 1517.
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
