<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AtmTransactions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {

        $table = $this->table('atm_transactions');

        $table->addColumn('from_account_id', 'integer', ['null' => true, "signed" => false])
                ->addColumn('to_account_id', 'integer', ['null' => true, "signed" => false])
                ->addColumn('balance', 'biginteger')
                ->addColumn('type', 'string')
                ->addColumn('date', 'datetime')
                ->addForeignKey('from_account_id', 'accounts', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
                ->addForeignKey('to_account_id', 'accounts', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
                ->create();

    }
}
