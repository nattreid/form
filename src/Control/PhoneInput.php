<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Rules;
use NAttreid\Utils\PhoneNumber;
use Nette\Forms\Controls\TextBase;
use Nette\Forms\Rule;
use Nette\Forms\Validator;

/**
 * Class PhoneInput
 *
 * @author Attreid <attreid@gmail.com>
 */
class PhoneInput extends TextInput
{
	/** @var string */
	private $prefix;

	/**
	 * PhoneInput constructor.
	 * @param string|object $label
	 */
	public function __construct($label)
	{
		parent::__construct($label, 20);
		$this->setType('tel');
		$this->setRequired(false);
		$this->addRule(Rules::PHONE);
	}

	public function addRule($validator, $message = null, $arg = null): self
	{
		TextBase::addRule($validator, $message, $arg);
		return $this;
	}

	public function setPrefix(string $prefix): self
	{
		$this->prefix = $prefix;
		return $this;
	}

	/**
	 * @return PhoneNumber
	 */
	public function getValue(): ?PhoneNumber
	{
		$value = parent::getValue();
		return empty($value) ? null : new PhoneNumber($value, $this->prefix);
	}

	public function validate(): void
	{
		parent::validate();
		$value = $this->getValue();
		if ($value !== null) {
			if (!$value->validate()) {
				$rule = new Rule;
				$rule->control = $this;
				$rule->validator = Rules::PHONE;
				$this->addError(Validator::formatMessage($rule));
			}
		}
	}
}