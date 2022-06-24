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

            try{

                $conn->beginTransaction();
                
                $acc = "682463772";
                $accToTransfer = $_POST['account_id'];
                $balanceDifference = $_POST['amount_of_money'];
                $balancOfTransaction = $balanceDifference/100;
                $date = date('Y-m-d');
                
                $conn->query("UPDATE `accounts` SET `accounts`.`balance` = `accounts`.`balance` - '$balanceDifference' WHERE `accounts`.`id` = '$acc'");
        
                $conn->query("UPDATE `accounts` SET `accounts`.`balance` = `accounts`.`balance` + '$balanceDifference' WHERE `accounts`.`id` = '$accToTransfer'");

                $conn->query("INSERT INTO `atm_transactions` (date, balance, account_id) VALUES ('$date', '$balancOfTransaction', '$acc')");

                $conn->commit();
        
            }
            catch(\PDOException $e)
            {
                $conn->rollBack();
                die($e->getMessage());
            }

        }

        

    }

}