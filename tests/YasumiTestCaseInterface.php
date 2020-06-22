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

namespace Yasumi\tests;

/**
 * Interface YasumiTestCaseInterface - Yasumi TestCase Interface.
 *
 * This interface class defines the standard functions that any holiday provider PHPUnit test case needs to define.
 *
 * @see     AbstractProvider
 */
interface YasumiTestCaseInterface
{

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation();

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType();
}
