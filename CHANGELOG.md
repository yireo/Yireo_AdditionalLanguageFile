# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.1.2] - 25 November 2026
### Removed
- Dropped support for PHP 8.1 and older; the module now requires PHP 8.2 up to 8.5

### Added
- README section explaining that `*_additional.csv` files are trusted content and should be reviewed like templates

### Fixed
- The additional language file is now looked up with the full translator configuration (area, theme and locale) instead of the area alone, so the correct theme file is found
- The locale is validated before it is used in the additional language file path, preventing path manipulation through a malformed locale
- The module now loads after Magento_Theme and Magento_Translation, so its translator preference is applied in a predictable order

## [0.1.1] - 22 October 2025
### Fixed
- Add new CI files
- Note on PWA
- Coding style
- Fix homepage
- Increase requirements
- Update README.md

## [0.0.1] - 22 October 2025
### Added
- Initial release
