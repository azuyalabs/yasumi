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

use Countable;
use FilterIterator;
use Yasumi\SubstituteHoliday;

/**
 * AbstractFilter.
 *
 * @package Yasumi\Filters
 */
abstract class AbstractFilter extends FilterIterator implements Countable
{
    /**
     * Returns the number of holidays returned by this iterator.
     *
     * In case a holiday is substituted (e.g. observed), the holiday is only counted once.
     *
     * @return int Number of unique holidays.
     */
    public function count(): int
    {
        $names = \array_map(static function (&$holiday) {
            if ($holiday instanceof SubstituteHoliday) {
                return $holiday->substitutedHoliday->shortName;
            }

            return $holiday->shortName;
        }, \iterator_to_array($this));

        return \count(\array_unique($names));
    }
}
