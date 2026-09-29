# Release Policy

This document outlines the release cycle, versioning and quality policy of the **Yasumi** PHP
library. It is intended for users, downstream maintainers and contributors.

## Release Cycle

Yasumi follows a scheduled **bi-annual release cycle**, with two minor releases per year.

| Month         | Release        | Version | Scope                                                                                                |
| ------------- | -------------- | ------- | ---------------------------------------------------------------------------------------------------- |
| **March**     | Spring release | `2.Y.0` | New holiday providers, structural backwards-compatible improvements and PHP runtime support updates. |
| **September** | Autumn release | `2.Y.0` | New holiday providers, structural backwards-compatible improvements and PHP runtime support updates. |

Work merged into the `develop` branch between two releases ships with the next scheduled release. Because
downstream systems and projects rely on Yasumi for critical processes such as payroll, payment scheduling
and other business logic, predictability and correctness are prioritized over release speed.

> **Note:** March and September are targets, and not fixed dates. Releases are made on a
> best-effort basis and can be delayed when a change needs additional validation - a release is
> only published once it passes the quality gates below.

## Versioning

Yasumi adheres to [Semantic Versioning](https://semver.org) where Git tags follow the same format
and carry no `v` prefix (for example `2.11.0`).

- **MAJOR** (`X.0.0`) - incompatible API changes or other backwards-incompatible changes.
- **MINOR** (`X.Y.0`) - new holiday providers, features and backwards-compatible enhancements.
  Released in March and September.
- **PATCH** (`X.Y.Z`) - backwards-compatible bug fixes, corrected holiday rules and updated
  legislative dates. Released as needed, in between the scheduled releases.

## Patch Releases

Holiday legislation, government decrees and newly announced holidays do not wait for the
bi-annual schedule. Such corrections, along with critical bug fixes, are released as a
patch version.

Patch releases contain bug fixes and updated holiday data only. They never introduce breaking API
changes.

## Major Releases

Yasumi has only released two major releases and major releases will occur infrequently when significant backwards-incompatible changes
or incompatible API changes are introduced.

## Scheduled Release Contents

- New country and region holiday providers.
- Backwards-compatible structural, architectural or API improvements.
- PHP runtime support updates (adding or sunsetting a PHP version).
- Refactoring, documentation and test improvements accumulated since the previous release.

Urgent calculation fixes and legislative updates do not wait for the schedule - see
[Patch releases](#patch-releases).

## Release Quality

A release is only made once every change in it has been validated:

- The full test suite passes on all supported PHP versions.
- Static analysis reports no errors.
- The PSR-12 coding standard is satisfied.
- Every change since the previous release is recorded in `CHANGELOG.md`
  (generated with [git-cliff](https://git-cliff.org) from Conventional Commits).
- New or changed holiday dates cite official sources (government gazettes, legislation, official
  bank holiday announcements).
