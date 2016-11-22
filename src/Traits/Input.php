<?php

namespace NAttreid\Form\Traits;

/**
 * Trait Input
 *
 * @author Attreid <attreid@gmail.com>
 */
trait Input
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