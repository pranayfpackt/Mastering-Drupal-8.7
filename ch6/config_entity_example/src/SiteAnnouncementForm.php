<?php

namespace Drupal\config_entity_example;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageInterface;

class SiteAnnouncementForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#required' => TRUE,
      '#default_value' => $this->entity->label(),
    ];
    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
      '#default_value' => $this->entity->getMessage(),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $is_new = !$entity->getOriginalId();
    if ($is_new) {
      // Configuration entities need an ID manually set.
      $machine_name = \Drupal::transliteration()
        ->transliterate($entity->label(),
          LanguageInterface::LANGCODE_DEFAULT, '_');
      $entity->set('id', mb_strtolower($machine_name));
      $this->messenger()->addStatus($this->t('The %label announcement has been created.', ['%label' => $entity->label()]));
    }
    else {
      $this->messenger()->addStatus($this->t('Updated the %label announcement.', ['%label' => $entity->label()]));
    }
    $entity->save();
    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
  }
}
