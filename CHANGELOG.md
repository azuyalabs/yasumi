# Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html) and
[Conventional Commits](https://conventionalcommits.org) for commit conventions.

Changes related to the logic of the holidays or their providers are listed first,
followed by any architectural or technical changes.

## [unreleased]

### Documentation

- Update list of supported versions

### Other

- Drop PHP 8.1 support

## [2.9.0] - 2025-12-29

### Features

- _(Netherlands)_ Add new holiday-equivalent days 2026 till 2028 ([#393](https://github.com/azuyalabs/yasumi/issues/393))
- _(Slovakia)_ Slovak State Consolidation Package for 2025 ([#389](https://github.com/azuyalabs/yasumi/issues/389))
- Add Slovenia holiday provider ([#387](https://github.com/azuyalabs/yasumi/issues/387))
- Add New York Stock Exchange (NYSE) provider ([#384](https://github.com/azuyalabs/yasumi/issues/384))
- _(New Zealand)_ Add Matariki public holiday ([#378](https://github.com/azuyalabs/yasumi/issues/378))

### Fixes

- _(New Zealand)_ Add missing namespace in the MatarikiTest
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

- _(Poland)_ Fix Christmas Eve test
- _(Slovakia)_ Fix failing tests for the years 2025 and 2026

### Other

- _(Deps)_ Bump actions/stale from 10.1.0 to 10.1.1 ([#391](https://github.com/azuyalabs/yasumi/issues/391))
- Add support for PHP 8.5
- Remove Psalm static analysis tool
- Fix deprecated 'set-output' command
- _(Deps)_ Bump actions/stale from 10.0.0 to 10.1.0 ([#386](https://github.com/azuyalabs/yasumi/issues/386))
- _(Deps)_ Bump actions/stale from 9.1.0 to 10.0.0 ([#385](https://github.com/azuyalabs/yasumi/issues/385))

## New Contributors ❤️

- @Stollie made their first contribution
- @mgwebgroup made their first contribution
- @soukicz made their first contribution
- @timeshifting made their first contribution

## [2.8.0] - 2025-07-13

### Features

- _(Canada)_ Nunavut Day for the Nunavut province
- Add Bulgaria provider
- _(Latvia)_ Add Pentecost and Mother's Day ([#368](https://github.com/azuyalabs/yasumi/issues/368))
- _(Argentina)_ Movable holidays ([#367](https://github.com/azuyalabs/yasumi/issues/367))
- _(Poland)_ Christmas Eve is a public holiday from 2025 ([#371](https://github.com/azuyalabs/yasumi/issues/371))
- _(Ireland)_ Saint Brigid's Day ([#374](https://github.com/azuyalabs/yasumi/issues/374))
- _(Lithuania)_ Mother's Day and Father's Day ([#370](https://github.com/azuyalabs/yasumi/issues/370))
- _(Mexico)_ Add Transmission of Federal Executive Power Holiday ([#361](https://github.com/azuyalabs/yasumi/issues/361))
- _(Brazil)_ Black Consciousness Day ([#365](https://github.com/azuyalabs/yasumi/issues/365))
- _(Germany)_ Day of Liberation is celebrated in Berlin in 2025 too.
- _(Germany)_ Add Assumption of Mary holiday to Bavaria
- Add Iran provider ([#341](https://github.com/azuyalabs/yasumi/issues/341))

### Fixes

- _(Brazil)_ Add passing $this->locale for calculateProclamationOfRepublicDay() ([#376](https://github.com/azuyalabs/yasumi/issues/376))
- _(Scotland)_ Easter Monday is not a bank holiday ([#372](https://github.com/azuyalabs/yasumi/issues/372))
- _(Ireland)_ New Year's Day on a Saturday also gives a substitute holiday ([#375](https://github.com/azuyalabs/yasumi/issues/375))
- _(Ukraine)_ Ukraine 2021-2023 changes ([#369](https://github.com/azuyalabs/yasumi/issues/369))
- _(Ireland)_ Easter Sunday is not an official holiday ([#373](https://github.com/azuyalabs/yasumi/issues/373))
- _(Mexico)_ Mark several holidays as observance ([#362](https://github.com/azuyalabs/yasumi/issues/362))
- _(Mexico)_ Mark three holidays as official ([#359](https://github.com/azuyalabs/yasumi/issues/359))
- _(Portugal)_ Corpus Christi is official ([#363](https://github.com/azuyalabs/yasumi/issues/363))
- _(Czech-republic)_ Christmas Eve is official ([#366](https://github.com/azuyalabs/yasumi/issues/366))
- _(Germany)_ Pentecost is not an official holiday - except in Brandenburg ([#337](https://github.com/azuyalabs/yasumi/issues/337))
- _(Slovakia)_ Update rules for Anniversary of the Declaration of the Slovak Nation ([#340](https://github.com/azuyalabs/yasumi/issues/340))

### Refactor

- _(South Korea)_ Simplify code by using early returns
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

- _(Portugal)_ Fix official holidays tests
- Fix test for the previous function
- Increase memory_limit, to be able to run all tests on MacOS
- _(Portugal)_ Fix issue with Republic Day failing for the restored years between 2013 and 2016

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

- @attepulkkinen made their first contribution
- @dependabot[bot] made their first contribution
- @fbett made their first contribution
- @hamrak made their first contribution
- @mtbossa made their first contribution
- @thrashzone13 made their first contribution

[2.9.0]: https://github.com/azuyalabs/yasumi/compare/2.8.0..2.9.0
[2.8.0]: https://github.com/azuyalabs/yasumi/compare/2.7.0..2.8.0
