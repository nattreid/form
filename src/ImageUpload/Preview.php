<?php

namespace NAttreid\Form\ImageUpload;

use Nette\Utils\Html;
use WebChemistry\Images\AbstractStorage;
use WebChemistry\Images\Image\PropertyAccess;

/**
 * Zobrazeni obrazku
 *
 * @author Attreid <attreid@gmail.com>
 */
class Preview extends \Nette\Forms\Controls\SubmitButton
{

	const NAME = '_preview';

	/** @var string */
	private $imageName;

	/** @var AbstractStorage */
	private $storage;

	/** @var string */
	private $prepend;

	/** @var string */
	private $size = NULL;

	/** @var boolean */
	private $required = FALSE;

	public function __construct($button)
	{
		if ($button == NULL) {
			$button = 'Delete';
		}
		parent::__construct($button);
	}

	/**
	 * {@inheritdoc }
	 */
	protected function attached($form)
	{
		parent::attached($form);
		$this->setAttribute('class', 'btn btn-danger');
		$this->setValidationScope(FALSE);
	}

	/**
	 * @return bool
	 */
	public function isOk()
	{
		return $this->imageName && $this->getImageClass()->isExists();
	}

	/**
	 * @return string
	 */
	public function getHtmlName()
	{
		return $this->prepend . self::NAME;
	}

	/**
	 * @param string $prepend
	 * @return self
	 */
	public function setPrepend($prepend)
	{
		$this->prepend = $prepend;
		return $this;
	}

	/**
	 * @param AbstractStorage $storage
	 * @return self
	 */
	public function setStorage(AbstractStorage $storage)
	{
		$this->storage = $storage;
		return $this;
	}

	/**
	 * @param string $imageName
	 * @return self
	 */
	public function setImageName($imageName)
	{
		$this->imageName = $imageName;
		return $this;
	}

	/**
	 * Nastavi zobrazeni prehledu a moznosti smazani obrazku
	 * @param string $size napr. '200x500'
	 * @return self
	 */
	public function setPreview($size = '200x100')
	{
		$this->size = $size;
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function setRequired($value = TRUE)
	{
		$this->required = $value;
		return $this;
	}

	/**
	 * {@inheritdoc }
	 */
	public function getControl($caption = NULL)
	{
		$button = parent::getControl($caption);
		if ($this->isOk()) {
			$container = NULL;
			if ($this->size !== NULL) {
				/* @var $container Html */
				$container = Html::el('div')->setClass('upload-preview-image-container');
				$el = Html::el('img')
					->setClass('upload-preview-image')
					->setSrc($this->storage->get($this->imageName, $this->size)->getLink());
				$container->addHtml($el);

				if (!$this->required) {
					$container->addHtml($button);
				}
			}
			return $container;
		} else {
			return NULL;
		}
	}

	/**
	 * @return PropertyAccess
	 */
	private function getImageClass()
	{
		$image = $this->storage->createImage();
		$image->setAbsoluteName($this->imageName);
		$image->setDefaultImage(NULL);

		return $image;
	}

}
