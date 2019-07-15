<?php

namespace Drupal\content_entity_example;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;

class MessageStorage extends SqlContentEntityStorage {

  public function loadMultipleByType($message_type) {
    return $this->loadByProperties([
      $this->entityType->getKey('bundle') => $message_type
    ]);
  }

}
