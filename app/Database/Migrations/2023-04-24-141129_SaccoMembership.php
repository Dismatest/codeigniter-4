<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SaccoMembership extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'membership_id'        => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'user_id'                    => ['type' => 'int', 'constraint' => 11],
            'sacco_id'                 => ['type' => 'int', 'constraint' => 11],
            'id_number'                => ['type' => 'int', 'constraint' => 10],
            'status'                   => ['type' => 'int', 'constraint' => 1, 'default' => 0],
            'created_at'              => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
            'updated_at'              => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('membership_id');


        // Add foreign key constraints
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sacco_id', 'sacco', 'sacco_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('sacco_membership', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->dropTable('sacco_membership');
        $this->db->enableForeignKeyChecks();
    }
}
