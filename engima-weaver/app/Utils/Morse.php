<?php

namespace App\Utils;

use Exception;

class Morse
{
    /**
     * Exception message for invalid characters in text-to-Morse conversion.
     */
    const TEXT_TO_MORSE_EXCEPTION = "Request contains invalid characters, allowed characters : A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9 . , ? !  ";
    /**
     * Exception message for invalid characters in Morse-to-text conversion.
     */
    const MORSE_TO_TEXT_EXCEPTION = "Request contains invalid characters, allowed characters : . - ";
    /**
     * Morse code mapping for characters.
     */
    const CODE_BOOK = [
        'A' => '.-',   'B' => '-...', 'C' => '-.-.', 'D' => '-..', 'E' => '.',
        'F' => '..-.', 'G' => '--.',  'H' => '....', 'I' => '..',  'J' => '.---',
        'K' => '-.-',  'L' => '.-..', 'M' => '--',   'N' => '-.',  'O' => '---',
        'P' => '.--.', 'Q' => '--.-', 'R' => '.-.',  'S' => '...', 'T' => '-',
        'U' => '..-',  'V' => '...-', 'W' => '.--',  'X' => '-..-', 'Y' => '-.--',
        'Z' => '--..', '0' => '-----', '1' => '.----', '2' => '..---', '3' => '...--',
        '4' => '....-', '5' => '.....', '6' => '-....', '7' => '--...', '8' => '---..',
        '9' => '----.', '.' => '.-.-.-', ',' => '--..--', '?' => '..--..', '!' => '-.-.--', " " => " "
    ];
    /**
     * Convert text to Morse code.
     *
     * @param string $text The input text to be converted.
     *
     * @return string The Morse code representation of the input text.
     * 
     * @throws Exception If the input contains characters not in CODE_BOOK.
     */
    public static function textToMorse(string $text): string
    {
        $text = strtoupper($text);
        $result = '';
        $invalidChars = preg_replace('/[' . preg_quote(implode('', array_keys(self::CODE_BOOK)), '/') . ']/', '', $text);

        if (!empty($invalidChars)) {
            throw new Exception(self::TEXT_TO_MORSE_EXCEPTION);
        }
        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];

            if (isset(self::CODE_BOOK[$char])) {
                $result .= self::CODE_BOOK[$char] . ' ';
            } else {
                $result .= ' ';
            }
        }

        return trim($result);
    }
    /**
     * Convert Morse code to text.
     *
     * @param string $morse The Morse code to be converted.
     *
     * @return string The text representation of the input Morse code.
     * 
     * @throws Exception If the input contains invalid Morse code.
     */
    public static function morseToText(string $morse): string
    {

        $morseParts = explode(' ', $morse);
        $text = '';
        $allowedPattern = '/^[.\- ]+$/';

        if (!preg_match($allowedPattern, $morse)) {
            throw new Exception(SELF::MORSE_TO_TEXT_EXCEPTION);
        }
        foreach ($morseParts as $morsePart) {
            foreach (self::CODE_BOOK as $character => $morseSymbol) {
                if ($morsePart === $morseSymbol) {
                    $text .= $character;
                    break;
                }
            }
        }
        return $text;
    }
}
