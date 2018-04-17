<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'System Admin',],
            ['id' => 3, 'title' => 'Chairman',],
            ['id' => 4, 'title' => 'CEO',],
            ['id' => 5, 'title' => 'HR',],
            ['id' => 6, 'title' => 'Project Manager',],
            ['id' => 7, 'title' => 'Web Designer',],
            ['id' => 8, 'title' => 'Web Developer',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
