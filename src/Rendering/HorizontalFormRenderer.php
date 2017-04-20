<?php

declare(strict_types=1);

namespace NAttreid\Form\Rendering;

/**
 * Class HorizontalFormRenderer
 *
 * @author Attreid <attreid@gmail.com>
 */
class HorizontalFormRenderer extends BootstrapRenderer
{
	protected $formType = 'horizontal';

	public function __construct()
	{
		parent::__construct();
		$this->wrappers['control']['container'] = 'div class=col-sm-9';
		$this->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
	}
}