<?php

declare(strict_types=1);

use ObjectCalisthenics\Sniffs\Files\FunctionLengthSniff;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits;
use ObjectCalisthenics\Sniffs\Metrics\MethodPerClassLimitSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\TypeHintDeclarationSniff;
use NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowMixedTypeHintSniff;
use NunoMaduro\PhpInsights\Domain\Insights\Composer\ComposerMustBeValid;
use SlevomatCodingStandard\Sniffs\Namespaces\AlphabeticallySortedUsesSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods\CamelCapsMethodNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;

return [
    'preset' => 'default',
    'exclude' => [
        'vendor',
        'config',
        'bootstrap',
        'resources',
        'storage',
        'public',
        'routes',
        'assets',
        'app/Views',
        'phpinsights.php'
    ],
    'add' => [

    ],
    'remove' => [
        ForbiddenTraits::class,
        TypeHintDeclarationSniff::class,
        DisallowMixedTypeHintSniff::class,
        ComposerMustBeValid::class,
        AlphabeticallySortedUsesSniff::class,
        CamelCapsMethodNameSniff::class,
        LineLengthSniff::class
    ],
    'config' => [
        CyclomaticComplexityIsHigh::class => [
            'maxComplexity' => 7
        ],
        FunctionLengthSniff::class => [
            'maxLength' => 30
        ],
        MethodPerClassLimitSniff::class => [
            'maxCount' => 12
        ]
    ]
];
