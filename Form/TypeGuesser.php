<?php

namespace JMS\FormExtraBundle\Form;

use Metadata\MetadataFactoryInterface;
use Symfony\Component\Form\FormTypeGuesserInterface;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class TypeGuesser implements FormTypeGuesserInterface
{
    private $metadataFactory;

    public function __construct(MetadataFactoryInterface $factory)
    {
        $this->metadataFactory = $factory;
    }

    public function guessType($className, $property)
    {
        $metadata = $this->metadataFactory->getMetadataForClass($className);

        foreach ($metadata->classMetadata as $classMetadata) {
            if (!isset($classMetadata->propertyMetadata[$property])) {
                continue;
            }

            return new TypeGuess(
                $classMetadata->propertyMetadata[$property]->type,
                $classMetadata->propertyMetadata[$property]->options,
                Guess::HIGH_CONFIDENCE + 1
            );
        }

        return null;
    }

    public function guessRequired($class, $property)
    {
        return null;
    }

    public function guessMaxLength($class, $property)
    {
        return null;
    }
}