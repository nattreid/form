<?php

namespace NAttreid\Form;

use Nette\ComponentModel\IContainer;
use Nette\Localization\ITranslator;
use Nette\SmartObject;

/**
 * Tovarna na formular
 *
 * @author Attreid <attreid@gmail.com>
 */
class FormFactory
{
	use SmartObject;

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
