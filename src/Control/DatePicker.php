<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Date;
use NAttreid\Form\Traits\Input;
use Nette\Utils\Html;

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
	public function getControl(): Html
	{
		$this->htmlType = 'text';
		$control = parent::getControl();

		$control->addClass('form-date');
		$control->setAttribute('autocomplete', 'off');

		return $control;
	}

}
