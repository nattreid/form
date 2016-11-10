<?php

namespace NAttreid\Form\Control\PhoneInput;

use NAttreid\Utils\Strings;
use Nette\SmartObject;

/**
 * Class PhoneNomber
 *
 * @property-read string $prefix
 * @property-read string $number
 *
 * @author Attreid <attreid@gmail.com>
 */
class PhoneNumber
{
	use SmartObject;

	/** @var string[] */
	private static $phonePrefixes = [
		'+1',
		'+20',
		'+27',
		'+28',
		'+210',
		'+211',
		'+212',
		'+213',
		'+214',
		'+215',
		'+216',
		'+217',
		'+218',
		'+219',
		'+220',
		'+221',
		'+222',
		'+223',
		'+224',
		'+225',
		'+226',
		'+227',
		'+228',
		'+229',
		'+230',
		'+231',
		'+232',
		'+233',
		'+234',
		'+235',
		'+236',
		'+237',
		'+238',
		'+239',
		'+240',
		'+241',
		'+242',
		'+243',
		'+244',
		'+245',
		'+246',
		'+247',
		'+248',
		'+249',
		'+250',
		'+251',
		'+252',
		'+253',
		'+254',
		'+255',
		'+256',
		'+257',
		'+258',
		'+259',
		'+260',
		'+261',
		'+262',
		'+263',
		'+264',
		'+265',
		'+266',
		'+267',
		'+268',
		'+269',
		'+290',
		'+291',
		'+292',
		'+293',
		'+294',
		'+295',
		'+296',
		'+297',
		'+298',
		'+299',
		'+30',
		'+31',
		'+32',
		'+33',
		'+34',
		'+36',
		'+39',
		'+350',
		'+351',
		'+352',
		'+353',
		'+354',
		'+355',
		'+356',
		'+357',
		'+358',
		'+359',
		'+370',
		'+371',
		'+372',
		'+373',
		'+374',
		'+375',
		'+376',
		'+377',
		'+378',
		'+379',
		'+380',
		'+381',
		'+382',
		'+383',
		'+384',
		'+385',
		'+386',
		'+387',
		'+388',
		'+389',
		'+40',
		'+41',
		'+43',
		'+44',
		'+45',
		'+46',
		'+47',
		'+48',
		'+49',
		'+420',
		'+421',
		'+422',
		'+423',
		'+424',
		'+425',
		'+426',
		'+427',
		'+428',
		'+429',
		'+51',
		'+52',
		'+53',
		'+54',
		'+55',
		'+56',
		'+57',
		'+58',
		'+500',
		'+501',
		'+502',
		'+503',
		'+504',
		'+505',
		'+506',
		'+507',
		'+508',
		'+509',
		'+590',
		'+591',
		'+592',
		'+593',
		'+594',
		'+595',
		'+596',
		'+597',
		'+598',
		'+599',
		'+60',
		'+61',
		'+62',
		'+63',
		'+64',
		'+65',
		'+66',
		'+670',
		'+671',
		'+672',
		'+673',
		'+674',
		'+675',
		'+676',
		'+677',
		'+678',
		'+679',
		'+680',
		'+681',
		'+682',
		'+683',
		'+684',
		'+685',
		'+686',
		'+687',
		'+688',
		'+689',
		'+690',
		'+691',
		'+692',
		'+693',
		'+694',
		'+695',
		'+696',
		'+697',
		'+698',
		'+699',
		'+7',
		'+800',
		'+801',
		'+802',
		'+803',
		'+804',
		'+805',
		'+806',
		'+807',
		'+808',
		'+809',
		'+81',
		'+82',
		'+83',
		'+84',
		'+86',
		'+89',
		'+850',
		'+851',
		'+852',
		'+853',
		'+854',
		'+855',
		'+856',
		'+857',
		'+858',
		'+859',
		'+870',
		'+875',
		'+876',
		'+877',
		'+878',
		'+879',
		'+880',
		'+881',
		'+882',
		'+883',
		'+884',
		'+885',
		'+886',
		'+887',
		'+888',
		'+889',
		'+90',
		'+91',
		'+92',
		'+93',
		'+94',
		'+95',
		'+98',
		'+960',
		'+961',
		'+962',
		'+963',
		'+964',
		'+965',
		'+966',
		'+967',
		'+968',
		'+969',
		'+970',
		'+971',
		'+972',
		'+973',
		'+974',
		'+975',
		'+976',
		'+977',
		'+978',
		'+979',
		'+990',
		'+991',
		'+992',
		'+993',
		'+994',
		'+995',
		'+996',
		'+997',
		'+998',
		'+999',
	];

	/** @var string */
	private $prefix;

	/** @var int */
	private $number;

	/** @var bool */
	private $valid = true;

	/**
	 * PhoneNumber constructor.
	 * @param int $number
	 */
	public function __construct($number, $prefix = null)
	{
		$this->number = $number;
		if (self::validatePhone($number)) {
			$this->prefix = $prefix;

			$number = Strings::replace($number, array(
				'/[-\.\s]+/' => '', // remove separators
				'/^00([0-9]{6,16})$/' => '+$1'
			));

			if (Strings::contains($number, '+')) {
				$this->parseNumber($number);
			} elseif ($prefix !== null) {
				$this->parseNumber($prefix . $number);
			}
		} else {
			$this->valid = false;
		}
	}

	/**
	 * @return string
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * @return string
	 */
	public function getPrefix()
	{
		return $this->prefix;
	}

	/**
	 * @return bool
	 */
	public function validate()
	{
		return $this->valid;
	}

	/**
	 * @return boolean
	 */
	public static function validatePhone($number)
	{
		$number = Strings::replace($number, '/[-\.\s]+/');
		return (boolean)preg_match('/^(\(?\+?([0-9]{1,4})\)?)?([0-9]{6,16})$/', $number);
	}

	/**
	 * @param string $number
	 */
	private function parseNumber($number)
	{
		$prefix = Strings::containsArray($number, self::$phonePrefixes);
		if ($prefix) {
			$number = str_replace($prefix, '', $number);
			if ($prefix === '+420' && strlen($number) != 9) {
			} elseif ($prefix === '+421' && strlen($number) != 9) {
			} else {
				$this->prefix = $prefix;
				$this->number = $number;
				return;
			}
		}

		$this->valid = false;
		$this->prefix = null;
	}

	function __toString()
	{
		return ($this->prefix ? $this->prefix . ' ' : '') . $this->number;
	}


}