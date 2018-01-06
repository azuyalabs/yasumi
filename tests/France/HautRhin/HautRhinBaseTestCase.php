<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\France\HautRhin;

use Yasumi\tests\France\FranceBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Haut-Rhin (France) holiday provider.
 */
abstract class HautRhinBaseTestCase extends FranceBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    const REGION = 'France/HautRhin';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Paris';

    /**
     * Locale that is considered common for this provider
     */
    const LOCALE = 'fr_FR';
}
