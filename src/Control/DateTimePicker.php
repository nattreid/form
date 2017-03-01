<?php

declare(strict_types = 1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Date;
use NAttreid\Form\Traits\Input;

/**
 * Datum a cas
 *
 * @author Attreid <attreid@gmail.com>
 */
class DateTimePicker extends \Nextras\Forms\Controls\DateTimePicker
{
	use Input,
		Date;

	/**
	 * {@inheritdoc }
	 */
	public function getControl()
	{
		$this->htmlType = 'text';
		$control = parent::getControl();

		$control->addClass('form-datetime');

		return $control;
	}

}
