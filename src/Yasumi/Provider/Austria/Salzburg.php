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

namespace Yasumi\Provider\Austria;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Austria;

/**
 * Provider for all holidays in Salzburg (Austria).
 *
 * @see https://en.wikipedia.org/wiki/Salzburg_(state)
 */
class Salzburg extends Austria
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AT-5';

    /**
     * Initialize holidays for Salzburg (Austria).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom holidays.
        $this->calculateStRupertsDay();
    }

    /**
     * Saint Rupert's Day.
     *
     * Rupert of Salzburg was Bishop of Worms as well as the first Bishop of
     * Salzburg and abbot of St. Peter's in Salzburg. He was a contemporary of
     * the Frankish king Childebert III and is venerated as a saint in the
     * Roman Catholic and Eastern Orthodox Churches. Rupert is also patron
     * saint of the Austrian state of Salzburg. His feast day in Austria is
     * September 24 (since 710).
     *
     * @see https://en.wikipedia.org/wiki/Rupert_of_Salzburg
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStRupertsDay(): void
    {
        if ($this->year < 710) {
            return;
        }

        $this->addHoliday(new Holiday(
            'stRupertsDay',
            [],
            new DateTime($this->year.'-9-24', new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
