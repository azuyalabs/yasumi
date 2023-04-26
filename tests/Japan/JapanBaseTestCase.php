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

namespace Yasumi\tests\Japan;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class JapanBaseTestCase.
 */
abstract class JapanBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'Japan';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Asia/Tokyo';

    /**
     * Prefix for holiday key used when holiday is substituted.
     */
    public const SUBSTITUTE_PREFIX = 'substituteHoliday:';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'ja_JP';
}
