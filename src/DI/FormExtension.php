<?php

namespace NAttreid\Form\DI;

/**
 * Rozsireni formulare
 *
 * @author Attreid <attreid@gmail.com>
 */
class FormExtension extends \Nette\DI\CompilerExtension {

    private $defaults = [
        'maxUploadSize' => 5,
    ];

    public function loadConfiguration() {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults, $this->getConfig());

        $this->compiler->addExtension('formReplicator', new \Kdyby\Replicator\DI\ReplicatorExtension);

        $builder->addDefinition($this->prefix('form'))
                ->setImplement('NAttreid\Form\IForm')
                ->setClass('NAttreid\Form\Form')
                ->setArguments(['%maxUploadSize%'])
                ->setParameters([['maxUploadSize' => $config['maxUploadSize']]]);
    }

    public function beforeCompile() {
        $builder = $this->getContainerBuilder();
        $builder->getDefinition('latte.latteFactory')
                ->addSetup('Nextras\Forms\Bridges\Latte\Macros\BS3InputMacros::install(?->getCompiler())', ['@self']);
    }

}
