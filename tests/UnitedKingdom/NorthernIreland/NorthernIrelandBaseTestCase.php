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

namespace Yasumi\tests\UnitedKingdom\NorthernIreland;

use Yasumi\tests\UnitedKingdom\UnitedKingdomBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Northern Ireland holiday provider.
 */
abstract class NorthernIrelandBaseTestCase extends UnitedKingdomBaseTestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'UnitedKingdom\NorthernIreland';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Belfast';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'en_GB';

    /**
     * Number of iterations to be used for the various unit tests of this provider.
     */
    public const TEST_ITERATIONS = 50;
}
