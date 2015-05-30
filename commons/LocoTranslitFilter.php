<?php

namespace app\commons;

/**
 * ETranslitFilter class file reworked to Loco version: LocoTranslitFilter.
 *
 * @author  Veaceslav Medvedev <slavcopost@gmail.com> then almix
 * @link    http://code.google.com/p/yiiext/
 * @license http://www.opensource.org/licenses/mit-license.php
 */
class LocoTranslitFilter
{
    /**
     * Translit text from cyrillic to latin letters.
     * @static
     *
     * @param string $text the text being translit.
     *
     * @return string
     */
    public static function cyrillicToLatin($text, $toLowCase = true)
    {
        $matrix = [
            "й"   => "i",
            "ц"   => "c",
            "у"   => "u",
            "к"   => "k",
            "е"   => "e",
            "н"   => "n",
            "г"   => "g",
            "ш"   => "sh",
            "щ"   => "shch",
            "з"   => "z",
            "х"   => "h",
            "ъ"   => "",
            "ф"   => "f",
            "ы"   => "y",
            "в"   => "v",
            "а"   => "a",
            "п"   => "p",
            "р"   => "r",
            "о"   => "o",
            "л"   => "l",
            "д"   => "d",
            "ж"   => "zh",
            "э"   => "e",
            "ё"   => "e",
            "я"   => "ya",
            "ч"   => "ch",
            "с"   => "s",
            "м"   => "m",
            "и"   => "i",
            "т"   => "t",
            "ь"   => "",
            "б"   => "b",
            "ю"   => "yu",
            "Й"   => "I",
            "Ц"   => "C",
            "У"   => "U",
            "К"   => "K",
            "Е"   => "E",
            "Н"   => "N",
            "Г"   => "G",
            "Ш"   => "SH",
            "Щ"   => "SHCH",
            "З"   => "Z",
            "Х"   => "X",
            "Ъ"   => "",
            "Ф"   => "F",
            "Ы"   => "Y",
            "В"   => "V",
            "А"   => "A",
            "П"   => "P",
            "Р"   => "R",
            "О"   => "O",
            "Л"   => "L",
            "Д"   => "D",
            "Ж"   => "ZH",
            "Э"   => "E",
            "Ё"   => "E",
            "Я"   => "YA",
            "Ч"   => "CH",
            "С"   => "S",
            "М"   => "M",
            "И"   => "I",
            "Т"   => "T",
            "Ь"   => "",
            "Б"   => "B",
            "Ю"   => "YU",
            'І'   => 'I',
            'і'   => 'i',
            'Ї'   => 'I',
            'ї'   => 'i',
            'Є'   => 'E',
            'є'   => 'є',
            "«"   => "",
            "»"   => "",
            " "   => "-",
            "\""  => "",
            "\."  => "",
            "–"   => "-",
            "\,"  => "",
            "\("  => "",
            "\)"  => "",
            "\?"  => "",
            "\!"  => "",
            "\:"  => "",
            "\%"  => "",
            '#'   => '',
            '№'   => '',
            ' - ' => '-',
            '/'   => '-',
            '  '  => '-',
            "'"   => '',
            '!'   => '',
            '@'   => '',
            '$'   => '',
            '%'   => '',
            '^'   => '',
            '&'   => '',
            '\*'   => '',
            '='   => '',
            '>'   => '',
            '<'   => '',
            '|'   => '',
            '{'   => '',
            '}'   => '',
            '~'   => '',
            '\+'   => '',
            '\['   => '',
            '\]'   => '',
        ];

        // Enforce the maximum component length
        $maxlength = 100;
        $text      = implode(array_slice(explode('<br>', wordwrap(trim(strip_tags(html_entity_decode($text))), $maxlength, '<br>', false)), 0, 1));
        //$text = substr(, 0, $maxlength);

        foreach ($matrix as $from => $to) {
            $text = mb_eregi_replace($from, $to, $text);
        }

        // Optionally convert to lower case.
        if ($toLowCase) {
            $text = strtolower($text);
        }

        return $text;
    }
}