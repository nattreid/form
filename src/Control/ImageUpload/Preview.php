<?php

declare(strict_types=1);

namespace NAttreid\Form\Control\ImageUpload;

use NAttreid\ImageStorage\ImageStorage;
use Nette\Forms\Controls\SubmitButton;
use Nette\Forms\Validator;
use Nette\Utils\Html;

/**
 * Zobrazeni obrazku
 *
 * @author Attreid <attreid@gmail.com>
 */
class Preview extends SubmitButton
{

	const
		NAME = '_preview',
		DELETE = ':imagePreviewDelete';

	/** @var string */
	private $imageName;

	/** @var ImageStorage */
	private $storage;

	/** @var string */
	private $prepend;

	/** @var string */
	private $size = null;

	/** @var bool */
	private $required = false;

	/**
	 * Preview constructor.
	 * @param string|object $button
	 */
	public function __construct($button = null)
	{
		if ($button == null) {
			$button = Validator::$messages[self::DELETE] ?? 'Delete';
		}
		parent::__construct($button);
	}

	/**
	 * {@inheritdoc }
	 */
	protected function attached($form): void
	{
		parent::attached($form);
		$this->setAttribute('class', 'btn btn-danger');
		$this->setValidationScope(false);
	}

	/**
	 * @return bool
	 */
	public function isOk(): bool
	{
		return $this->imageName && $this->storage->getResource($this->imageName)->isOk();
	}

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
	public function setPrepend(string $prepend): self
	{
		$this->prepend = $prepend;
		return $this;
	}

	/**
	 * @param ImageStorage $storage
	 * @return self
	 */
	public function setStorage(ImageStorage $storage): self
	{
		$this->storage = $storage;
		return $this;
	}

	/**
	 * @param string $imageName
	 * @return self
	 */
	public function setImageName(string $imageName): self
	{
		$this->imageName = $imageName;
		return $this;
	}

	/**
	 * Nastavi zobrazeni prehledu a moznosti smazani obrazku
	 * @param string $size napr. '200x500'
	 * @return self
	 */
	public function setPreview(string $size): self
	{
		$this->size = $size;
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function setRequired($value = true): self
	{
		$this->required = $value;
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl($caption = null): ?Html
	{
		$button = parent::getControl($caption);
		if ($this->isOk()) {
			$container = null;
			if ($this->size !== null) {
				$resource = $this->storage->getResource($this->imageName, $this->size);

				/* @var $container Html */
				$container = Html::el('div')->setClass('upload-preview-image-container');
				$el = Html::el('img')
					->setClass('upload-preview-image')
					->setSrc($this->storage->link($resource));
				if ($resource->width) {
					$el->setWidth($resource->width);
				}
				if ($resource->height) {
					$el->setHeight($resource->height);
				}
				$container->addHtml($el);

				if (!$this->required) {
					$container->addHtml($button);
				}
			}
			return $container;
		} else {
			return null;
		}
	}
}
