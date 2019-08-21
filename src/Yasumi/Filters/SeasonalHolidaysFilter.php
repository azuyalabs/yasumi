<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Filters;

use Countable;
use FilterIterator;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;

/**
 * SeasonalHolidaysFilter is a class for filtering all seasonal holidays.
 *
 * OfficialHolidaysFilter is a class that returns all holidays that are considered seasonal of any given holiday
 * provider.
 *
 * Example usage:
 * $holidays = Yasumi::create('Netherlands', 2015);
 * $seasonal = new SeasonalHolidaysFilter($holidays->getIterator());
 */
class SeasonalHolidaysFilter extends FilterIterator implements Countable
{
    /**
     * Checks whether the current element of the iterator is a seasonal holiday.
     *
     * @return bool
     */
    public function accept(): bool
    {
        return $this->getInnerIterator()->current()->getType() === Holiday::TYPE_SEASON;
    }

    /**
     * @return integer Returns the number of filtered holidays.
     */
    public function count(): int
    {
        $names = \array_map(static function (&$holiday) {
            if ($holiday instanceof SubstituteHoliday) {
                return $holiday->substitutedHoliday->shortName;
            } else {
                return $holiday->shortName;
            }
        }, \iterator_to_array($this));

        return \count(\array_unique($names));
    }
}
