<?php
namespace Tefps\TefpsClientsBundle\dto\tv;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Plate {

    /**
     * Immatriculation du véhicule contrôlé
     * @Type("string")
     * @SerializedName("plate")
     */
    private $plate;

    /**
     * Pays d'origine de la plaque au format ISO 3166-1 alpha-2
     * @Type("string")
     * @SerializedName("plateCountry")
     */
    private $plateCountry;

    /**
     * @Type("string")
     * @SerializedName("pricingCategory")
     */
    private $pricingCategory;

    public function getPlate() {
        return $this->plate;
    }

    public function setPlate($plate) {
        $this->plate = $plate;
    }

    public function getPlateCountry() {
        return $this->plateCountry;
    }

    public function setPlateCountry($plateCountry) {
        $this->plateCountry = $plateCountry;
    }

    public function getPricingCategory() {
        return $this->pricingCategory;
    }

    public function setPricingCategory($pricingCategory) {
        $this->pricingCategory = $pricingCategory;
    }
}
