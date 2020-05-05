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

namespace Yasumi\tests\Canada;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Class CanadaBaseTestCase.
 */
abstract class CanadaBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested
     */
    public const REGION = 'Canada';

    /**
     * Timezone in which this provider has holidays defined
     */
    public const TIMEZONE = 'America/Toronto';

    /**
     * Locale that is considered common for this provider
     */
    public const LOCALE = 'en_CA';
}
