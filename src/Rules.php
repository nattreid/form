<?php

namespace NAttreid\Form;

use NAttreid\Utils\PhoneNumber;
use Nette\Forms\IControl;

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
		return PhoneNumber::validatePhone($control->getValue());
	}
}