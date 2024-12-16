@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chapters of "{{ $story->title }}"</h1>
    <a href="/stories-auther" class="btn btn-primary mb-3">Back to Stories</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Content</th>
                <th>Author</th>
                <th>Word Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($story->chapters as $index => $chapter)
                <tr id="chapter-{{ $chapter->id }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $chapter->content }}</td>
                    <td>{{ $chapter->user->name }}</td>
                    <td>{{ $chapter->word_count }}</td>
                    <td>
                        <a href="{{ route('chapters.edit', $chapter->id) }}" class="btn btn-secondary">Edit</a>
                        <button class="btn btn-danger delete-chapter-btn" data-chapter-id="{{ $chapter->id }}">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No chapters available for this story.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.delete-chapter-btn', function () {
            const chapterId = $(this).data('chapter-id'); // Fetch the chapter ID from the button
            const row = $(this).closest('tr'); // Reference to the row to remove

            if (!confirm('Are you sure you want to delete this chapter?')) {
                return; // Exit if user cancels the confirmation dialog
            }

            $.ajax({
                url: `/api/chapters/${chapterId}`, // API endpoint for chapter deletion
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer {{ Auth::user()->api_token }}`, // Use the current user's API token (ensure it's set properly in your app)
                },
                success: function (response) {
                    alert(response.message); // Show success message
                    row.remove(); // Remove the row from the table
                },
                error: function (error) {
                    console.error('Error deleting chapter:', error);
                    alert('Failed to delete chapter.'); // Show error message
                }
            });
        });
    });
</script>
