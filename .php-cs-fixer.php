<?php declare(strict_types=1);

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */
$finder = PhpCsFixer\Finder::create()->in(__DIR__);

$config = new PhpCsFixer\Config();
$config->setRiskyAllowed(true)->setRules([
    '@PSR2' => true,
    '@Symfony' => true,
    'blank_line_after_opening_tag' => true,
    'is_null' => true,
    'modernize_types_casting' => true,
    'self_accessor' => true,
    'dir_constant' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'no_unused_imports' => true,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'trailing_comma_in_multiline' => true,
    'cast_spaces' => ['space' => 'single'],
    'declare_strict_types' => true,
])->setLineEnding("\n")->setFinder($finder);

return $config;
