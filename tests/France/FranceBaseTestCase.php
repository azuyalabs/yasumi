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

namespace Yasumi\tests\France;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the France holiday provider.
 */
abstract class FranceBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested.
     */
    public const REGION = 'France';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Paris';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'fr_FR';
}
