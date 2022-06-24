<?php

namespace App\Models;
use system\Model;


class Account extends Model
{

    protected $id;
    protected $balance;
    protected $account_type;
    protected $description;

    public $conn;

    public function __construct() {
        parent :: __construct();
        $this->conn = $this->databaseConnection;
    }

    //get methods

    public function getId() {
        return $this->id;
    }

    public function getBalance() {
        return $this->balance;
    }

    
    public function getAccountType() {
        return $this->account_type;
    }
    
    public function getDescription() {
        return $this->description;
    }

    //set methods

    public function setId(string $id) {
        $this->id = $id;
    }

    public function setBalance(string $balance) {
        $this->balance = $balance;
    }

    
    public function setAccountType(string $account_type) {
        $this->balance = $account_type;
    }
    
    public function setDescription(string $description) {
        $this->description = $description;
    }

}