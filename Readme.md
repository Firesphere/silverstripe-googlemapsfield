[![CircleCI](https://img.shields.io/circleci/project/github/Firesphere/silverstripe-googlemapsfield.svg)](https://circleci.com/gh/Firesphere/silverstripe-googlemapsfield)
[![codecov](https://codecov.io/gh/Firesphere/silverstripe-googlemapsfield/branch/master/graph/badge.svg)](https://codecov.io/gh/Firesphere/silverstripe-googlemapsfield)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Firesphere/silverstripe-googlemapsfield/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Firesphere/silverstripe-googlemapsfield/?branch=master)

# Google Places field

Play with Google Places in your forms in SilverStripe

# Installation

`composer require firesphere/googlemapsfield`

# Usage

Add the form field to your form and enter your keys in the SiteConfig.

All the information from Google Places is automatically populated in hidden fields. You will have to map these to your own
DataObject storage on saving the form.

The fields given from places are:

- GoogleMapsLatField
- GoogleMapsLngField
- subpremise
- street_number
- route
- sublocality_level_1
- locality
- administrative_area_level_1
- country
- postal_code

If you want to change the fields, add custom hidden fields or remove some fields, you can do so via the `getExtraFields` and `setExtraFields` methods.
 

You can only use this field _once_ per form, due to restrictions of the ID's of fields.

## Custom options

https://developers.google.com/maps/documentation/javascript/places-autocomplete#add_autocomplete

Any options you want to add, can be set on the field as an array:
```php
$field = GoogleMapsField::create('MyField');
$field->setCustomOptions(['componentRestrictions' => ['country' => 'nz']]);
```

# Actual license

This module is published under BSD 3-clause license, although these are not in the actual classes, the license does apply:

http://www.opensource.org/licenses/BSD-3-Clause

Copyright (c) 2012-NOW(), Simon "Firesphere" Erkelens

All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
    Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.


# Did you read this entire readme? You rock!

Pictured below is a cow, just for you.
```

               /( ,,,,, )\
              _\,;;;;;;;,/_
           .-"; ;;;;;;;;; ;"-.
           '.__/`_ / \ _`\__.'
              | (')| |(') |
              | .--' '--. |
              |/ o     o \|
              |           |
             / \ _..=.._ / \
            /:. '._____.'   \
           ;::'    / \      .;
           |     _|_ _|_   ::|
         .-|     '==o=='    '|-.
        /  |  . /       \    |  \
        |  | ::|         |   | .|
        |  (  ')         (.  )::|
        |: |   |;  U U  ;|:: | `|
        |' |   | \ U U / |'  |  |
        ##V|   |_/`"""`\_|   |V##
           ##V##         ##V##
```
