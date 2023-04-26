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

namespace Yasumi\tests\Denmark;

use Yasumi\tests\HolidayTestCase;

abstract class DaylightSavingTime extends DenmarkBaseTestCase implements HolidayTestCase
{
    /** @var int[] */
    public array $observedYears;

    /** @var int[] */
    public array $unobservedYears;

    public function __construct()
    {
        $observedYears = [1916, 1940];
        $observedYears = array_merge($observedYears, range(1942, 1948));
        $observedYears = array_merge($observedYears, range(1980, 2037)); // PHP caps future DST transitions

        $this->observedYears = $observedYears;
        $this->unobservedYears = array_diff(range(reset($observedYears), end($observedYears)), $observedYears);

        parent::__construct();
    }

    /* Swaps the observation from observed to unobserved for the given years */
    protected function swapObservation(array $years): void
    {
        foreach ($years as $y) {
            $this->observedYears[] = $y;
            if (false !== ($key = array_search($y, $this->unobservedYears, true))) {
                unset($this->unobservedYears[(int) $key]);
            }
        }
    }
}
