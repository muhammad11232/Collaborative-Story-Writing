<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Jobs\SendStoryNotificationJob;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Story::with('user', 'chapters.user')->latest();
         
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }
        else{
            $query->where('is_published', 1);
        }
        


        $stories=$query->get();
        return response()->json($stories);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:stories|max:255',
            'description' => 'required|max:500',
            'chapter_content' => 'required|string',
        ]);

        // Create the story
        $story = Story::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        // Add the first chapter
        $chapter = Chapter::create([
            'story_id' => $story->id,
            'content' => $request->chapter_content,
            'user_id' => $request->user()->id,
            'word_count' => str_word_count($request->chapter_content),
        ]);

        
        return response()->json([
            'message' => 'Story created successfully with the first chapter.',
            'story' => $story,
            'chapter' => $chapter,
        ], 201);
    }

    public function updateStatus(Request $request, $storyId)
    {
        $story = Story::findOrFail($storyId);
        $story->is_published = $request->status;
        $story->save();
        return response()->json(['message' => 'Story status updated successfully.']);
    }

}
