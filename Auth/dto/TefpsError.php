<?php

namespace TefpsClientsBundle\Auth\dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class TefpsError
{
    /**
     * @Type("int")
     * @SerializedName("timestamp")
     */
    private $timestamp;

    /**
     * @Type("string")
     * @SerializedName("requestId")
     */
    private $requestId;

    /**
     * @Type("int")
     * @SerializedName("status")
     */
    private $status;

    /**
     * @Type("string")
     * @SerializedName("error")
     */
    private $error;

    /**
     * @Type("string")
     * @SerializedName("message")
     */
    private $message;

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function getRequestId() {
        return $this->requestId;
    }

    public function setRequestId($requestId) {
        $this->requestId = $requestId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getError() {
        return $this->error;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
}
