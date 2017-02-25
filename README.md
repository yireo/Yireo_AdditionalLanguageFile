# Yireo AdditionalLanguageFile
This Magento 2 module adds the ability to add an extra language file to
your theme. 

## Overview
Every theme has the ability to override language strings in a file like
`i18n/en_US.csv`. This module allows you to add a second file
`i18n/en_US_additional.csv` which is loaded on top of the original file.
The benefit of this is that you can have a parent theme that fills up
the `en_US.csv` which is then inherited in the child theme. Yet using
this module, you can make specific overrides in the additional language
file.

## Installation
Install this module within Magento 2 using composer:

    composer require yireo/additional-language-file

And of course afterwards use the regular commands to enable the module.

## Technical architecture
This module remaps the preference for the original `Magento\Framework\Translate` file to a new class.
