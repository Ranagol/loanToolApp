<?php

use Illuminate\Database\Seeder;
use App\Tool;
class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tool::class, 5)->create();
    }
}
