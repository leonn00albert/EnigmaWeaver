<?php

namespace App\Controllers;

use App\Utils\Morse;
use Exception;

class MorseController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function textToMorse()
    {
        try {
            $json = $this->request->getJSON();
            $data = [
                "code" => Morse::textToMorse($json->text),
                "original_text" => $json->text,
            ];
            return $this->response->setJSON($data);
        } catch (Exception $e) {
            return $this->response->setJSON(["error" => $e->getMessage()]);
        }
    }
    public function morseTotext()
    {
        try {
            $json = $this->request->getJSON();
            $data = [
                "text" => Morse::morseToText($json->code),
                "original_code" => $json->code,
            ];
            return $this->response->setJSON($data);
        } catch (Exception $e) {
            return $this->response->setJSON(["error" => $e->getMessage()]);
           
        }
    }

    public function morseDictionary()
    {
        try {
            $json = $this->request->getJSON();
            $data = [
                "code" => Morse::morseDictionary($json->character),
                "original_character" => $json->character,
            ];
            return $this->response->setJSON($data);
        } catch (Exception $e) {
            return $this->response->setJSON(["error" => $e->getMessage()]);
           
        }
    }
    public function getCodeBook()
    {
        $data = [
            "code_book" => Morse::CODE_BOOK
        ];
        return $this->response->setJSON($data);
    }
}
