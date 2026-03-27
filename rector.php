<?php

declare(strict_types=1);
use Rector\CodeQuality\Rector\ClassMethod\ExplicitReturnNullRector;
use Rector\CodeQuality\Rector\ClassMethod\LocallyCalledStaticMethodToNonStaticRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\CodeQuality\Rector\Identical\StrlenZeroToIdenticalEmptyStringRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector;
use Rector\CodingStyle\Rector\ClassLike\NewlineBetweenClassLikeStmtsRector;
use Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\String_\SimplifyQuoteEscapeRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodParameterRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\Php70\Rector\Variable\WrapVariableVariableNameInCurlyBracesRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php81\Rector\Array_\ArrayToFirstClassCallableRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;

return RectorConfig::configure()
    ->withImportNames(removeUnusedImports: true)
    ->withIndent(indentChar: ' ', indentSize: 4)
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/routes',
        __DIR__.'/tests',
    ])
    ->withSkip([
        AbsolutizeRequireAndIncludePathRector::class => [
            __DIR__.'/deploy.php',
        ],
        ArrayToFirstClassCallableRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class,
        CompactToVariablesRector::class,
        ExplicitBoolCompareRector::class,
        ExplicitReturnNullRector::class,
        LocallyCalledStaticMethodToNonStaticRector::class,
        NewlineAfterStatementRector::class,
        NewlineBetweenClassLikeStmtsRector::class,
        NewlineBeforeNewAssignSetRector::class,
        NullToStrictStringFuncCallArgRector::class,
        RemoveUnusedPrivateMethodParameterRector::class,
        RemoveUnusedPrivateMethodRector::class => [
            __DIR__.'/app/View/Components/Form/Schedule.php',
        ],
        SimplifyQuoteEscapeRector::class,
        StrlenZeroToIdenticalEmptyStringRector::class,
        WrapVariableVariableNameInCurlyBracesRector::class,
    ])
    ->withPhpSets(php84: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true
    );
