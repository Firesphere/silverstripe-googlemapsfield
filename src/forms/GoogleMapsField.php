<?php

namespace Firesphere\GoogleMapsField\Forms;

use SilverStripe\Core\Convert;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;

/**
 * Class GoogleMapsField
 * @package Firesphere\GoogleMapsField\Forms
 */
class GoogleMapsField extends TextField
{
    /**
     * @var array
     */
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

    /**
     * @var array
     */
    protected $customOptions = [];

    /**
     * @var string
     */
    protected $customisationsVarName;

    /**
     * GoogleMapsField constructor.
     * @param $name
     * @param null $title
     * @param string $value
     * @param null $maxLength
     * @param Form|null $form
     */
    public function __construct($name, $title = null, $value = '', $maxLength = null, Form $form = null)
    {
        $this->setAttribute('data-mapsfield', 'mapsfield');
        $this->setCustomisationsVarName($name . 'Customisations');
        parent::__construct($name, $title, $value, $maxLength, $form);
    }

    /**
     * @param array $properties
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function field($properties = [])
    {
        $config = SiteConfig::current_site_config();

        Requirements::javascript(
            'https://maps.googleapis.com/maps/api/js?key=' . $config->MapsBrowserKey . '&libraries=places'
        );
        Requirements::javascript('firesphere/googlemapsfield:client/dist/main.js');

        return parent::Field($properties);
    }

    /**
     * @return string
     */
    public function getHiddenFields()
    {
        $output = '';
        foreach ($this->extraFields as $field) {
            $output .= HiddenField::create($this->Name . $field)->Field();
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
     * @param string $field
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

    /**
     * @return string
     */
    public function getCustomisationsVarName()
    {
        return $this->customisationsVarName;
    }

    /**
     * @param string $varName
     */
    public function setCustomisationsVarName($varName)
    {
        $this->customisationsVarName = $varName;
    }
}
