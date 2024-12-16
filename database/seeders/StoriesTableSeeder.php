<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;

class StoriesTableSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::find(1); // John Doe
        $user2 = User::find(2); // Jane Smith
        $user3 = User::find(3); // Mark Johnson
        $user4 = User::find(4); // Emily Davis
        $user5 = User::find(5); // Lucas Brown

        Story::create([
            'title' => 'The Adventure Begins',
            'description' => 'An exciting adventure story.',
            'user_id' => $user1->id,
            'is_published' => true,
        ]);

        Story::create([
            'title' => 'Mystery of the Lost City',
            'description' => 'A gripping mystery story.',
            'user_id' => $user2->id,
            'is_published' => false,
        ]);

        Story::create([
            'title' => 'The Haunted Mansion',
            'description' => 'A spine-chilling ghost story.',
            'user_id' => $user3->id,
            'is_published' => true,
        ]);

        Story::create([
            'title' => 'A Journey to the Stars',
            'description' => 'A thrilling space exploration story.',
            'user_id' => $user4->id,
            'is_published' => false,
        ]);

        Story::create([
            'title' => 'The Chronicles of Time',
            'description' => 'A time-traveling adventure.',
            'user_id' => $user5->id,
            'is_published' => true,
        ]);
    }
}
