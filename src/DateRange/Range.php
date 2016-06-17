<?php

namespace NAttreid\Form\DateRange;

/**
 * Datum od do
 *
 * @author Attreid <attreid@gmail.com>
 */
class Range {

    private static $delimiter = '--';
    private static $format = 'Y-m-d';

    /**
     * Datum od
     * @var \DateTime 
     */
    public $from;

    /**
     * Datum do
     * @var \DateTime 
     */
    public $to;

    public function __construct(\DateTime $from = NULL, \DateTime $to = NULL) {
        $this->from = $from ? : new \DateTime;
        $this->to = $to ? : new \DateTime;
    }

    /**
     * Vytvori objekt z retezce intervalu
     * @param string $interval
     * @return \self
     */
    public static function createFromString($interval) {
        list($from, $to) = explode(self::$delimiter, $interval);

        $dateFrom = DateTime::createFromFormat(self::$format, $from);
        $dateTo = DateTime::createFromFormat(self::$format, $to);

        return new self($dateFrom, $dateTo);
    }

    /**
     * Vrati from jako datum bez casu
     * @return string
     */
    public function getFromDate() {
        return $this->from->format(self::$format);
    }

    /**
     * Vrati to jako datum bez casu
     * @return string
     */
    public function getToDate() {
        return $this->to->format(self::$format);
    }

    public function __toString() {
        return $this->getFromDate() . self::$delimiter . $this->getToDate();
    }

}
