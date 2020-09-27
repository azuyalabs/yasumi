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
 * NonWorkingDayFilter is a class for filtering all non-working holidays.
 *
 * NonWorkingDayFilter is a class that returns all holidays that are non-working holiday, which are, usually, the
 * official ones.
 *
 * Example usage:
 * $holidays = Yasumi::create('Netherlands', 2015);
 * $nonWorkingDay = new NonWorkingDayFilter($holidays->getIterator());
 */
class NonWorkingDayFilter extends AbstractFilter
{
    /**
     * Checks whether the current element of the iterator is an non-working day.
     *
     * @return bool
     */
    public function accept(): bool
    {
        return $this->getInnerIterator()->current()->isNonWorkingDay();
    }
}
