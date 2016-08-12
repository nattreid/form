<?php

namespace NAttreid\Form\DI;

use NAttreid\Form\IFormFactory,
    NAttreid\Form\Form,
    Nextras\Forms\Bridges\Latte\Macros\BS3InputMacros;

/**
 * Rozsireni formulare
 *
 * @author Attreid <attreid@gmail.com>
 */
class FormExtension extends \Nette\DI\CompilerExtension {

    public function beforeCompile() {
        $builder = $this->getContainerBuilder();
        $builder->getDefinition('latte.latteFactory')
                ->addSetup(BS3InputMacros::class . '::install(?->getCompiler())', ['@self']);
    }

    public function afterCompile(\Nette\PhpGenerator\ClassType $class) {
        (new \Kdyby\Replicator\DI\ReplicatorExtension())->afterCompile($class);
    }

}
