<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Shares extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'share_on_sale_id'        => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'uuid'                    => ['type' => 'varchar', 'constraint' => 32],
            'user_id'                 => ['type' => 'int', 'constraint' => 11],
            'sacco_id'                => ['type' => 'int', 'constraint' => 11],
            'membership_number'       => ['type' => 'varchar', 'constraint' => 10],
            'shares_on_sale'          => ['type' => 'int', 'constraint' => 255],
            'total'                   => ['type' => 'decimal', 'constraint' => '10,2'],
            'is_verified'             => ['type' => 'int', 'constraint' => 1, 'default' => 0],
            'created_at'              => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('share_on_sale_id');
        $this->forge->addKey('uuid');

        // Add foreign key constraints
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sacco_id', 'sacco', 'sacco_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('shares_on_sale', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropKey('shares_on_sale', 'uuid');
        $this->forge->dropTable('shares_on_sale');
        $this->db->enableForeignKeyChecks();
    }
}
