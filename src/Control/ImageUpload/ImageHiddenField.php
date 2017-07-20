<?php

declare(strict_types=1);

namespace NAttreid\Form\Control\ImageUpload;

use Nette\Forms\Controls\HiddenField;

/**
 * Ulozeny obrazek
 *
 * @author Attreid <attreid@gmail.com>
 */
class ImageHiddenField extends HiddenField
{

	const NAME = '_uploaded';

	/** @var string */
	private $prepend;

	/**
	 * @return string
	 */
	public function getHtmlName(): string
	{
		return $this->prepend . self::NAME;
	}

	/**
	 * @param string $prepend
	 * @return self
	 */
	public function setPrepend($prepend): self
	{
		$this->prepend = $prepend;
		return $this;
	}

}
