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
use Iterator;

/**
 * OnFilter is a class used for filtering holidays based on a given date.
 *
 * Filters for all holidays that happen on the given date.
 *
 * Note: this class can be used separately, however is implemented by the AbstractProvider::on method.
 *
 * @package Yasumi\Filters
 */
class OnFilter extends FilterIterator implements Countable
{
    /**
     * @var string date to check for holidays
     */
    private $date;


    /**
     * Construct the On FilterIterator Object
     *
     * @param \Iterator          $iterator   Iterator object of the Holidays Provider
     * @param \DateTimeInterface $date Start date of the time frame to check against
     */

    public function __construct(
        Iterator $iterator,
        \DateTimeInterface $date
    ) {
        parent::__construct($iterator);
        $this->date      = $date->format('Y-m-d');
    }

    /**
     * @return bool Check whether the current element of the iterator is acceptable
     */
    public function accept(): bool
    {
        $holiday = $this->getInnerIterator()->current()->format('Y-m-d');
        return $holiday === $this->date;
    }

    /**
     * @return integer Returns the number of holidays that happen on the specified date
     */
    public function count(): int
    {
        $days = \array_keys(\iterator_to_array($this));

        \array_walk($days, static function (&$day) {
            $day = \str_replace('substituteHoliday:', '', $day);
        });

        return \count(\array_unique($days));
    }
}
