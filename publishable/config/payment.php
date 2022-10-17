<?php

return [
    // The default gateway to use
    'default' => 'Alipay_AopPage',

    // Add in each gateway here
    'gateways' => [
        'Alipay_AopPage' => [
            'driver'  => 'Alipay_AopPage',
            'options' => [
                'solutionType'   => '',
                'landingPage'    => '',
                'headerImageUrl' => ''
            ]
        ]
    ]

];
