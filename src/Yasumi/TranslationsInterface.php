<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 * @author Tomasz Sawicki
 *
 */
namespace Yasumi;

/**
 * Interface TranslationsInterface
 *
 * @package Yasumi
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
    function getTranslation($shortName, $locale);

    /**
     * Returns all available translations for holiday.
     *
     * @param   string $shortName holiday short name
     *
     * @return array holiday name translations ['<locale>' => '<translation>', ...]
     */
    function getTranslations($shortName);
}