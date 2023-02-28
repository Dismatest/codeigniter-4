<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'fname'             => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'lname'             => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'phone'             => ['type' => 'varchar', 'constraint' => 13],
            'email'             => ['type' => 'varchar', 'constraint' => 255],
            'password'          => ['type' => 'varchar', 'constraint' => 255],
            'activation_link'   => ['type' => 'varchar', 'constraint' =>255],
            'activation_status' => ['type' => 'int', 'default' =>0],
            'remember_token'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('user_id');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
