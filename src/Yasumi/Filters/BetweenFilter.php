<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Filters;

use DateTime;
use FilterIterator;
use Iterator;
use Countable;

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
     * @var \DateTime start date of the time frame to check against
     */
    private $start_date;

    /**
     * @var \DateTime end date of the time frame to check against
     */
    private $end_date;

    /**
     * @var bool indicates whether the start and end dates should be included in the comparison
     */
    private $equal;

    /**
     * Construct the Between FilterIterator Object
     *
     * @param \Iterator $iterator   Iterator object of the Holidays Provider
     * @param \DateTime $start_date Start date of the time frame to check against
     * @param \DateTime $end_date   End date of the time frame to check against
     * @param  bool     $equal      Indicate whether the start and end dates should be included in the comparison
     */
    public function __construct(
        Iterator $iterator,
        DateTime $start_date,
        DateTime $end_date,
        $equal = true
    ) {
        parent::__construct($iterator);
        $this->equal      = $equal;
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }

    /**
     * @return bool Check whether the current element of the iterator is acceptable
     */
    public function accept()
    {
        $holiday = $this->getInnerIterator()->current();

        if ($this->equal && $holiday >= $this->start_date && $holiday <= $this->end_date) {
            return true;
        }

        return $holiday > $this->start_date && $holiday < $this->end_date;
    }

    /**
     * @return integer Returns the number of holidays between the given start and end date.
     */
    public function count()
    {
        return iterator_count($this);
    }
}
