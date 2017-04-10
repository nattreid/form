<?php

declare(strict_types=1);

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
	 * @return bool
	 */
	public static function validatePhone(IControl $control): bool
	{
		return PhoneNumber::validatePhone((string) $control->getValue());
	}
}