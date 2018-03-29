<?php

namespace Firesphere\GoogleMapsField\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

/**
 * Class \Firesphere\GoogleMapsField\Extensions\SiteConfigExtension
 *
 * @property \SilverStripe\SiteConfig\SiteConfig|\Firesphere\GoogleMapsField\Extensions\SiteConfigExtension $owner
 * @property string $MapsBrowserKey
 * @property string $MapsServerKey
 */
class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'MapsBrowserKey' => 'Varchar(255)',
        'MapsServerKey' => 'Varchar(255)',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);

        $fields->addFieldsToTab('Root.GoogleMaps', [
            TextField::create('MapsBrowserKey', _t(static::class . 'BROWSERKEY', 'Google API Browser key for address search')),
            TextField::create('MapsServerKey', _t(static::class . 'SERVERKEY', 'Google API Server key for geolocation')),
        ]);
    }
}
