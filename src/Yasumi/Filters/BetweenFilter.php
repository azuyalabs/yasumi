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

use Yasumi\ProviderInterface;

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
    private const DATE_FORMAT = 'Y-m-d';

    /** start date of the time frame to check against. */
    private string $startDate;

    /** end date of the time frame to check against */
    private string $endDate;

    /**
     * Construct the Between FilterIterator Object.
     *
     * @param \Iterator<ProviderInterface> $iterator  Iterator object of the Holidays Provider
     * @param \DateTimeInterface           $startDate Start date of the time frame to check against
     * @param \DateTimeInterface           $endDate   End date of the time frame to check against
     * @param bool                         $equal     Indicate whether the start and end dates should be included in the
     *                                                comparison
     */
    public function __construct(
        \Iterator $iterator,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        private bool $equal = true
    ) {
        parent::__construct($iterator);
        $this->startDate = $startDate->format(self::DATE_FORMAT);
        $this->endDate = $endDate->format(self::DATE_FORMAT);
    }

    public function accept(): bool
    {
        $holiday = $this->getInnerIterator()->current()->format(self::DATE_FORMAT);

        return $this->equal
            ? $holiday >= $this->startDate && $holiday <= $this->endDate
            : $holiday > $this->startDate && $holiday < $this->endDate;
    }
}
