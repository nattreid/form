<?php

namespace nattreid\form\ImageUpload;

use WebChemistry\Images\AbstractStorage,
    Nette\Utils\Html;

/**
 * Zobrazeni obrazku
 *
 * @author Attreid <attreid@gmail.com>
 */
class Preview extends \Nette\Forms\Controls\SubmitButton {

    const NAME = '_preview';

    /** @var string */
    private $imageName;

    /** @var Image */
    private $image;

    /** @var AbstractStorage */
    private $storage;

    /** @var string */
    private $prepend;

    /** @var boolean */
    private $view = FALSE;

    /** @var boolean */
    private $required = FALSE;

    public function __construct() {
        parent::__construct('default.form.delete');
    }

    /**
     * {@inheritdoc }
     */
    protected function attached($form) {
        parent::attached($form);
        $this->setAttribute('title', $this->getTranslator()->translate('default.form.deleteImage'));
        $this->setAttribute('class', 'submit-remove');
        $this->setValidationScope(FALSE);
        $this->onClick[] = function(Preview $button) {
            $this->storage->delete($this->image->value);
        };
    }

    /**
     * @return bool
     */
    public function isOk() {
        return $this->imageName && $this->getImageClass()->isExists();
    }

    /**
     * @return string
     */
    public function getHtmlName() {
        return $this->prepend . self::NAME;
    }

    /**
     * @param string $prepend
     * @return self
     */
    public function setPrepend($prepend) {
        $this->prepend = $prepend;
        return $this;
    }

    /**
     * @param Image $image
     * @return self
     */
    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    /**
     * @param AbstractStorage $storage
     * @return self
     */
    public function setStorage(AbstractStorage $storage) {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @param string $imageName
     * @return self
     */
    public function setImageName($imageName) {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * Nastavi zobrazeni prehledu a moznosti smazani obrazku
     * @param boolean $view
     * @return self
     */
    public function setPreview($view = TRUE) {
        $this->view = $view;
        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function setRequired($value = TRUE) {
        $this->required = $value;
        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function getControl($caption = NULL) {
        $button = parent::getControl($caption);
        if ($this->isOk()) {
            $container = NULL;
            if ($this->view) {
                $container = Html::el('div')->setClass('upload-preview-image-container');

                $el = Html::el('img')
                        ->setClass('upload-preview-image')
                        ->setSrc($this->storage->get($this->imageName, 'x100')->getLink());
                $container->add($el);

                if (!$this->required) {
                    $container->add($button);
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
    private function getImageClass() {
        $image = $this->storage->createImage();
        $image->setAbsoluteName($this->imageName);
        $image->setDefaultImage(NULL);

        return $image;
    }

}
