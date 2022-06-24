<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerController
{
    public function loginDisplay()
    {

        require_once __DIR__ . '/../../views/login.phtml';

    }

    public function login()
    {   
        if (isset($_POST['login'])) {

            $customer = new Customer();

            $name = $_POST['name'];

            $password = $_POST['password'];
            
            $sql  = "SELECT * FROM `customers` where `name` ='{$name}' and `password` = '{$password}' ";

            $stmt = $customer->conn->query($sql);

            $user = $stmt->fetch();

            if(!$user){
                
                header("location: login");

            }
                    
            session_start();

            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;

            header("location: customer");

            exit();

        }

    }

}

?>