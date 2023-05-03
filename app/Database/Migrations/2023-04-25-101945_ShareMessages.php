<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ShareMessages extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'share_message'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'user_id'                 => ['type' => 'int', 'constraint' => 11],
            'share_id'                => ['type' => 'varchar', 'constraint' => 32],
            'sacco_id'                => ['type' => 'int', 'constraint' => 11],
            'reason'                  => ['type' => 'varchar', 'constraint' => 255],
            'created_at'              => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('share_message');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('share_id', 'shares_on_sale', 'uuid', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sacco_id', 'sacco', 'sacco_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('share_messages', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('share_messages');
        $this->db->enableForeignKeyChecks();
    }
}
