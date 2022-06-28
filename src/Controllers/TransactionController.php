<?php

namespace App\Controllers;


use PDOException;
use system\Model;
use App\Models\Transacions;

require __DIR__ . '/../../helper/general_helper.php';

session_start();

class TransactionController
{

    public function transaction()
    {

        $model = new Model();

        $conn = $model->databaseConnection;
        
        if(isset($_REQUEST['transact']))
        {

            $acc = $_POST['acc'];
            $accToTransfer = $_POST['account_id'];
            $balanceDifference = $_POST['amount_of_money'];
            $date = date('Y-m-d');

            $balance =$conn->query("SELECT `balance` FROM accounts WHERE `accounts`.`id` = '$acc'");

            $bal = $balance->fetch();

            $accDb = $conn->query("SELECT `id` FROM accounts WHERE `accounts`.`id` = '$acc'")->fetch();

            $accToTransferDb = $conn->query("SELECT `id` FROM accounts WHERE `accounts`.`id` = '$accToTransfer'")->fetch();
            
            if(!$accDb) {
                appLogger('Transaction from ' . $acc . ' failed because ' . $acc . ' doestn exists!', 'transactions/transactions.log');
                die();
            }

            if(!$accToTransferDb) {
                appLogger('Transaction to ' . $accToTransfer . ' failed because ' . $accToTransfer . ' doesnt exist!', 'transactions/transactions.log');
                die();
            }

            if(!$bal) {
                appLogger('', 'transactions/transactions.log');
                die();
            }

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

                $conn->query("INSERT INTO `atm_transactions` (date, balance, from_account_id, to_account_id) VALUES ('$date', '$balanceDifference', '$acc', '$accToTransfer')");

                $conn->commit();

                appLogger('Transaction from ' . $acc . ' to ' . $accToTransfer . ' sending ' . $balanceDifference . ' cent completed succesfuly', 'transactions/transactions.log');

                header("location: customer");
        
            }
            catch(\PDOException $e)
            {
                $conn->rollBack();

                appLogger('Transaction from ' . $acc . ' to ' . $accToTransfer . ' sending ' . $balanceDifference . ' cent failed!', 'transactions/transactions.log');

                die($e->getMessage());
            }

        }

    }

}