<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Hamburg (Germany).
 *
 * Hamburg, officially Freie und Hansestadt Hamburg (Free and Hanseatic City of Hamburg), is the second largest city in
 * Germany and the eighth largest city in the European Union. It is the second smallest German state by area. Its
 * population is over 1.7 million people, and the Hamburg Metropolitan Region (including parts of the neighbouring
 * Federal States of Lower Saxony and Schleswig-Holstein) has more than 5 million inhabitants.
 *
 * @link https://en.wikipedia.org/wiki/Hamburg
 */
class Hamburg extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-HH';

    /**
     * Initialize holidays for Schleswig-Holstein (Germany).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateDayOfReformation();
    }

    /**
     * Since 2018 Hamburg celebrates the "Day of Reformation".
     * It is not called "Reformation Day" like other states to prevent church-based associations
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateDayOfReformation(): void
    {
        if ($this->year < 2018) {
            return;
        }

        $this->addHoliday(
            new Holiday(
                'dayOfReformation',
                [],
                new \DateTime("{$this->year}-10-31", new \DateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OFFICIAL
            )
        );
    }
}
