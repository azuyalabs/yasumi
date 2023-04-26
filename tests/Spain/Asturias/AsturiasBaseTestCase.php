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

namespace Yasumi\tests\Spain\Asturias;

use Yasumi\tests\Spain\SpainBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Asturias (Spain) holiday provider.
 */
abstract class AsturiasBaseTestCase extends SpainBaseTestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'Spain/Asturias';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Madrid';
}
