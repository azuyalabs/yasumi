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

use Iterator;

/**
 * BetweenFilter is a class used for filtering holidays based on given date range.
 *
 * Filters all holidays between the given start and end date. An additional parameter can be used to identify if the
 * start and end date need to be included in the comparison.
 *
 * Note: this class can be used separately, however is implemented by the AbstractProvider::between method.
 */
class BetweenFilter extends AbstractFilter
{
    /**
     * @var string start date of the time frame to check against
     */
    private $startDate;

    /**
     * @var string end date of the time frame to check against
     */
    private $endDate;

    /**
     * @var bool indicates whether the start and end dates should be included in the comparison
     */
    private $equal;

    /**
     * Construct the Between FilterIterator Object.
     *
     * @param Iterator           $iterator  Iterator object of the Holidays Provider
     * @param \DateTimeInterface $startDate Start date of the time frame to check against
     * @param \DateTimeInterface $endDate   End date of the time frame to check against
     * @param bool               $equal     Indicate whether the start and end dates should be included in the
     *                                      comparison
     */
    public function __construct(
        Iterator $iterator,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        bool $equal = true
    ) {
        parent::__construct($iterator);
        $this->equal = $equal;
        $this->startDate = $startDate->format('Y-m-d');
        $this->endDate = $endDate->format('Y-m-d');
    }

    public function accept(): bool
    {
        $holiday = $this->getInnerIterator()->current()->format('Y-m-d');

        if ($this->equal && $holiday >= $this->startDate && $holiday <= $this->endDate) {
            return true;
        }

        return $holiday > $this->startDate && $holiday < $this->endDate;
    }
}
