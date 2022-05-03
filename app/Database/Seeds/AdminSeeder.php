<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'first_name' => 'admin',
            'last_name'    => 'admin',
            'username' => 'ciadmin',
            'password' => password_hash('master99', PASSWORD_DEFAULT),
            'email' => 'developer8here@gmail.com',
            'phone' => '9898989898',
            'address_line1' => 'Test Address1',
            'address_line2' => '',
            'country' => 'IN',
            'state' => 'Gujarat',
            'city' => 'Ahmedabad',
            'zip' => '380015',
            'status' => 1,
            'created_at'  =>    Time::createFromTimestamp(time()),
            'updated_at'  =>   Time::createFromTimestamp(time())
        ];

        // Simple Queries
        //$this->db->query("INSERT INTO admins (username, email) VALUES(:username:, :email:)", $data);

        // Using Query Builder
        $this->db->table('admins')->insert($data);
    }
}
