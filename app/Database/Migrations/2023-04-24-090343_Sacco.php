<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sacco extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'sacco_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'uuid'   => ['type' => 'varchar', 'constraint' =>255],
            'name'             => ['type' => 'varchar', 'constraint' => 255],
            'email'             => ['type' => 'varchar', 'constraint' => 255],
            'location'             => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'contact_phone'             => ['type' => 'int', 'constraint' => 12, 'null' => true],
            'contact_email'          => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'till' => ['type' => 'int', 'constraint' => 10, 'null' => true],
            'commission'        => ['type' => 'int', 'constraint' => 10, 'null' => true],
            'website'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'logo'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'password'          => ['type' => 'varchar', 'constraint' => 255],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('sacco_id');
        $this->forge->createTable('sacco', true);

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();


        $this->forge->dropTable('sacco');

        $this->db->enableForeignKeyChecks();
    }
}
