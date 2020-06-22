# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/) and this project adheres to [Semantic Versioning](https://semver.org).

## [Unreleased]

### Added

### Changed

### Fixed

### Deprecated

### Removed


## [2.3.0] - 2020-06-22

### Added
- Added Canada Provider [\#215](https://github.com/azuyalabs/yasumi/pull/215) ([lux](https://github.com/lux))
- Added Luxembourg Provider [\#205](https://github.com/azuyalabs/yasumi/pull/205) ([Arkounay](https://github.com/Arkounay))
- Holiday providers for states of Austria. [\#182](https://github.com/azuyalabs/yasumi/pull/182) ([aprog](https://github.com/aprog))
- Added All Souls Day to Lithuania [\#227](https://github.com/azuyalabs/yasumi/pull/227) ([norkunas](https://github.com/norkunas))
- Catholic Christmas Day is a new official holiday since 2017 in the Ukraine. [\#202](https://github.com/azuyalabs/yasumi/pull/202)
- Additional Dates for Australia/Victoria:AFL Grand Final Friday [\#190](https://github.com/azuyalabs/yasumi/pull/190) ([brucealdridge](https://github.com/brucealdridge))
- Substituted holidays (holidays that fall in the weekend) for Australia. [\#201](https://github.com/azuyalabs/yasumi/pull/201) ([c960657](https://github.com/c960657))
- Added New Years Eve to Germany [\#226](https://github.com/azuyalabs/yasumi/pull/226) ([Patrick-Root](https://github.com/Patrick-Root))
- Day of Liberation (Tag der Befreiung) is a one-time official holiday in 2020 in Berlin (Germany).
- Catalan translations for holidays in Catalonia, Valencian Community, Balearic Islands and Aragon [\#189](https://github.com/azuyalabs/yasumi/pull/189) ([c960657](https://github.com/c960657))
- Added American English spelling for Labour Day [\#216](https://github.com/azuyalabs/yasumi/issues/216)
- Added French translation for Second Christmas Day [\#188](https://github.com/azuyalabs/yasumi/pull/188) ([Arkounay](https://github.com/Arkounay))

- Added accessor methods Holiday::getKey() and SubstituteHoliday::getSubstitutedHoliday() [\#220](https://github.com/azuyalabs/yasumi/pull/220)+[\#221](https://github.com/azuyalabs/yasumi/pull/221) ([c960657](https://github.com/c960657))
- Added missing return (correct) and parameter types in various methods.

### Changed
- Renamed the Australian states to be full names instead of abbreviations to be in line with other Holiday Providers [\#214](https://github.com/azuyalabs/yasumi/pull/214)
- Statehood Day is celebrated at a new date since 2020 in Croatia. [\#203](https://github.com/azuyalabs/yasumi/pull/203) ([krukru](https://github.com/krukru))
- Independence Day is no longer an official holiday since 2020 in Croatia. [\#203](https://github.com/azuyalabs/yasumi/pull/203) ([krukru](https://github.com/krukru))
- Homeland Thanksgiving Day has been renamed to "Victory and Homeland Thanksgiving Day and the Day of Croatian Defenders" since 2020 in Croatia. [\#203](https://github.com/azuyalabs/yasumi/pull/203) ([krukru](https://github.com/krukru))
- Remembrance Day for Homeland War Victims and Remembrance Day for the Victims of Vukovar and Skabrnja is a new official holiday since 2020 in Croatia. [\#203](https://github.com/azuyalabs/yasumi/pull/203) ([krukru](https://github.com/krukru))
- Second International Workers Day in Ukraine was an official holiday only until 2018. [\#202](https://github.com/azuyalabs/yasumi/pull/202)
- Holiday names in Danish, Dutch, and Norwegian are no longer capitalized. [\#185](https://github.com/azuyalabs/yasumi/pull/185) ([c960657](https://github.com/c960657))

- Changed the fallback from DEFAULT_LANGUAGE to 'en'. [\#183](https://github.com/azuyalabs/yasumi/pull/183) ([c960657](https://github.com/c960657))
- Introduced a DateTimeZoneFactory class to improve performance. This will keep a static reference to the instantiated DateTimezone, thus saving resources. [\#213](https://github.com/azuyalabs/yasumi/pull/213) ([pvgnd](https://github.com/pvgn))
- Changed DateTime to DateTimeImmutable as dates should be that: immutable (by default)
- Explicitly set nullable parameters as such.
- Refactored various conditional structures.
- Changed signature of some methods as parameters with defaults should come after required parameters.
- Updated third party dependencies.

### Fixed
- Fixed Ukraine holidays on weekends. These days need to be substituted. [\#202](https://github.com/azuyalabs/yasumi/pull/202)
- Fixed issue if the next working day happens to be in the next year  (i.e. not in the year of the Yasumi instance) [\#192](https://github.com/azuyalabs/yasumi/issues/192) ([tniemann](https://github.com/tniemann))
- Fix locale fallback for substitute holidays [\#180](https://github.com/azuyalabs/yasumi/pull/180) ([c960657](https://github.com/c960657))
- Fixed issue if the previous working day happens to be in the previous year (i.e. not in the year of the Yasumi instance)

- Fixed compound conditions that are always true by simplifying the condition steps.

### Deprecated
- Deprecated direct access to public properties Holiday::$shortName and SubstituteHoliday::$substitutedHoliday in favor of accessor methods [\#220](https://github.com/azuyalabs/yasumi/pull/220) ([c960657](https://github.com/c960657))

### Removed
- PHP 7.1 Support, as it has reached its end of life.
- Removed the assertion of the instance type in some functions as it is already defined by the return type.
- Removed unused variables, namespaces, brackets, empty tests, etc.


## [2.2.0] - 2019-10-06

### Added
- Holiday providers for England, Wales, Scotland and Northern Ireland [\#166](https://github.com/azuyalabs/yasumi/pull/166) ([c960657](https://github.com/c960657))
- Holiday Provider for South Korea. [\#156](https://github.com/azuyalabs/yasumi/pull/156) ([blood72](https://github.com/blood72))
- Translation for the Easter holiday for the 'fr_FR' locale [\#146](https://github.com/azuyalabs/yasumi/pull/146) ([pioc92](https://github.com/pioc92))
- Translation for the Pentecost holiday for the 'fr_FR' locale [\#145](https://github.com/azuyalabs/yasumi/pull/145) ([pioc92](https://github.com/pioc92))
- Late Summer Bank Holiday in United Kingdom prior to 1965 [\#161](https://github.com/azuyalabs/yasumi/pull/161) ([c960657](https://github.com/c960657))
- Observance holidays for Sweden [\#172](https://github.com/azuyalabs/yasumi/pull/172) ([c960657](https://github.com/c960657))
- Created a special subclass of Holiday for substitute holidays [\#162](https://github.com/azuyalabs/yasumi/pull/162) ([c960657](https://github.com/c960657))
- Added additional code style fixers and aligning StyleCI settings with PHP-CS.
- Included extra requirement for some PHP Extensions in the composer file.

### Changed
- Updated the translation for the All Saints holiday for the 'fr_FR' locale [\#152](https://github.com/azuyalabs/yasumi/pull/152) ([pioc92](https://github.com/pioc92))
- Updated the translation for the Armistice holiday for the 'fr_FR' locale [\#154](https://github.com/azuyalabs/yasumi/pull/154) ([pioc92](https://github.com/pioc92))
- Updated the translation for the Victory in Europe holiday for the 'fr_FR' locale [\#153](https://github.com/azuyalabs/yasumi/pull/153) ([pioc92](https://github.com/pioc92))
- Updated the translation for the Assumption of Mary holiday for the 'fr_FR' locale [\#155](https://github.com/azuyalabs/yasumi/pull/155) ([pioc92](https://github.com/pioc92))
- Updated the translation for Christmas Day for the 'nl_NL' locale [\#160](https://github.com/azuyalabs/yasumi/pull/160) ([pioc92](https://github.com/pioc92))
- Reordered arguments to Yoda style.
- Replaced null checks by appropriate instance / type checks.
- Moved default method values to method body as parameters should be nullable. 
- Applying the use of strict types. Strict typing allows for improved readability, maintainability, and less prone to bugs and security vulnerabilities.
- PHP 7.1 is allowed to fail for Travis-CI due to the fact PHPUnit 8 requires PHP >= 7.2. PHP 7.1 support will be dropped in Yasumi once 7.1 has reached its end of life (December 2019).
- Code using class imports rather than Fully Qualified Class names.
- Upgraded to PHPUnit 8.
- Replaced the standard 'InvalidArgumentException' when an invalid year or holiday provider is given by a new exception for each of these two situations separately ('InvalidYearException' and 'ProviderNotFoundException'). This allows you to better distinguish which exception may occur when instantiating the Yasumi class. [\#95](https://github.com/azuyalabs/yasumi/pull/95) ([qneyrat](https://github.com/qneyrat))
- Refactored the AbstractProvider::count method to use the newly added SubstituteHoliday class.
- Fallback support added to getName() to allow e.g. fallback from 'de_AT' to 'de'. [\#176](https://github.com/azuyalabs/yasumi/pull/176) ([c960657](https://github.com/c960657))

### Fixed
- Late Summer Bank Holiday in 1968 and 1969 in United Kingdom [\#161](https://github.com/azuyalabs/yasumi/pull/161) ([c960657](https://github.com/c960657))
- Fixed one-off exceptions for May Day Bank Holiday in 1995 and 2020 and Spring Bank Holiday in 2002 and 2012 (United Kingdom) [\#160](https://github.com/azuyalabs/yasumi/pull/160) ([c960657](https://github.com/c960657))
- Fixed revoked holidays in Portugal in 2013-2015 [\#163](https://github.com/azuyalabs/yasumi/pull/163) ([c960657](https://github.com/c960657))
- Fixed spelling issues in the Danish translation for Second Christmas Day. [\#167](https://github.com/azuyalabs/yasumi/pull/167) ([c960657](https://github.com/c960657))
- Corpus Christi is official in Poland [\#168](https://github.com/azuyalabs/yasumi/pull/168) ([c960657](https://github.com/c960657))
- Liberation Day is official in the Netherlands [\#169](https://github.com/azuyalabs/yasumi/pull/169) ([c960657](https://github.com/c960657))
- Typos in Easter Monday and Republic Day for the 'it_IT' locale [\#171](https://github.com/azuyalabs/yasumi/pull/171) ([c960657](https://github.com/c960657))
- Corrected the name of the Emperors Birthday function and variable.
- Good Friday is not official in Brazil [\#174](https://github.com/azuyalabs/yasumi/pull/174) ([c960657](https://github.com/c960657))

### Removed
- Unused constants.


## [2.1.0] - 2019-03-29

### Added
- As the Japanese Emperor will abdicate the throne on May 1st 2019, the holiday of the Emperors Birthday will change to February 23rd from 2020 (No holiday in 2019). In addition, Coronation Day and the Enthronement Proclamation Ceremony will be extra holidays in 2019. [\#130](https://github.com/azuyalabs/yasumi/pull/130) ([cookie-maker](https://github.com/cookie-maker))
- International Women's Day is an official holiday since 2019 in Berlin (Germany). [#133](https://github.com/azuyalabs/yasumi/pull/133) ([huehnerhose](https://github.com/huehnerhose))

### Changed
- Japanese Health And Sports Day will be renamed to Sports Day from 2020. [\#129](https://github.com/azuyalabs/yasumi/pull/129) ([cookie-maker](https://github.com/cookie-maker))
- Dutch spelling for Easter/Pentecost/Christmas to use lower case. [\#128](https://github.com/azuyalabs/yasumi/pull/128) ([c960657](https://github.com/c960657))
- Refactored the Netherlands Holiday provider by moving the calculation of individual holidays to private methods. This will reduce the complexity of the initialize method.
- Visibility of internal class functions to 'private'. These are to be used within the class only and should not be public.

### Fixed
- "Bridge Day" for Japan takes two days in 2019. Currently, the code only allows for 1 bridge day at a maximum. [\#141](https://github.com/azuyalabs/yasumi/pull/141) ([cookie-maker](https://github.com/cookie-maker))
- Tests for Bremen, Lower Saxony and Schleswig Holstein (Germany) also celebrated Reformation Day in 2017. The unit tests were failing as it didn't account for that.
- Changed the USA Provider to check all holidays for potential substitute holidays, not just New Year's Day, Independence Day, and Christmas Day. [\#140](https://github.com/azuyalabs/yasumi/pull/140) ([jagers](https://github.com/jagers))
- Adjusted tests for the 'next' and 'previous' methods to avoid actually exceeding the year boundaries.
- Deprecation warning for the package mikey179/vfStream. Composer 2.0 requires package names to not contain any upper case characters. [\#135](https://github.com/azuyalabs/yasumi/pull/135) ([IceShack](https://github.com/IceShack))
- Incorrect comment about weekends in India [\#126](https://github.com/azuyalabs/yasumi/pull/126) ([c960657](https://github.com/c960657))
- Correction to the test of New Year's Day in the United Kingdom. It has been identified as a Bank Holiday only since 1975 (not from 1974).
  
### Removed
- Duplicate definition of newYearsDay [\#125](https://github.com/azuyalabs/yasumi/pull/125) ([c960657](https://github.com/c960657))


## [2.0.0] - 2019-01-11

### Added
- New filter to select holidays that happen on a given date [\#119](https://github.com/azuyalabs/yasumi/pull/119) ([cruxicheiros](https://github.com/cruxicheiros))
- Holiday Providers for all Australian states and territories. [\#112](https://github.com/azuyalabs/yasumi/pull/112) ([Milamber33](https://github.com/Milamber33))
- Holiday Provider for Bosnia. [\#94](https://github.com/azuyalabs/yasumi/pull/94) ([TheAdnan](https://github.com/TheAdnan))
- Added Reformation Day as official holiday since 2018 in Lower Saxony (Germany). [#115](https://github.com/azuyalabs/yasumi/issues/115) ([Taxcamp](https://github.com/Taxcamp))
- Added Reformation Day as official holiday since 2018 in Schleswig-Holstein (Germany). [#106](https://github.com/azuyalabs/yasumi/pull/106) ([HenningCash](https://github.com/HenningCash))
- Added Reformation Day as official holiday since 2018 in Hamburg (Germany). [#108](https://github.com/azuyalabs/yasumi/pull/108) ([HenningCash](https://github.com/HenningCash))
- Added Reformation Day as official holiday since 2018 in Bremen (Germany). [#116](https://github.com/azuyalabs/yasumi/issues/116) ([TalonTR](https://github.com/TalonTR))
- The (observed) holidays Lukkeloven, Constitution Day, New Year's Eve and Labour Day, as well as summertime and wintertime are included for Denmark [\#104](https://github.com/azuyalabs/yasumi/pull/104) ([c960657](https://github.com/c960657))

### Changed
- Upgraded entirely to PHP version 7 with PHP 7.1 being the minimum required version. Base code and all unit tests have been reworked to compatibility with PHP 7.
- Upgraded to PHPUnit to version 7.5.
- Changed Japanese holiday for the 2020 Olympic Games. Marine Day, Mountain Day and Health And Sports Day. [\#113](https://github.com/azuyalabs/yasumi/pull/113) ([cookie-maker](https://github.com/cookie-maker))
- Summer/winter time is now fetched from PHP's tz database. [\#103](https://github.com/azuyalabs/yasumi/pull/103) ([c960657](https://github.com/c960657))
- Changed translation for Norway's national day. [\#98](https://github.com/azuyalabs/yasumi/pull/98) ([c960657](https://github.com/c960657))
- Applied proper null checks in the summer time and wintertime calculations for Denmark and The Netherlands.
- Corrected some namespaces for Australia and Germany.
- Updated copyright year.
- Upgraded various dependency packages.
- Internal locale list updated based on CLDR v34.
- Refactored the Japan and USA Holiday Provider by moving the holiday calculations to private methods. This reduced the complexity of the initialize method.
- Changed individual added International Women's Day for Ukraine and Russia to common holiday.  [#133](https://github.com/azuyalabs/yasumi/pull/133) ([huehnerhose](https://github.com/huehnerhose))

### Fixed
- Translation for Russia showed in English (except New Year's Day) as the proper locale was not in place.
- Fixed issue for summer time in Denmark in 1980. By default summertime in Denmark is set for the last day of March since 1980, however in 1980 itself, it started on April, 6th.
- Fixed spelling issue in the Swedish translation. [\#97](https://github.com/azuyalabs/yasumi/pull/97) ([c960657](https://github.com/c960657))
- Fixed spelling issues in the Danish translation. [\#96](https://github.com/azuyalabs/yasumi/pull/96) ([c960657](https://github.com/c960657))
- Fixed German Easter Sunday and Pentecost Sunday holidays (not nationwide, only in Brandenburg). [\#100](https://github.com/azuyalabs/yasumi/pull/100) ([TalonTR](https://github.com/TalonTR))
- Fixed BetweenFilter to ignore time part and timezone. [\#101](https://github.com/azuyalabs/yasumi/pull/101) ([c960657](https://github.com/c960657))
- Fixed bug in provider list generation related to variable order of files returned by the filesystem [\#107](https://github.com/azuyalabs/yasumi/pull/107) ([leafnode](https://github.com/leafnode))

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
- Fixed Brazilian Carnival Day and added Ash Wednesday to Brazilian Holidays. [\#92](https://github.com/azuyalabs/yasumi/pull/92) ([glauberm](https://github.com/glauberm))
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
- All filters implement the [Countable](https://php.net/manual/en/class.countable.php) interface allowing you to use the ->count() method. [\#77](https://github.com/azuyalabs/yasumi/issues/77)
- Holiday Provider for Latvia. [\#70](https://github.com/azuyalabs/yasumi/pull/70) ([lukosius](https://github.com/lukosius))
- Holiday Provider for Lithuania. [\#67](https://github.com/azuyalabs/yasumi/pull/67) ([lukosius](https://github.com/lukosius))
- Sometimes it is more convenient to be able to create a Yasumi instance by ISO3166 code rather than Yasumi's Holiday Provider name. A new function `createByISO3166_2` has been added to allow for that. [\#62](https://github.com/azuyalabs/yasumi/pull/62) ([huehnerhose](https://github.com/huehnerhose))
- Missing translations (de_DE) for Easter Sunday and Whitsunday. [\#60](https://github.com/azuyalabs/yasumi/pull/60) ([IceShack](https://github.com/IceShack))
- Holiday Provider for Hungary. [\#57](https://github.com/azuyalabs/yasumi/pull/57) ([AronNovak](https://github.com/AronNovak))
- Holiday Provider for Switzerland. [\#56](https://github.com/azuyalabs/yasumi/pull/56) ([qligier](https://github.com/qligier))

### Changed
- Made `calculate` method public and use of proper camel casing. [\#73](https://github.com/azuyalabs/yasumi/pull/73) ([patrickreck](https://github.com/patrickreck))
- Upgraded Faker Library to version 1.7
- Renamed the holiday type NATIONAL to OFFICIAL. Sub regions may have official holidays, and the name NATIONAL doesn't suit these situations. [\#65](https://github.com/azuyalabs/yasumi/pull/65)
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
- All Holiday Provider must now implement a code that will identify it. Typically, this is the ISO3166 code
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
- Fixed issue for Sweden as Midsummer's Day (st. Johns Day) was always calculated to be on June 24th. However, the
  holiday has always been celebrated on a Saturday (between June 20 and June 26).
- Fixed base test for some Spain/LaRioja as some holidays have been established only in a particular year, causing
  false failures in the unit tests.
- Running php-cs-fixer fix . --level=psr2 generated a massive list of changes, and broke unit tests. Added a custom
  .php_cs config file to adhere to the PSR-2 Coding Standards and resolve this issue. In addition, the php-cs-fixer
  command has been added to composer to run the fixers and on the CI server (Travis), meaning PR’s will need to be
  PSR2 compliant before they can be merged. If any files do not pass, the build fails. [\#15](https://github.com/azuyalabs/yasumi/issues/15) [\#16](https://github.com/azuyalabs/yasumi/pull/16) ([badams](https://github.com/badams))
- Accidentally the timezone for Norway was set to "Europe/Copenhagen". This has been corrected to "Europe/Oslo". [\#11](https://github.com/azuyalabs/yasumi/issues/11) [\#12](https://github.com/azuyalabs/yasumi/pull/12) ([badams](https://github.com/badams))
- Fixed issue for Finland as Midsummer's Day (st. Johns Day) was always calculated to be on June 24th. However, since
  1955, the holiday has always been celebrated on a Saturday (between June 20 and June 26).


## [1.2.0] - 2016-04-04
### Added
- Added Holiday Provider for Denmark
- Added Holiday Provider for Norway
- Added Holiday Provider for Sweden
- Added Holiday Provider for Finland
- New function 'isWorkingDay' added that determines whether a date represents a working day or not. A working day is
  a date that is neither a holiday nor falls into the weekend.

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
- Allow for namespaced holiday providers.
- Added test for translation of Ash Wednesday and Valentines day in the Netherlands.
- Added test to check whether all holidays for a Holiday Provider are defined by the respective provider class.

### Changed
- Updated some English, Italian, French and Dutch translations.
- Moved all other holiday calculations in Netherlands and France to individual methods.

### Fixed
- For Japan substituted holidays had same date as the original holidays.

### Removed
- Removed support for PHP 5.4. The minimum version is now 5.5. PHP 7.0 is known to work however in Travis CI still allowed
  to fail.


## [1.0.0] - 2015-04-21
- Initial Release
