<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Preset
    |--------------------------------------------------------------------------
    |
    | This option controls the default preset that will be used by PHP Insights
    | to make your code reliable, simple, and clean. However, you can always
    | adjust the `Metrics` and `Insights` below in this configuration file.
    |
    | Supported: "default", "laravel", "symfony", "magento2", "drupal"
    |
    */

    'preset' => 'symfony',

    /*
    |--------------------------------------------------------------------------
    | IDE
    |--------------------------------------------------------------------------
    |
    | This options allow to add hyperlinks in your terminal to quickly open
    | files in your favorite IDE while browsing your PhpInsights report.
    |
    | Supported: "textmate", "macvim", "emacs", "sublime", "phpstorm",
    | "atom", "vscode".
    |
    | If you have another IDE that is not in this list but which provide an
    | url-handler, you could fill this config with a pattern like this:
    |
    | myide://open?url=file://%f&line=%l
    |
    */

    'ide' => null,

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may adjust all the various `Insights` that will be used by PHP
    | Insights. You can either add, remove or configure `Insights`. Keep in
    | mind, that all added `Insights` must belong to a specific `Metric`.
    |
    */

    'exclude' => [
        //  'path/to/directory-or-file'
    ],

    'add' => [
        //  ExampleMetric::class => [
        //      ExampleInsight::class,
        //  ]
    ],

    'remove' => [
        PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\TodoSniff::class,
        SlevomatCodingStandard\Sniffs\ControlStructures\DisallowShortTernaryOperatorSniff::class,
        SlevomatCodingStandard\Sniffs\ControlStructures\DisallowYodaComparisonSniff::class,
        SlevomatCodingStandard\Sniffs\Commenting\DocCommentSpacingSniff::class,

        // Remove checks for superfluous naming as we follow PER which supports such convention
        SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff::class,
        SlevomatCodingStandard\Sniffs\Classes\SuperfluousAbstractClassNamingSniff::class,
        SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff::class,
    ],

    'config' => [
        PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class => [
            'lineLimit' => 120,
            'absoluteLineLimit' => 140,
            'ignoreComments' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Requirements
    |--------------------------------------------------------------------------
    |
    | Here you may define a level you want to reach per `Insights` category.
    | When a score is lower than the minimum level defined, then an error
    | code will be returned. This is optional and individually defined.
    |
    */

    'requirements' => [
        'min-quality' => 90,
        'min-complexity' => 90,
        'min-architecture' => 90,
        'min-style' => 90,
        'disable-security-check' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Threads
    |--------------------------------------------------------------------------
    |
    | Here you may adjust how many threads (core) PHPInsights can use to perform
    | the analyse. This is optional, don't provide it and the tool will guess
    | the max core number available. It accepts null value or integer > 0.
    |
    */

    'threads' => null,
];
