<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Date;
use NAttreid\Form\Traits\Input;
use Nette\Utils\Html;
use Tracy\Debugger;

/**
 * Datum a cas
 *
 * @author Attreid <attreid@gmail.com>
 */
class DateTimePicker extends \Nextras\Forms\Controls\DateTimePicker
{
	use Input,
		Date;

	/** @var int|null */
	private $increment;


	public function setValue($value)
	{
		if ($value instanceof \DateTime || $value instanceof \DateTimeImmutable) {
			if ($this->increment) {
				$minutes = $value->format('i');
				$minutes = $minutes % $this->increment;
				$value = $value->modify("-$minutes minute");
			}
		}
		return parent::setValue($value);
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl(): Html
	{
		$this->htmlType = 'text';
		$control = parent::getControl();

		$control->addClass('form-datetime');
		$control->setAttribute('autocomplete', 'off');

		return $control;
	}

	/**
	 * @param int|null $increment
	 * @return static
	 */
	public function setTimeIncrement(?int $increment)
	{
		$this->increment = (int) abs($increment);
		if ($increment !== null) {
			$this->setAttribute('data-increment', $increment);
		} else {
			$this->setAttribute('data-increment', null);
		}
		return $this;
	}

}
