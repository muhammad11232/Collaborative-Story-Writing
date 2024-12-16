<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Chapter;
use App\Models\Contribution;
use Illuminate\Http\Request;
use App\Jobs\SendStoryNotificationJob;

class ChapterController extends Controller
{

public function destroy($id)
{
    // Find the chapter by ID
    $chapter = Chapter::findOrFail($id);

    // Optional: Check if the user is authorized to delete this chapter
    if (auth()->id() !== $chapter->user_id && auth()->id() !== $chapter->story->user_id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    // Delete the chapter
    $chapter->delete();

    // Return success response
    return response()->json(['message' => 'Chapter deleted successfully.']);
}



    public function edit($id)
    {
        // Fetch the story and its related chapters
        $chapter = Chapter::findOrFail($id);

        // Pass the story and its chapters to the view
        return view('chapters.edit', compact('chapter'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);
    
        $chapter = Chapter::findOrFail($id);
    
        // Calculate word count dynamically
        $wordCount = str_word_count($request->content);
    
        $chapter->content = $request->content;
        $chapter->word_count = $wordCount; // Automatically set the word count
        $chapter->save();
    
        return response()->json([
            'message' => 'Chapter updated successfully.',
            'story_id' => $chapter->story_id,
        ]);
    }
    

    public function showChapters($id)
    {
        // Fetch the story and its related chapters
        $story = Story::with('chapters.user')->findOrFail($id);

        // Pass the story and its chapters to the view
        return view('chapters.index', compact('story'));
    }

    public function showChapterForm($storyId)
    {
        $story = Story::findOrFail($storyId);  // Find the story by ID
        return view('chapters.create', compact('story'));
    }
    public function store(Request $request, $storyId)
    {
        
        $request->validate([
            'content' => 'required',
        ]);

        $story = Story::findOrFail($storyId);

        if (!$story->is_published) {
            return response()->json(['message' => 'Cannot add chapters to an unpublished story'], 403);
        }

        $wordCount = str_word_count($request->content);

        $chapter = Chapter::create([
            'story_id' => $story->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'word_count' => $wordCount,
        ]);

        Contribution::create([
            'chapter_id' => $chapter->id,
            'user_id' => auth()->id(),
            'word_count' => $wordCount,
        ]);
        SendStoryNotificationJob::dispatch($story->user, $chapter, 'added');
        return response()->json(['chapter' => $chapter, 'message' => 'Chapter added successfully']);
    }
}
