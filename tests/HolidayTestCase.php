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

namespace Yasumi\tests;

/**
 * This interface class defines the standard functions that any holiday PHPUnit test case needs to define.
 *
 * @see     AbstractProvider
 */
interface HolidayTestCase
{
    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation(): void;

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void;
}
