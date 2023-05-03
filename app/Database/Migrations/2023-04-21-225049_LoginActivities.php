<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoginActivities extends Migration
{

    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id'        => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'uniid'     => ['type' => 'varchar', 'constraint' => 255],
            'agent'     => ['type' => 'varchar', 'constraint' => 255],
            'ip'        => ['type' => 'varchar', 'constraint' => 32],
            'login_time'=> ['type' => 'datetime', 'default' => date('Y-m-d H:i:s')],
            'logout_time'=> ['type' => 'datetime']
        ]);

        $this->forge->addPrimaryKey('id');


        $this->forge->addForeignKey('uniid', 'users', 'uniid', 'CASCADE', 'CASCADE');
        $this->forge->createTable('login_activities', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->dropTable('login_activities');
        $this->db->enableForeignKeyChecks();
    }
}

