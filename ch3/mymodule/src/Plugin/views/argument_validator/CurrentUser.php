<?php

namespace Drupal\mymodule\Plugin\views\argument_validator;

use Drupal\views\Plugin\views\argument_validator\ArgumentValidatorPluginBase;

/**
 * Validates whether the argument matches the current user.
 *
 * @ViewsArgumentValidator(
 *   id = "mymodule_current_user",
 *   title = @Translation("Current user"),
 *   entity_type = "user"
 * )
 */
class CurrentUser extends ArgumentValidatorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function validateArgument($argument) {
    if (!is_numeric($argument)) {
      return FALSE;
    }
    $user_storage = \Drupal::entityTypeManager()->getStorage('user');
    /** @var \Drupal\user\UserInterface $user */
    $user = $user_storage->load($argument);
    if ($user === NULL) {
      return FALSE;
    }

    return $user->id() === \Drupal::currentUser()->id();
  }

}

