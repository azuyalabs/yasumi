# Contributing

Contributions are encouraged and welcome; we are always happy to get feedback or pull requests
on [GitHub](https://github.com/azuyalabs/yasumi).

When contributing there are a few guidelines we'd like you to keep in mind:

## Pull Requests

- **[PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/)**
  Please use the following command after you have completed your work:

  ``` shell
  composer format
  ```

  This will check/correct all the code for the PSR-12 Coding Standard using the
  wonderful [php-cs-fixer](https://cs.symfony.com).

- **Add unit tests!** - Your Pull Request won't be accepted if it does not have tests:

    1. Ensure your new Holiday Provider contains all the necessary unit tests.
    2. Next to the file `{REGIONNAME}BaseTestCase.php`, a file called `{REGIONNAME}Test.php` needs to be present. This
       file needs to include region/country level tests and requires assertion of all expected holidays.
    3. All the unit tests and the implementation Holiday Provider require to have the correct locale, time zone and
       region/country name.
    4. As almost all tests use automatic iterations, make sure the year for which the test is executed is a valid year.
       Some holidays are only established from a certain year and having the test year number smaller than the minimum
       establishment year (amongst all holidays) can result in false errors.

- **Document any change** - Make sure the `CHANGELOG.md` and any other relevant documentation are kept up-to-date.

- **One pull request per feature** - If you want to contribute more than one thing, send multiple pull requests.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make
  multiple intermediate commits while developing,
  please [squash them](https://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#_changing_multiple) before
  submitting.

## Running Tests

``` shell
composer test
```

Or, alternatively run with:

``` shell
vendor/bin/phpunit
```
