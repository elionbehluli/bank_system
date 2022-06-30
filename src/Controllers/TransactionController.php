<?php

namespace App\Controllers;
    

use PDOException;
use system\Model;
use App\Models\Transacions;
use system\SmtpClass;

require __DIR__ . '/../../helper/general_helper.php';



session_start();

class TransactionController
{

    public function transaction()
    {

        $model = new Model();

        $conn = $model->databaseConnection;

        $smtp = new SmtpClass();

        $mail = $smtp->mailConn;
        
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

            $accToSendEmail = $conn->query("SELECT `customer_id` FROM accounts WHERE `accounts`.`id` = '$accToTransfer'")->fetch();

            $emailToSend = $conn->query("SELECT `cs`.`email` FROM customers cs WHERE cs.`id` = '$accToSendEmail[0]'")->fetch();

            // var_dump($emailToSend[0]);
            // die;
            
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

                $conn->query("INSERT INTO `atm_transactions` (balance, from_account_id, to_account_id, `date`) VALUES ('$balanceDifference', '$acc', '$accToTransfer', '$date')");
                
                $mail->isHTML(true);
                
                $mail->setFrom("elion.behluli@spinpagency.com", "elion-behluli");

                $mail->addAddress($emailToSend[0]);

                $mail->Subject = "Transaction";

                $mail->msgHTML($balanceDifference . "cent are transacted from " . $acc . "to your account " . $accToTransfer);

                if(!$mail->send()) {
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                    echo 'email not send ' . $mail->ErrorInfo;

                }
                else{

                    echo "email sent successfuly";

                }

                $conn->commit();

                appLogger('Transaction from ' . $acc . ' to ' . $accToTransfer . ' sending ' . $balanceDifference . ' cent completed succesfuly', 'transactions/');

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