<?php

/**
 * @package    Joomla.Language
 *
 * @copyright  (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @phpcs:disable Squiz.Classes.ValidClassName.NotCamelCaps
 *
 * @phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 */

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects
use \Joomla\String\StringHelper;

/**
 * bg_BG localise class.
 *
 * @since  1.6
 */
abstract class Bg_BGLocalise
{
    /**
     * Returns the potential suffixes for a specific number of items
     *
     * @param   integer  $count  The number of items.
     *
     * @return  array  An array of potential suffixes.
     *
     * @since   1.6
     */
    public static function getPluralSuffixes($count)
    {
        switch ($count) {
            case 0:
                return ['0'];

            case 1:
                return ['ONE', '1'];
        }

        return ['OTHER', 'MORE'];
    }
	/*
    * Correct transliteration according to the transliteration law in Bulgaria.
    * https://www.mrrb.bg/bg/zakon-za-transliteraciyata/
    */
	public static function transliterate($string)
	{
    $str = StringHelper::strtolower($string);

    $glyph_array = [
        'bulgaria' => 'България, българия',
        'a' => 'а,А',                        
        'b' => 'б,Б',
        'v' => 'в,В',
        'g' => 'г,Г',
        'd' => 'д,Д',
        'e' => 'е,Е',
        'zh' => 'ж,Ж',
        'z' => 'з,З',
        'k' => 'к,К',
        'l' => 'л,Л',
        'm' => 'м,М',
        'n' => 'н,Н',
        'o' => 'о,О',
        'p' => 'п,П',
        'r' => 'р,Р',
        's' => 'с,С',
        't' => 'т,Т',
        'u' => 'у,У',
        'f' => 'φ,ф',
        'h' => 'х,Х',
        'ts' => 'ц,Ц',
        'ch' => 'ч,Ч',
        'sh' => 'ш,Ш',
        'sht' => 'щ,Щ',
		'a'	=>	'ъ,Ъ',
		'y'	=>	'ь,Ь',
        'yu' => 'ю,Ю',
        'dzh' => 'дж,ДЖ',
        'dz' => 'дз,ДЗ',
        'yo' => 'ьо,йо,ЬО,ЙО',
		''	=>	'№',
		'-'	=>	'_',

    ];

    foreach ($glyph_array as $letter => $glyphs)
    {
        $glyphs = explode(',', $glyphs);
        $str = StringHelper::str_ireplace($glyphs, $letter, $str);
    }

    $str = preg_replace('/ия\b/iu', 'ia', $str);

    $str = preg_replace('/и(?!я\b)/iu', 'i', $str); 
    $str = str_ireplace('й', 'y', $str); 
    $str = str_ireplace('я', 'ya', $str);

    $str = preg_replace('#\&\#?[a-z0-9]+\;#ismu', '', $str);

    return $str;
	}
}
