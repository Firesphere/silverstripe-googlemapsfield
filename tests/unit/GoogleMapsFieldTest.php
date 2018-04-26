<?php

namespace Firesphere\GoogleMapsField\Tests;

use Firesphere\GoogleMapsField\Forms\GoogleMapsField;
use SilverStripe\Core\Convert;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;

class GoogleMapsFieldTest extends SapphireTest
{
    public function testConstruct()
    {
        $field = GoogleMapsField::create('TestField');

        $attr = $field->getAttribute('data-mapsfield');

        $this->assertEquals('mapsfield', $attr);
    }

    public function testField()
    {
        /** @var GoogleMapsField $field */
        $field = GoogleMapsField::create('TestField');

        $field->Field([]);

        $config = SiteConfig::current_site_config();

        $requiredJs = Requirements::backend()->getJavascript();

        $this->assertArrayHasKey(
            'https://maps.googleapis.com/maps/api/js?key=' . $config->MapsBrowserKey . '&libraries=places',
            $requiredJs
        );
    }

    public function testCustomOptions()
    {
        /** @var GoogleMapsField $field */
        $field = GoogleMapsField::create('Test', 'Test');

        $field->setCustomOptions(['option' => 'option1']);

        $this->assertEquals(Convert::array2json(['option' => 'option1']), $field->getCustomOptions());
    }

    public function testGetHiddenFields()
    {
        $field = GoogleMapsField::create('Test');

        $fields = '<input type="hidden" name="TestGoogleMapsLatField" class="hidden" id="TestGoogleMapsLatField" />'
            . '<input type="hidden" name="TestGoogleMapsLngField" class="hidden" id="TestGoogleMapsLngField" />'
            . '<input type="hidden" name="Testsubpremise" class="hidden" id="Testsubpremise" />'
            . '<input type="hidden" name="Teststreet_number" class="hidden" id="Teststreet_number" />'
            . '<input type="hidden" name="Testroute" class="hidden" id="Testroute" />'
            . '<input type="hidden" name="Testsublocality_level_1" class="hidden" id="Testsublocality_level_1" />'
            . '<input type="hidden" name="Testlocality" class="hidden" id="Testlocality" />'
            . '<input type="hidden" name="Testadministrative_area_level_1" class="hidden"'
            . ' id="Testadministrative_area_level_1" />'
            . '<input type="hidden" name="Testcountry" class="hidden" id="Testcountry" />'
            . '<input type="hidden" name="Testpostal_code" class="hidden" id="Testpostal_code" />';

        $this->assertEquals($fields, $field->getHiddenFields());
    }

    public function testGetSetExtraFields()
    {
        $field = GoogleMapsField::create('Test');

        $extraFields = $field->getExtraFields();

        $expected = [
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

        $this->assertEquals($expected, $extraFields);

        $field->setExtraFields(['GoogleMapsLatField', 'GoogleMapsLngField']);

        $extraFields = $field->getExtraFields();

        $this->assertEquals(['GoogleMapsLatField', 'GoogleMapsLngField'], $extraFields);
    }

    public function testAddExtraFields()
    {
        $field = GoogleMapsField::create('Test');

        $extraFields = $field->getExtraFields();

        $expected = [
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

        $this->assertEquals($expected, $extraFields);

        $field->addExtraField('premise');

        $extraFields = $field->getExtraFields();

        $this->assertEquals(array_merge($expected, ['premise']), $extraFields);
    }
}
