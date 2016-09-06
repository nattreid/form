<?php

namespace NAttreid\Form\DI;

use Nextras\Forms\Bridges\Latte\Macros\BS3InputMacros;

/**
 * Rozsireni formulare
 *
 * @author Attreid <attreid@gmail.com>
 */
class FormExtension extends \Nette\DI\CompilerExtension {

    public function beforeCompile() {
		parent::beforeCompile();
		$builder = $this->getContainerBuilder();
		$builder->getDefinition('nette.latteFactory')
			->addSetup('?->onCompile[] = function ($engine) { '.BS3InputMacros::class.'::install($engine->getCompiler()); }', ['@self']);

	}

    public function afterCompile(\Nette\PhpGenerator\ClassType $class) {
        (new \Kdyby\Replicator\DI\ReplicatorExtension())->afterCompile($class);
    }

}
