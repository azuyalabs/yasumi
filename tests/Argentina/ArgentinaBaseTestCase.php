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

namespace Yasumi\tests\Argentina;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class ArgentinaBaseTestCase.
 */
abstract class ArgentinaBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'Argentina';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'America/Argentina/Buenos_Aires';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'es';
}
