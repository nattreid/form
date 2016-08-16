<?php

namespace NAttreid\Form;

use Nette\Utils\Html;

/**
 * Link ve formulari
 * 
 * @author Attreid <attreid@gmail.com>
 */
class LinkControl extends \Nette\Forms\Controls\Button {

    /**
     * @param string $caption text odkazu
     * @param string $link link odkazu
     */
    public function __construct($caption, $link = NULL) {
        parent::__construct($caption);
        $this->control = Html::el('a');
        $this->link($link);
    }

    /**
     * Ulozi link odkazu
     * @param string $link
     * @return this
     */
    public function link($link) {
        $this->control->href = $link;
        return $this;
    }

    /**
     * Nastavi link jako ajax
     * @param boolean $ajax
     * @return this
     */
    public function setAjaxRequest($ajax = TRUE) {
        if ($ajax) {
            $this->addClass('ajax');
        } else {
            $this->removeClass('ajax');
        }
        return $this;
    }

    /**
     * Prida tridu
     * @param string $class
     * @return $this
     */
    public function addClass($class) {
        $this->getControlPrototype()->addClass($class);
        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function getControl($caption = NULL) {
        $control = parent::getControl();
        $control->setText($this->translate($this->caption));
        return $control;
    }

    /**
     * {@inheritdoc }
     */
    public function isOmitted() {
        return TRUE;
    }

    /**
     * {@inheritdoc }
     */
    public function getLabel($caption = NULL) {
        return NULL;
    }

}
