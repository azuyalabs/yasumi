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

namespace Yasumi\tests\Benin;

use PHPUnit\Framework\TestCase;
use Yasumi\Provider\Benin;
use Yasumi\tests\YasumiBase;

/**
 * Base class for Benin holiday tests.
 */
abstract class BeninBaseTestCase extends TestCase
{
    use YasumiBase;

    /** Country (name) to be tested. */
    public const REGION = 'Benin';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Africa/Porto-Novo';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'fr_BJ';

    /**
     * Returns random test dates for a holiday on a fixed date, from the establishment year onwards.
     *
     * @param int $month month (number) of the holiday
     * @param int $day   day (number) of the holiday
     *
     * @return array<array{int, \DateTimeInterface}> list of random test dates
     *
     * @throws \Exception
     */
    public static function generateRandomDatesSinceEstablishment(int $month, int $day): array
    {
        $data = [];
        for ($i = 1; $i <= 10; ++$i) {
            $year = static::generateRandomYear(Benin::ESTABLISHMENT_YEAR);
            $data[] = [$year, new \DateTime("{$year}-{$month}-{$day}", new \DateTimeZone(self::TIMEZONE))];
        }

        return $data;
    }
}
