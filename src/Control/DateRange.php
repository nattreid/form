<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use NAttreid\Utils\Range;
use Nette\Forms\Controls\TextBase;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\DateTime;
use Nette\Utils\Html;

/**
 * Interval datumu
 *
 * @author Attreid <attreid@gmail.com>
 */
class DateRange extends TextInput
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
	 * @return DateRange
	 */
	public function setFormat(string $format): self
	{
		$this->format = $format;
		return $this;
	}

	/**
	 * Nastavi pouze rozmezi
	 * @return DateRange
	 */
	public function useRangeOnly(): self
	{
		$this->setAttribute('data-only-range', 'true');
		return $this;
	}

	/**
	 * Nastavi oddelovac datumu
	 * @param string $delimiter
	 * @return DateRange
	 */
	public function setDelimiter(string $delimiter): self
	{
		$this->delimiter = $delimiter;
		return $this;
	}

	/**
	 * Vrati pole intervalu datumu
	 * @return Range|null
	 */
	public function getValue(): ?Range
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
	 * @return TextBase
	 */
	public function setValue($value)
	{
		if ($value instanceof Range) {
			$str = $value->from->format($this->format) . $this->delimiter . $value->to->format($this->format);
			return parent::setValue($str);
		} else {
			return parent::setValue((string) $value);
		}
	}

	/**
	 * Nastavi kontrol
	 * @return Html
	 */
	public function getControl(): Html
	{
		$control = parent::getControl();

		$control->class = 'form-daterange form-control';
		$control->readonly = true;

		return $control;
	}

}
