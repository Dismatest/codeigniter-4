<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
    public function up()

    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'transaction_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'bid_id'   => ['type' => 'int', 'constraint' =>11],
            'transaction_uuid'   => ['type' => 'varchar', 'constraint' =>255],
            'merchantRequestID' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'checkoutRequestID'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('transaction_id');
        $this->forge->addForeignKey('bid_id', 'bid_share', 'bid_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('transactions');
        $this->db->enableForeignKeyChecks();

    }
}
