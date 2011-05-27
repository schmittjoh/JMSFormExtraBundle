========
Overview
========

This bundle adds some convenience features to make using forms even easier.

Installation
------------
Checkout a copy of the code::

    git submodule add https://github.com/schmittjoh/FormExtraBundle.git src/JMS/FormExtraBundle

Then register the bundle with your kernel::

    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new JMS\FormExtraBundle\JMSFormExtraBundle(),
        // ...
    );

This bundle also requires the Metadata library::

    git submodule add https://github.com/schmittjoh/metadata.git vendor/metadata

Make sure that you also register the namespaces with the autoloader::

    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'JMS'              => __DIR__.'/../vendor/bundles',
        'Metadata'         => __DIR__.'/../vendor/metadata/src',
        // ...
    ));

Annotations
-----------

@Type
~~~~~
This annotation can be specified on properties where the default type guesser
is wrong, or not accurate enough::

    <?php

    namespace MyNamespace;

    use Doctrine\ORM\Mapping as ORM;
    use JMS\FormExtraBundle\Annotation as Form;

    class Order
    {
        /**
         * @ORM\Column(type="decimal", precision=2)
         * @Form\Type("money", options = {"currency" = "EUR"})
         */
        private $amount;
    }