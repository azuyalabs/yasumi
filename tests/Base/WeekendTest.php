<?php declare(strict_types=1);

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use Yasumi\Yasumi;

/**
 * Class containing various tests pertaining to the determination of a date
 * being a weekend (i.e. non-working day) or not.
 */
class WeekendTest extends TestCase
{
    private const HOLIDAY_PROVIDER = 'Belgium';

    /**
     * Tests that the isWeekendDay function correctly assesses that the given date falls into the
     * weekend.
     *
     * Note: this test uses Belgium as a representative country for the global, common weekend definition.
     * Tests for countries that deviate from the global definition will be added as soon as their respective
     * Holiday Provider is created.
     *
     * @dataProvider dataProviderWeekendDays
     *
     * @param \DateTimeImmutable $date
     * @throws \ReflectionException
     */
    public function testWeekendDay(\DateTimeImmutable $date): void
    {
        $yasumiProvider = Yasumi::create(self::HOLIDAY_PROVIDER, (int) $date->format('Y'));
        $isWeekendDay = $yasumiProvider->isWeekendDay($date);

        $this->assertIsBool($isWeekendDay);
        $this->assertTrue($isWeekendDay);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function dataProviderWeekendDays(): array
    {
        return [
            [
                new \DateTimeImmutable('2020-04-19'),
            ],
            [
                new \DateTimeImmutable('2019-12-29'),
            ],
            [
                new \DateTimeImmutable('2019-12-28'),
            ],
            [
                new \DateTimeImmutable('2018-06-16'),
            ],
        ];
    }

    /**
     * Tests that the isWeekendDay function correctly assesses that the given date does not
     * fall into the weekend.
     *
     * Note: this test uses Belgium as a representative country for the global, common weekend definition.
     * Tests for countries that deviate from the global definition will be added as soon as their respective
     * Holiday Provider is created.
     *
     * @dataProvider dataProviderNonWeekendDays
     *
     * @param \DateTimeImmutable $date
     * @throws \ReflectionException
     */
    public function testNonWeekendDay(\DateTimeImmutable $date): void
    {
        $yasumiProvider = Yasumi::create(self::HOLIDAY_PROVIDER, (int) $date->format('Y'));
        $isWeekendDay = $yasumiProvider->isWeekendDay($date);

        $this->assertIsBool($isWeekendDay);
        $this->assertFalse($isWeekendDay);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function dataProviderNonWeekendDays(): array
    {
        return [
            [
                new \DateTimeImmutable('2020-04-20'),
            ],
            [
                new \DateTimeImmutable('2019-12-30'),
            ],
            [
                new \DateTimeImmutable('2019-12-27'),
            ],
            [
                new \DateTimeImmutable('2018-06-15'),
            ],
        ];
    }
}
