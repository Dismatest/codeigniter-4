<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTable extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'user_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'uniid'   => ['type' => 'varchar', 'constraint' =>255],
            'fname'             => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'lname'             => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'phone'             => ['type' => 'varchar', 'constraint' => 13],
            'email'             => ['type' => 'varchar', 'constraint' => 255],
            'password'          => ['type' => 'varchar', 'constraint' => 255],
            'activation_status' => ['type' => 'int', 'default' =>0],
            'activation_date'        => ['type' => 'datetime'],
            'profile'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'updated_at'        => ['type' => 'datetime'],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('user_id');
        $this->forge->addKey('uniid');
        $this->forge->createTable('users', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropKey('users', 'uniid');
        $this->forge->dropTable('users');
        $this->db->enableForeignKeyChecks();
    }
}
