# Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html) and
[Conventional Commits](https://conventionalcommits.org) for commit conventions.

Changes related to the logic of the holidays or their providers are listed first,
followed by any architectural or technical changes.

## [2.8.0] - 2025-07-13

### Features

- (Canada) Nunavut Day for the Nunavut province
- Add Bulgaria provider
- (Latvia) Add Pentecost and Mother's Day ([#368](https://github.com/azuyalabs/yasumi/issues/368))
- (Argentina) Movable holidays ([#367](https://github.com/azuyalabs/yasumi/issues/367))
- (Poland) Christmas Eve is a public holiday from 2025 ([#371](https://github.com/azuyalabs/yasumi/issues/371))
- (Ireland) Saint Brigid's Day ([#374](https://github.com/azuyalabs/yasumi/issues/374))
- (Lithuania) Mother's Day and Father's Day ([#370](https://github.com/azuyalabs/yasumi/issues/370))
- (Mexico) Add Transmission of Federal Executive Power Holiday ([#361](https://github.com/azuyalabs/yasumi/issues/361))
- (Brazil) Black Consciousness Day ([#365](https://github.com/azuyalabs/yasumi/issues/365))
- (Germany) Day of Liberation is celebrated in Berlin in 2025 too.
- (Germany) Add Assumption of Mary holiday to Bavaria
- Add Iran provider ([#341](https://github.com/azuyalabs/yasumi/issues/341))

### Fixes

- (Brazil) Add passing $this->locale for calculateProclamationOfRepublicDay() ([#376](https://github.com/azuyalabs/yasumi/issues/376))
- (Scotland) Easter Monday is not a bank holiday ([#372](https://github.com/azuyalabs/yasumi/issues/372))
- (Ireland) New Year's Day on a Saturday also gives a substitute holiday ([#375](https://github.com/azuyalabs/yasumi/issues/375))
- (Ukraine) Ukraine 2021-2023 changes ([#369](https://github.com/azuyalabs/yasumi/issues/369))
- (Ireland) Easter Sunday is not an official holiday ([#373](https://github.com/azuyalabs/yasumi/issues/373))
- (Mexico) Mark several holidays as observance ([#362](https://github.com/azuyalabs/yasumi/issues/362))
- (Mexico) Mark three holidays as official ([#359](https://github.com/azuyalabs/yasumi/issues/359))
- (Portugal) Corpus Christi is official ([#363](https://github.com/azuyalabs/yasumi/issues/363))
- (Czech-republic) Christmas Eve is official ([#366](https://github.com/azuyalabs/yasumi/issues/366))
- (Germany) Pentecost is not an official holiday - except in Brandenburg ([#337](https://github.com/azuyalabs/yasumi/issues/337))
- (Slovakia) Update rules for Anniversary of the Declaration of the Slovak Nation ([#340](https://github.com/azuyalabs/yasumi/issues/340))

### Refactor

- (South korea) Simplify code by using early returns
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

- (Portugal) Fix official holidays tests
- Fix test for the previous function
- Increase memory_limit, to be able to run all tests on MacOS
- (Portugal) Fix issue with Republic Day failing for the restored years between 2013 and 2016

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

## [2.7.0] - 2024-01-07

### Refactor

- Update copyright year
- Simplify foreach loop in order to remove unused variables.
- Check for type rather than null value to be more explicit. Untangle nested ifs to early returns allowing for quick exit.
- Change nested ifs to early return as it is best to exit early. Change to array spread instead of array_merge for simplicity.
- Extract Day of Antifascist Struggle calculation to a private method. Simplify Statehood Day calculation to make it more concise.
- Add check in case date subtraction fails.
- Add check for the Australia provider in case date subtraction fails.
- Simplify the conditions for the Coming of Age day calculation.
- Simplify the calculation of Carnival in Argentina to reduce duplication. Add check in case date subtraction fails.
- Simplify the calculation of Carnival in Brazil to reduce duplication. Add check in case date subtraction fails.
- Introduced private methods for each holiday to eliminate complexity.
- Simplify the calculation of the three Carnival Days in the Netherlands to reduce duplication. Add check in case date subtraction fails.
- Optimize some if/then statements and other parts to be more succinct.
- Remove unnecessary method argument as method accepts none and change switch block to a simple check as it only has one scenario.
- Replaced the anonymous function inside array_map with arrow function syntax to make it more concise and readable.
- Extract constant representing the date format (avoid 'magic' constants).

### Documentation

- Update the changelog to reflect changes for the 2.7.0 release

### Code Style

- Fix naming of fully qualified class names
- Simplify the code for selecting holidays before and after 2013 making it more concise
- Fix indentation
- Add a few more PHPStan settings and fix indentation
- Fix code style issues.
- Remove redundant parentheses and fix array indentation.
- Avoid use of the empty() function.
- Convert implicit variables into explicit ones in double-quoted strings.
- Remove unnecessary blank lines in doc blocks.
- Remove unnecessary intermediate variable.
- Add expected newline between different annotations.
- Simplify the code making it more concise and readable.
- Simplify the code and remove useless doc blocks/annotations.

### Other

- Remove unused infections Composer script entry
- Remove checks for Superfluous naming as we follow PER which supports such convention.
- Include PHPInsights configuration for additional code analysis.

## New Contributors ❤️

* @gogl92 made their first contribution
* @ihmels made their first contribution
* @rChassat made their first contribution

## [1.0.0] - 2015-04-21

## New Contributors ❤️

* @Furgas made their first contribution
* @stelgenhof made their first contribution

[2.8.0]: https://github.com/azuyalabs/yasumi/compare/2.7.0..2.8.0
[2.7.0]: https://github.com/azuyalabs/yasumi/compare/2.6.0..2.7.0

