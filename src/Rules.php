<?php

namespace NAttreid\Form;

use Nette\Forms\IControl;

/**
 * Class Rules
 *
 * @author Attreid <attreid@gmail.com>
 */
class Rules
{
	const PHONE = 'NAttreid\Form\Rules::validatePhone';

	/**
	 * Validace telefoniho cisla
	 * @param IControl $control
	 * @return boolean
	 */
	public static function validatePhone(IControl $control)
	{
		return preg_match('/^\(?\+?([0-9]{1,4})\)?[-\. ]?(\d{3})[-\. ]?([0-9]{7})$/', trim($control->getValue()));
	}
}