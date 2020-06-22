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

$finder = PhpCsFixer\Finder::create()->in(__DIR__);

return PhpCsFixer\Config::create()->setRiskyAllowed(true)->setRules([
        '@PSR2'                             => true,
        'array_syntax'                      => ['syntax' => 'short'],
        'native_function_invocation'        => true,
        'ordered_imports'                   => ['sortAlgorithm' => 'alpha'],
        'no_unused_imports'                 => true,
        'single_quote'                      => true,
        'space_after_semicolon'             => true,
        'trailing_comma_in_multiline_array' => true,
        'cast_spaces'                       => ['space' => 'single'],
        'declare_strict_types'              => true,
    ])->setLineEnding("\n")->setFinder($finder);