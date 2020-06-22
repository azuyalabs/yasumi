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
 * ObservedHolidaysFilter is a class for filtering all observed holidays.
 *
 * ObservedHolidaysFilter is a class that returns all holidays that are considered observed of any given holiday
 * provider.
 *
 * Example usage:
 * $holidays = Yasumi::create('Netherlands', 2015);
 * $observed = new ObservedHolidaysFilter($holidays->getIterator());
 */
class ObservedHolidaysFilter extends AbstractFilter
{
    /**
     * Checks whether the current element of the iterator is an observed holiday.
     *
     * @return bool
     */
    public function accept(): bool
    {
        return $this->getInnerIterator()->current()->getType() === Holiday::TYPE_OBSERVANCE;
    }
}
