# Change Log


## DEV/MASTER

**Implemented enhancements:**

- Added Denmark Holiday Driver
- Added Norway Holiday Driver
- New function 'isWorkingDay' added that determines whether a date represents a working day or not. A working day is 
  considered a date that is neither a holiday nor falls into the weekend.
- Refactoring and cleanup of unit tests

**Resolved issues:**

- The Vernal Equinox Day and Autumnal Equinox Day in Japan were excluded from having it substituted for another day in
  case these days would fall on the weekend.


## 1.1.0 (Mar 10, 2016)

**Implemented enhancements:**

- Added Spain Holiday Driver (including the autonomous communities Andalusia, Aragon, Asturias, Balearic Islands, 
    Basque Country, Canary Islands, Cantabria, Castile and León, Castilla-La Mancha, Ceuta, Community of Madrid, 
    Extremadura, Galicia, La Rioja, Melilla, Navarre, Region of Murcia, Valencian Community)
- Added Corpus Christi, St. Joseph's Day, Maundy Thursday, St. George's Day, St. John's Day to the common Christian 
  Holidays.
- Updated some English, Italian, French and Dutch translations. 
- Created separate tests for holidays that are substituted on different days.
- Moved all other holiday calculations in Netherlands and France to individual methods.
- Allow for name spaced holiday providers.
- Added test for translation of Ash Wednesday and Valentinesday in the Netherlands.
- Added test to check whether all holidays for a Holiday Provider are defined by the respective provider class.
- Removed support for PHP 5.4. Minimum version is now 5.5. PHP 7.0 is known to work however in Travis CI still allowed
  to fail

**Resolved issues:**

- For Japan substituted holidays had same date as the original holidays.

## 1.0.0 (Apr 21, 2015)

- Initial Release