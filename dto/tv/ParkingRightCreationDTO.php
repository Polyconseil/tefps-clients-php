<?php

namespace TefpsClientsBundle\dto\tv;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class ParkingRightCreationDTO {

    /**
     * @Type("string")
     * @SerializedName("type")
     */
    private $type;

    /**
     * @Type("string")
     * @SerializedName("source")
     */
    private $source;

    /**
     * @Type("string")
     * @SerializedName("fineLegalId")
     */
    private $fineLegalId;

    /**
     * @Type("string")
     * @SerializedName("zoneId")
     */
    private $zoneId;

    /**
     * @Type("string")
     * @SerializedName("parkId")
     */
    private $parkId;

    /**
     * @Type("TefpsClientsBundle\dto\tv\Plate")
     * @SerializedName("licensePlate")
     */
    private $licensePlate;

    /**
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     * @SerializedName("startDatetime")
     */
    private $startDatetime;

    /**
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     * @SerializedName("endDatetime")
     */
    private $endDatetime;

    /**
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     * @SerializedName("creationDatetime")
     */
    private $creationDatetime;

    /**
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     * @SerializedName("cancelDatetime")
     */
    private $cancelDatetime;

    /**
     * @Type("int")
     * @SerializedName("price")
     */
    private $price;

    /**
      * @Type("ArrayCollection<string, string>")
      * @SerializedName("pricingContext")
      */
    private $pricingContext;

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getSource() {
        return $this->source;
    }

    public function setSource($source) {
        $this->source = $source;
    }

    public function getFineLegalId() {
        return $this->fineLegalId;
    }

    public function setFineLegalId($fineLegalId) {
        $this->fineLegalId = $fineLegalId;
    }

    public function getZoneId() {
        return $this->zoneId;
    }

    public function setZoneId($zoneId) {
        $this->zoneId = $zoneId;
    }

    public function getParkId() {
        return $this->parkId;
    }

    public function setParkId($parkId) {
        $this->parkId = $parkId;
    }

    public function getLicensePlate() {
        return $this->licensePlate;
    }

    public function setLicensePlate($licensePlate) {
        $this->licensePlate = $licensePlate;
    }

    public function getStartDatetime() {
        return $this->startDatetime;
    }

    public function setStartDatetime($startDatetime) {
        $this->startDatetime = $startDatetime;
    }

    public function getEndDatetime() {
        return $this->endDatetime;
    }

    public function setEndDatetime($endDatetime) {
        $this->endDatetime = $endDatetime;
    }

    public function getCreationDatetime() {
        return $this->creationDatetime;
    }

    public function setCreationDatetime($creationDatetime) {
        $this->creationDatetime = $creationDatetime;
    }

    public function getCancelDatetime() {
        return $this->cancelDatetime;
    }

    public function setCancelDatetime($cancelDatetime) {
        $this->cancelDatetime = $cancelDatetime;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPricingContext() {
        return $this->pricingContext;
    }

    public function setPricingContext($pricingContext) {
        $this->pricingContext = $pricingContext;
    }
}
