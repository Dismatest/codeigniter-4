<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetSaccoCommission extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'sacco_commission_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'sacco_id'   => ['type' => 'int', 'constraint' => 11],
            'sacco_commission'        => ['type' => 'decimal', 'constraint' => '10,2'],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('sacco_commission_id');
        $this->forge->addForeignKey('sacco_id', 'sacco', 'sacco_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('set_sacco_commission', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('set_sacco_commission');
        $this->db->enableForeignKeyChecks();
    }
}
