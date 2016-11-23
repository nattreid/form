<?php

namespace NAttreid\Form\Factories;

use NAttreid\Form\Form;
use Nette\ComponentModel\IContainer;
use Nette\Localization\ITranslator;

/**
 * Tovarna na formular
 *
 * @author Attreid <attreid@gmail.com>
 */
abstract class Factory
{
	/** @var ITranslator */
	private $translator;

	public function __construct(ITranslator $translator = null)
	{
		$this->translator = $translator;
	}

	/**
	 * @param IContainer $parent
	 * @param string $name
	 * @return Form
	 */
	public function create(IContainer $parent = null, $name = null)
	{
		$form = new Form($parent, $name);

		$form->setTranslator($this->translator);

		return $form;
	}
}
