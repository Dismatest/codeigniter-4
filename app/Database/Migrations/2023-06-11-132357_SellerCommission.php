<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SellerCommission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'commission_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'seller_commission'   => ['type' => 'int', 'constraint' =>10],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('commission_id');
        $this->forge->createTable('seller_commission', true);
    }

    public function down()
    {
        $this->forge->dropTable('seller_commission');
    }
}
