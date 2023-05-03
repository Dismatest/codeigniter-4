<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agreement extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'agreement_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'sacco_id'               => ['type' => 'int', 'constraint' => 11],
            'file'                => ['type' => 'varchar', 'constraint' => 255],
        ]);

        $this->forge->addPrimaryKey('agreement_id');
        $this->forge->addForeignKey('sacco_id', 'sacco', 'sacco_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('agreement', true);
        $this->db->enableForeignKeyChecks();

    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('agreement');
        $this->db->enableForeignKeyChecks();
    }
}
