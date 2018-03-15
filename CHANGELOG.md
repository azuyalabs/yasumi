# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org).

## [Unreleased]

### Added

### Changed

### Fixed
- Fixed spelling issue in the Swedish translation. [\#97](https://github.com/azuyalabs/yasumi/pull/97)
- Fixed German Easter Sunday and Pentecost Sunday holidays (not nationwide, only in Brandenburg). [\#100](https://github.com/azuyalabs/yasumi/pull/100)
- Fixed BetweenFilter to ignore time part and timezone. [\#101](https://github.com/azuyalabs/yasumi/pull/101)

### Removed

## [1.8.0] - 2018-02-21

### Added
- Added a function that can remove a holiday from the holidays providers (i.e. country/state) list of holidays. This function can be helpful in cases where an existing holiday provider class can be extended but some holidays are not part of the original (extended) provider.
- Changed various functions that have a date parameter to support now objects implementing the DateTimeInterface and objects of the DateTimeImmutable type. 
- Added support for countries where the weekend definition (start and end day) differs from the global definition (Saturday and Sunday).
- Holiday Provider for Russia. [\#72](https://github.com/azuyalabs/yasumi/pull/72) ([lukosius](https://github.com/lukosius))
- Holiday Provider for Estonia. [\#71](https://github.com/azuyalabs/yasumi/pull/71) ([lukosius](https://github.com/lukosius))
- Added Scrutinizer integration.

### Changed
- Locale List updated based on CLDR version 32. 
- Added PHPStan static analysis tool to Travis CI [\#88](https://github.com/azuyalabs/yasumi/pull/88) ([lukosius](https://github.com/lukosius))
- Various inline documentation enhancements. [\#87](https://github.com/azuyalabs/yasumi/pull/87) ([lukosius](https://github.com/lukosius))
- Removed unnecessary typecasts and if-construct. [\#87](https://github.com/azuyalabs/yasumi/pull/87) ([lukosius](https://github.com/lukosius))
- Updated inline documentation to include correction Exception throws.
- Removed unnecessary NULL checks.

### Fixed
- Fixed Brazilian Carnaval Day and added Ash Wednesday to Brazilian Holidays. [\#92](https://github.com/azuyalabs/yasumi/pull/92) ([glauberm](https://github.com/glauberm))
- Yasumi listed 01.04.2018 (Easter Sunday) for Spain as an official holiday, however it is not recognized as such. Fix made that recognizes Easter Sunday as being observed (in all regions). [\#86](https://github.com/azuyalabs/yasumi/pull/86) ([Bastian Konetzny](https://github.com/bkonetzny))
- Corrected reference to the Holiday Provider's ID to be static.
- Changed weekend data property into constant as it is not dynamic (runtime). 
- Corrected the name translation test for the Restoration of Independence Day (Portugal). The test didn't account for the fact that this holiday was abolished and reinstated at some time.
- Corrected unit test for Geneva (Switzerland) as the jeune Genevois day was incorrectly asserted as a regional holiday.
- Corrected the count logic so that in case a holiday is substituted (or observed), it is only counted once.
- Dropped unnecessary arguments of some methods in various Holiday Providers.
- Corrected Japanese "Green Day" and "Children's Day" to use "Hiragana" instead of Kanji. [\#80](https://github.com/azuyalabs/yasumi/pull/80) ([cookie-maker](https://github.com/cookie-maker))


## [1.7.0] - 2017-12-11
### Added
- All filters implement the [Countable](http://php.net/manual/en/class.countable.php) interface allowing you to use the ->count() method. [\#77](https://github.com/azuyalabs/yasumi/issues/77)
- Holiday Provider for Latvia. [\#70](https://github.com/azuyalabs/yasumi/pull/70) ([lukosius](https://github.com/lukosius))
- Holiday Provider for Lithuania. [\#67](https://github.com/azuyalabs/yasumi/pull/67) ([lukosius](https://github.com/lukosius))
- Sometimes it is more convenient to be able to create a Yasumi instance by ISO3166 code rather than Yasumi's Holiday Provider name. A new function `createByISO3166_2` has been added to allow for that. [\#62](https://github.com/azuyalabs/yasumi/pull/62) ([huehnerhose](https://github.com/huehnerhose))
- Missing translations (de_DE) for Easter Sunday and Whitsunday. [\#60](https://github.com/azuyalabs/yasumi/pull/60) ([IceShack](https://github.com/IceShack))
- Holiday Provider for Hungary. [\#57](https://github.com/azuyalabs/yasumi/pull/57) ([AronNovak](https://github.com/AronNovak))
- Holiday Provider for Switzerland. [\#56](https://github.com/azuyalabs/yasumi/pull/56) ([qligier](https://github.com/qligier))

### Changed
- Made `calculate` method public and use of proper camel casing. [\#73](https://github.com/azuyalabs/yasumi/pull/73) ([patrickreck](https://github.com/patrickreck))
- Upgraded Faker Library to version 1.7
- Renamed the holiday type NATIONAL to OFFICIAL. Subregions may have official holidays and the name NATIONAL doesn't suit these situations. [\#65](https://github.com/azuyalabs/yasumi/pull/65)
- Upgraded PHP-CS-Fixer to version 2.6

### Fixed
- Corrected Geneva (Switzerland) unit test to ensure some holidays that are established at a particular year are handled as such.
- Repentance Day is an official holiday in Saxony (Germany) [\#63](https://github.com/azuyalabs/yasumi/issues/63)
- Corrected the Easter Sunday translation for Austria (de_AT)  [\#66](https://github.com/azuyalabs/yasumi/issues/66)
- Corrected Hungary unit test to ensure holidays that are established at a particular year are handled as such.
- Added missing Summer Bank Holiday for the United Kingdom. [\#64](https://github.com/azuyalabs/yasumi/issues/64)


## [1.6.1] - 2017-02-07
### Added
- Added missing unit tests for Reformation Day as in 2017 it is celebrated in all German states for its 500th anniversary.
- Added missing unit tests for the German Unit Day for each German state.
- Created fallback calculation of the easter_days function in case the PHP extension 'calendar' is not loaded. [\#55](https://github.com/azuyalabs/yasumi/pull/55) ([stelgenhof](https://github.com/stelgenhof))

### Changed
- Moved Reformation Day to Christian Holidays as it is not only celebrated in Germany.
- Changed Travis configuration to use Composer-installed phpunit to avoid if any issues arise with globally installed phpunit.

### Fixed
- Fixed Christmas Day and Boxing Day for the United Kingdom. A substitute bank holiday is now created for both Christmas and Boxing Day when either of those days fall on a weekend. [\#48](https://github.com/azuyalabs/yasumi/issues/48) ([joshuabaker](https://github.com/joshuabaker))
- Renamed 'en_US' translation for the Second Christmas Day (from ‘Boxing Day’ to ‘Second Christmas Day’: Boxing Day concept does not exist in the US). [\#53](https://github.com/azuyalabs/yasumi/pull/53) ([AngelinCalu](https://github.com/AngelinCalu))


## [1.6.0] - 2017-01-06
### Added
- Added Holiday Provider for Romania. [\#52](https://github.com/azuyalabs/yasumi/pull/52) ([AngelinCalu](https://github.com/AngelinCalu))
- Added Holiday Provider for Ireland. [stelgenhof](https://github.com/stelgenhof)
- Added Holiday Provider for South Africa. [stelgenhof](https://github.com/stelgenhof)
- Added Holiday Provider for Austria. [stelgenhof](https://github.com/stelgenhof)
- Added 'en_US' translations for the Polish Independence Day and Constitution Day. [\#45](https://github.com/azuyalabs/yasumi/pull/45) ([AngelinCalu](https://github.com/AngelinCalu))

### Changed
- Refactored the calculation of Orthodox Easter using the function from ChristianHolidays.php. [\#47](https://github.com/azuyalabs/yasumi/pull/47) ([AngelinCalu](https://github.com/AngelinCalu))

### Fixed
- The parameters of the `isHoliday` and `isWorkingDay` methods now allow for classes that derive from DateTime (like the very popular Carbon class). [\#49](https://github.com/azuyalabs/yasumi/issues/49) ([stelgenhof](https://github.com/stelgenhof))


## [1.5.0] - 2016-11-25
### Added
- Added Holiday Provider for Australia (and the sub-region of Victoria). [\#38](https://github.com/azuyalabs/yasumi/pull/38) ([brucealdridge](https://github.com/brucealdridge))
- You can now also use your own holiday providers in addition to the included holiday providers.
  A very helpful improvement if Yasumi does not include your provider (yet), but you want to use yours! [\#29](https://github.com/azuyalabs/yasumi/pull/29) ([navarr](https://github.com/navarr))
- Added Holiday Provider for Portugal. [\#44](https://github.com/azuyalabs/yasumi/pull/44) ([rvelhote](https://github.com/rvelhote))
- Added Holiday Provider for Ukraine. [\#41](https://github.com/azuyalabs/yasumi/pull/41) ([madmis](https://github.com/madmis))
- Possibility to retrieve the next or previous working day within a defined number of days from today [\#39](https://github.com/azuyalabs/yasumi/pull/39) ([brucealdridge](https://github.com/brucealdridge))
- Added Holiday Providers for all 16 German States. [\#34](https://github.com/azuyalabs/yasumi/pull/34) ([stelgenhof](https://github.com/stelgenhof))
- Added Holiday Provider for Croatia. [\#32](https://github.com/azuyalabs/yasumi/pull/32) ([karlomikus](https://github.com/karlomikus))

### Fixed
- Carnival Day in Brazil was incorrectly set to be 47 days after Easter. Carnival Day begins Friday before Ash Wednesday (51 days to Easter). [\#36](https://github.com/azuyalabs/yasumi/pull/36) ([icaroce](https://github.com/icaroce))
- All Saints Day for Finland was incorrectly set for November 1st. The correct date is Saturday between 31 Oct and 6 Nov, similar to Sweden. [\#43](https://github.com/azuyalabs/yasumi/issues/43) ([stelgenhof](https://github.com/stelgenhof))


## [1.4.0] - 2016-06-04
### Added
- Added Holiday Provider for Brazil. [\#21](https://github.com/azuyalabs/yasumi/pull/21) ([dorianneto](https://github.com/dorianneto))
- Added Holiday Provider for the Czech Republic. [\#26](https://github.com/azuyalabs/yasumi/pull/26) ([dfridrich](https://github.com/dfridrich))
- Added Holiday Provider for the United Kingdom. [\#23](https://github.com/azuyalabs/yasumi/pull/23) ([stelgenhof](https://github.com/stelgenhof))
- Add Welsh language (spoken in Wales, UK) translations for the holidays in the United Kingdom [\#25](https://github.com/azuyalabs/yasumi/pull/25) ([meigwilym](https://github.com/meigwilym))
- To determine a set of holidays between two dates you can now use the aptly named 'between()' method.

### Changed
- All Holiday Provider must now implement a code that will identify it. Typically this is the ISO3166 code
  corresponding to the respective country or sub-region. This can help for purposes such as translations or interfacing
  with other API's for example.

### Fixed
- Fixed an issue with the unit test for the 'getProviders' method failing on Windows. Hardcoded unix-style directory separators have been replaced by DIRECTORY_SEPARATOR. [\#30](https://github.com/azuyalabs/yasumi/pull/30) ([navarr](https://github.com/navarr))
- Corrected a typo in the English translation for 敬老の日 (Japan) [\#22](https://github.com/azuyalabs/yasumi/pull/22) ([navarr](https://github.com/navarr))
- Fixed issue that the unit tests in 'YasumiTest' (methods 'next' and 'previous') did not cover the situations that the limits are exceeded. [\#28](https://github.com/azuyalabs/yasumi/issues/28)


## [1.3.0] - 2016-05-02
### Added
- Added Holiday Provider for Poland. [\#18](https://github.com/azuyalabs/yasumi/pull/18) ([mpdx](https://github.com/mpdx))
- Added Holiday Provider for New Zealand. [\#13](https://github.com/azuyalabs/yasumi/pull/13) ([badams](https://github.com/badams))
- Added Holiday Provider for Greece. [\#10](https://github.com/azuyalabs/yasumi/pull/10) ([sebdesign](https://github.com/sebdesign))
- Added Holiday Provider for Germany. [\#9](https://github.com/azuyalabs/yasumi/pull/9) ([eaglefsd](https://github.com/eaglefsd))
- Added translations ('fr_FR', 'fr_BE') for Belgium National day [\#864d250](https://github.com/azuyalabs/yasumi/commit/864d25097abbeedbee15bcc37702a34c36a5b696) ([R2c](https://github.com/R2c))
- Added missing English ('en_US') translations for the Christian holidays 'Immaculate Conception', 'Maundy Thursday',
  'St. Georges Day', 'St. John's Day', 'St. Josephs Day' and 'St. Stephens Day'.
- Added Test Interface class to ensure the unit tests contain a some minimal assertions.

### Changed
- Sorted all translations in the translation files alphabetically (descending).
- Refactoring and cleanup of all unit tests.

### Fixed
- Fixed issue for Sweden as All Saints Day was always calculated to be on November 1st. However the holiday has always
  been celebrated on a Saturday (between October 31 and November 6th).
- Fixed the getProviders as it was not able to load Holiday Providers defined in (sub) regions [\#5879133](https://github.com/azuyalabs/yasumi/commit/58791330ccf5c13b1626885921534c32866b7faf) ([R2c](https://github.com/R2c))
- Fixed issue that it was possible for the AbstractProvider class to be loaded as a Holiday Provider [\#9678bc4](https://github.com/azuyalabs/yasumi/commit/9678bc490e34980404ad5dc5b3d45a3c76a3ca0f) ([R2c](https://github.com/R2c))
- Corrected incorrect pathname reference \*BaseTestCase.php files ("Test" -> "test).
- Fixed issue for France as Good Friday and St. Stephens Day were defined as official holidays. These aren't national
  holidays and are only observed in the French departments Moselle, Bas-Rhin and Haut-Rhin. With this fix, these
  holidays have been removed from the France Holiday providers and new providers for the departments Moselle, Bas-Rhin
  and Haut-Rhin are added. [\#17](https://github.com/azuyalabs/yasumi/issues/17) ([R2c](https://github.com/R2c))
- Updated locales list based on CLDR version 29. Removed locales of which the region identifier is not specified.
- Fixed issue for Sweden as Midsummer's Day (st. Johns Day) was always calculated to be on June 24th. However the
  holiday has always been celebrated on a Saturday (between June 20 and June 26).
- Fixed base test for some Spain/LaRioja as some holidays have been established only in a particular year, causing
  false failures in the unit tests.
- Running php-cs-fixer fix . --level=psr2 generated a massive list of changes, and broke unit tests. Added a custom
  .php_cs config file to adhere to the PSR-2 Coding Standards and resolve this issue. In addition the php-cs-fixer
  command to has been added to composer to run the fixers and on the CI server (Travis), meaning PR’s will need to be
  PSR2 compliant before they can be merged. If any files do not pass, the build fails. [\#15](https://github.com/azuyalabs/yasumi/issues/15) [\#16](https://github.com/azuyalabs/yasumi/pull/16) ([badams](https://github.com/badams))
- Accidentally the timezone for Norway was set to "Europe/Copenhagen". This has been corrected to "Europe/Oslo". [\#11](https://github.com/azuyalabs/yasumi/issues/11) [\#12](https://github.com/azuyalabs/yasumi/pull/12) ([badams](https://github.com/badams))
- Fixed issue for Finland as Midsummer's Day (st. Johns Day) was always calculated to be on June 24th. However since
  1955, the holiday has always been celebrated on a Saturday (between June 20 and June 26).


## [1.2.0] - 2016-04-04
### Added
- Added Holiday Provider for Denmark
- Added Holiday Provider for Norway
- Added Holiday Provider for Sweden
- Added Holiday Provider for Finland
- New function 'isWorkingDay' added that determines whether a date represents a working day or not. A working day is
  considered a date that is neither a holiday nor falls into the weekend.

### Changed
- Refactoring and cleanup of unit tests

### Fixed
- The Vernal Equinox Day and Autumnal Equinox Day in Japan were excluded from having it substituted for another day in
  case these days would fall on the weekend.
- Fixed tests for some holiday providers as some holidays have been established only in a particular year, causing
  false failures in the unit tests.


## [1.1.0] - 2016-03-10
### Added
- Added Spain Holiday Provider (including the autonomous communities Andalusia, Aragon, Asturias, Balearic Islands,
  Basque Country, Canary Islands, Cantabria, Castile and León, Castilla-La Mancha, Ceuta, Community of Madrid,
  Extremadura, Galicia, La Rioja, Melilla, Navarre, Region of Murcia, Valencian Community)
- Added Corpus Christi, St. Joseph's Day, Maundy Thursday, St. George's Day, St. John's Day to the common Christian
  Holidays.
- Created separate tests for holidays that are substituted on different days.
- Allow for name spaced holiday providers.
- Added test for translation of Ash Wednesday and Valentinesday in the Netherlands.
- Added test to check whether all holidays for a Holiday Provider are defined by the respective provider class.

### Changed
- Updated some English, Italian, French and Dutch translations.
- Moved all other holiday calculations in Netherlands and France to individual methods.

### Fixed
- For Japan substituted holidays had same date as the original holidays.

### Removed
- Removed support for PHP 5.4. Minimum version is now 5.5. PHP 7.0 is known to work however in Travis CI still allowed
  to fail


## [1.0.0] - 2015-04-21
- Initial Release
