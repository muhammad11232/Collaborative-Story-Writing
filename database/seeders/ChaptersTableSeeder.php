<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    public function run()
    {
        $story1 = Story::find(1); // The Adventure Begins
        $story2 = Story::find(2); // Mystery of the Lost City
        $story3 = Story::find(3); // The Haunted Mansion
        $story4 = Story::find(4); // A Journey to the Stars
        $story5 = Story::find(5); // The Chronicles of Time

        $user1 = User::find(1); // John Doe
        $user2 = User::find(2); // Jane Smith
        $user3 = User::find(3); // Mark Johnson
        $user4 = User::find(4); // Emily Davis
        $user5 = User::find(5); // Lucas Brown

        Chapter::create([
            'story_id' => $story1->id,
            'user_id' => $user1->id,
            'content' => 'Chapter 1 content of "The Adventure Begins".',
            'word_count' => 1000,
        ]);

        Chapter::create([
            'story_id' => $story2->id,
            'user_id' => $user2->id,
            'content' => 'Chapter 1 content of "Mystery of the Lost City".',
            'word_count' => 800,
        ]);

        Chapter::create([
            'story_id' => $story3->id,
            'user_id' => $user3->id,
            'content' => 'Chapter 1 content of "The Haunted Mansion".',
            'word_count' => 1200,
        ]);

        Chapter::create([
            'story_id' => $story4->id,
            'user_id' => $user4->id,
            'content' => 'Chapter 1 content of "A Journey to the Stars".',
            'word_count' => 1500,
        ]);

        Chapter::create([
            'story_id' => $story5->id,
            'user_id' => $user5->id,
            'content' => 'Chapter 1 content of "The Chronicles of Time".',
            'word_count' => 1100,
        ]);
    }
}
