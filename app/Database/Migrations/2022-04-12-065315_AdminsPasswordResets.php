<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminsPasswordResets extends Migration
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
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'admin_id' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'created_at'       => [
                'type'       => 'DATETIME',
            ],
            'updated_at'       => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('admins_password_resets');
    }

    public function down()
    {
        $this->forge->dropTable('admins_password_resets');
    }
}
