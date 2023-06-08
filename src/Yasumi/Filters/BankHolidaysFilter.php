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

namespace Yasumi\Filters;

use Yasumi\Holiday;

/**
 * BankHolidaysFilter is a class for filtering all bank holidays.
 *
 * BankHolidaysFilter is a class that returns all holidays that are considered bank holidays of any given holiday
 * provider.
 *
 * Example usage:
 * $holidays = Yasumi::create('Netherlands', 2015);
 * $bank = new BankHolidaysFilter($holidays->getIterator());
 */
class BankHolidaysFilter extends AbstractFilter
{
    public function accept(): bool
    {
        return Holiday::TYPE_BANK === $this->getInnerIterator()->current()->getType();
    }
}
