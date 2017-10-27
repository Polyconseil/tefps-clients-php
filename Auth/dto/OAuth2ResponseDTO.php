<?php

namespace Tefps\TefpsClientsBundle\Auth\dto;

use JMS\Serializer\Annotation\Type;

class OAuth2ResponseDTO
{
    /**
     * @Type("string")
     */
    private $accessToken;

    /**
     * @Type("string")
     */
    private $tokenType;

    /**
     * @Type("int")
     */
    private $expiresIn;

    /**
     * @Type("string")
     */
    private $refreshToken;

    public function getAccessToken() {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;
    }

    public function getTokenType() {
        return $this->tokenType;
    }

    public function setTokenType($tokenType) {
        $this->tokenType = $tokenType;
    }

    public function getExpiresIn() {
        return $this->expiresIn;
    }

    public function setExpiresIn($expiresIn) {
        $this->expiresIn = $expiresIn;
    }

    public function getRefreshToken() {
        return $this->refreshToken;
    }

    public function setRefreshToken($refreshToken) {
        $this->refreshToken = $refreshToken;
    }
}
