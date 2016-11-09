<?php

namespace NAttreid\Form\Control;

use NAttreid\Form\Rules;
use Nette\Forms\Controls\TextBase;

/**
 * Class PhoneInput
 *
 * @author Attreid <attreid@gmail.com>
 */
class PhoneInput extends TextInput
{
	public function __construct($label)
	{
		parent::__construct($label, 20);
		$this->setType('tel');
		$this->setRequired(false);
		$this->addRule(Rules::PHONE);
	}

	public function addRule($validator, $message = NULL, $arg = NULL)
	{
		return TextBase::addRule($validator, $message, $arg);
	}

}