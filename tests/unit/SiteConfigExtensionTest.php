<?php

namespace Firesphere\GoogleMapsField\Tests;

use Firesphere\GoogleMapsField\Extensions\SiteConfigExtension;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;

class SiteConfigExtensionTest extends SapphireTest
{
    public function testUpdateCMSFields()
    {
        $fieldList = FieldList::create();
        $fieldList->push(TabSet::create("Root", Tab::create("Main")));
        $extension = Injector::inst()->get(SiteConfigExtension::class);

        $extension->updateCMSFields($fieldList);

        $this->assertNotNull($fieldList->dataFieldByName('MapsBrowserKey'));
        $this->assertNotNull($fieldList->dataFieldByName('MapsServerKey'));
    }
}
