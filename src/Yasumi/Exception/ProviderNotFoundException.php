<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Exception;

use InvalidArgumentException;

/**
 * Class ProviderNotFoundException.
 *
 * @author Quentin Neyrat <quentin.neyrat@gmail.com>
 */
class ProviderNotFoundException extends InvalidArgumentException implements Exception
{
}
