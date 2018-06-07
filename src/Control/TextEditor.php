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
	private $line = false;

	public function setCkEditorLine(bool $line = true): void
	{
		$this->line = $line;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl(): Html
	{
		$this->htmlType = 'text';
		$control = parent::getControl();

		if ($this->line) {
			$control->addClass('ckEditorLine');
		} else {
			$control->addClass('ckeditor');
		}

		return $control;
	}
}