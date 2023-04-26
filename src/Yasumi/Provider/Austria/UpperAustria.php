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

namespace Yasumi\Provider\Austria;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Austria;

/**
 * Provider for all holidays in Upper Austria (Austria).
 *
 * @see https://en.wikipedia.org/wiki/Upper_Austria
 */
class UpperAustria extends Austria
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AT-4';

    /**
     * Initialize holidays for Upper Austria (Austria).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom holidays.
        $this->calculateStFloriansDay();
    }

    /**
     * Saint Florian's Day.
     *
     * St. Florian was born around 250 AD in the ancient Roman city of Aelium
     * Cetium, present-day Sankt Pölten, Austria. He joined the Roman Army and
     * advanced in the ranks, rising to commander of the imperial army in the
     * Roman province of Noricum. In addition to his military duties, he was
     * also responsible for organizing and leading firefighting brigades.
     * Florian organized and trained an elite group of soldiers whose sole duty
     * was to fight fires. His feast day is May 4 (since 304).
     *
     * @see https://en.wikipedia.org/wiki/Saint_Florian
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStFloriansDay(): void
    {
        if ($this->year < 304) {
            return;
        }

        $this->addHoliday(new Holiday(
            'stFloriansDay',
            [],
            new \DateTime($this->year.'-5-4', new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
