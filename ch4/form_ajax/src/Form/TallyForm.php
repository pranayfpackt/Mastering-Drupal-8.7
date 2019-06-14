<?php

namespace Drupal\form_ajax\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class TallyForm extends FormBase {
  public function getFormId() {
    return 'form_tally_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $counter = $form_state->get('counter') ?: 0;
    $form['counter_container'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'counter-wrapper']
    ];
    $form['counter_container']['counter'] = [
      '#plain_text' => $this->t('Counter: @counter', ['@counter' => $counter]),
    ];
    $form['actions']['#type'] = 'actions';

    $ajax = [
      'callback' => '::ajaxRefresh',
      'wrapper' => 'counter-wrapper',
    ];
    $form['actions']['increment'] = [
      '#type' => 'submit',
      '#value' => $this->t('Increment'),
      '#ajax' => $ajax,
      '#name' => 'increment',
      '#submit' => ['::adjustCounter'],
    ];
    $form['actions']['decrement'] = [
      '#type' => 'submit',
      '#value' => $this->t('Decrement'),
      '#ajax' => $ajax,
      '#name' => 'decrement',
      '#submit' => ['::adjustCounter'],
    ];
    return $form;
  }

  public function adjustCounter(array &$form, FormStateInterface $form_state) {
    $counter = $form_state->get('counter') ?: 0;
    $triggering_element = $form_state->getTriggeringElement();

    if ($triggering_element['#name'] === 'increment') {
      $counter++;
    }
    else {
      $counter--;
    }
    $form_state->set('counter', $counter);
    $form_state->setRebuild();
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {  }

  public function ajaxRefresh($form, FormStateInterface $form_state) {
    return $form['counter_container'];
  }
}
