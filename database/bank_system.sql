CREATE TABLE banks (
    `id` INT NOT NULL AUTO_INCREMENT,
    `code` INT,
    `address` VARCHAR(30),
    `name` varchar(20),
    PRIMARY KEY (`id`)
);

CREATE TABLE branch_cities (
    `id` INT NOT NULL AUTO_INCREMENT,
    `city` VARCHAR(60),
    PRIMARY KEY (`id`)
);

CREATE TABLE branches (
    `id` INT AUTO_INCREMENT,
    `address` VARCHAR(250),
    `city_id` INT,
    `bank_id` INT,
    PRIMARY KEY (`id`),

    CONSTRAINT FK_BankId FOREIGN KEY (`bank_id`) REFERENCES banks(`id`),
    CONSTRAINT FK_CityId FOREIGN KEY (`city_id`) REFERENCES branch_cities(`id`)
);

CREATE TABLE customers (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` varchar(20),
    `email` varchar(50),
    `phone_number` varchar(250),
    `address` varchar(250),
    `card` INT,
    `password` VARCHAR(255),
    `branch_id` INT,
    PRIMARY KEY (`id`),

    CONSTRAINT FK_BranchId FOREIGN KEY (`branch_id`) REFERENCES branches(`id`)
);

CREATE TABLE atms (
    `id` INT NOT NULL AUTO_INCREMENT,
    `atm_location` VARCHAR(30),
    `managed_by` VARCHAR(30),
    `bank_id` INT,
    PRIMARY KEY (`id`),

    CONSTRAINT FK_AtmBankId FOREIGN KEY (`bank_id`) REFERENCES banks(`id`)  
);

CREATE TABLE accounts (
    `id` INT NOT NULL AUTO_INCREMENT,
    `balance` BIGINT(100),
    `account_type` VARCHAR(20),
    `description` VARCHAR(90),
    `bank_id` INT,
    `customer_id` INT,
    PRIMARY KEY (`id`),

    CONSTRAINT FK_AccountBankId FOREIGN KEY (`bank_id`) REFERENCES banks(`id`),
    CONSTRAINT FK_AccountCustomerId FOREIGN KEY (`customer_id`) REFERENCES customers(`id`)
);

CREATE TABLE atm_transactions (
    `id` INT NOT NULL AUTO_INCREMENT,
    `from_account_id` INT,
    `to_account_id` INT,
    `balance` BIGINT(100),    
    `type` VARCHAR(20),
    PRIMARY KEY (`id`),
    `date` DATE,

    CONSTRAINT FK_FromTransactionAccountId FOREIGN KEY (`from_account_id`) REFERENCES accounts(`id`),
    CONSTRAINT FK_ToTransactionAccountId FOREIGN KEY (`to_account_id`) REFERENCES accounts(`id`)
);