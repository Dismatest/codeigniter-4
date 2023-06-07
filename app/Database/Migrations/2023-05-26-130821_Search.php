<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Search extends Migration
{
    public function up()
    {
      $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'search_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'user_id'   => ['type' => 'int', 'constraint' => 11],
            'sacco_name'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'total'       => ['type' => 'decimal', 'constraint' => '10,2', 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('search_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('search', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('search');
        $this->db->enableForeignKeyChecks();
    }
}
