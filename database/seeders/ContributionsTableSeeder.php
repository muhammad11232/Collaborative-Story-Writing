<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Chapter;
use App\Models\Contribution;
use Illuminate\Database\Seeder;

class ContributionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure chapters exist before attempting to add contributions
        $chapter1 = Chapter::find(1); 
        $chapter2 = Chapter::find(2); 
        $chapter3 = Chapter::find(3); 
        $chapter4 = Chapter::find(4); 
        $chapter5 = Chapter::find(5);

        if ($chapter1 && $chapter2 && $chapter3 && $chapter4 && $chapter5) {
            $user1 = User::find(1); 
            $user2 = User::find(2); 
            $user3 = User::find(3); 
            $user4 = User::find(4); 
            $user5 = User::find(5); 

            Contribution::create([
                'chapter_id' => $chapter1->id,
                'user_id' => $user1->id,
                'word_count' => 500,
            ]);

            Contribution::create([
                'chapter_id' => $chapter2->id,
                'user_id' => $user2->id,
                'word_count' => 400,
            ]);

            Contribution::create([
                'chapter_id' => $chapter3->id,
                'user_id' => $user3->id,
                'word_count' => 600,
            ]);

            Contribution::create([
                'chapter_id' => $chapter4->id,
                'user_id' => $user4->id,
                'word_count' => 700,
            ]);

            Contribution::create([
                'chapter_id' => $chapter5->id,
                'user_id' => $user5->id,
                'word_count' => 550,
            ]);
        } else {
            // Handle the case where chapters don't exist
            echo "One or more chapters are missing.\n";
        }
    }
}
