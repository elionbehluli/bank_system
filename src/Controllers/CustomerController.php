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

            $email = $_POST['email'];

            $password = $_POST['password'];

            $user = "SELECT * FROM customers where `email` = :email";

            $stmt = $customer->conn->prepare($user);

            $stmt->bindValue(':email', $email);

            $stmt->execute();

            $result = $stmt->fetch();

            if(!$stmt) {

                echo "User does not exists in database!";
                die();
                
            } else {

                if(!password_verify($password, $result['password'])) {

                    echo "Email or password incorrect!";
                    die();

                } else {
                    
                    session_start();

                    $_SESSION['id'] = $result['id'];
                    $_SESSION['email'] = $result['email'];

                    header("location: customer");

                    exit();

                }

            }       
            
        }

    }

}

?>