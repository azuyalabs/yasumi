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
 * BetweenFilter is a class used for filtering holidays based on given date range.
 *
 * Filters all holidays between the given start and end date. An additional parameter can be used to identify if the
 * start and end date need to be included in the comparison.
 *
 * Note: this class can be used separately, however is implemented by the AbstractProvider::between method.
 *
 * @package Yasumi\Filters
 */
class BetweenFilter extends FilterIterator implements Countable
{
    /**
     * @var string start date of the time frame to check against
     */
    private $start_date;

    /**
     * @var string end date of the time frame to check against
     */
    private $end_date;

    /**
     * @var bool indicates whether the start and end dates should be included in the comparison
     */
    private $equal;

    /**
     * Construct the Between FilterIterator Object
     *
     * @param \Iterator          $iterator   Iterator object of the Holidays Provider
     * @param \DateTimeInterface $start_date Start date of the time frame to check against
     * @param \DateTimeInterface $end_date   End date of the time frame to check against
     * @param  bool              $equal      Indicate whether the start and end dates should be included in the
     *                                       comparison
     */
    public function __construct(
        Iterator $iterator,
        \DateTimeInterface $start_date,
        \DateTimeInterface $end_date,
        $equal = true
    ) {
        parent::__construct($iterator);
        $this->equal      = $equal;
        $this->start_date = $start_date->format('Y-m-d');
        $this->end_date   = $end_date->format('Y-m-d');
    }

    /**
     * @return bool Check whether the current element of the iterator is acceptable
     */
    public function accept(): bool
    {
        $holiday = $this->getInnerIterator()->current()->format('Y-m-d');

        if ($this->equal && $holiday >= $this->start_date && $holiday <= $this->end_date) {
            return true;
        }

        return $holiday > $this->start_date && $holiday < $this->end_date;
    }

    /**
     * @return integer Returns the number of holidays between the given start and end date.
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
