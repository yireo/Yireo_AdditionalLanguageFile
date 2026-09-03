# Yireo AdditionalLanguageFile

<!-- badges.specs.start -->
![Magento version](https://img.shields.io/badge/Magento-2.4.6%20%7C%202.4.9-orange)
![PHP version](https://img.shields.io/badge/PHP-8.2%E2%80%938.5-777BB4)
![License](https://img.shields.io/badge/License-OSL--3.0-blue)
![Latest Version](https://img.shields.io/packagist/v/yireo/magento2-additional-language-file)
<!-- badges.specs.end -->

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

    composer require yireo/magento2-additional-language-file

And of course afterwards use the regular commands to enable the module.

## Technical architecture
This module remaps the preference for the original `Magento\Framework\Translate` file to a new class.

## Current status

<!-- badges.test.start -->
![Static Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_AdditionalLanguageFile/static-tests.yml?label=static-tests)
![Unit Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_AdditionalLanguageFile/unit-tests.yml?label=unit-tests)
![Integration Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_AdditionalLanguageFile/integration-tests.yml?label=integration-tests)
![Playwright](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_AdditionalLanguageFile/playwright.yml?label=playwright)
![DI Compilation](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_AdditionalLanguageFile/compile.yml?label=compile)
<!-- badges.test.end -->
