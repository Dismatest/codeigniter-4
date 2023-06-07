<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BidShare extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'bid_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'sacco_id'   => ['type' => 'int', 'constraint' => 11],
            'buyer_id'   => ['type' => 'varchar', 'constraint' => 32],
            'seller_id'   => ['type' => 'int', 'constraint' => 11],
            'share_on_sale_id'   => ['type' => 'varchar', 'constraint' => 32],
            'bid_amount'        => ['type' => 'decimal', 'constraint' => '10,2'],
            'buyer_membership_number'        => ['type' => 'varchar', 'constraint' => 100],
            'action'        => ['type' => 'int', 'constraint' => 10, 'default' => 0],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('bid_id');
        $this->forge->addForeignKey('sacco_id', 'sacco', 'sacco_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('seller_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('share_on_sale_id', 'shares_on_sale', 'uuid', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bid_share', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('bid_share');
        $this->db->enableForeignKeyChecks();
    }
}
