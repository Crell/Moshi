<?php

declare(strict_types=1);

namespace Crell\Moshi;

use Crell\Moshi\Schema\Schema;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\FileGenerator;
use Laminas\Code\Generator\PropertyGenerator;

class Exporter
{
    public function __construct(
        /**
         * Map of schema ID URIs to desired class names.
         */
        protected array $idMap,
    ) {}

    /**
     * @return FileGenerator[]
     */
    public function export(Schema $schema, string $namespace): array
    {
        $gClass = new ClassGenerator();

        $name = $this->idMap[$schema?->id] ?? throw NoClassNameDefined::create($schema?->schema);

        $gClass->setName($name);

        $gDocblock = new DocBlockGenerator();
        if ($schema->title) {
            $gDocblock->setShortDescription($schema->title);
        }

        $description = $schema?->description ?? '';
        if ($description) {
            $description .= PHP_EOL . PHP_EOL;
        }

        // @todo Maybe this should be a tag of some kind instead of free form?
        $description .= sprintf("Auto-generated from %s", $schema?->schema);

        $gDocblock->setLongDescription($description);
        $gClass->setDocBlock($gDocblock);

        foreach ($schema->properties as $name => $property) {
            $gProperty = new PropertyGenerator($name);
            $gProperty->setVisibility(PropertyGenerator::VISIBILITY_PUBLIC);
            if ($property->description) {
                $gDocblock = new DocBlockGenerator($property->description);
                $gProperty->setDocBlock($gDocblock);
            }
            $gClass->addPropertyFromGenerator($gProperty);
        };


        $gFile = new FileGenerator();
        $gFile->setClass($gClass);

        $gFile->setNamespace($namespace);

        $files[] = $gFile;

        return $files;
    }
}
