<?php

namespace App\Models;
use system\Model;

class Transactions extends Model
{

    protected $id;
    protected $date;
    protected $type;
    protected $amount;
    protected $balance;

    public $conn;

    public function __construct() {
        parent :: __construct();
        $this->conn = $this->databaseConnection;
    }

    //get methods
    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getType() {
        return $this->type;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getBalance() {
        return $this->balance;
    }

    //set methods
    public function setId(string $id) {
        return $this->id = $id;
    }

    public function setDate(string $date) {
        return $this->date = $date;
    }

    public function setType(string $type) {
        return $this->type = $type;
    }

    public function setAmount(string $amount) {
        return $this->amount = $amount;
    }

    public function setBalance(string $balance) {
        return $this->balance = $balance;
    }

}