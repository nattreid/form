<?php

declare(strict_types=1);

namespace NAttreid\Form;

use Kdyby\Replicator\Container;
use NAttreid\Form\Control\DatePicker;
use NAttreid\Form\Control\DateRange;
use NAttreid\Form\Control\DateTimePicker;
use NAttreid\Form\Control\ImageUpload\ImageUploadControl;
use NAttreid\Form\Control\LinkControl;
use NAttreid\Form\Control\PhoneInput;
use NAttreid\Form\Control\Spectrum\SpectrumControl;
use NAttreid\Form\Control\TextArea;
use NAttreid\Form\Control\TextEditor;
use NAttreid\Form\Control\TextInput;
use NAttreid\Form\Control\Typeahead;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Forms\Controls\SelectBox;

/**
 * Interface IContainer
 *
 * @method Container addDynamic($name, callable $callable, $createDefault = 0, $forceDefault = false) Callable function(\Nette\Forms\Container $item)
 * @method TextInput addText(string $name, $label = null, int $cols = null, int $maxLength = null)
 * @method TextArea addTextArea(string $name, $label = null, int $cols = null, int $rows = null)
 * @method TextInput addPassword(string $name, $label = null, int $cols = null, int $maxLength = null)
 * @method LinkControl addLink(string $name, string $caption, string $link = null) Prida odkaz do formulare
 * @method SelectBox addSelectUntranslated(string $name, $label = null, array $items = null, string $prompt = null) Prida Select box s neprelozenymi daty
 * @method MultiSelectBox addMultiSelectUntranslated(string $name, $label = null, array $items = null, string $prompt = null) Prida Multi Select box s neprelozenymi daty
 * @method CheckboxList addCheckboxListUntranslated(string $name, $label = null, array $items = null) Prida Checkbox seznam s neprelozenymi daty
 * @method Checkbox addCheckboxUntranslated(string $name, string $caption = null) Prida Checkbox s neprelozenymi daty
 * @method DatePicker addDate(string $name, $label = null) Prida pole datum
 * @method DateTimePicker addDateTime(string $name, $label = null, bool $withSeconds = false) Prida pole datum a cas
 * @method DateRange addDateRange(string $name, $label = null) Prida pole interval datumu
 * @method Typeahead addTypeahead(string $name, $label = null, callable $callback = null) Autocomplete
 * @method ImageUploadControl addImageUpload(string $name, $label = null, string $button = null, int $maxImageSize = 15) Prida upload obrazku
 * @method TextEditor addTextEditor(string $name, $label = null) Prida textovy editor
 * @method PhoneInput addPhone(string $name, $label = null) Prida telefon
 * @method TextInput addEmail(string $name, $label = null) Prida Email
 * @method TextInput addInteger(string $name, $label = null) Prida cislo
 * @method SpectrumControl addColor(string $name, $label = null) Prida barvu
 *
 * @package NAttreid\Form
 */
interface IContainer
{

}