<?php
namespace App\Utils;

class Morse {
    const CODE_BOOK = [
        'A' => '.-',   'B' => '-...', 'C' => '-.-.', 'D' => '-..', 'E' => '.',
        'F' => '..-.', 'G' => '--.',  'H' => '....', 'I' => '..',  'J' => '.---',
        'K' => '-.-',  'L' => '.-..', 'M' => '--',   'N' => '-.',  'O' => '---',
        'P' => '.--.', 'Q' => '--.-', 'R' => '.-.',  'S' => '...', 'T' => '-',
        'U' => '..-',  'V' => '...-', 'W' => '.--',  'X' => '-..-', 'Y' => '-.--',
        'Z' => '--..', '0' => '-----', '1' => '.----', '2' => '..---', '3' => '...--',
        '4' => '....-', '5' => '.....', '6' => '-....', '7' => '--...', '8' => '---..',
        '9' => '----.', '.' => '.-.-.-', ',' => '--..--', '?' => '..--..', '!' => '-.-.--'
    ];

    public static function textToMorse(string $text){
        $text = strtoupper($text);
        $result = '';
        
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

    public static function morseToText(string $morse){
        
    $morseParts = explode(' ', $morse); // Split Morse code by spaces
    $text = '';
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