<?php

declare(strict_types=1);

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
	public function setPlaceholder(string $value = null): self
	{
		$this->setAttribute('placeholder', $value ?? $this->caption);
		return $this;
	}
}