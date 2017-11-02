<?php
namespace Tefps\TefpsClientsBundle\Subscriber;

use Tefps\TefpsClientsBundle\Auth\OAuth2HttpClient;
use Tefps\TefpsClientsBundle\dto\subscriber\LightSubscriberDTO;

class TefpsSubscriberClient
{
    const SUBSCRIBER_API = "/api/cities/{cityId}/subscribers/{id}";

    private $subscriberUrl;
    private $oAuth2Client;

    public function __construct(OAuth2HttpClient $oAuth2Client, $subscriberUrl) {
        $this->oAuth2Client = $oAuth2Client;
        $this->subscriberUrl = $subscriberUrl;
    }

    public function createOrUpdateSubscriber(
            $cityId,
            $subscriberId,
            $plate,
            $subscriptionPlanId,
            \DateTime $startOfValidityDatetime,
            \DateTime $endOfValidityDatetime,
            $validityAreas
    ) {
        $dto = new LightSubscriberDTO();

        $dto->setSubscriberId($subscriberId);
        $dto->setPlate($plate);
        $dto->setSubscriptionPlanId($subscriptionPlanId);
        $dto->setStartOfValidityDatetime($startOfValidityDatetime);
        $dto->setEndOfValidityDatetime($endOfValidityDatetime);
        $dto->setValidityAreas($validityAreas);

        return $this->oAuth2Client->put(
                $this->buildURI($cityId, $subscriberId),
                $dto,
                null
        );
    }

    public function fetchSubscriber($cityId, $subscriberId) {
        return $this->oAuth2Client->get(
                $this->buildURI($cityId, $subscriberId),
                LightSubscriberDTO::class
        );
    }

    public function deleteSubscriber($cityId, $subscriberId) {
        $this->oAuth2Client->delete($this->buildURI($cityId, $subscriberId));
    }

    private function buildURI($cityId, $subscriberId) {
        return OAuth2HttpClient::buildURI($this->subscriberUrl, self::SUBSCRIBER_API, $cityId, $subscriberId);
    }
}
