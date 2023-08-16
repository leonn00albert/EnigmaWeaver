<?php

namespace Tests\Controllers;

use App\Utils\Morse;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;

/**
 * @internal
 */
final class MorseControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    public function testTextToMorse()
    {
        $body = json_encode(['text' => 'hello']);
        $result = $this->withBody($body)
            ->controller(\App\Controllers\MorseController::class)
            ->execute('textToMorse');
        $this->assertTrue($result->getJSON() !== false, "Response is not of type: JSON");
        $result->assertJSONExact(["code" => ".... . .-.. .-.. ---", "original_text" => "hello"]);
    }
    public function testMorseToText()
    {
        $body = json_encode(['code' => '.... . .-.. .-.. ---']);
        $result = $this->withBody($body)
            ->controller(\App\Controllers\MorseController::class)
            ->execute('morseToText');
        $this->assertTrue($result->getJSON() !== false, "Response is not of type: JSON");
        $result->assertJSONExact(["text" => "HELLO", "original_code" => ".... . .-.. .-.. ---"]);
    }
    public function testGetCodeBook()
    {
        $result = $this->controller(\App\Controllers\MorseController::class)
            ->execute('getCodeBook');
        $this->assertTrue($result->getJSON() !== false, "Response is not of type: JSON");
        $result->assertJSONExact(["code_book" => Morse::CODE_BOOK]);
    }
}
