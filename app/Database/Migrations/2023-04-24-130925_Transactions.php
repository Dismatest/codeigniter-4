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
            'user_id'   => ['type' => 'varchar', 'constraint' =>255],
            'share_id'             => ['type' => 'varchar', 'constraint' => 32],
            'amount'             => ['type' => 'decimal', 'constraint' => '10,2', 'null' => true],
            'mpesaReceiptNumber'             => ['type' => 'varchar', 'constraint' => 255],
            'transactionDate'             => ['type' => 'datetime', 'default' => null],
            'phoneNumber'          => ['type' => 'int', 'constraint' => 12, 'null' => true],
            'merchantRequestID' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'checkoutRequestID'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'    => ['type' => 'int', 'default' => 0, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('transaction_id');
        $this->forge->addForeignKey('user_id', 'users', 'uniid', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('share_id', 'shares_on_sale', 'uuid', 'CASCADE', 'CASCADE');
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
