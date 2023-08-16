<?php

namespace App\Controllers;
use App\Utils\Morse;

class MorseController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function textToMorse(){
        $json = $this->request->getJSON();
        $data = [
            "code" => Morse::textToMorse($json->text),
            "original_text" => $json->text,
        ];
        return $this->response->setJSON($data);
    }
    public function morseTotext(){
        $json = $this->request->getJSON();
        $data = [
            "text" => Morse::morseToText($json->code),
            "original_code" => $json->code,
        ];
        return $this->response->setJSON($data);
    }
    public function getCodeBook(){
        $data = [
            "code_book" => Morse::CODE_BOOK
        ];
        return $this->response->setJSON($data);
    }
}
