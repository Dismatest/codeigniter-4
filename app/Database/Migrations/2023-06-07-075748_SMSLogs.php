<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SMSLogs extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'sms_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'uuid'             => ['type' => 'varchar', 'constraint' =>255],
            'fname'            => ['type' => 'varchar', 'constraint' => 255],
            'phone'            => ['type' => 'varchar', 'constraint' => 255],
            'message_title'        => ['type' => 'varchar', 'constraint' => 255],
            'role'             => ['type' => 'varchar', 'constraint' => 255],
            'status'           => ['type' => 'int', 'constraint' => 11],
            'created_at'       => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('sms_id');
        $this->forge->addKey('uuid');
        $this->forge->createTable('sms_logs', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropKey('sms_logs', 'uuid');
        $this->forge->dropTable('sms_logs');
        $this->db->enableForeignKeyChecks();
    }
}
