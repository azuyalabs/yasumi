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

namespace Yasumi\tests\Australia;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Australia holiday provider.
 */
abstract class AustraliaBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Locale that is considered common for this provider
     */
    public const LOCALE = 'en_AU';
    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public $region = 'Australia';
    /**
     * Timezone in which this provider has holidays defined
     */
    public $timezone = 'Australia/Melbourne';
}
