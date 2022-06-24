<?php

namespace App\Controllers;

use system\Model;

session_start();

class AccountController
{

    public function index()
    {
        require_once __DIR__ . '/../../views/customerProfile.phtml';
    }

    public function store()
    {
        
        if($_POST['submit']) {
            
            $id = rand(100000000,999999999);
            $balance = '0';
            $account_type = $_POST['account_type'];
            $description = $_POST['description'];
            $customer_id = $_SESSION['id'];
            
            $model = new Model();
        
            $conn = $model->databaseConnection;
        
            $insert = $conn->prepare("INSERT INTO `accounts` (id, balance, account_type, description, customer_id)
                        VALUES ('$id', '$balance', '$account_type', '$description', '$customer_id')");
        
            $insert->execute();
        
            header("location: customer");
        }

    }

}