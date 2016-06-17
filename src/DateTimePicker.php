<?php

namespace NAttreid\Form;

/**
 * Datum a cas
 *
 * @author Attreid <attreid@gmail.com>
 */
class DateTimePicker extends \RadekDostal\NetteComponents\DateTimePicker\DateTimePicker {

    /**
     * Nastavi placeholder
     * @param string $value
     * @return self
     */
    public function setPlaceholder($value) {
        $this->setAttribute('placeholder', $value);
        return $this;
    }

}
