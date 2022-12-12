<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Atms extends AbstractMigration
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

        $table = $this->table('atms');

        $table->addColumn('atm_location', 'string')
                ->addColumn('managed_by', 'string')
                ->addColumn('bank_id', 'integer', ['null' => true, "signed" => false])
                ->addColumn('created_at', 'datetime')
                ->addForeignKey('bank_id', 'banks', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
                ->create();

    }
}
