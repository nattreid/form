<?php

namespace NAttreid\Form;

/**
 * Datum a cas
 *
 * @author Attreid <attreid@gmail.com>
 */
class DateTimePicker extends \Nextras\Forms\Controls\DateTimePicker
{

	/**
	 * Nastavi placeholder
	 * @param string $value
	 * @return self
	 */
	public function setPlaceholder($value)
	{
		$this->setAttribute('placeholder', $value);
		return $this;
	}

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
