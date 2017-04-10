<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Input;

/**
 * {@inheritdoc }
 */
class TextInput extends \Nette\Forms\Controls\TextInput
{
	use Input;

	/**
	 * Vypne naseptavani prohlizece
	 * @param bool $disable
	 * @return self
	 */
	public function disableAutocomplete(bool $disable = true): self
	{
		$this->setAttribute('autocomplete', $disable ? 'off' : 'on');
		return $this;
	}

}
