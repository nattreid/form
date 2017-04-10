<?php

declare(strict_types=1);

namespace NAttreid\Form\Traits;

/**
 * Trait Date
 *
 * @author Attreid <attreid@gmail.com>
 */
trait Date
{
	/**
	 * Nastavi formatovani data
	 * @param string $format
	 * @return self
	 */
	public function setFormat(string $format): self
	{
		$this->htmlFormat = $format;
		return $this;
	}
}