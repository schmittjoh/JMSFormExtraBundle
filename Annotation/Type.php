<?php

namespace JMS\FormExtraBundle\Annotation;

class Type
{
    public $type;
    public $options;

    public function __construct(array $values)
    {
        if (!isset($value['value'])) {
            throw new \InvalidArgumentException('"value" attribute must be set.');
        }
        if (isset($value['options']) && !is_array($value['options'])) {
            throw new \InvalidArgumentException(sprintf('"options" attribute must be an array, but got %s.', json_encode($value['options'])));
        }

        $this->type = $value['value'];
        $this->options = isset($value['options']) ? $value['options'] : array();
    }
}