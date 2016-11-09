<?php

namespace NAttreid\Form\DI;

use Kdyby\Replicator\DI\ReplicatorExtension;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nextras\Forms\Bridges\Latte\Macros\BS3InputMacros;

/**
 * Rozsireni formulare
 *
 * @author Attreid <attreid@gmail.com>
 */
class FormExtension extends CompilerExtension
{
	private $defaults = [
		'BS3Macros' => false
	];

	public function beforeCompile()
	{
		parent::beforeCompile();
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());
		if ($config['BS3Macros']) {
			$builder->getDefinition('nette.latteFactory')
				->addSetup('?->onCompile[] = function ($engine) { ' . BS3InputMacros::class . '::install($engine->getCompiler()); }', ['@self']);
		}
	}

	public function afterCompile(ClassType $class)
	{
		(new ReplicatorExtension())->afterCompile($class);
	}

}
