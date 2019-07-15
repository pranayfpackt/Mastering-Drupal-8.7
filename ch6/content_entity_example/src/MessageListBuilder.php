<?php

namespace Drupal\content_entity_example;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class MessageListBuilder extends EntityListBuilder {

  public function buildHeader() {
    $header['title'] = $this->t('Title');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    $row['title'] = $entity->label();
    return $row + parent::buildRow($entity);
  }
}
