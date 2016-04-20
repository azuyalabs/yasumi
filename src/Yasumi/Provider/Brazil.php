<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Dorian Neto <doriansampaioneto@gmail.com>
 */
namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in the Brazil.
 */
class Brazil extends AbstractProvider
{

    use CommonHolidays, ChristianHolidays;

    /**
     * Initialize holidays for the Brazil.
     */
    public function initialize()
    {
        $this->timezone = 'America/Fortaleza';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));

        /**
         * Carnaval
         *
         * Carnaval do Brasil é a maior festa popular do país. A festa acontece durante quatro dias. (que precedem a
         * quarta–feira de cinzas). O último dia de Carnaval precede a quarta-feira de cinzas (início da Quaresma).
         *
         * @link https://pt.wikipedia.org/wiki/Carnaval_do_Brasil
         */
        if ($this->year >= 1700) {
            $this->addHoliday(new Holiday('carnaval', [], $this->calculateEaster($this->year, $this->timezone)
                ->sub(new DateInterval('P47D')), $this->locale));
        }

        /**
         * Dia de Tiradentes
         *
         * Tiradentes (ou Dia de Tiradentes) é um dos feriados nacionais brasileiros. É uma homenagem ao herói nacional
         * brasileiro Joaquim José da Silva Xavier, mártir da Inconfidência Mineira. É celebrado no dia 21 de abril,
         * pois a execução de Tiradentes deu-se neste dia, no ano de 1792.
         *
         * @link https://pt.wikipedia.org/wiki/Tiradentes_(feriado_nacional)
         */
        if ($this->year >= 1792) {
            $this->addHoliday(new Holiday('diaDeTiradentes', [], new DateTime("$this->year-04-21",
            	new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Dia da Independência do Brasil
         *
         * O Dia da Pátria (também chamado Dia da Independência do Brasil ou Sete de Setembro) é um feriado nacional da
         * pátria brasileira celebrado no dia 7 de setembro de cada ano. A data comemora a Declaração de Independência
         * do Brasil do Império Português no dia 7 de setembro de 1822.
         *
         * @link https://pt.wikipedia.org/wiki/Dia_da_P%C3%A1tria
         */
        if ($this->year >= 1822) {
            $this->addHoliday(new Holiday('diaDaIndependenciaDoBrasil', [], new DateTime("$this->year-09-07",
            	new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Nossa Senhora Aparecida
         *
         * Nossa Senhora da Conceição Aparecida, popularmente chamada de Nossa Senhora Aparecida, é a padroeira do
         * Brasil. Venerada na Igreja Católica. Um título mariano negro, Nossa Senhora Aparecida é representada por uma
         * pequena imagem de terracota da Virgem Maria atualmente alojada na Basílica de Nossa Senhora Aparecida,
         * localizada na cidade de Aparecida, em São Paulo.
         *
         * Sua festa litúrgica é celebrada em 12 de outubro, um feriado nacional no Brasil desde 1980, quando o Papa
         * João Paulo II consagrou a Basílica, que é o quarto santuário mariano mais visitado do mundo,[4] capaz de
         * abrigar até 45.000 fiéis.
         *
         * @link https://pt.wikipedia.org/wiki/Nossa_Senhora_da_Concei%C3%A7%C3%A3o_Aparecida
         */
        if ($this->year >= 1980) {
            $this->addHoliday(new Holiday('nossaSenhoraAparecida', [], new DateTime("$this->year-10-12",
            	new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Dia dos Finados
         *
         * O Dia dos Fiéis Defuntos ou Dia de Finados, (conhecido ainda como Dia dos Mortos no México), é celebrado pela
         * Igreja Católica no dia 2 de novembro.
         *
         * @link https://pt.wikipedia.org/wiki/Dia_dos_Fi%C3%A9is_Defuntos
         */
        if ($this->year >= 1300) {
            $this->addHoliday(new Holiday('diaDosFinados', [], new DateTime("$this->year-11-02",
            	new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Proclamação da República
         *
         * A Proclamação da República Brasileira foi um levante político-militar ocorrido em 15 de novembro de 1889 que
         * instaurou a forma republicana federativa presidencialista do governo no Brasil, derrubando a monarquia
         * constitucional parlamentarista do Império do Brasil e, por conseguinte, pondo fim à soberania do imperador
         * D. Pedro II. Foi, então, proclamada a República do Brasil.
         *
         * @link https://pt.wikipedia.org/wiki/Proclama%C3%A7%C3%A3o_da_Rep%C3%BAblica_do_Brasil
         */
        if ($this->year >= 1889) {
            $this->addHoliday(new Holiday('proclamacaoDaRepublica', [], new DateTime("$this->year-11-15",
            	new DateTimeZone($this->timezone)), $this->locale));
        }
    }

}