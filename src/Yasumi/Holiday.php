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

use DateTime;
use InvalidArgumentException;
use JsonSerializable;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;

/**
 * Class Holiday.
 */
class Holiday extends DateTime implements JsonSerializable
{
    /**
     * Type definition for Official (i.e. National/Federal) holidays.
     */
    public const TYPE_OFFICIAL = 'official';

    /**
     * Type definition for Observance holidays.
     */
    public const TYPE_OBSERVANCE = 'observance';

    /**
     * Type definition for seasonal holidays.
     */
    public const TYPE_SEASON = 'season';

    /**
     * Type definition for Bank holidays.
     */
    public const TYPE_BANK = 'bank';

    /**
     * Type definition for other type of holidays.
     */
    public const TYPE_OTHER = 'other';

    /**
     * The default locale. Used for translations of holiday names and other text strings.
     */
    public const DEFAULT_LOCALE = 'en_US';

    /**
     * @var array list of all defined locales
     */
    private static $locales = [];

    /**
     * @var string short name (internal name) of this holiday
     */
    public $shortName;

    /**
     * @var array list of translations of this holiday
     */
    public $translations;

    /**
     * @var string identifies the type of holiday
     */
    protected $type;

    /**
     * @var string Locale (i.e. language) in which the holiday information needs to be displayed in. (Default 'en_US')
     */
    protected $displayLocale;

    /**
     * Creates a new Holiday.
     *
     * If a holiday date needs to be defined for a specific timezone, make sure that the date instance
     * (DateTimeInterface) has the correct timezone set. Otherwise the default system timezone is used.
     *
     * @param string $shortName The short name (internal name) of this holiday
     * @param array $names An array containing the name/description of this holiday in various
     *                                          languages. Overrides global translations
     * @param \DateTimeInterface $date A DateTimeInterface instance representing the date of the holiday
     * @param string $displayLocale Locale (i.e. language) in which the holiday information needs to be
     *                                          displayed in. (Default 'en_US')
     * @param string $type The type of holiday. Use the following constants: TYPE_OFFICIAL,
     *                                          TYPE_OBSERVANCE, TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an
     *                                          official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    public function __construct(
        string $shortName,
        array $names,
        \DateTimeInterface $date,
        string $displayLocale = self::DEFAULT_LOCALE,
        string $type = self::TYPE_OFFICIAL
    ) {
        // Validate if short name is not empty
        if (empty($shortName)) {
            throw new InvalidArgumentException('Holiday name can not be blank.');
        }

        // Load internal locales variable
        if (empty(self::$locales)) {
            self::$locales = Yasumi::getAvailableLocales();
        }

        // Assert display locale input
        if (!\in_array($displayLocale, self::$locales, true)) {
            throw new UnknownLocaleException(\sprintf('Locale "%s" is not a valid locale.', $displayLocale));
        }

        // Set additional attributes
        $this->shortName = $shortName;
        $this->translations = $names;
        $this->displayLocale = $displayLocale;
        $this->type = $type;

        // Construct instance
        parent::__construct($date->format('Y-m-d'), $date->getTimezone());
    }

    /**
     * Returns what type this holiday is.
     *
     * @return string the type of holiday (official, observance, season, bank or other).
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @return $this
     */
    public function jsonSerialize(): self
    {
        return $this;
    }

    /**
     * Returns the name of this holiday.
     *
     * The name of this holiday is returned translated in the given locale. If for the given locale no translation is
     * defined, the name in the default locale ('en_US') is returned. In case there is no translation at all, the short
     * internal name is returned.
     */
    public function getName(): string
    {
        foreach ($this->getLocales() as $locale) {
            if (isset($this->translations[$locale])) {
                return $this->translations[$locale];
            }
        }

        return $this->shortName;
    }

    /**
     * Returns the display locale and its fallback locales.
     *
     * @return array
     */
    protected function getLocales(): array
    {
        $locales = [$this->displayLocale];
        $parts = \explode('_', $this->displayLocale);
        while (\array_pop($parts) && $parts) {
            $locales[] = \implode('_', $parts);
        }

        // DEFAULT_LOCALE is en_US
        $locales[] = 'en_US';
        $locales[] = 'en';

        return $locales;
    }

    /**
     * Merges local translations (preferred) with global translations.
     *
     * @param TranslationsInterface $globalTranslations global translations
     */
    public function mergeGlobalTranslations(TranslationsInterface $globalTranslations): void
    {
        $holidayGlobalTranslations = $globalTranslations->getTranslations($this->shortName);
        $this->translations = \array_merge($holidayGlobalTranslations, $this->translations);
    }

    /**
     * Format the instance as a string using the set format.
     *
     * @return string this instance as a string using the set format.
     */
    public function __toString(): string
    {
        return $this->format('Y-m-d');
    }
}
