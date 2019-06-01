<?php

namespace Drupal\mymodule\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * @ViewsField("mymodule_example_field")
 */
class ExampleField extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    // Gets the value for this field out of the result row.
    $value = $this->getValue($values);
    // Replace any instance of `foo` with `bar` from the database value.
    $value = str_replace('foo', 'bar', $value);
    // Sanitize the output and render it.
    return $this->sanitizeValue($value);
  }

}
