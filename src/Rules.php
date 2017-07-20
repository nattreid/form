<?php

declare(strict_types=1);

namespace NAttreid\Form;

use NAttreid\Utils\PhoneNumber;
use Nette\Forms\Controls\UploadControl;
use Nette\Forms\IControl;
use Nette\Http\FileUpload;

/**
 * Class Rules
 *
 * @author Attreid <attreid@gmail.com>
 */
class Rules
{
	const
		PHONE = 'NAttreid\Form\Rules::validatePhone',
		IMAGE = 'NAttreid\Form\Rules::validateImage';

	/**
	 * Validace telefoniho cisla
	 * @param IControl $control
	 * @return bool
	 */
	public static function validatePhone(IControl $control): bool
	{
		return PhoneNumber::validatePhone((string) $control->getValue());
	}

	/**
	 * Validace obrazku + svg
	 * @param IControl $control
	 * @return bool
	 */
	public static function validateImage(UploadControl $control)
	{
		/* @var $file FileUpload */
		$file = $control->getValue();

		if (!in_array($file->getContentType(), ['image/gif', 'image/png', 'image/jpeg', 'image/svg+xml'], true)) {
			return false;
		}
		return true;
	}
}