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

namespace Yasumi\Provider\France;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\France;

/**
 * Provider for all holidays in Moselle (France).
 *
 * Moselle is one of the original 83 departments created during the French Revolution on March 4, 1790. It was created
 * from the former province of Lorraine. In 1793 France annexed the German enclaves of Manderen, Lixing-lès-Rouhling,
 * Momerstroff, and Créhange (Kriechingen) - all possessions of princes of the German Holy Roman Empire - and
 * incorporated them into the Moselle département.
 *
 * @link https://en.wikipedia.org/wiki/Moselle_(department)
 */
class Moselle extends France
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'FR-57';

    /**
     * Initialize holidays for Moselle (France).
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
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));
    }
}
