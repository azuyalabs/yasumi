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
 * Provider for all holidays in Carinthia (Austria).
 *
 * @see https://en.wikipedia.org/wiki/Carinthia
 */
class Carinthia extends Austria
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AT-2';

    /**
     * Initialize holidays for Carinthia (Austria).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Common holidays.
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale));
        $this->calculatePlebisciteDay();
    }

    /**
     * Plebiscite Day.
     *
     * The Carinthian plebiscite was held on 10 October 1920 in the area
     * predominantly settled by Carinthian Slovenes. It determined the final
     * southern border between the Republic of Austria and the newly formed
     * Kingdom of Serbs, Croats and Slovenes (Yugoslavia) after World War I.
     *
     * @see https://en.wikipedia.org/wiki/1920_Carinthian_plebiscite
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculatePlebisciteDay(): void
    {
        if ($this->year < 1920) {
            return;
        }

        $this->addHoliday(new Holiday(
            'plebisciteDay',
            [],
            new \DateTime($this->year.'-10-10', new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
