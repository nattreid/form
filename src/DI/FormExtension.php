<?php

declare(strict_types=1);

namespace NAttreid\Form\DI;

use Kdyby\Replicator\DI\ReplicatorExtension;
use NAttreid\Form\Control\DatePicker;
use NAttreid\Form\Control\DateRange;
use NAttreid\Form\Control\DateTimePicker;
use NAttreid\Form\Control\ImageUpload\ImageUploadControl;
use NAttreid\Form\Control\LinkControl;
use NAttreid\Form\Control\PhoneInput;
use NAttreid\Form\Control\Spectrum\SpectrumControl;
use NAttreid\Form\Control\TextEditor;
use NAttreid\Form\Control\Typeahead;
use NAttreid\Form\Factories\FormFactory;
use NAttreid\Utils\Date;
use Nette\DI\CompilerExtension;
use Nette\Forms\Container;
use Nette\Forms\Controls\TextArea;
use Nette\Forms\Controls\TextInput;
use Nette\PhpGenerator\ClassType;
use Nette\Utils\ObjectMixin;
use Nextras\Forms\Bridges\Latte\Macros\BS3InputMacros;

/**
 * Rozsireni formulare
 *
 * @author Attreid <attreid@gmail.com>
 */
class FormExtension extends CompilerExtension
{
	private $defaults = [
		'BS3Macros' => false
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('factory'))
			->setType(FormFactory::class);
	}

	public function beforeCompile(): void
	{
		parent::beforeCompile();
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());
		if ($config['BS3Macros']) {
			$builder->getDefinition('nette.latteFactory')
				->addSetup('?->onCompile[] = function ($engine) { ' . BS3InputMacros::class . '::install($engine->getCompiler()); }', ['@self']);
		}
	}

	public function afterCompile(ClassType $class): void
	{
		$init = $class->getMethods()['initialize'];
		$init->addBody(__CLASS__ . '::registerControls();');
		$replicatorExtension = new ReplicatorExtension();
		$replicatorExtension->afterCompile($class);
	}

	public static function registerControls(): void
	{
		TextInput::extensionMethod('disableAutocomplete', function (TextInput $control, bool $disable = true) {
			$control->setAttribute('autocomplete', $disable ? 'off' : 'on');
			return $control;
		});

		TextInput::extensionMethod('setPlaceholder', function (TextInput $control, string $value = null) {
			$control->setAttribute('placeholder', $value ?? $control->caption);
			return $control;
		});

		TextArea::extensionMethod('setPlaceholder', function (TextArea $control, string $value = null) {
			$control->setAttribute('placeholder', $value ?? $control->caption);
			return $control;
		});

		Container::extensionMethod('addLink', function (Container $container, string $name, string $caption, string $link = null) {
			return $container[$name] = new LinkControl($caption, $link);
		});

		Container::extensionMethod('addSelectUntranslated', function (Container $container, string $name, $label = null, array $items = null, string $prompt = null) {
			$translator = $container->form ? $container->form->getTranslator() : null;
			if ($translator != null && $label !== null) {
				$label = $translator->translate($label);
			}
			$element = $container->addSelect($name, $label, $items);
			if ($prompt !== null) {
				if ($translator != null) {
					$prompt = $translator->translate($prompt);
				}
				$element->setPrompt($prompt);
			}
			$element->setTranslator();
			return $element;
		});

		Container::extensionMethod('addMultiSelectUntranslated', function (Container $container, string $name, $label = null, array $items = null, string $prompt = null) {
			$translator = $container->form ? $container->form->getTranslator() : null;
			if ($translator != null && $label !== null) {
				$label = $translator->translate($label);
			}
			if ($prompt !== null) {
				if ($translator != null) {
					$prompt = $translator->translate($prompt);
				}
				$items = ['' => $prompt] + $items;
			}
			$element = $container->addMultiSelect($name, $label, $items);

			$element->setTranslator();
			return $element;
		});

		Container::extensionMethod('addCheckboxListUntranslated', function (Container $container, string $name, $label = null, array $items = null) {
			$translator = $container->form ? $container->form->getTranslator() : null;
			if ($translator != null && $label !== null) {
				$label = $translator->translate($label);
			}
			$element = $container->addCheckboxList($name, $label, $items);
			$element->setTranslator();
			return $element;
		});

		Container::extensionMethod('addCheckboxUntranslated', function (Container $container, string $name, string $caption = null) {
			$element = $container->addCheckbox($name, $caption);
			$element->setTranslator();
			return $element;
		});

		Container::extensionMethod('addDate', function (Container $container, string $name, $label = null) {
			return $container[$name] = (new DatePicker($label))
				->setFormat(Date::getFormat(true, false));
		});

		Container::extensionMethod('addDateTime', function (Container $container, string $name, $label = null, bool $withSeconds = false) {
			$control = new DateTimePicker($label);
			if ($withSeconds) {
				$control->setFormat(Date::getFormat(true, true, true));
			} else {
				$control->setFormat(Date::getFormat());
			}
			return $container[$name] = $control;

		});

		Container::extensionMethod('addDateRange', function (Container $container, string $name, $label = null) {
			return $container[$name] = (new DateRange($label))
				->setFormat(Date::getFormat(true, false));
		});

		Container::extensionMethod('addTypeahead', function (Container $container, string $name, $label = null, callable $callback = null) {
			return $container[$name] = new Typeahead($label, $callback);
		});

		Container::extensionMethod('addImageUpload', function (Container $container, string $name, $label = null, string $button = null, int $maxImageSize = 15) {
			return $container[$name] = new ImageUploadControl($label, $button, $maxImageSize);
		});

		Container::extensionMethod('addTextEditor', function (Container $container, string $name, $label = null) {
			return $container[$name] = new TextEditor($label);
		});

		Container::extensionMethod('addPhone', function (Container $container, string $name, $label = null) {
			return $container[$name] = new PhoneInput($label);
		});

		Container::extensionMethod('addColor', function (Container $container, string $name, $label = null) {
			return $container[$name] = new SpectrumControl($label);
		});
	}
}
