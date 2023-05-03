<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Errors extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'error_id'           => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'error'   => ['type' => 'varchar', 'constraint' => 255],
            'level'        => ['type' => 'varchar', 'constraint' => 255],
            'created_at'        => ['type' => 'datetime', 'default' => date('Y-m-d H:i:s'), 'null' => true],
        ]);

        $this->forge->addPrimaryKey('error_id');
        $this->forge->createTable('errors', true);
    }

    public function down()
    {
        $this->forge->dropTable('errors');
    }
}
