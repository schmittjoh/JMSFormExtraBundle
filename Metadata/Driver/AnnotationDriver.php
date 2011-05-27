<?php

namespace JMS\FormExtraBundle\Metadata\Driver;

use Annotations\Reader;
use JMS\FormExtraBundle\Annotation\Type;
use JMS\FormExtraBundle\Metadata\PropertyMetadata;
use Metadata\ClassMetadata;
use Metadata\Driver\DriverInterface;

class AnnotationDriver implements DriverInterface
{
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function loadMetadataForClass(\ReflectionClass $class)
    {
        $metadata = new ClassMetadata($className = $class->getName());
        foreach ($class->getProperties() as $name => $property) {
            if ($property->getDeclaringClass()->getName() !== $className) {
                continue;
            }

            if ($annotations = $this->reader->getPropertyAnnotations($property)) {
                $propertyMetadata = new PropertyMetadata($className, $name);

                $add = false;
                foreach ($annotations as $annot) {
                    if ($annot instanceof Type) {
                        $propertyMetadata->fieldType = $annot->type;
                        $propertyMetadata->fieldOptions = $annot->options;
                        $add = true;
                    }
                }

                if ($add) {
                    $metadata->addPropertyMetadata($propertyMetadata);
                }
            }
        }

        if ($metadata->propertyMetadata) {
            return $metadata;
        }

        return null;
    }
}