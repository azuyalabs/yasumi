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

namespace Yasumi\tests\Austria;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Austria holiday provider.
 */
abstract class AustriaBaseTestCase extends TestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'Austria';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Vienna';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'de_AT';

    /**
     * Number of iterations to be used for the various unit tests of this provider.
     */
    public const TEST_ITERATIONS = 50;
}
