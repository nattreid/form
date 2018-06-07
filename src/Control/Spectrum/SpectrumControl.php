<?php

declare(strict_types=1);

namespace NAttreid\Form\Control\Spectrum;

use Nette\Forms\Controls\TextInput;
use Nette\Utils\Html;

/**
 * Class Spectrum
 *
 * @author Attreid <attreid@gmail.com>
 */
class SpectrumControl extends TextInput
{

	public function __construct($label)
	{
		parent::__construct($label, 9);
	}

	public function getValue(): ?Color
	{
		$value = parent::getValue();
		return empty($value) ? null : new Color($value);
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl(): Html
	{
		$control = parent::getControl();

		$control->addClass('spectrum');

		return $control;
	}
}