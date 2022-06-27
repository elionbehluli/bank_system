<?php

namespace App\Controllers;

use PDOException;
use system\Model;
use App\Models\Transacions;

session_start();

class TransactionController
{

    public function transaction()
    {

        $model = new Model();

        $conn = $model->databaseConnection;

        if($_REQUEST['transact'])
        {

            $acc = $_POST['acc'];
            $accToTransfer = $_POST['account_id'];
            $balanceDifference = $_POST['amount_of_money'];
            $balancOfTransaction = $balanceDifference/100;
            $date = date('Y-m-d');


            $balance =$conn->query("SELECT `balance` FROM accounts WHERE `accounts`.`id` = '$acc'");

            $bal = $balance->fetch();

          
            if(!$bal) die("you don't have enough credits for this transation");

            $options = array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => $bal['balance'],
                )
            );

            if(!filter_var($balanceDifference, FILTER_VALIDATE_INT, $options) == TRUE) {
                die("you don't have enough credits for this transation");
            }

            try{

                $conn->beginTransaction();
            
                $conn->query("UPDATE `accounts` SET `accounts`.`balance` = `accounts`.`balance` - '$balanceDifference' WHERE `accounts`.`id` = '$acc'");
    
                $conn->query("UPDATE `accounts` SET `accounts`.`balance` = `accounts`.`balance` + '$balanceDifference' WHERE `accounts`.`id` = '$accToTransfer'");

                $conn->query("INSERT INTO `atm_transactions` (date, balance, account_id) VALUES ('$date', '$balanceDifference', '$acc')");

                $conn->commit();

                header("location: customer");
        
            }
            catch(\PDOException $e)
            {
                $conn->rollBack();
                die($e->getMessage());
            }

        }

    }

}