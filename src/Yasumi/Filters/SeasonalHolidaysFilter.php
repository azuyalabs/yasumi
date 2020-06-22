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

namespace Yasumi\Filters;

use Yasumi\Holiday;

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
class SeasonalHolidaysFilter extends AbstractFilter
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
}
