<?php

namespace Firesphere\GoogleMapsField\Forms;

use SilverStripe\Core\Convert;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;

class GoogleMapsField extends TextField
{
    protected $extraFields = [
        'GoogleMapsLatField',
        'GoogleMapsLngField',
        'subpremise',
        'street_number',
        'route',
        'sublocality_level_1',
        'locality',
        'administrative_area_level_1',
        'country',
        'postal_code'
    ];

    protected $customOptions = [];


    public function __construct($name, $title = null, $value = '', $maxLength = null, Form $form = null)
    {
        $this->setAttribute('data-mapsfield', 'mapsfield');
        parent::__construct($name, $title, $value, $maxLength, $form);
    }

    public function Field($properties = [])
    {
        $config = SiteConfig::current_site_config();

        Requirements::javascript('https://maps.googleapis.com/maps/api/js?key=' . $config->MapsBrowserKey . '&libraries=places');
        Requirements::javascript('firesphere/googlemapsfield:client/dist/main.js');

        return parent::Field($properties);
    }

    public function getHiddenFields()
    {
        $output = '';
        foreach ($this->extraFields as $field) {
            $output .= HiddenField::create($field)->Field();
        }
        return $output;
    }

    /**
     * @return array
     */
    public function getExtraFields()
    {
        return $this->extraFields;
    }

    /**
     * @param array $extraFields
     */
    public function setExtraFields($extraFields)
    {
        $this->extraFields = $extraFields;
    }

    /**
     * @param array $field
     */
    public function addExtraField($field)
    {
        $this->extraFields[] = $field;
    }

    /**
     * @return string
     */
    public function getCustomOptions()
    {
        return Convert::array2json($this->customOptions);
    }

    /**
     * @param array $customOptions
     */
    public function setCustomOptions($customOptions)
    {
        $this->customOptions = $customOptions;
    }
}
