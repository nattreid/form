<?php

namespace NAttreid\Form\DI;

/**
 * Rozsireni formulare
 *
 * @author Attreid <attreid@gmail.com>
 */
class FormExtension extends \Nette\DI\CompilerExtension {

    private $defaults = [
        'maxUploadImageSize' => 5,
    ];

    public function loadConfiguration() {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults, $this->getConfig());

        $builder->addDefinition($this->prefix('form'))
                ->setImplement('NAttreid\Form\IFormFactory')
                ->setFactory('NAttreid\Form\Form')
                ->setArguments([$builder->literal('$maxUploadImageSize')])
                ->setParameters(['maxUploadImageSize' => $config['maxUploadImageSize']]);
    }

    public function beforeCompile() {
        $builder = $this->getContainerBuilder();
        $builder->getDefinition('latte.latteFactory')
                ->addSetup('Nextras\Forms\Bridges\Latte\Macros\BS3InputMacros::install(?->getCompiler())', ['@self']);
    }

    public function afterCompile(\Nette\PhpGenerator\ClassType $class) {
        (new \Kdyby\Replicator\DI\ReplicatorExtension())->afterCompile($class);
    }

}
