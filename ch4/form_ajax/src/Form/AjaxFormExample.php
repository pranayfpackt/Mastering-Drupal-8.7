<?php

namespace Drupal\form_ajax\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AjaxFormExample extends FormBase {

    public function getFormId() {
        return 'ajax_form_example';
    }

  public function buildForm(array $form, FormStateInterface $form_state) {
    dpm($form);
    $form['#title'] = $this->t('Feedback form');
    $form['intro'] = [
      '#plain_text' => $this->t('This is an example form using states.'),
      '#access' => FALSE,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email'),
      '#required' => TRUE,
    ];
    $form['newsletters'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Sign up for our news letter?'),
      '#ajax' => [
        'callback' => '::ajaxRefresh',
        'wrapper' => 'newsletters-container',
      ],
    ];
    $form['newsletters_container'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'newsletters-container'],
    ];
    $form['newsletters_container']['options'] = [
      '#type' => 'checkboxes',
      '#title' => 'Newsletters',
      '#access' => !empty($form_state->getValue('newsletters')),
      '#options' => ['daily' => 'Daily digest', 'tips' => 'Useful tips'],
      '#default_value' => ['tips']
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#ajax' => [
        'callback' => '::testThis',
        'wrapper' => 'ajax-form-example',
      ],
    ];
    return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

    }

    public function ajaxRefresh($form, FormStateInterface $form_state) {
      return $form['newsletters_container'];
    }

}
