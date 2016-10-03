<?php

namespace NAttreid\Form;

use NAttreid\Utils\Range;
use Nette\Utils\DateTime;

/**
 * Interval datumu
 *
 * @author Attreid <attreid@gmail.com>
 */
class DateRange extends \Nette\Forms\Controls\TextInput
{

	/**
	 * Format datumu
	 * @var string
	 */
	private $format = 'd.m.Y';
	private $delimiter = ' - ';

	public function __construct($label = null)
	{
		parent::__construct($label, null);
	}

	/**
	 * Nastavi format
	 * @param string $format
	 */
	public function setFormat($format)
	{
		$this->format = $format;
	}

	/**
	 * Nastavi oddelovac datumu
	 * @param string $delimiter
	 */
	public function setDelimiter($delimiter)
	{
		$this->delimiter = $delimiter;
	}

	/**
	 * Vrati pole intervalu datumu
	 * @return Range|null
	 */
	public function getValue()
	{
		if (!empty($this->value)) {
			$result = new Range;
			list($from, $to) = explode($this->delimiter, $this->value);

			$result->from = DateTime::createFromFormat($this->format, $from);
			$result->to = DateTime::createFromFormat($this->format, $to);

			return $result;
		} else {
			return null;
		}
	}

	/**
	 * Nastavi hodnotu
	 * @param Range|string $value
	 */
	public function setValue($value)
	{
		if ($value instanceof Range) {
			$str = $value->from->format($this->format) . $this->delimiter . $value->to->format($this->format);
			parent::setValue($str);
		} else {
			parent::setValue($value);
		}
	}

	/**
	 * Nastavi kontrol
	 * @return \Nette\Utils\Html
	 */
	public function getControl()
	{
		$control = parent::getControl();

		$control->class = 'form-daterange form-control';
		$control->readonly = true;

		return $control;
	}

}
