<?php

namespace Yasumi\Provider\SouthKorea\Translation;

use Yasumi\TranslationsInterface;

class KoreanTranslation implements TranslationsInterface
{
    public function __construct(protected int $year, protected array $translations = [])
    {
        foreach (array_keys($this->translations) as $key) {
            if (method_exists($this, $key)) {
                $this->{$key}();
            };
        }
    }

    public function getTranslation(string $key, string $locale): ?string
    {
        return $this->translations[$key][$locale] ?? null;
    }

    public function getTranslations(string $key): array
    {
        return $this->translations[$key] ?? [];
    }

    public function addTranslation(string $key, string $translation, string $locale = 'ko'): void
    {
        $this->translations[$key][$locale] = $translation;
    }

    private function seollal(): void
    {
        // It was officially designated as "민속의 날" from 1985 through 1988
        if ($this->year > 1984 && $this->year < 1989) {
            $this->addTranslation('seollal', '민속의 날');
        }
    }

    private function arborDay(): void
    {
        // In 1960 only, "사방의 날" temporarily replaced "식목일".
        if ($this->year === 1960) {
            $this->addTranslation('arborDay', '사방의 날');
        }
    }

    private function buddhasBirthday(): void
    {
        // Officially renamed from "석가탄신일" to "부처님오신날" in 2017
        if ($this->year < 2016) {
            $this->addTranslation('buddhasBirthday', '석가탄신일');
        }
    }
}
