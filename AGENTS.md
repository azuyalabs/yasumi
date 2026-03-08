# Yasumi — Agent Instructions

Yasumi is a PHP library for calculating public holidays across countries and regions.
It is calculation-driven (no database), provider-based (one class per country/region),
and PSR-12/PSR-4 compliant.

## Project Structure

```
src/Yasumi/
  Yasumi.php              # Main entry point / factory
  Holiday.php             # Represents a single holiday
  SubstituteHoliday.php   # Substituted holiday
  ProviderInterface.php   # Contract all providers must implement
  Translations.php        # Holiday name translations
  Provider/               # One file (or directory) per country/region
    AbstractProvider.php  # Base class for all providers
    CommonHolidays.php    # Reusable holiday calculations (New Year's, etc.)
    ChristianHolidays.php # Easter and related calculations
    *.php / */            # Country and sub-region providers
  Filters/                # Holiday type filters (Official, Bank, etc.)
  data/                   # Translation data files
tests/                    # PHPUnit tests, mirroring src structure
examples/                 # Usage examples
```

## Requirements

- PHP 8.2+
- `ext-json` (required), `ext-intl` (dev), `ext-calendar` (optional, for Easter)

## Key Commands

```shell
composer test          # Run the full PHPUnit test suite
composer cs            # Check coding standard (dry-run)
composer cs-fix        # Auto-fix coding standard violations (alias: composer format)
composer phpstan       # Run static analysis (level 8)
```

## Coding Conventions

- **PSR-12** coding standard enforced via `php-cs-fixer`. Always run `composer cs-fix` after changes.
- **PSR-4** autoloading: `Yasumi\` → `src/Yasumi/`, `Yasumi\tests\` → `tests/`.
- Strict types (`declare(strict_types=1)`) are required in all PHP files.
- Holiday providers extend `AbstractProvider` and implement `initialize()`.

## Adding a New Holiday Provider

1. Create `src/Yasumi/Provider/{CountryName}.php` extending `AbstractProvider`.
2. Implement `initialize()`: call `addHoliday()` for each holiday.
3. Implement `getSources()`: list of external resources.
4. Add translations to `src/Yasumi/data/`.
5. Create `tests/{CountryName}/{CountryName}BaseTestCase.php` (shared assertions).
6. Create `tests/{CountryName}/{CountryName}Test.php` (country-level tests asserting all expected holidays).
7. Add a `<testsuite>` entry in `phpunit.xml.dist`.
8. Each test must cover multiple years; respect establishment/abolition years of holidays.

## Testing

- All new providers and holidays **must** have unit tests — PRs without tests are not accepted.
- Tests use PHPUnit 11 and iterate over a range of years automatically.
- Run a specific suite: `vendor/bin/phpunit --testsuite Netherlands`

## Static Analysis

- PHPStan at level 8. Run `composer phpstan` and fix all errors before committing.
- Ignored errors are listed in `phpstan.neon.dist`; do not add new ignores without good reason.

## Pull Request Guidelines

- One PR per feature or country provider.
- Run `composer test`, `composer cs`, and `composer phpstan` before submitting.
- Adhere to conventional commits for commit conventions.
- Squash intermediate commits; keep history meaningful.
- Branch off `develop`; target `develop` for PRs.
