<?php

namespace nattreid\form;

/**
 * Datum
 *
 * @author Attreid <attreid@gmail.com>
 */
class DatePicker extends \RadekDostal\NetteComponents\DateTimePicker\DatePicker {

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
