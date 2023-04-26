<?php

declare(strict_types=1);

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */
$finder = PhpCsFixer\Finder::create()->in(__DIR__);

$config = new PhpCsFixer\Config();
$config->setRiskyAllowed(true)->setRules([
  '@Symfony' => true,
  '@PER' => true,
  'combine_consecutive_issets' => true,
  'combine_consecutive_unsets' => true,
  'declare_strict_types' => true,
  'no_superfluous_elseif' => true,
  'no_superfluous_phpdoc_tags' => ['remove_inheritdoc' => true],

   // Risky rules
  'dir_constant' => true,
  'get_class_to_class_keyword' => true,
  'is_null' => true,
  'modernize_strpos' => true,
  'modernize_types_casting' => true,
  'self_accessor' => true,
])->setFinder($finder);

return $config;
