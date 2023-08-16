<?php

namespace Tests\Controllers;

use App\Utils\Morse;
use CodeIgniter\Test\CIUnitTestCase;
use Exception;

/**
 * @internal
 */
final class MorseTest extends CIUnitTestCase
{
    public function testTextToMorse()
    {
        $result = Morse::textToMorse("hello");
        $this->assertEquals(".... . .-.. .-.. ---", $result);
    }
    public function testTextToMorseException()
    {
        $this->expectException(Exception::class);
        Morse::textToMorse("ABC%");
    }

    public function testMorseToText()
    {
        $result = Morse::morseToText(".... . .-.. .-.. ---");
        $this->assertEquals("HELLO", $result);
    }
    public function testMorseToTextException()
    {
        $this->expectException(Exception::class);
        Morse::morseToText(".A.. B");
    }
    public function testCodeBookContainsCorrectMorseMappings()
    {
        $code_book_test = [
            'A' => '.-',   'B' => '-...', 'C' => '-.-.', 'D' => '-..', 'E' => '.',
            'F' => '..-.', 'G' => '--.',  'H' => '....', 'I' => '..',  'J' => '.---',
            'K' => '-.-',  'L' => '.-..', 'M' => '--',   'N' => '-.',  'O' => '---',
            'P' => '.--.', 'Q' => '--.-', 'R' => '.-.',  'S' => '...', 'T' => '-',
            'U' => '..-',  'V' => '...-', 'W' => '.--',  'X' => '-..-', 'Y' => '-.--',
            'Z' => '--..', '0' => '-----', '1' => '.----', '2' => '..---', '3' => '...--',
            '4' => '....-', '5' => '.....', '6' => '-....', '7' => '--...', '8' => '---..',
            '9' => '----.', '.' => '.-.-.-', ',' => '--..--', '?' => '..--..', '!' => '-.-.--',  " " => " "
        ];
        foreach (Morse::CODE_BOOK as $character => $morse) {
            $this->assertTrue(
                array_key_exists($character, $code_book_test),
                "Character '$character' is missing from CODE_BOOK."
            );

            $this->assertEquals(
                $code_book_test[$character],
                $morse,
                "Character '$character' has incorrect Morse mapping."
            );
        }
    }
}
