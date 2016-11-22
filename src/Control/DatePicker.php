<?php

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Input;

/**
 * Datum
 *
 * @author Attreid <attreid@gmail.com>
 */
class DatePicker extends \Nextras\Forms\Controls\DatePicker
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

		$control->addClass('form-date');

		return $control;
	}

}
