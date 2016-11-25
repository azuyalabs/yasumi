<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\bin;

use ArrayIterator;
use CachingIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Yasumi\Translations;
use Yasumi\Yasumi;

class SortTranslationsCommand extends Command
{
    /**
     * The location where all translation files are kept.
     */
    const TRANSLATIONS_DIR = '/../src/Yasumi/data/translations';

    /**
     * The default locale to be used for translating the holiday name.
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this->setName('sort-translations')->setDescription('Sorts all translations in the translation files alphabetically (descending).');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $trans = new Translations(Yasumi::getAvailableLocales());
        $trans->loadTranslations(__DIR__.self::TRANSLATIONS_DIR);

        // Looping through all holidays and their translations
        foreach ($trans->translations as $shortName => $translations) {
            if (!isset($translations[self::DEFAULT_LOCALE])) {
                $output->writeln('<error>No default ('.self::DEFAULT_LOCALE.') translation for `'.$shortName.'`</error>');
                $holidayName = $shortName;
            } else {
                $holidayName = $translations[self::DEFAULT_LOCALE];
            }

            ksort($translations); // Sort the translations alphabetically

            $translationRow = '';
            $it = new CachingIterator(new ArrayIterator($translations));
            foreach ($it as $locale => $translation) {
                $translation = addslashes(trim($translation));
                $translationRow .= str_repeat(' ', 4)."'$locale' => '$translation',";
                if ($it->hasNext()) {
                    $translationRow .= PHP_EOL;
                }
            }

            $template = <<<EOD
<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

// Translation for $holidayName
return [
$translationRow
];

EOD;

            file_put_contents(__DIR__.self::TRANSLATIONS_DIR.'/'.$shortName.'.php', $template);
        }

        $output->writeln('<info>Translations in Yasumi have been sorted successfully.</info>');
    }
}
