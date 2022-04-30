<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoleMaster extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status'       => [
                'type'       => 'SMALLINT',
                'constraint' => '1',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('role_master');
    }

    public function down()
    {
        $this->forge->dropTable('role_master');
    }
}
