<?php

declare(strict_types=1);

namespace NAttreid\Form\Rendering;

/**
 * Class InlineFormRenderer
 *
 * @author Attreid <attreid@gmail.com>
 */
class InlineFormRenderer extends BootstrapRenderer
{
	protected $formType = 'inline';

	public function __construct()
	{
		parent::__construct();
		$this->wrappers['control']['container'] = null;
		$this->wrappers['label']['container'] = null;
	}
}