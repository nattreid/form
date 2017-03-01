<?php

declare(strict_types = 1);

namespace NAttreid\Form\Control;

use Nette\Forms\Controls\Button;
use Nette\Utils\Html;

/**
 * Link ve formulari
 *
 * @author Attreid <attreid@gmail.com>
 */
class LinkControl extends Button
{

	/**
	 * @param string $caption text odkazu
	 * @param string $link link odkazu
	 */
	public function __construct($caption, $link = null)
	{
		parent::__construct($caption);
		$this->control = Html::el('a');
		$this->link($link);
	}

	/**
	 * Ulozi link odkazu
	 * @param string $link
	 * @return self
	 */
	public function link(string $link): self
	{
		$this->control->href = $link;
		return $this;
	}

	/**
	 * Nastavi link jako ajax
	 * @return self
	 */
	public function setAjaxRequest(): self
	{
		$this->addClass('ajax');
		return $this;
	}

	/**
	 * Prida tridu
	 * @param string $class
	 * @return self
	 */
	public function addClass(string $class): self
	{
		$this->getControlPrototype()->addClass($class);
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl($caption = null)
	{
		$control = parent::getControl();
		$control->setText($this->translate($this->caption));
		return $control;
	}

	/**
	 * {@inheritdoc }
	 */
	public function isOmitted()
	{
		return true;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getLabel($caption = null)
	{
		return null;
	}

}
