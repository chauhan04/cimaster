<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'first_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'address_line1' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'address_line2' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'zip' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'status'       => [
                'type'       => 'SMALLINT',
                'constraint' => '1',
            ],
            'last_login'       => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'created_at'       => [
                'type'       => 'DATETIME',
            ],
            'updated_at'       => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
