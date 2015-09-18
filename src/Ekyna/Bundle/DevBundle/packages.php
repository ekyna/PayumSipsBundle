<?php
$packages = [
    'AgendaBundle',
    'AdminBundle',
    'AdvertisementBundle',
    'BlogBundle',
    'CoreBundle',
    'CartBundle',
    'CmsBundle',
    //'ContactBundle',
    'Characteristics',
    'CharacteristicsBundle',
    'DemoBundle',
    'GoogleBundle',
    'FontAwesomeBundle',
    'InstallBundle',
    //'LocalityBundle',
    'MediaBundle',
    'MailingBundle',
    'NewsBundle',
    'OrderBundle',
    'PaymentBundle',
    'ProductBundle',
    'RequireJsBundle',
    'Sale',
    'SettingBundle',
    'SitemapBundle',
    'ShipmentBundle',
    'SocialButtonsBundle',
    'SubscriptionBundle',
    'SurveyBundle',
    'Table',
    'TableBundle',
    'UserBundle',
];

$config = [];

function camelToDashed($name) {
    return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $name));
}

foreach ($packages as $name) {
    $alias = camelToDashed($name);
    $prefix = 0 < strpos($name, 'Bundle') ? 'src/Ekyna/Bundle/' : 'src/Ekyna/Component/';

    $config[$alias] = [
        'name'   => $name,
        'alias'  => $alias,
        'url'    => sprintf('https://github.com/ekyna/%s.git', $name),
        'prefix' => $prefix.$name,
    ];
}

return $config;