<?php

declare(strict_types=1);

namespace NAttreid\Form\Control;

use NAttreid\Form\Traits\Input;

/**
 * {@inheritdoc }
 */
class Typeahead extends \Nextras\Forms\Controls\Typeahead
{
	use Input;

	public function setLimit(int $limit): self
	{
		$this->setAttribute('data-limit', $limit);
		return $this;
	}

	public function disableAutocomplete(bool $disable = true): self
	{
		$this->setAttribute('autocomplete', $disable ? 'off' : 'on');
		return $this;
	}
}