<?php

namespace NAttreid\Form;

use NAttreid\Utils\Date;

/**
 * {@inheritdoc }
 * 
 * @method \Kdyby\Replicator\Container addDynamic($name, callable $callable) Callable function(\Nette\Forms\Container $item){}
 */
class Form extends \Nette\Application\UI\Form {

    /**
     * Maximalni velikost uploadu obrazku
     * @var int 
     */
    private $uploadImageMaxSize;

    /**
     * Vypnuti live JS validace formulare
     * @var boolean 
     */
    private $noLiveJsValidate = FALSE;

    public function __construct($uploadImageMaxSize, \Nette\Localization\ITranslator $translator = NULL, \Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
        parent::__construct($parent, $name);
        if ($translator != NULL) {
            $this->setTranslator($translator);
        }
        $this->uploadImageMaxSize = $uploadImageMaxSize;
    }

    /**
     * Nastavi html tridu pro formular
     * @param string $class
     * @return static
     */
    public function addClass($class) {
        $this->getElementPrototype()->class[] = $class;
        return $this;
    }

    /**
     * Nastavi formular jako AJAX
     * @return static
     */
    public function setAjaxRequest() {
        $this->addClass('ajax');
        return $this;
    }

    /**
     * Vypne live validaci v JS
     * @return static
     */
    public function noLiveJsValidate() {
        $this->noLiveJsValidate = TRUE;
        return $this;
    }

    /**
     * Vypne validaci v JS
     * @return static
     */
    public function noJsValidate() {
        $this->addClass('no-validate');
        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function render(...$args) {
        if ($this->noLiveJsValidate) {
            foreach ($this->getControls() as $control) {
                if ($control instanceof \Nette\Forms\Controls\BaseControl) {
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
    public function addError($message) {
        $translator = $this->getTranslator();
        if ($translator !== NULL) {
            $message = $translator->translate($message);
        }
        parent::addError($message);
    }

    /**
     * Adds single-line text input control to the form.
     * @param  string  control name
     * @param  string  label
     * @param  int  width of the control (deprecated)
     * @param  int  maximum number of characters the user may enter
     * @return TextInput
     */
    public function addText($name, $label = NULL, $cols = NULL, $maxLength = NULL) {
        $control = new TextInput($label, $maxLength);
        $control->setAttribute('size', $cols);
        return $this[$name] = $control;
    }

    /**
     * Adds multi-line text input control to the form.
     * @param  string  control name
     * @param  string  label
     * @param  int  width of the control
     * @param  int  height of the control in text lines
     * @return TextArea
     */
    public function addTextArea($name, $label = NULL, $cols = NULL, $rows = NULL) {
        $control = new TextArea($label);
        $control->setAttribute('cols', $cols)->setAttribute('rows', $rows);
        return $this[$name] = $control;
    }

    /**
     * Prida odkaz do formulare
     * @param string $name
     * @param string $caption
     * @param string $link
     * @return LinkControl
     */
    public function addLink($name, $caption, $link = NULL) {
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
    public function addSelectUntranslated($name, $label = NULL, array $items = NULL, $prompt = NULL) {
        $translator = $this->getTranslator();
        if ($translator != NULL && $label !== NULL) {
            $label = $translator->translate($label);
        }
        $element = parent::addSelect($name, $label, $items);
        if ($prompt !== NULL) {
            if ($translator != NULL) {
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
    public function addMultiSelectUntranslated($name, $label = NULL, array $items = NULL, $prompt = NULL) {
        $translator = $this->getTranslator();
        if ($translator != NULL && $label !== NULL) {
            $label = $translator->translate($label);
        }
        $element = parent::addMultiSelect($name, $label, $items);
        if ($prompt !== NULL) {
            if ($translator != NULL) {
                $prompt = $translator->translate($prompt);
            }
            $element->setPrompt($prompt);
        }
        $element->setTranslator();
        return $element;
    }

    /**
     * Prida Checkbox seznam s neprelozenymi daty
     * @param string $name
     * @param string $label
     * @param array $items
     * @return \Nette\Forms\Controls\CheckboxList
     */
    public function addCheckboxListUntranslated($name, $label = NULL, array $items = NULL) {
        $translator = $this->getTranslator();
        if ($translator != NULL && $label !== NULL) {
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
     * @return \Nette\Forms\Controls\Checkbox
     */
    public function addCheckboxUntranslated($name, $caption = NULL) {
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
    public function addDate($name, $label = NULL) {
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
    public function addDateTime($name, $label = NULL) {
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
    public function addDateRange($name, $label = NULL) {
        $element = new DateRange($label);
        $element->setFormat(Date::getFormat(Date::DATE));
        return $this[$name] = $element;
    }

    /**
     * Option control rendered as radio list
     * @param string $name
     * @param string $label
     * @param array $items
     * @return \Nextras\Forms\Controls\OptionList
     */
    public function addOptionList($name, $label = NULL, array $items = NULL) {
        return $this[$name] = new \Nextras\Forms\Controls\OptionList($label, $items);
    }

    /**
     * Multiple option control rendered as checkbox list
     * @param string $name
     * @param string $label
     * @param array $items
     * @return \Nextras\Forms\Controls\MultiOptionList
     */
    public function addMultiOptionList($name, $label = NULL, array $items = NULL) {
        return $this[$name] = new \Nextras\Forms\Controls\MultiOptionList($label, $items);
    }

    /**
     * Autocomplete
     * @param string $name
     * @param string $label
     * @param type $callback
     * @return \Nextras\Forms\Controls\Typeahead
     */
    public function addTypeahead($name, $label = NULL, $callback = NULL) {
        return $this[$name] = new Nextras\Forms\Controls\Typeahead($label, $callback);
    }

    /**
     * Prida upload obrazku
     * @param string $name
     * @param string $label
     * @return ImageUpload\ImageUploadControl
     */
    public function addImageUpload($name, $label = NULL) {
        return $this[$name] = new ImageUpload\ImageUploadControl($label, $this->uploadImageMaxSize);
    }

    /**
     * Prida Textovy editor
     * @param string $name
     * @param string $label
     * @param int $cols
     * @param int $rows
     * @return \Nette\Forms\Controls\TextArea
     */
    public function addTextEditor($name, $label = NULL, $cols = NULL, $rows = NULL) {
        return parent::addTextArea($name, $label, $cols, $rows)
                        ->setAttribute('class', 'ckeditor');
    }

}

interface IFormFactory {

    /** @return Form */
    public function create();
}
