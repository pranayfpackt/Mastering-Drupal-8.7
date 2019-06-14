<?php

namespace Drupal\form_states_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends FormBase {

    public function getFormId() {
        return 'form_states_example_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
      $form['#title'] = $this->t('Feedback form');
      $form['intro'] = [
        '#plain_text' => $this->t('This is an example form using states.'),
        '#access' => FALSE,
      ];
      $form['comments'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Feedback comments'),
      ];
      $form['email'] = [
        '#type' => 'email',
        '#title' => $this->t('Your email (optional)'),
      ];
      $form['contact_back'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('May we contact you for more information?'),
        '#states' => [
          'visible' => [
            ':input[name="email"]' => ['filled' => TRUE],
          ]
        ],
      ];
      $form['accept_terms'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Check this checkbox to acknowledge form submission.'),
        '#access' => FALSE,
      ];
      $form['actions']['#type'] = 'actions';
      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
        // '#states' => [
        //   'disabled' => [
        //     ':input[name="accept_terms"]' => ['checked' => FALSE],
        //   ]
        // ],
      ];
      return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->messenger()->addStatus('Submission completed!');
    }

}
