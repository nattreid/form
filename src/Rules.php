<?php

namespace NAttreid\Form;

use Nette\Forms\IControl;
use Nette\Utils\Strings;

/**
 * Class Rules
 *
 * @author Attreid <attreid@gmail.com>
 */
class Rules
{
	const
		PHONE = 'NAttreid\Form\Rules::validatePhone';

	/**
	 * Validace telefoniho cisla
	 * @param IControl $control
	 * @return boolean
	 */
	public static function validatePhone(IControl $control)
	{
		$value = Strings::replace($control->getValue(), '/[-\.\s]/');
		return preg_match('/^(\(?\+?([0-9]{1,4})\)?)?([0-9]{9,16})$/', $value);
	}
}