@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create a New Chapter for Story: {{ $story->title }}</h2>

    <!-- Chapter creation form -->
    <form id="createChapterForm">
        <div class="form-group">
            <label for="content">Chapter Content:</label>
            <textarea id="content" name="content" rows="6" cols="50" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Chapter</button>
    </form>

    <!-- Success or Error message -->
    <div id="message"></div>
</div>

<!-- Include jQuery (required for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Form submission using AJAX
        $('#createChapterForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const content = $('#content').val();  // Get the content of the chapter
            const storyId = '{{ $story->id }}';    // Pass the story ID to the backend

            $.ajax({
                url: '/api/stories/' + storyId + '/chapters', // API endpoint to store the chapter
                method: 'POST',
                data: {
                    content: content,
                    _token: '{{ csrf_token() }}'  // CSRF token for security
                },
                success: function(response) {
                    // Success message
                    $('#message').html('<p>Chapter added successfully!</p>').css('color', 'green');
                    $('#content').val('');  // Clear the textarea
                },
                error: function(xhr, status, error) {
                    // Error message
                    $('#message').html('<p>Failed to add chapter. Please try again.</p>').css('color', 'red');
                    console.log(xhr.responseText); // Output any response from the server for debugging
                }
            });
        });
    });
</script>
@endsection
