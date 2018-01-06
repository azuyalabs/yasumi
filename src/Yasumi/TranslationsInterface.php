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
     * @param string $locale    locale
     *
     * @return string|null translated holiday name
     */
    public function getTranslation($shortName, $locale);

    /**
     * Returns all available translations for holiday.
     *
     * @param string $shortName holiday short name
     *
     * @return array holiday name translations ['<locale>' => '<translation>', ...]
     */
    public function getTranslations($shortName);
}
