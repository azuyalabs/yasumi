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

namespace Yasumi\tests\France\BasRhin;

use Yasumi\tests\France\FranceBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Bas-Rhin (France) holiday provider.
 */
abstract class BasRhinBaseTestCase extends FranceBaseTestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'France/BasRhin';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Paris';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'fr_FR';
}
