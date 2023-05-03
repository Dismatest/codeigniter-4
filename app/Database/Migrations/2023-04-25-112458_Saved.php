<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Saved extends Migration
{
    public function up()

    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'saved_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'share_id'   => ['type' => 'varchar', 'constraint' => 32],
            'user_id'   => ['type' => 'varchar', 'constraint' => 32],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('saved_id');
        $this->forge->addForeignKey('share_id', 'shares_on_sale', 'uuid', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'uniid', 'CASCADE', 'CASCADE');
        $this->forge->createTable('saved', true);
        $this->db->enableForeignKeyChecks();

    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('saved');
        $this->db->enableForeignKeyChecks();
    }
}
