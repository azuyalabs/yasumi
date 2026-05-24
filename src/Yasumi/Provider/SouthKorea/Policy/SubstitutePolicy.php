<?php

namespace Yasumi\Provider\SouthKorea\Policy;

use Yasumi\Holiday;

class SubstitutePolicy
{
    private int $year;

    /** @var array Substitute policy. */
    private array $policy = [];

    public function __construct(int $year)
    {
        $this->year = $year;
        $this->init();
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
            $this->policy['internationalWorkersDay'] = [0, 6];
            $this->policy['constitutionDay'] = [0, 6];
        }
    }

    public function canSubsitute(Holiday $holiday): bool
    {
        return isset($this->policy[$holiday->getKey()]);
    }

    /**
     * Determines if an alternative holiday should be added for this year's holidays based on the policy.
     *
     * @param Holiday $holiday
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
}
