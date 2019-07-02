<?php

namespace Drupal\copyright_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
* @Block(
* id = "copyright_block",
* admin_label = @Translation("Copyright"),
* category = @Translation("Custom")
* )
*/
class CopyrightBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $date = new \DateTime();
    return [
      '#markup' => t('Copyright @year&copy; My Company', [
        '@year' => $date->format('Y'),
      ]),
    ];
  }
/**
 * {@inheritdoc}
 */
public function defaultConfiguration() {
  return [
   'company_name' => '',
  ];
}
/**
 * {@inheritdoc}
 */
public function blockForm($form, \Drupal\Core\Form\FormStateInterface $form_state) {
  $form['company_name'] = [
    '#type' => 'textfield',
    '#title' => t('Company name'),
    '#default_value' => $this->configuration['company_name'],
  ];
  return $form
}

/**
 * {@inheritdoc}
 */
public function blockSubmit($form, \Drupal\Core\Form\FormStateInterface $form_state) {
  $this->configuration['company_name'] = $form_state->getValue('company_name');
}

}
