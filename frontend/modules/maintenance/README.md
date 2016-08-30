Maintenance module
==================

Install
-------

Add to your main.php config file:

    'bootstrap' => ['log', 'maintenanceMode'],
    ...
    'modules' => [
        'maintenance' => [
            'class' => 'app\modules\maintenance\Module',
        ],
        ...
    ]

   