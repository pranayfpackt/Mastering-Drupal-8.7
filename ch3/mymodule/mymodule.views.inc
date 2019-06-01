<?php

function mymodule_views_data() {
    $data = [];
    $data['pricing']['table']['group'] = t('Pricing');
    $data['pricing']['table']['base'] = [
        'field' => 'pid',
        'title' => 'Pricing data',
    ];
    $data['pricing']['pid'] = [
        'title' => 'PID',
        'field' => [
            'id' => 'standard',
          ],
          'filter' => [
            'id' => 'numeric',
          ],
          'argument' => [
            'id' => 'numeric',
          ],
          'sort' => [
            'id' => 'standard',
          ],
    ];
    $data['pricing']['amount'] = [
        'title' => 'Amount',
        'field' => [
            'id' => 'numeric',
          ],
          'filter' => [
            'id' => 'numeric',
          ],
          'argument' => [
            'id' => 'numeric',
          ],
          'sort' => [
            'id' => 'standard',
          ],
    ];
    $data['pricing']['currency_code'] = [
        'title' => 'Currency',
        'field' => [
            'id' => 'standard',
          ],
          'filter' => [
            'id' => 'string',
          ],
          'argument' => [
            'id' => 'string',
          ],
          'sort' => [
            'id' => 'standard',
          ],
    ];
    // Usage of mymodule_example_field
    $data['pricing']['description'] = [
        'title' => 'Description',
        'field' => [
            'id' => 'mymodule_example_field',
          ],
          'filter' => [
            'id' => 'string',
          ],
          'argument' => [
            'id' => 'string',
          ],
          'sort' => [
            'id' => 'standard',
          ],
    ];
    // Usage of mymodule_example_price_field
    $data['pricing']['formatted_price'] = [
        'title' => 'Formatted price',
        'field' => [
          'id' => 'mymodule_example_price_field',
        ],
    ];

    return $data;
}
