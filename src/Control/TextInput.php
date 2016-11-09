<?php

namespace NAttreid\Form\Control;

/**
 * {@inheritdoc }
 */
class TextInput extends \Nette\Forms\Controls\TextInput
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
