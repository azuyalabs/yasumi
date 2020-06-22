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
 * Provider for all holidays in Rhineland Palatinate (Germany).
 *
 * Rhineland-Palatinate (German: Rheinland-Pfalz) is one of the 16 states (German: Bundesländer) of the Federal Republic
 * of Germany. It has an area of 19,846 square kilometres (7,663 sq mi) and about four million inhabitants. The city of
 * Mainz functions as the state capital.
 *
 * @link https://en.wikipedia.org/wiki/Rhineland-Palatinate
 */
class RhinelandPalatinate extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-RP';

    /**
     * Initialize holidays for Rhineland Palatinate (Germany).
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
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
    }
}
