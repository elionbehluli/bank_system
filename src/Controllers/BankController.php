<?php

namespace App\Controllers;

use App\Models\Banks;

class BankController
{


    public function  index()
    {
        
        $bank = new Banks();

        $bank->read();

    }

    public function create()
    {

    }

    public function store()
    {

        $bank = new Banks();

        $code = $_POST['code'];
        $address = $_POST['address'];
        $name = $_POST['name'];

        $bank->create($code, $address, $name);

        header('Location: /bank');
        
    }

    public function logout() {

        session_start();
        session_unset();
        session_destroy();
        header("location: login");

    }

}