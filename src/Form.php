<?php

declare(strict_types=1);

namespace NAttreid\Form;

use Nette\Forms\Controls\BaseControl;

/** @noinspection PhpHierarchyChecksInspection */

/**
 * Class Form
 *
 * @author Attreid <attreid@gmail.com>
 */
class Form extends \Nette\Application\UI\Form implements IContainer
{

	/**
	 * Vypnuti live JS validace formulare
	 * @var bool
	 */
	private $noLiveJsValidate = false;

	/**
	 * Nastavi html tridu pro formular
	 * @param string $class
	 * @return static
	 */
	public function addClass(string $class)
	{
		$this->getElementPrototype()->class[] = $class;
		return $this;
	}

	/**
	 * Nastavi formular jako AJAX
	 * @return static
	 */
	public function setAjaxRequest()
	{
		$this->addClass('ajax');
		return $this;
	}

	/**
	 * Vypne live validaci v JS
	 * @return static
	 */
	public function noLiveJsValidate()
	{
		$this->noLiveJsValidate = true;
		return $this;
	}

	/**
	 * Vypne validaci v JS
	 * @return static
	 */
	public function noJsValidate()
	{
		$this->addClass('no-validate');
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function render(...$args)
	{
		if ($this->noLiveJsValidate) {
			foreach ($this->getControls() as $control) {
				if ($control instanceof BaseControl) {
					$prototype = $control->getControlPrototype();
					if ($prototype->class) {
						$class = $prototype->class;
						unset($prototype->class);
						$prototype->class[] = $class;
					}
					$prototype->class[] = 'no-live-validation';
				}
			}
		}
		parent::render($args);
	}

	/**
	 * {@inheritdoc }
	 */
	public function addError($message)
	{
		$translator = $this->getTranslator();
		if ($translator !== null) {
			$message = $translator->translate($message);
		}
		parent::addError($message);
	}
}