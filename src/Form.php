<?php

declare(strict_types=1);

namespace NAttreid\Form;

use Kdyby\Replicator\Container;
use NAttreid\Form\Control\DatePicker;
use NAttreid\Form\Control\DateRange;
use NAttreid\Form\Control\DateTimePicker;
use NAttreid\Form\Control\ImageUpload\ImageUploadControl;
use NAttreid\Form\Control\LinkControl;
use NAttreid\Form\Control\PhoneInput;
use NAttreid\Form\Control\TextArea;
use NAttreid\Form\Control\TextInput;
use NAttreid\Form\Control\Typeahead;
use NAttreid\Utils\Date;
use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;

/**
 * {@inheritdoc }
 *
 * @method Container addDynamic($name, callable $callable, $createDefault = 0, $forceDefault = false) Callable function(\Nette\Forms\Container $item){
 * }
 */
class Form extends \Nette\Application\UI\Form
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

	/**
	 * {@inheritdoc }
	 * @return TextInput
	 */
	public function addText($name, $label = null, $cols = null, $maxLength = null)
	{
		$control = new TextInput($label, $maxLength);
		$control->setAttribute('size', $cols);
		return $this[$name] = $control;
	}

	/**
	 * {@inheritdoc }
	 * @return TextArea
	 */
	public function addTextArea($name, $label = null, $cols = null, $rows = null)
	{
		$control = new TextArea($label);
		$control->setAttribute('cols', $cols)->setAttribute('rows', $rows);
		return $this[$name] = $control;
	}

	/**
	 * {@inheritdoc }
	 * @return TextInput
	 */
	public function addPassword($name, $label = null, $cols = null, $maxLength = null)
	{
		return $this[$name] = (new TextInput($label, $maxLength))
			->setType('password')
			->setAttribute('size', $cols);
	}

	/**
	 * Prida odkaz do formulare
	 * @param string $name
	 * @param string $caption
	 * @param string $link
	 * @return LinkControl
	 */
	public function addLink($name, $caption, $link = null)
	{
		return $this[$name] = new LinkControl($caption, $link);
	}

	/**
	 * Prida Select box s neprelozenymi daty
	 * @param string $name
	 * @param string $label
	 * @param array $items
	 * @param string $prompt
	 * @return \Nette\Forms\Controls\SelectBox
	 */
	public function addSelectUntranslated($name, $label = null, array $items = null, $prompt = null)
	{
		$translator = $this->getTranslator();
		if ($translator != null && $label !== null) {
			$label = $translator->translate($label);
		}
		$element = parent::addSelect($name, $label, $items);
		if ($prompt !== null) {
			if ($translator != null) {
				$prompt = $translator->translate($prompt);
			}
			$element->setPrompt($prompt);
		}
		$element->setTranslator();
		return $element;
	}

	/**
	 * Prida Multi Select box s neprelozenymi daty
	 * @param string $name
	 * @param string $label
	 * @param array $items
	 * @param string $prompt
	 * @return \Nette\Forms\Controls\MultiSelectBox
	 */
	public function addMultiSelectUntranslated($name, $label = null, array $items = null, $prompt = null)
	{
		$translator = $this->getTranslator();
		if ($translator != null && $label !== null) {
			$label = $translator->translate($label);
		}

		if ($prompt !== null) {
			if ($translator != null) {
				$prompt = $translator->translate($prompt);
			}
			$items = ['' => $prompt] + $items;
		}
		$element = parent::addMultiSelect($name, $label, $items);

		$element->setTranslator();
		return $element;
	}

	/**
	 * Prida Checkbox seznam s neprelozenymi daty
	 * @param string $name
	 * @param string $label
	 * @param array $items
	 * @return CheckboxList
	 */
	public function addCheckboxListUntranslated($name, $label = null, array $items = null)
	{
		$translator = $this->getTranslator();
		if ($translator != null && $label !== null) {
			$label = $translator->translate($label);
		}
		$element = parent::addCheckboxList($name, $label, $items);
		$element->setTranslator();
		return $element;
	}

	/**
	 * Prida Checkbox s neprelozenymi daty
	 * @param string $name
	 * @param string $caption
	 * @return Checkbox
	 */
	public function addCheckboxUntranslated($name, $caption = null)
	{
		$element = parent::addCheckbox($name, $caption);
		$element->setTranslator();
		return $element;
	}

	/**
	 * Prida pole datum
	 * @param string $name
	 * @param string $label
	 * @return DatePicker
	 */
	public function addDate($name, $label = null)
	{
		$element = new DatePicker($label);
		$element->setFormat(Date::getFormat(Date::DATE));
		return $this[$name] = $element;
	}

	/**
	 * Prida pole datum a cas
	 * @param string $name
	 * @param string $label
	 * @return DateTimePicker
	 */
	public function addDateTime($name, $label = null)
	{
		$element = new DateTimePicker($label);
		$element->setFormat(Date::getFormat(Date::DATETIME));
		return $this[$name] = $element;
	}

	/**
	 * Prida pole interval datumu
	 * @param string $name
	 * @param string $label
	 * @return DateRange
	 */
	public function addDateRange($name, $label = null)
	{
		$element = new DateRange($label);
		$element->setFormat(Date::getFormat(Date::DATE));
		return $this[$name] = $element;
	}


	/**
	 * Autocomplete
	 * @param string $name
	 * @param string $label
	 * @param callback $callback
	 * @return Typeahead
	 */
	public function addTypeahead($name, $label = null, $callback = null)
	{
		return $this[$name] = new Typeahead($label, $callback);
	}

	/**
	 * Prida upload obrazku
	 * @param string $name
	 * @param string $label
	 * @param string $button
	 * @param int $maxImageSize
	 * @return ImageUploadControl
	 */
	public function addImageUpload($name, $label = null, $button = null, int $maxImageSize = 15)
	{
		return $this[$name] = new ImageUploadControl($label, $button, $maxImageSize);
	}

	/**
	 * Prida textovy editor
	 * @param string $name
	 * @param string $label
	 * @param int $cols
	 * @param int $rows
	 * @return \Nette\Forms\Controls\TextArea
	 */
	public function addTextEditor($name, $label = null, $cols = null, $rows = null)
	{
		return parent::addTextArea($name, $label, $cols, $rows)
			->setAttribute('class', 'ckeditor');
	}

	/**
	 * Prida telefon
	 * @param string $name
	 * @param string $label
	 * @return PhoneInput
	 */
	public function addPhone($name, $label = null)
	{
		return $this[$name] = new PhoneInput($label);
	}
}