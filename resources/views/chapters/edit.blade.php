@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Chapter</h1>
    <form id="editChapterForm">
        <!-- Chapter Content -->
        <div class="form-group">
            <label for="content">Chapter Content </label>
            <textarea name="content" id="content" class="form-control" rows="6" required>{{ $chapter->content }}</textarea>
        </div>
        
        <!-- Save Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    const apiToken = 'Bearer YOUR_ACCESS_TOKEN'; // Replace with actual token
    const chapterId = {{ $chapter->id }}; // Inject the chapter ID into the script

    // Set up AJAX headers
    $.ajaxSetup({
        headers: {
            'Authorization': apiToken,
            'Content-Type': 'application/json',
        }
    });

    // Handle form submission
    $('#editChapterForm').on('submit', function (e) {
        e.preventDefault();

        const content = $('#content').val();

        // AJAX request to update the chapter
        $.ajax({
            
            url: `/api/chapters/${chapterId}`, // API endpoint to update chapter
            method: 'PATCH',
            data: JSON.stringify({
                content: content,
            }),
            success: function (response) {
                alert('Chapter updated successfully.');
                window.location.href = `/story/${response.story_id}/chapters`; // Redirect to the chapter list page
            },
            error: function (err) {
                alert('Failed to update chapter.');
                console.log(err);
            }
        });
    });
});
</script>
@endsection
