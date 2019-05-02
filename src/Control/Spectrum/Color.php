<?php

declare(strict_types=1);

namespace NAttreid\Form\Control\Spectrum;

use NAttreid\Utils\Strings;
use Nette\InvalidArgumentException;
use Nette\InvalidStateException;
use Nette\SmartObject;

/**
 * Class Color
 *
 * @property int $red
 * @property int $green
 * @property int $blue
 * @property float $opacity
 * @property string $color
 * @property string $rgb
 *
 * @author Attreid <attreid@gmail.com>
 */
class Color
{
	use SmartObject;

	/** @var int */
	private $red;

	/** @var int */
	private $green;

	/** @var int */
	private $blue;

	/** @var float|null */
	private $opacity;

	public function __construct(string $color)
	{
		if (Strings::startsWith($color, 'rgb')) {
			@list(, $this->red, $this->green, $this->blue, , $opacity) = Strings::match($color, '/rgba?\s*\(([0-9]+),\s*([0-9]+),\s*([0-9]+)(,\s*([0-9|\.]+)\s*)?\)/');
		} elseif (Strings::startsWith($color, '#')) {
			@list($this->red, $this->green, $this->blue, $opacity) = sscanf($color, "#%02x%02x%02x%02x");
			$opacity = round($opacity / 255, 2);
		} else {
			throw new InvalidStateException();
		}
		$this->opacity = $opacity ? floatval($opacity) : null;
	}

	protected function getColor(): string
	{
		return sprintf("#%02x%02x%02x", $this->red, $this->green, $this->blue);
	}

	protected function getRgb(): string
	{
		if ($this->opacity === null) {
			return "rgb($this->red, $this->green, $this->blue)";
		} else {
			return "rgba($this->red, $this->green, $this->blue, $this->opacity)";
		}
	}

	protected function getRed(): int
	{
		return intval($this->red);
	}

	protected function setRed(int $red)
	{
		if ($red < 0 || $red > 255) {
			throw new InvalidArgumentException();
		}
		$this->red = $red;
	}

	protected function getGreen(): int
	{
		return intval($this->green);
	}

	protected function setGreen(int $green)
	{
		if ($green < 0 || $green > 255) {
			throw new InvalidArgumentException();
		}
		$this->green = $green;
	}

	protected function getBlue(): int
	{
		return intval($this->blue);
	}

	protected function setBlue(int $blue)
	{
		if ($blue < 0 || $blue > 255) {
			throw new InvalidArgumentException();
		}
		$this->blue = $blue;
	}

	protected function getOpacity(): float
	{
		return $this->opacity ?? 1;
	}

	protected function setOpacity(?float $opacity)
	{
		if ($opacity !== null) {
			if ($opacity < 0 || $opacity > 1) {
				throw new InvalidArgumentException();
			}
		}
		$this->opacity = $opacity;
	}

	public function __toString(): string
	{
		if ($this->opacity === null) {
			return $this->getColor();
		} else {
			return sprintf("#%02x%02x%02x%02x", $this->red, $this->green, $this->blue, $this->opacity * 255);
		}
	}
}