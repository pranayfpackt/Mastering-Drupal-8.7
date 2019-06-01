<?php

namespace Drupal\mymodule\Plugin\views\field;

use Drupal\Core\Session\AccountInterface;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;
use Drupal\views\ViewExecutable;

/**
 * @ViewsField("mymodule_example_price_field")
 */
class ExamplePriceField extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    // Add the `amount` field as an additional field.
    $this->additional_fields['amount'] = ['table' => $this->table, 'field' => 'amount'];
    // Add the `currency_code` field as an additional field.
    $this->additional_fields['currency_code'] = ['table' => $this->table, 'field' => 'currency_code'];
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    // Get the values from our additional fields.
    $amount = $this->getValue($values, 'amount');
    $currency_code = $this->getValue($values, 'currency_code');
    // Create the formatted price.
    return $this->sanitizeValue("$currency_code$amount");
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Ensure our additional fields without querying for our own
    // plugin's field name, which does not exist.
    $this->ensureMyTable();
    $this->addAdditionalFields();
  }

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account) {
    // Uncomment the followingt only display this field to roles which
    // have the `access to pricing` permission!
    // return $account->hasPermission('access to pricing');
    return TRUE;
  }

}
