<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Filters;

use Yasumi\Holiday;

/**
 * OtherHolidaysFilter is a class for filtering all other type of holidays.
 *
 * OtherHolidaysFilter is a class that returns all holidays that are considered another type of holiday of any given
 * holiday provider.
 *
 * Example usage:
 * $holidays = Yasumi::create('Netherlands', 2015);
 * $other = new OtherHolidaysFilter($holidays->getIterator());
 */
class OtherHolidaysFilter extends AbstractFilter
{
    public function accept(): bool
    {
        return Holiday::TYPE_OTHER === $this->getInnerIterator()->current()->getType();
    }
}
