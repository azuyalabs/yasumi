# Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html) and
[Conventional Commits](https://conventionalcommits.org) for commit conventions.

Changes related to the logic of the holidays or their providers are listed first,
followed by any architectural or technical changes.

## [unreleased]

## [2.12.0] - 2026-09-30

### Features

- Add Kenya holiday provider ([#418](https://github.com/azuyalabs/yasumi/issues/418))
- *(Colombia)* Add Day of Our Lady of the Rosary of Chiquinquirá holiday
- Add Colombia holiday provider ([#403](https://github.com/azuyalabs/yasumi/issues/403))
- *(Italy)* Add San Francesco of Assisi public holiday
- *(Australia)* Refresh holiday rules and rename Queen's Birthday to Monarch's Birthday ([#410](https://github.com/azuyalabs/yasumi/issues/410))

### Fixes

- *(South Korea)* Add missing namespace to LabourDayTest
- *(Various typos)* Correct spelling errors
- *(Canada)* Add Boxing Day as explicit holiday and fix tests
- Replace outdated PHP timezone names ([#425](https://github.com/azuyalabs/yasumi/issues/425))
- *(Canada)* Add Victoria Day and correct historical year bounds
- *(SouthKorea)* Correct buddhasBirthday translation year bound and update source URL
- *(Argentina)* Align code style with codebase conventions
- Throw HolidayNotFoundException for unknown holiday keys ([#421](https://github.com/azuyalabs/yasumi/issues/421))
- *(Japan)* Correct year bounds and holiday name accuracy
- *(Belgium)* Easter and Pentecost are not official holidays
- *(Belgium)* Correct nationalDay translations and rename PentecostMondayTest

### Refactor

- *(Provider)* Modernize PHP syntax for readability and conciseness
- Clean up property initialization and modernize test mocks
- *(Test)* Remove redundant test constructors
- *(South Korea)* Use readonly properties and constructor promotion
- *(South Korea)* Add Labor Day and reinstate Constitution Day ([#413](https://github.com/azuyalabs/yasumi/issues/413))
- *(Netherlands)* Standardize test file naming
- *(Japan)* Code consistency improvements
- Clean up SubstituteHoliday and fix Japan iterator null check

### Documentation

- Add release policy documenting bi-annual release cycle
- Update CODE_OF_CONDUCT to Contributor Covenant v3.0
- Updates to reflect recent PHPstan level bump
- Clarify holiday type classification
- Update list of supported versions

### Testing

- *(Canada)* Bound random year range in Boxing Day tests to >= 1879
- *(Lithuania)* Add allSoulsDay to official holidays test and implement ProviderTestCase
- *(Japan)* Skip 2020/2021 in MarineDay random year test instead of early return
- *(SouthKorea)* Correct test year range for pre-1949 assertion
- *(Japan)* Exclude 2019 from emperorsBirthday random year range

### Other

- Bump composer package versions to latest installed versions
- *(Deps)* Bump actions/stale from 10.4.0 to 11.0.0 ([#422](https://github.com/azuyalabs/yasumi/issues/422))
- *(Deps)* Add rector dev dependency and configure tool
- *(Colombia)* Fix file permissions on test files
- Update .editorconfig settings
- *(Deps)* Bump actions/stale from 10.3.0 to 10.4.0 ([#419](https://github.com/azuyalabs/yasumi/issues/419))
- Increase PHPStan analysis level to 9
- Upgrade rector configuration
- *(Deps)* Bump phpstan from 2.1 to 2.2
- *(Deps)* Bump actions/cache from 5 to 6 ([#417](https://github.com/azuyalabs/yasumi/issues/417))
- *(Deps)* Bump actions/checkout from 6 to 7 ([#416](https://github.com/azuyalabs/yasumi/issues/416))
- *(Deps)* Bump actions/stale from 10.2.0 to 10.3.0 ([#411](https://github.com/azuyalabs/yasumi/issues/411))

## New Contributors ❤️

* @aaronflorey made their first contribution
* @d-takeuchi made their first contribution
* @giovanny07 made their first contribution
* @kevinpapst made their first contribution
* @zigzagdev made their first contribution

## [2.11.0] - 2026-03-30

### Features

- Add Venezuela holiday provider
- Add San Marino holiday provider
- Add Andorra holiday provider
- Add "Czechia" provider as a short form of "Czech Republic" ([#397](https://github.com/azuyalabs/yasumi/issues/397))

### Refactor

- Add sorting to getHolidayNames
- Add key validation to removeHoliday
- Remove unnecessary sorting on getHoliday
- Remove deprecated isHolidayNameNotEmpty method
- Remove redundant initialize interface method
- *(Test)* Add context to base assertion failure messages
- *(Test)* Tighten default range for random year generator

### Documentation

- Improve contribution guidelines

### Code Style

- Fix code styling issue
- *(Netherlands)* Use strict comparison operators

### Testing

- *(Spain)* Fix murciaDay minimum year in RegionOfMurcia test
- *(South Korea)* Fix holiday type test of HangulDay
- *(United Kingdom)* Fix year boundary and test conditions
- *(Slovakia)* Fix excluded years in data providers
- *(South Korea)* Fix twoDaysLaterNewYearsDay test
- *(Spain)* Fix Extremadura test
- *(Nyse)* Fix tests for NYSE provider

### Other

- *(Test)* Add missing provider test suites
- *(Test)* Upgrade to PHPUnit 11
- Increase PHPStan analysis level to 8
- Add AGENTS.md file
- *(Deps)* Bump actions/stale from 10.1.1 to 10.2.0 ([#398](https://github.com/azuyalabs/yasumi/issues/398))

## New Contributors ❤️

* @ppaulis made their first contribution

## [2.10.0] - 2026-01-22

### Documentation

- Update list of supported versions

### Other

- Drop PHP 8.1 support


## [2.9.0] - 2025-12-29

### Features

- *(Netherlands)* Add new holiday-equivalent days 2026 till 2028 ([#393](https://github.com/azuyalabs/yasumi/issues/393))
- *(Slovakia)* Slovak State Consolidation Package for 2025 ([#389](https://github.com/azuyalabs/yasumi/issues/389))
- Add Slovenia holiday provider ([#387](https://github.com/azuyalabs/yasumi/issues/387))
- Add New York Stock Exchange (NYSE) provider ([#384](https://github.com/azuyalabs/yasumi/issues/384))
- *(New Zealand)* Add Matariki public holiday ([#378](https://github.com/azuyalabs/yasumi/issues/378))

### Fixes

- *(New Zealand)* Add missing namespace in the MatarikiTest
- Various typos

### Refactor

- Use strict comparison with equal types

### Performance

- Optimize filter count()
- Fix needless sorting on every holiday insert

### Documentation

- Add requirements and installation/quick start sections
- Update list of supported versions

### Testing

- *(Poland)* Fix Christmas Eve test
- *(Slovakia)* Fix failing tests for the years 2025 and 2026

### Other

- *(Deps)* Bump actions/stale from 10.1.0 to 10.1.1 ([#391](https://github.com/azuyalabs/yasumi/issues/391))
- Add support for PHP 8.5
- Remove Psalm static analysis tool
- Fix deprecated 'set-output' command
- *(Deps)* Bump actions/stale from 10.0.0 to 10.1.0 ([#386](https://github.com/azuyalabs/yasumi/issues/386))
- *(Deps)* Bump actions/stale from 9.1.0 to 10.0.0 ([#385](https://github.com/azuyalabs/yasumi/issues/385))

## New Contributors ❤️

* @Stollie made their first contribution
* @mgwebgroup made their first contribution
* @soukicz made their first contribution
* @timeshifting made their first contribution

## [2.8.0] - 2025-07-13

### Features

- *(Canada)* Nunavut Day for the Nunavut province
- Add Bulgaria provider
- *(Latvia)* Add Pentecost and Mother's Day ([#368](https://github.com/azuyalabs/yasumi/issues/368))
- *(Argentina)* Movable holidays ([#367](https://github.com/azuyalabs/yasumi/issues/367))
- *(Poland)* Christmas Eve is a public holiday from 2025 ([#371](https://github.com/azuyalabs/yasumi/issues/371))
- *(Ireland)* Saint Brigid's Day ([#374](https://github.com/azuyalabs/yasumi/issues/374))
- *(Lithuania)* Mother's Day and Father's Day ([#370](https://github.com/azuyalabs/yasumi/issues/370))
- *(Mexico)* Add Transmission of Federal Executive Power Holiday ([#361](https://github.com/azuyalabs/yasumi/issues/361))
- *(Brazil)* Black Consciousness Day ([#365](https://github.com/azuyalabs/yasumi/issues/365))
- *(Germany)* Day of Liberation is celebrated in Berlin in 2025 too.
- *(Germany)* Add Assumption of Mary holiday to Bavaria
- Add Iran provider ([#341](https://github.com/azuyalabs/yasumi/issues/341))

### Fixes

- *(Brazil)* Add passing $this->locale for calculateProclamationOfRepublicDay() ([#376](https://github.com/azuyalabs/yasumi/issues/376))
- *(Scotland)* Easter Monday is not a bank holiday ([#372](https://github.com/azuyalabs/yasumi/issues/372))
- *(Ireland)* New Year's Day on a Saturday also gives a substitute holiday ([#375](https://github.com/azuyalabs/yasumi/issues/375))
- *(Ukraine)* Ukraine 2021-2023 changes ([#369](https://github.com/azuyalabs/yasumi/issues/369))
- *(Ireland)* Easter Sunday is not an official holiday ([#373](https://github.com/azuyalabs/yasumi/issues/373))
- *(Mexico)* Mark several holidays as observance ([#362](https://github.com/azuyalabs/yasumi/issues/362))
- *(Mexico)* Mark three holidays as official ([#359](https://github.com/azuyalabs/yasumi/issues/359))
- *(Portugal)* Corpus Christi is official ([#363](https://github.com/azuyalabs/yasumi/issues/363))
- *(Czech-republic)* Christmas Eve is official ([#366](https://github.com/azuyalabs/yasumi/issues/366))
- *(Germany)* Pentecost is not an official holiday - except in Brandenburg ([#337](https://github.com/azuyalabs/yasumi/issues/337))
- *(Slovakia)* Update rules for Anniversary of the Declaration of the Slovak Nation ([#340](https://github.com/azuyalabs/yasumi/issues/340))

### Refactor

- *(South Korea)* Simplify code by using early returns
- Fix use of concatenation with mixed types
- Make the Holiday class implement the Stringable interface
- Remove astray var_dump use
- Update methods visibility in multiple Providers ([#332](https://github.com/azuyalabs/yasumi/issues/332))

### Documentation

- Include supported PHP versions with security updates
- Move DCO fulltext to its own file
- Clean up examples and correct spelling mistakes
- Fix parameter types that do not match signature
- Add announcement of new documentation site
- Remove duplicate commit messages from the changelog
- Sort the first time contributors alphabetically (a-z)
- Add initial git-cliff configuration

### Code Style

- Fix code styling issues
- Fix code styling and formatting issues ([#338](https://github.com/azuyalabs/yasumi/issues/338))

### Testing

- *(Portugal)* Fix official holidays tests
- Fix test for the previous function
- Increase memory_limit, to be able to run all tests on MacOS
- *(Portugal)* Fix issue with Republic Day failing for the restored years between 2013 and 2016

### Other

- Bump composer package versions to latest installed versions
- Remove phpinsights config
- Remove Phan static analysis tool
- Update maintainer information in composer.json
- Disable enforcing the Override attribute by Psalm
- Report unused classes, etc by Psalm as informational
- Drop PHP 8.0 support and add support for PHP 8.4
- Bump package versions to latest working versions
- Upgrade PHPStan to v2.0
- Replace deprecated PHPstan configuration option
- Add dependabot configuration file
- Exclude phpactor configuration file from Git
- Use shared PHP CS Fixer config
- Pin version of PHP CS Fixer to 3.46 as latest (3.47) release produces undesired changes

## New Contributors ❤️

* @attepulkkinen made their first contribution
* @dependabot[bot] made their first contribution
* @fbett made their first contribution
* @hamrak made their first contribution
* @mtbossa made their first contribution
* @thrashzone13 made their first contribution

[unreleased]: https://github.com/azuyalabs/yasumi/compare/2.12.0..HEAD
[2.12.0]: https://github.com/azuyalabs/yasumi/compare/2.11.0..2.12.0
[2.11.0]: https://github.com/azuyalabs/yasumi/compare/2.10.0..2.11.0
[2.10.0]: https://github.com/azuyalabs/yasumi/compare/2.9.0..2.10.0
[2.9.0]: https://github.com/azuyalabs/yasumi/compare/2.8.0..2.9.0
[2.8.0]: https://github.com/azuyalabs/yasumi/compare/2.7.0..2.8.0

