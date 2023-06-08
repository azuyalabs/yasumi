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

namespace Yasumi\Exception;

use Exception as BaseException;

/**
 * Class MissingTranslationException.
 */
class MissingTranslationException extends BaseException implements Exception
{
    /**
     * Initializes the Exception instance.
     *
     * @param string             $key     The holiday key
     * @param array<int, string> $locales The locales that was searched
     */
    public function __construct(string $key, array $locales)
    {
        parent::__construct(\sprintf("Translation for '%s' not found for any locale: '%s'", $key, \implode("', '", $locales)));
    }
}
