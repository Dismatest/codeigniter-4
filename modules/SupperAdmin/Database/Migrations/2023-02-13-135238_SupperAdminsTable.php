<?php

namespace Modules\SupperAdmin\Database\Migrations;

use CodeIgniter\Database\Migration;

class SupperAdminsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'admin_id'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'fname'             => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'lname'             => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'email'             => ['type' => 'varchar', 'constraint' => 255],
            'password'          => ['type' => 'varchar', 'constraint' => 255],
            'remember_token'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('admin_id');
        $this->forge->createTable('supperAdmins', true);
    }

    public function down()
    {
        $this->forge->dropTable('supperAdmins');
    }
}
