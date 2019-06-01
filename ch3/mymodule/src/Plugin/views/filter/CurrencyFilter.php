<?php

namespace Drupal\mymodule\Plugin\views\filter;

use Drupal\views\Plugin\views\filter\InOperator;

/**
 * @ViewsFilter("mymodule_currency_filter")
 */
class CurrencyFilter extends InOperator {

  /**
   * {@inheritdoc}
   */
  public function getValueOptions() {
    if (!isset($this->valueOptions)) {
      $database = \Drupal::database();
      $this->valueOptions = $database
        ->query('SELECT DISTINCT(currency_code) FROM {pricing} ORDER BY currency_code')
        ->fetchAllKeyed(0, 0);
    }
    return $this->valueOptions;
  }

}
