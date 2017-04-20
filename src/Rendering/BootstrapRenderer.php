<?php

declare(strict_types=1);

namespace NAttreid\Form\Rendering;

use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Forms\Controls\RadioList;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\TextBase;
use Nette\Forms\Form;
use Nette\Forms\IControl;
use Nette\Forms\Rendering\DefaultFormRenderer;
use Nette\InvalidStateException;


/**
 * Class BootstrapRenderer
 *
 * @author Attreid <attreid@gmail.com>
 */
abstract class BootstrapRenderer extends DefaultFormRenderer
{
	/** @var Button */
	public $primaryButton = null;

	/** @var bool */
	private $controlsInit = false;

	/** @var string */
	protected $formType;

	public function __construct()
	{
		$this->wrappers['controls']['container'] = null;
		$this->wrappers['pair']['container'] = 'div class=form-group';
		$this->wrappers['pair']['.error'] = 'has-error';
		$this->wrappers['control']['description'] = 'span class=help-block';
		$this->wrappers['control']['errorcontainer'] = 'span class=help-block';
		$this->wrappers['error']['container'] = null;
		$this->wrappers['error']['item'] = 'div class="alert alert-danger"';
	}

	public function renderBegin()
	{
		$this->controlsInit();
		return parent::renderBegin();
	}

	public function renderEnd()
	{
		$this->controlsInit();
		return parent::renderEnd();
	}

	public function renderBody()
	{
		$this->controlsInit();
		return parent::renderBody();
	}

	public function renderControls($parent)
	{
		$this->controlsInit();
		return parent::renderControls($parent);
	}

	public function renderPair(IControl $control)
	{
		$this->controlsInit();
		return parent::renderPair($control);
	}

	public function renderPairMulti(array $controls)
	{
		$this->controlsInit();
		return parent::renderPairMulti($controls);
	}

	public function renderLabel(IControl $control)
	{
		$this->controlsInit();
		return parent::renderLabel($control);
	}

	public function renderControl(IControl $control)
	{
		$this->controlsInit();
		return parent::renderControl($control);
	}

	private function controlsInit()
	{
		if ($this->formType === null) {
			throw new InvalidStateException("'formType' must be set");
		}

		if ($this->controlsInit) {
			return;
		}

		$this->controlsInit = true;
		$this->form->getElementPrototype()->addClass('form-' . $this->formType);
		foreach ($this->form->getControls() as $control) {
			if ($control instanceof Button) {
				$markAsPrimary = $control === $this->primaryButton || (!isset($this->primaryButton) && empty($usedPrimary) && $control->parent instanceof Form);
				if ($markAsPrimary) {
					$class = 'btn btn-primary';
					$usedPrimary = true;
				} else {
					$class = 'btn btn-default';
				}
				$control->getControlPrototype()->addClass($class);

			} elseif ($control instanceof TextBase || $control instanceof SelectBox || $control instanceof MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');

			} elseif ($control instanceof Checkbox || $control instanceof CheckboxList || $control instanceof RadioList) {
				if ($control->getSeparatorPrototype()->getName() !== null) {
					$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
				} else {
					$control->getItemLabelPrototype()->addClass($control->getControlPrototype()->type . '-inline');
				}
			}
		}
	}
}
