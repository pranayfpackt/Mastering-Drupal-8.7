<?php

namespace Drupal\mymodule\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'realname_default' widget.
 *
 * @FieldWidget(
 *   id = "realname_default",
 *   label = @Translation("Real name"),
 *   field_types = {
 *     "realname"
 *   }
 * )
*/
class RealNameDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#default_value' => '',
      '#size' => 25,
      '#required' => $element['#required'],
      '#access' => !($this->getSetting('name_format') === 'last')
    ];
    $element['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last name'),
      '#default_value' => '',
      '#size' => 25,
      '#required' => $element['#required'],
      '#access' => !($this->getSetting('name_format') === 'first')
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'name_format' => 'both',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['name_format'] = [
      '#type' => 'select',
      '#title' => $this->t('Name format'),
      '#options' => [
        'both' => $this->t('First and last name'),
        'first' => $this->t('First name only'),
        'last' => $this->t('Last name only'),
      ],
      '#default_value' => $this->getSetting('name_format'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $format = $this->getSetting('name_format');
    if ($format === 'first') {
      $summary[] = $this->t('First name only');
    }
    elseif ($format === 'last') {
      $summary[] = $this->t('Last name only');
    }
    else {
      $summary[] = $this->t('First and last name');
    }
    return $summary;
  }

}
