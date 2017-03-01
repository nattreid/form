<?php

declare(strict_types = 1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Date;
use NAttreid\Form\Traits\Input;

/**
 * Datum
 *
 * @author Attreid <attreid@gmail.com>
 */
class DatePicker extends \Nextras\Forms\Controls\DatePicker
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

		$control->addClass('form-date');

		return $control;
	}

}
