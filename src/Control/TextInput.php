<?php

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
	 * @param boolean $disable
	 * @return self
	 */
	public function disableAutocomplete($disable = true)
	{
		$this->setAttribute('autocomplete', $disable ? 'off' : 'on');
		return $this;
	}

}
