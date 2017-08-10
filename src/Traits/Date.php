<?php

declare(strict_types=1);

namespace NAttreid\Form\Traits;

use DateTimeImmutable;
use Nette\Utils\DateTime;

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

	public function getValue()
	{
		if ($this->value instanceof DateTimeImmutable) {
			return DateTime::from($this->value);
		} else {
			return parent::getValue();
		}
	}

	public function setValue($value)
	{
		return parent::setValue($value instanceof DateTimeImmutable ? $value->format($this->htmlFormat) : $value);
	}
}