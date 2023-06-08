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

namespace Yasumi;

interface TranslationsInterface
{
    /**
     * Returns translation for holiday in specific locale.
     *
     * @param string $key    holiday key
     * @param string $locale locale
     *
     * @return string|null translated holiday name
     */
    public function getTranslation(string $key, string $locale): ?string;

    /**
     * Returns all available translations for holiday.
     *
     * @param string $key holiday key
     *
     * @return array<string, string> holiday name translations ['<locale>' => '<translation>', ...]
     */
    public function getTranslations(string $key): array;
}
