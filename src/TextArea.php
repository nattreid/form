<?php

namespace NAttreid\Form;

/**
 * {@inheritdoc }
 */
class TextArea extends \Nette\Forms\Controls\TextArea
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

}
