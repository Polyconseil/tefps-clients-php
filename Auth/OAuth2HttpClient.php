<?php

namespace TefpsClientsBundle\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Handler\ArrayCollectionHandler;
use TefpsClientsBundle\Auth\dto\OAuth2ResponseDTO;
use TefpsClientsBundle\Auth\DateTimeHandler;
use TefpsClientsBundle\Auth\dto\TefpsError;

class OAuth2HttpClient
{
    const HTTP_OK = 200;
    const HTTP_UNAUTHORIZED = 401;
    const DIRECTORY_API = "/api/oauth2/v1/token";
    const GRANT_CLIENT_CREDENTIALS = "client_credentials";

    private $tokenUrl;
    private $clientId;
    private $clientSecret;
    private $mapper;
    private $httpClient;

    private $currentAccessToken;
    private $currentAccessTokenExpiration;

    public function __construct($tokenUrl, $clientId, $clientSecret) {
        $this->tokenUrl = $tokenUrl;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        $this->httpClient = new Client();
        $this->mapper = SerializerBuilder::create()
          ->setSerializationContextFactory(function () {
            return SerializationContext::create()->setSerializeNull(true);
          })
          ->addDefaultHandlers()
          ->configureHandlers(function(\JMS\Serializer\Handler\HandlerRegistry $registry) {
            $registry->registerSubscribingHandler(new DateTimeHandler());
          })
        ->build();
    }

    private function doExecute(Request $requestBase, $valueType) {
        try {
          $response = $this->httpClient->send($requestBase);
          $content = $response->getBody()->getContents();

          return strlen($content) != 0 ? $this->mapper->deserialize($content, $valueType, 'json') : NULL;
        } catch (ClientException $e) {
          $content = $e->getResponse()->getBody()->getContents();
          $error = $this->mapper->deserialize($content, TefpsError::class, 'json');
          throw new TefpsCoreClientErrorException($error->getMessage(), $error->getError(), $error->getStatus());
        }
    }

    private function execute(Request $requestBase, $valueType) {
        $accessToken = $this->getOrFetchAccessToken();
        $requestBase = $requestBase->withAddedHeader("Authorization", "Bearer " . $accessToken);
        $requestBase = $requestBase->withAddedHeader("Content-Type",  "application/json");

        return $this->doExecute($requestBase, $valueType);
    }

    private function executeAuthenticated(Request $requestBase, $valueType) {
        try {
            return $this->execute($requestBase, $valueType);
        } catch (TefpsCoreClientErrorException $e) {
            if ($e->getStatus() == self::HTTP_UNAUTHORIZED) {
              $this->currentAccessToken = NULL;
              return $this->execute($requestBase, $valueType);
            } else {
              throw $e;
            }
        }
    }

    private function getOrFetchAccessToken() {
        if ($this->currentAccessToken != null
                && $this->currentAccessTokenExpiration != null
                && $this->currentAccessTokenExpiration > new \DateTime('now')) {
            return $this->currentAccessToken;
        }

        try {
            $oauth2Response = $this->oauth2TokenClientCredentials();
            $this->currentAccessToken = $oauth2Response->getAccessToken();

            $date = new \DateTime('now');
            $this->currentAccessTokenExpiration = $date->modify("+".$oauth2Response->getExpiresIn()." seconds");
        } catch (Exception $e) {
            throw new TefpsCoreOauth2TokenRetrievalException($e->getMessage());
        }
        return $this->currentAccessToken;
    }

    private function oauth2TokenClientCredentials() {
        $request = [
          "grant_type" => self::GRANT_CLIENT_CREDENTIALS,
          "client_id" => $this->clientId,
          "client_secret" => $this->clientSecret
        ];

        $postRequest = new Request(
          'POST',
          $this->tokenUrl . self::DIRECTORY_API,
          ["Content-Type" => "application/x-www-form-urlencoded"],
          Psr7\stream_for(http_build_query($request))
        );

        return $this->doExecute($postRequest, OAuth2ResponseDTO::class);
    }

    public function get($uri, $valueType) {
        $getRequest = new Request('GET', $uri);
        return $this->executeAuthenticated($getRequest, $valueType);
    }

    public function put($uri, $entity, $valueType) {
        $putRequest = new Request('PUT', $uri, [], $this->mapper->serialize($entity, 'json'));
        return $this->executeAuthenticated($putRequest, $valueType);
    }

    public function delete($uri) {
        $deleteRequest = new Request('DELETE', $uri);
        $this->executeAuthenticated($deleteRequest, NULL);
    }

    public function patch($uri, $patchList, $valueType) {
        $patchRequest = new Request('PATCH', $uri, [], $this->mapper->serialize($patchList, 'json'));
        return $this->executeAuthenticated($patchRequest, $valueType);
    }

    public static function buildURI($host, $path, $cityId, $id) {
        $builtPath = str_replace("{cityId}", $cityId, $path);
        $builtPath = str_replace("{id}", $id, $builtPath);
        return $host . $builtPath;
    }
}

class TefpsCoreOauth2TokenRetrievalException extends \RuntimeException {
}

class TefpsCoreClientErrorException extends \RuntimeException {
    private $status;
    private $error;

    public function getStatus() {
        return $this->status;
    }

    public function getError() {
        return $this->error;
    }

    function __construct($message, $error, $status) {
        parent::__construct($message);
        $this->status = $status;
        $this->error = $error;
    }
}
