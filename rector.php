<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);

    // single rules
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // sets of rules
    $rectorConfig->sets([
        SetList::PHP_74,
        SetList::CODE_QUALITY,
        SetList::TYPE_DECLARATION_STRICT,
        SetList::DEAD_CODE,
    ]);
};
