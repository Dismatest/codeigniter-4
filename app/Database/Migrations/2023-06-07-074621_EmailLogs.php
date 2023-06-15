<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailLogs extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'email_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'uuid'               => ['type' => 'varchar', 'constraint' =>255],
            'fname'            => ['type' => 'varchar', 'constraint' => 255],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'message_title'      => ['type' => 'varchar', 'constraint' => 255],
            'role'               => ['type' => 'varchar', 'constraint' => 255],
            'status'             => ['type' => 'int', 'constraint' => 11],
            'created_at'         => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('email_id');
        $this->forge->addKey('uuid');
        $this->forge->createTable('email_logs', true);
    }

    public function down()
    {

        $this->forge->dropKey('email_logs', 'uuid');
        $this->forge->dropTable('email_logs');

    }
}
