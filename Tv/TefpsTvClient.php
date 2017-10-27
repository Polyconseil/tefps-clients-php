<?php
namespace Tefps\TefpsClientsBundle\Tv;

use Tefps\TefpsClientsBundle\Auth\OAuth2HttpClient;
use Tefps\TefpsClientsBundle\dto\tv\ParkingRightDTO;
use Tefps\TefpsClientsBundle\dto\tv\ParkingRightCreationDTO;
use Tefps\TefpsClientsBundle\dto\tv\ParkingRightType;
use Tefps\TefpsClientsBundle\dto\tv\Plate;
use Tefps\TefpsClientsBundle\dto\PatchObject;

class TefpsTvClient
{
    const TV_API = "/api/cities/{cityId}/tickets/v1/{id}";

    private $tvUrl;
    private $oAuth2Client;

    public function __construct(OAuth2HttpClient $oAuth2Client, $tvUrl) {
        $this->oAuth2Client = $oAuth2Client;
        $this->tvUrl = $tvUrl;
    }

    public function createTv(
            $cityId,
            $tvId,
            $type,
            $source,
            $fineLegalId,
            $zoneId,
            $parkId,
            $plate,
            $plateCountry,
            $pricingCategory,
            \DateTime $startDatetime,
            \DateTime $endDatetime,
            \DateTime $creationDatetime,
            $cancelDatetime,
            $price,
            $pricingContext
    ) {
        $dto = new ParkingRightCreationDTO();

        $dto->setType($type);
        $dto->setFineLegalId($fineLegalId);
        $dto->setSource($source);
        $dto->setZoneId($zoneId);
        $dto->setParkId($parkId);

        $licensePlate = new Plate();
        $licensePlate->setPlate($plate);
        $licensePlate->setPricingCategory($pricingCategory);
        $licensePlate->setPlateCountry($plateCountry);
        $dto->setLicensePlate($licensePlate);

        $dto->setStartDatetime($startDatetime);
        $dto->setEndDatetime($endDatetime);
        $dto->setCreationDatetime($creationDatetime);
        $dto->setCancelDatetime($cancelDatetime);
        $dto->setPrice($price);
        $dto->setPricingContext($pricingContext);

        return $this->oAuth2Client->put(
                $this->buildURI($cityId, $tvId),
                $dto,
                ParkingRightDTO::class
        );
    }

    public function patchTv(
            $cityId,
            $tvId,
            $endDatetime = null,
            $price = null,
            $pricingContext = null
    ) {
        $patchList = [];

        if ($endDatetime != null) {
            $patch = new PatchObject();
            $patch->setOp(PatchObject::REPLACE);
            $patch->setPath("/endDatetime");
            $patch->setValue($endDatetime->format('Y-m-d\TH:i:s.uP'));
            $patchList[] = $patch;
        }

        if ($price != null) {
            $patch = new PatchObject();
            $patch->setOp(PatchObject::REPLACE);
            $patch->setPath("/price");
            $patch->setValue($price);
            $patchList[] = $patch;
        }

        if ($pricingContext != null) {
            $patch = new PatchObject();
            $patch->setOp(PatchObject::REPLACE);
            $patch->setPath("/pricingContext");
            $patch->setValue($pricingContext);
            $patchList[] = $patch;
        }

        return $this->oAuth2Client->patch(
                $this->buildURI($cityId, $tvId),
                $patchList,
                ParkingRightDTO::class
        );
    }

    public function fetchTv($cityId, $tvId) {
        return $this->oAuth2Client->get(
                $this->buildURI($cityId, $tvId),
                ParkingRightDTO::class
        );
    }

    public function deleteTv($cityId, $tvId) {
        $this->oAuth2Client->delete($this->buildURI($cityId, $tvId));
    }

    private function buildURI($cityId, $tvId) {
        return OAuth2HttpClient::buildURI($this->tvUrl, self::TV_API, $cityId, $tvId);
    }
}
