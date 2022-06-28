<?php

namespace App\Controllers;

use system\Model;

require __DIR__ . '/../../helper/general_helper.php';

session_start();

class AccountController
{

    public function index()
    {
        require_once __DIR__ . '/../../views/customerProfile.phtml';
    }

    public function store()
    {
        
        if(isset($_POST['submit'])) {
            
            $id = rand(100000000,999999999);
            $balance = '0';
            $account_type = $_POST['account_type'];
            $description = $_POST['description'];
            $customer_id = $_SESSION['id'];
            
            $model = new Model();

            $account_types = ["debit", "credit", "master", "visa"];

            if (!in_array($account_type, $account_types)) {
                appLogger('Typed incorrect type of account', 'accounts/accounts.log');
                die;
            } 

            if (!is_string($description)) {
                die;
            }
        
            $conn = $model->databaseConnection;
        
            $insert = $conn->prepare("INSERT INTO `accounts` (id, balance, account_type, description, customer_id)
                        VALUES ('$id', '$balance', '$account_type', '$description', '$customer_id')");
        
            $insert->execute();
        
            header("location: customer");
        }

    }

}