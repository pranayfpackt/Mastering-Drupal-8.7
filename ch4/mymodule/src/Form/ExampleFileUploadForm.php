<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;

class ExampleFileUploadForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mymodule_file_upload_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $validators = [
      'file_validate_extensions' => ['pdf'],
      'file_validate_size' => [\Drupal\Component\Utility\Environment::getUploadMaxSize()],
    ];
    $form['pdf_file'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Upload a PDF'),
      '#description' => [
        '#theme' => 'file_upload_help',
        '#description' => $this->t('A PDF file.'),
        '#upload_validators' => $validators,
      ],
      '#upload_location' => 'public://',
      '#upload_validators' => $validators,
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    /*
    $pdf_file = _file_save_upload_from_form($form['pdf_file'], $form_state, 0);
    if ($pdf_file instanceof \Drupal\file\FileInterface) {
      $form_state->setValue('pdf_file', $pdf_file);
    }
    */
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    /** @var \Drupal\file\FileInterface $pdf_file */
    $pdf_file = File::load($form_state->getValue(['pdf_file', 0]));
    $pdf_file->setPermanent();
    $pdf_file->save();
    $this->messenger()->addStatus($this->t('The @filename has been uploaded to @destination', [
      '@filename' => $pdf_file->getFilename(),
      '@destination' => file_create_url($pdf_file->getFileUri()),
    ]));
  }

}
