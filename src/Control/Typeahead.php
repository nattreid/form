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

	public function setMinLength(int $minLength): self
	{
		$this->setAttribute('data-min-length', $minLength);
		return $this;
	}

	public function setSubmitOnSelect(bool $submit = true): self
	{
		$this->setAttribute('data-submit-on-select', $submit);
		return $this;
	}

	public function disableAutocomplete(bool $disable = true): self
	{
		$this->setAttribute('autocomplete', $disable ? 'off' : 'on');
		return $this;
	}

	public function setEmptyMessage(string $message): self
	{
		$this->setAttribute('data-empty-message', $this->translate($message));
		return $this;
	}

	public function setSuggestionCallback(string $callback, string $display): self
	{
		$this->setAttribute('data-suggestion-callback', $callback);
		$this->setAttribute('data-suggestion-display', $display);
		return $this;
	}
}