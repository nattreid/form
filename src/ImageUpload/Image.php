<?php

namespace NAttreid\Form\ImageUpload;

/**
 * Ulozeny obrazek
 *
 * @author Attreid <attreid@gmail.com>
 */
class Image extends \Nette\Forms\Controls\HiddenField {

    const NAME = '_uploaded';

    /** @var string */
    private $prepend;

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

}
