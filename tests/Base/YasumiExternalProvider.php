<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Base;

use Yasumi\ProviderInterface;
use Yasumi\TranslationsInterface;

/**
 * Class YasumiExternalProvider.
 *
 * Class for testing the use of an external holiday provider class.
 */
class YasumiExternalProvider implements ProviderInterface
{
    public $year;
    public $locale;
    public $globalTranslations;

    public function __construct($year, $locale, TranslationsInterface $globalTranslations)
    {
        $this->year = $year;
        $this->locale = $locale;
        $this->globalTranslations = $globalTranslations;
    }

    /**
     * Initialize country holidays.
     */
    public function initialize(): void
    {
        // We don't actually have to do anything here.
    }
}
