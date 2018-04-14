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

        $fields = '<input type="hidden" name="GoogleMapsLatField" class="hidden" id="GoogleMapsLatField" />'
            . '<input type="hidden" name="GoogleMapsLngField" class="hidden" id="GoogleMapsLngField" />'
            . '<input type="hidden" name="subpremise" class="hidden" id="subpremise" />'
            . '<input type="hidden" name="street_number" class="hidden" id="street_number" />'
            . '<input type="hidden" name="route" class="hidden" id="route" />'
            . '<input type="hidden" name="sublocality_level_1" class="hidden" id="sublocality_level_1" />'
            . '<input type="hidden" name="locality" class="hidden" id="locality" />'
            . '<input type="hidden" name="administrative_area_level_1" class="hidden"'
            . ' id="administrative_area_level_1" />'
            . '<input type="hidden" name="country" class="hidden" id="country" />'
            . '<input type="hidden" name="postal_code" class="hidden" id="postal_code" />';

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
