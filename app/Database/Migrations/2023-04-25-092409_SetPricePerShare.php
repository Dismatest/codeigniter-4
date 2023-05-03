<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetPricePerShare extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'price_per_share_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'sacco_id'   => ['type' => 'int', 'constraint' => 11],
            'price_per_share'        => ['type' => 'int', 'constraint' => 10],
        ]);

        $this->forge->addPrimaryKey('price_per_share_id');
        $this->forge->addForeignKey('sacco_id', 'sacco', 'sacco_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('set_price_per_share', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('set_price_per_share');
        $this->db->enableForeignKeyChecks();
    }
}
