<?php

namespace TefpsClientsBundle\Auth;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\Context;

class DateTimeHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'DateTime',
                'method' => 'deserializeJsonToDateTime',
            ),
        );
    }

    public function deserializeJsonToDateTime(JsonDeserializationVisitor $visitor, $data, array $type)
    {
      if (null === $data) {
          return null;
      }

      $datetime = \DateTime::createFromFormat($type['params'][0], (string)$data);

      if (false === $datetime) {
          $datetime = \DateTime::createFromFormat(\DateTime::ISO8601, (string)$data);
          if (false === $datetime) {
            throw new \RuntimeException(sprintf('Invalid datetime "%s", expected format %s.', $data, $type['params'][0]));
          }
      }

      return $datetime;
    }
}
