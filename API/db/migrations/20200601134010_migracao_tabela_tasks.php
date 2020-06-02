<?php

use Phinx\Migration\AbstractMigration;

class MigracaoTabelaTasks extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(){
        $table = $this->table('tasks');
        $table
            ->addColumn('user_id', 'integer',['limit'=>10])
            ->addColumn('task', 'string',['limit'=>250])
            ->addColumn('description', 'string',['limit'=>1000])
            ->addColumn('done', 'integer',['limit'=>1]);
        $table->create();
    }
}
