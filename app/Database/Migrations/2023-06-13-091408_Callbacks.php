<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Callbacks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'callback_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'callback_uuid'   => ['type' => 'varchar', 'constraint' =>255],
            'amount'             => ['type' => 'decimal', 'constraint' => '10,2', 'null' => true],
            'mpesaReceiptNumber'             => ['type' => 'varchar', 'constraint' => 255],
            'transactionDate'             => ['type' => 'datetime', 'default' => null],
            'phoneNumber'          => ['type' => 'int', 'constraint' => 12, 'null' => true],
            'merchantRequestID' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'checkoutRequestID'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'    => ['type' => 'int', 'default' => 0, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);
        $this->forge->addPrimaryKey('callback_id');
        $this->forge->createTable('callbacks', true);
    }

    public function down()
    {
        $this->forge->dropTable('callbacks');
    }
}
