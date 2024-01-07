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

use Yasumi\SubstituteHoliday;

abstract class AbstractFilter extends \FilterIterator implements \Countable
{
    /**
     * Returns the number of holidays returned by this iterator.
     *
     * In case a holiday is substituted (e.g. observed), the holiday is only counted once.
     *
     * @return int number of unique holidays
     */
    public function count(): int
    {
        $names = array_map(
            static fn ($holiday) => $holiday instanceof SubstituteHoliday ?
            $holiday->getSubstitutedHoliday()->getKey() : $holiday->getKey(),
            iterator_to_array($this)
        );

        return count(array_unique($names));
    }
}
