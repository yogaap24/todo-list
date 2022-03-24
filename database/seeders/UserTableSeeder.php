<?php

namespace Database\Seeders;

use App\Models\Table\UserTable;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = (new UserTable());
        $table = $model->getTable();

        $password = \Illuminate\Support\Facades\Hash::make('password');

        $pages = [
            [
                'id'            => "00000000-0000-1111-1111-000000000011",
                'name'          => 'User 1',
                'email'         => 'user1@mail.id',
                'password'      => $password,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => "00000000-0000-1111-1111-000000000012",
                'name'          => 'User 2',
                'email'         => 'user2@mail.id',
                'password'      => $password,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($pages as $page) {
            $find = $model->newQuery()->where('email', '=', $page['email'])->first();

            if (empty($find)) {
                $model->newQuery()->create($page);
            }
            else {
                echo "\e[33m SKIPPED:, \e[31m Page '{$page['slug']}' is already registered \n";
            }
        }
    }
}
