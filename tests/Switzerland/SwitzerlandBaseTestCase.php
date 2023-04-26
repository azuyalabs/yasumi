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

namespace Yasumi\tests\Switzerland;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Switzerland holiday provider.
 */
abstract class SwitzerlandBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'Switzerland';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Zurich';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'de_CH';
}
