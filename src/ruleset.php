<?php

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use SlevomatCodingStandard\Sniffs\ControlStructures\EarlyExitSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withConfiguredRule(ArraySyntaxFixer::class, ['syntax' => 'short'])
    ->withRules([
        EarlyExitSniff::class
    ])
    ->withPreparedSets(namespaces: true);
