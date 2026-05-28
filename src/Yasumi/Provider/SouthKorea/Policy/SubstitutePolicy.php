<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\SouthKorea\Policy;

use Yasumi\Holiday;

class SubstitutePolicy
{
    private int $year;

    /** @var array<string, list<int>> Substitute policy. */
    private array $policy = [];

    public function __construct(int $year)
    {
        $this->year = $year;
        $this->init();
    }

    public function canSubsitute(Holiday $holiday): bool
    {
        return isset($this->policy[$holiday->getKey()]);
    }

    /**
     * Determines if an alternative holiday should be added for this year's holidays based on the policy.
     *
     * @return bool
     */
    public function shouldSubstitute(Holiday $holiday)
    {
        return \in_array(
            (int) $holiday->format('w'),
            $this->policy[$holiday->getKey()] ?? [],
            true
        );
    }

    private function init(): void
    {
        $this->policy += array_fill_keys([
            'dayBeforeSeollal', 'seollal', 'dayAfterSeollal',
            'dayBeforeChuseok', 'chuseok', 'dayAfterChuseok',
        ], [0]);

        $this->policy += array_fill_keys([
            'childrensDay', 'independenceMovementDay', 'liberationDay',
            'nationalFoundationDay', 'hangulDay', 'buddhasBirthday', 'christmasDay',
        ], [0, 6]);

        if ($this->year > 2025) {
            $this->policy['labourDay'] = [0, 6];
            $this->policy['constitutionDay'] = [0, 6];
        }
    }
}
