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

namespace Yasumi\tests\Belgium;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Belgium holiday provider.
 */
abstract class BelgiumBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'Belgium';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Brussels';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'nl_BE';
}
