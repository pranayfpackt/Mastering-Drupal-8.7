<?php

namespace Drupal\mymodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'realname_one_line' formatter.
 *
 * @FieldFormatter(
 *   id = "realname_one_line",
 *   label = @Translation("Real name (one line)"),
 *   field_types = {
 *     "realname"
 *   }
 * )
*/
class RealNameFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    $name_format = $this->getSetting('name_format');
    foreach ($items as $delta => $item) {
      if ($name_format === 'first') {
        $name = $item->first_name;
      }
      elseif ($name_format === 'last') {
        $name = $item->last_name;
      }
      else {
        $name = sprintf('%s %s', $item->first_name, $item->last_name);
      }
      $element[$delta] = [
        '#markup' => $name,
      ];
    }
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
