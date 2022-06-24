<?php

namespace App\Models;
use system\Model;
use PDOException;

class Banks extends Model
{

    protected $id;
    protected $code;
    protected $address;
    protected $name;

    //get methods
    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getName()
    {
        return $this->name;
    }

    //set  methods
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function create($code, $address, $name) {

        try {

            $stmt = $this->databaseConnection->prepare("INSERT INTO `banks` (`code`, `address`, `name`) 
            VALUES ('$code', '$address' , '$name')");

            $stmt->execute();            
            
        }
        catch (PDOException $ex) {

            return $ex->getMessage();

        }

    }
    
    public function read() {

        require_once __DIR__ . '/../../views/bank.phtml';

    }

    public function delete() {



    }

}

?>