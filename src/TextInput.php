<?php

namespace nattreid\form;

/**
 * {@inheritdoc }
 */
class TextInput extends \Nette\Forms\Controls\TextInput {

    /**
     * Nastavi placeholder
     * @param string $value
     * @return self
     */
    public function setPlaceholder($value) {
        $this->setAttribute('placeholder', $value);
        return $this;
    }

    /**
     * Vypne naseptavani prohlizece
     * @param boolean $disable
     * @return self
     */
    public function disableAutocomplete($disable = TRUE) {
        $this->setAttribute('autocomplete', $disable ? 'off' : 'on');
        return $this;
    }

}
