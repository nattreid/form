<?php

namespace nattreid\form;

use Nette\Utils\Html;

/**
 * Link ve formulari
 * 
 * @author Attreid <attreid@gmail.com>
 */
class LinkControl extends \Nette\Forms\Controls\Button {

    /** @var Html */
    private $button;

    /**
     * 
     * @param string $caption text odkazu
     * @param string $link link odkazu
     */
    public function __construct($caption, $link = NULL) {
        parent::__construct($caption);
        $this->control = Html::el('a');
        $this->button = Html::el('input');
        $this->link($link);
        $this->setOmitted(TRUE);
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
            parent::setAttribute('class', 'ajax');
        } else {
            parent::setAttribute('class', NULL);
        }
        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function setAttribute($name, $value = TRUE) {
        $this->button->$name = $value;
        return $this;
    }

    /**
     * {@inheritdoc }
     */
    public function getLabel($caption = NULL) {
        return NULL;
    }

    /**
     * {@inheritdoc }
     */
    public function getControl($caption = NULL) {
        $control = parent::getControl();
        $this->button->type = 'button';
        $this->button->value = $this->translate($this->caption);
        $control->setHtml($this->button);
        $control->name = NULL;
        $control->value = NULL;
        return $control;
    }

}
