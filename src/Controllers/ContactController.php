<?php

namespace App\Controllers;

class ContactController
{

    public function execute(): void
    {
        require_once __DIR__ . '/../../views/contact.phtml';
    }

    public function exec($params)
    {
        var_dump($params);
    }
    
}