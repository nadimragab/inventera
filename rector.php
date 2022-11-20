<?php

declare(strict_types=1);

use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Symfony\Set\SymfonySetList;
use Rector\Symfony\Set\SensiolabsSetList;
use RectorNette\Set\NetteSetList;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Php80\Rector\Class_\DoctrineAnnotationClassToAttributeRector;
return static function (RectorConfig $rectorConfig): void {
    #$rectorConfig->paths([
     #   __DIR__ . '/src'
    #]);

    $rectorConfig->ruleWithConfiguration(DoctrineAnnotationClassToAttributeRector::class, [
        DoctrineAnnotationClassToAttributeRector::REMOVE_ANNOTATIONS => true,
    ]);
    #$rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

};
