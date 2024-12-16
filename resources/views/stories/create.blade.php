@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a Story</h1>
    <form id="createStoryForm">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" maxlength="500" required></textarea>
        </div>
        <div class="form-group">
            <label for="chapter_content">First Chapter</label>
            <textarea id="chapter_content" class="form-control" name="chapter_content" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Story</button>
        <a href="/stories" class="btn btn-secondary float-right mt-3">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    const apiToken = 'Bearer YOUR_ACCESS_TOKEN';

    // Set up AJAX headers for API authentication
    $.ajaxSetup({
        headers: {
            'Authorization': apiToken,
        }
    });
    $('#createStoryForm').on('submit', function (e) {
        e.preventDefault();

        const formData = {
            title: $('#title').val(),
            description: $('#description').val(),
            chapter_content: $('#chapter_content').val(),
        };

        $.ajax({
            url: '/api/stories',
            method: 'POST',
            data: formData,
            success: function (response) {
                alert('Story created successfully.');
                loadStories();
                $('#createStoryForm')[0].reset();
            },
            error: function (err) {
                alert('Failed to create story. Ensure the title is unique and description is valid.');
            }
        });
    });
});
</script>
@endsection
