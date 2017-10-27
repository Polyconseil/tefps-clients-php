<?php

namespace TefpsClientsBundle\dto\tv;

use TefpsClientsBundle\dto\tv\ParkingRightCreationDTO;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class ParkingRightDTO extends ParkingRightCreationDTO
{
    /**
     * @Type("string")
     * @SerializedName("ticketId")
     */
    private $ticketId;

    public function getTicketId() {
        return $this->ticketId;
    }

    public function setTicketId($ticketId) {
        $this->ticketId = $ticketId;
    }
}
