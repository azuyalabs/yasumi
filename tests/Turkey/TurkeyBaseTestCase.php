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

namespace Yasumi\tests\Turkey;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

class TurkeyBaseTestCase extends TestCase
{
    use YasumiBase;

    public const REGION = 'Turkey';

    public const TIMEZONE = 'Europe/Istanbul';

    public const LOCALE = 'tr_TR';
}
