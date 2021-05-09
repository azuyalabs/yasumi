<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Filters;

use Yasumi\Holiday;

/**
 * OfficialHolidaysFilter is a class for filtering all official holidays.
 *
 * OfficialHolidaysFilter is a class that returns all holidays that are considered official of any given
 * holiday provider.
 *
 * Example usage:
 * $holidays = Yasumi::create('Netherlands', 2015);
 * $official = new OfficialHolidaysFilter($holidays->getIterator());
 */
class OfficialHolidaysFilter extends AbstractFilter
{
    public function accept(): bool
    {
        return Holiday::TYPE_OFFICIAL === $this->getInnerIterator()->current()->getType();
    }
}
