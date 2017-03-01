<?php

declare(strict_types = 1);

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
	public function setPlaceholder(string $value): self
	{
		$this->setAttribute('placeholder', $value);
		return $this;
	}
}