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

$finder = PhpCsFixer\Finder::create()->in(__DIR__);

return PhpCsFixer\Config::create()->setRules(['@PSR2' => true])->setFinder($finder);