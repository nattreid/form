<?php

declare(strict_types=1);

namespace NAttreid\Form\Control\ImageUpload;

use NAttreid\Form\Form;
use NAttreid\Form\Rules;
use NAttreid\ImageStorage\ImageStorage;
use Nette\Application\IPresenter;
use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\UploadControl;
use Nette\Http\FileUpload;
use Nette\Utils\Html;

/**
 * Ukladani obrazku ve form
 *
 * @author Attreid <attreid@gmail.com>
 */
class ImageUploadControl extends UploadControl
{

	/** @var Preview */
	private $preview;

	/** @var ImageHiddenField */
	private $imageHiddenField;

	/** @var ImageStorage */
	private $storage;

	/** @var ?string */
	private $namespace;

	/** @var bool */
	private $isValidated = false;

	/**
	 * @param string|object $label
	 * @param string|object $button
	 * @param int $maxImageSize
	 */
	public function __construct($label = null, $button = null, int $maxImageSize = 15)
	{
		$this->preview = new Preview($button);
		$this->imageHiddenField = new ImageHiddenField;

		parent::__construct($label);

		$this->addCondition(Form::FILLED)
			->addRule(Rules::IMAGE)
			->addRule(Form::MAX_FILE_SIZE, null, $maxImageSize * 1024 * 1024 /* v bytech */)
			->endCondition();

		$this->monitor('Nette\Application\IPresenter');
	}

	/**
	 * {@inheritdoc }
	 */
	protected function attached($form): void
	{
		parent::attached($form);

		if ($form instanceof Form) {
			$this->preview->setParent($form, $form->getName());
			$this->imageHiddenField->setParent($form, $form->getName());

			$form->onValidate[] = [$this, 'onValidate'];
		}

		if ($form instanceof IPresenter) {
			if (isset($form->imageStorage) && $form->imageStorage instanceof ImageStorage) {
				$this->storage = $form->imageStorage;
			} else {
				$this->storage = $form->context->getByType(ImageStorage::class);
			}

			$this->imageHiddenField->setPrepend($this->getHtmlName());

			$this->preview->setPrepend($this->getHtmlName());
			$this->preview->setStorage($this->storage);
			$this->preview->onClick[] = function () {
				$this->storage->delete($this->imageHiddenField->value);
				$this->value = null;
			};
		}
	}

	/**
	 * Ulozeni
	 */
	public function onValidate(): void
	{
		$value = null;
		if ($this->value instanceof FileUpload && $this->value->isOk()) {
			if ($this->imageHiddenField->value) {
				$this->storage->delete($this->imageHiddenField->value);
			}
			$resource = $this->storage->createUploadedResource($this->value);
			$resource->setNamespace($this->namespace);
			if ($this->storage->save($resource)) {
				$value = $resource->getIdentifier();
			}
		} else {
			$value = $this->imageHiddenField->value;
		}
		$this->value = $value;
		$this->preview->setImageName($value);
	}

	/**
	 * {@inheritdoc }
	 */
	public function loadHttpData(): void
	{
		parent::loadHttpData();

		$this->validate();
		$this->isValidated = true;

		$this->preview->loadHttpData();
		$this->imageHiddenField->loadHttpData();

		if (!$this->value->isOk()) {
			$this->value = null;
		}
	}

	/**
	 * Nastavi namespace
	 * @param string|null $namespace
	 * @return self
	 */
	public function setNamespace(?string $namespace = null): self
	{
		$this->namespace = $namespace;
		return $this;
	}

	/**
	 * Nastavi zobrazeni prehledu a moznosti smazani obrazku
	 * @param string $size napr. '200x500'
	 * @return self
	 */
	public function setPreview(string $size): self
	{
		$this->preview->setPreview($size);
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function setRequired($value = true): self
	{
		$this->preview->setRequired($value);
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function validate(): void
	{
		if (!$this->isValidated) {
			parent::validate();
		}
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl(): Html
	{
		if ($this->value !== null) {
			$this->preview->setImageName($this->value);
		}
		$this->imageHiddenField->value = $this->value;

		$control = Html::el('div');
		if (($preview = $this->preview->getControl()) !== null) {
			$control->addHtml($preview);
		}

		$control->addHtml(parent::getControl())
			->addHtml($this->imageHiddenField->getControl());

		return $control;
	}

	/**
	 * {@inheritdoc }
	 */
	public function setValue($value): void
	{
		BaseControl::setValue($value);
	}

}
