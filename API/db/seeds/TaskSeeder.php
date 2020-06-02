<?php


use Phinx\Seed\AbstractSeed;

class TaskSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
        public function run(){
        $data = [
            [
                'id'=>'1',
                'user_id'=>'1',
                'task'=>'Teste de Rafael',
                'description'=>'testar scripts',
                'done'=>'1',
            ],
            [
                'id'=>'2',
                'user_id'=>'1',
                'task'=>'Teste dois',
                'description'=>'Testar codigos',
                'done'=>'1',
            ],
            [
                'id'=>'3',
                'user_id'=>'2',
                'task'=>'Teste de Fulano',
                'description'=>'testar ',
                'done'=>'1',
            ],
            [
                'id'=>'4',
                'user_id'=>'2',
                'task'=>'testar',
                'description'=>'teste',
                'done'=>'2',
            ],

        ];
        $table = $this->table('tasks');
        $table->insert($data)->save();
    }
}
