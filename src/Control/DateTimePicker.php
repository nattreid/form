<?php

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Input;

/**
 * Datum a cas
 *
 * @author Attreid <attreid@gmail.com>
 */
class DateTimePicker extends \Nextras\Forms\Controls\DateTimePicker
{
	use Input;

	/**
	 * Nastavi formatovani data
	 * @param string $format
	 */
	public function setFormat($format)
	{
		$this->htmlFormat = $format;
	}

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
