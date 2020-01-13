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

namespace Yasumi;

/**
 * Interface TranslationsInterface.
 */
interface TranslationsInterface
{
    /**
     * Returns translation for holiday in specific locale.
     *
     * @param string $shortName holiday short name
     * @param string $locale locale
     *
     * @return string|null translated holiday name
     */
    public function getTranslation(string $shortName, string $locale): ?string;

    /**
     * Returns all available translations for holiday.
     *
     * @param string $shortName holiday short name
     *
     * @return array holiday name translations ['<locale>' => '<translation>', ...]
     */
    public function getTranslations(string $shortName): array;
}
