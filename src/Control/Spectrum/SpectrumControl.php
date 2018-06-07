<?php

declare(strict_types=1);

namespace NAttreid\Form\Control\Spectrum;

use Nette\Forms\Controls\TextInput;

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
}