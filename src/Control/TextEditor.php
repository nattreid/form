<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use Nette\Utils\Html;

/**
 * {@inheritdoc }
 *
 * @author Attreid <attreid@gmail.com>
 */
class TextEditor extends \Nette\Forms\Controls\TextArea
{
	/** @var bool */
	private $inline = false;

	/**
	 * @param bool $inline
	 * @return static
	 */
	public function setInline(bool $inline = true)
	{
		$this->inline = $inline;
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl(): Html
	{
		$control = parent::getControl();

		if ($this->inline) {
			$control->addClass('ckEditorInline');
		} else {
			$control->addClass('ckeditor');
		}

		return $control;
	}
}