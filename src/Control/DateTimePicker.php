<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Date;
use NAttreid\Form\Traits\Input;
use Nette\Utils\Html;

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
	public function getControl(): Html
	{
		$this->htmlType = 'text';
		$control = parent::getControl();

		$control->addClass('form-datetime');

		return $control;
	}

	/**
	 * @param int|null $increment
	 * @return static
	 */
	public function setTimeIncrement(?int $increment)
	{

		if ($increment !== null) {
			$this->setAttribute('data-increment', $increment);
		} else {
			$this->setAttribute('data-increment', null);
		}
		return $this;
	}

}
