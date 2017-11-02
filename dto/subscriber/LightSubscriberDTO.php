<?php

namespace Tefps\TefpsClientsBundle\dto\subscriber;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class LightSubscriberDTO
{
    /**
     * @Type("string")
     * @SerializedName("subscriberId")
     */
    private $subscriberId;

    /**
     * @Type("string")
     * @SerializedName("plate")
     */
    private $plate;

    /**
     * @Type("string")
     * @SerializedName("subscriptionPlanId")
     */
    private $subscriptionPlanId;

    /**
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     * @SerializedName("startOfValidityDatetime")
     */
    private $startOfValidityDatetime;

    /**
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     * @SerializedName("endOfValidityDatetime")
     */
    private $endOfValidityDatetime;

    /**
      * @Type("array<string>")
      * @SerializedName("validityAreas")
      */
    private $validityAreas;

    public function getSubscriberId() {
        return $this->subscriberId;
    }

    public function setSubscriberId($subscriberId) {
        $this->subscriberId = $subscriberId;
    }

    public function getPlate() {
        return $this->plate;
    }

    public function setPlate($plate) {
        $this->plate = $plate;
    }

    public function getSubscriptionPlanId() {
        return $this->subscriptionPlanId;
    }

    public function setSubscriptionPlanId($subscriptionPlanId) {
        $this->subscriptionPlanId = $subscriptionPlanId;
    }

    public function getStartOfValidityDatetime() {
        return $this->startOfValidityDatetime;
    }

    public function setStartOfValidityDatetime(\DateTime $startOfValidityDatetime) {
        $this->startOfValidityDatetime = $startOfValidityDatetime;
    }

    public function getEndOfValidityDatetime() {
        return $this->endOfValidityDatetime;
    }

    public function setEndOfValidityDatetime(\DateTime $endOfValidityDatetime) {
        $this->endOfValidityDatetime = $endOfValidityDatetime;
    }

    public function getValidityAreas() {
        return $this->validityAreas;
    }

    public function setValidityAreas($validityAreas) {
        $this->validityAreas = $validityAreas;
    }
}
