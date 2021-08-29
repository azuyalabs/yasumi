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

namespace Yasumi\tests\Canada;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Thanksgiving Day in Canada.
 */
class TruthAndReconciliationDayTest extends CanadaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'truthAndReconciliationDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2021;

    /**
     * Tests TruthAndReconciliationDay on or after 2021. Thanksgiving Day is celebrated since 2021 on the last day
     * of September.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testTruthAndReconciliationDayOnAfter2021(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("last day of september $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests TruthAndReconciliationDay before 2021. TruthAndReconciliationDay is celebrated since 2021 on the last day
     * of September.
     *
     * @throws ReflectionException
     */
    public function testTruthAndReconciliationDayBefore2021(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'National Day For Truth And Reconciliation']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
