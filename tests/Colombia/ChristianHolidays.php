<?php

declare(strict_types=1);

namespace Yasumi\Provider;

use Yasumi\Holiday;

/**
 * Trait for Christian holidays in Colombia.
 */
trait ChristianHolidays
{
    /*
     * Easter Monday
     *
     * Easter Monday is the day after Easter Sunday, which commemorates the resurrection of Jesus Christ.
     */
    private function easterMonday(int $year, string $timezone, string $locale, string $type = Holiday::TYPE_PUBLIC): Holiday
    {
        $easter = $this->calculateEaster($year, $timezone);
        
        return new Holiday(
            'easterMonday',
            ['es' => 'Lunes de Pascua'],
            $easter->modify('+1 day'),
            $locale,
            $type
        );
    }
}
