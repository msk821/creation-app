<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::now()->addDays(1)->format('Y-m-d');
        $after = Carbon::now()->addDays(2)->format('Y-m-d');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('posts')->truncate();
        DB::table('posts')->insert([
            [
                'title' => 'イベント1',
                'body' => 'こんなイベントだよー',
                'user_id' => 1,
                'tag_id' => 1,
                'start_date' => $today,
                'end_date' => $today,
            ],
            [
                'title' => 'イベント2',
                'body' => 'こんなイベントだよー',
                'user_id' => 1,
                'tag_id' => 1,
                'start_date' => $tomorrow,
                'end_date' => $tomorrow,
            ],
            [
                'title' => 'イベント3',
                'body' => 'こんなイベントだよー',
                'user_id' => 1,
                'tag_id' => 1,
                'start_date' => $after,
                'end_date' => $after,
            ],
            
            
            

        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
    
}












