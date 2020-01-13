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
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Bremen (Germany).
 *
 * The Free Hanseatic City of Bremen is the smallest of Germany's 16 states. A more informal name, but used in some
 * official contexts, is Land Bremen ('State of Bremen'). The state consists of two enclaves with two cities (Bremen
 * and Bremerhaven) in the North of Germany, surrounded by the larger state of Lower Saxony.
 *
 * @link https://en.wikipedia.org/wiki/Bremen_(state)
 */
class Bremen extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-HB';

    /**
     * Initialize holidays for Bremen (Germany).
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
     * For the German state of Bremen, Reformation Day is celebrated since 2018.
     * Note: In 2017 all German states will celebrate Reformation Day for its 500th anniversary.
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
