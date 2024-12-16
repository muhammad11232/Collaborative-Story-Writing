@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-3">My Stories</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Author</th>
                <th>Chapters</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="storiesTable">
            <!-- Stories will be dynamically loaded here -->
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    const apiToken = 'Bearer YOUR_ACCESS_TOKEN'; // Replace with actual token
    var userId = @json(auth()->user()->id);  // Inject user ID into JavaScript

    // Set up AJAX headers for API authentication
    $.ajaxSetup({
        headers: {
            'Authorization': apiToken,
        }
    });

    // Load Stories
    function loadStories() {
        $.ajax({
            url: '/api/stories',
            method: 'GET',
            data: { user_id: userId },
            success: function (stories) {
                let html = '';
                stories.forEach((story, index) => {
                    const chapters = story.chapters.map((chapter, i) => `
                        <li>Chapter ${i + 1}
                        <br><small>By ${chapter.user.name} (${chapter.word_count} words)</small>
                        </li>
                    `).join('');

                    const publishedStatus = story.is_published === 1 ? 1 : 0;
                    const publishedOptions = `
                        <select class="form-control status-select" data-story-id="${story.id}">
                            <option value="1" ${publishedStatus === 1 ? 'selected' : ''}>Published</option>
                            <option value="0" ${publishedStatus === 0 ? 'selected' : ''}>Unpublished</option>
                        </select>
                    `;

                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${story.title}</td>
                            <td>${story.description}</td>
                            <td>${story.user.name}</td>
                            <td>
                                <ul>${chapters || '<i>No chapters yet.</i>'}</ul>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="/story/${story.id}/create-chapter">Add Chapter</a>
                                <a class="btn btn-secondary" href="/story/${story.id}/chapters">Edit</a> <!-- Edit Button -->
                            </td>
                            <td>
                                ${publishedOptions} <!-- Dropdown for Published/Unpublished status -->
                            </td>
                        </tr>
                    `;
                });

                // Inject the HTML into the stories table
                $('#storiesTable').html(html);
            },
            error: function (err) {
                alert('Failed to load stories.');
            }
        });
    }

    // Handle status change (Publish/Unpublish)
    $(document).on('change', '.status-select', function () {
        const storyId = $(this).data('story-id');
        const status = $(this).val(); // 1 for Published, 0 for Unpublished

        $.ajax({
            url: `/api/story/status/${storyId}`, // Use the correct URL for updating status
            method: 'PATCH', // Change status via PATCH method
            data: {
                status: status
            },
            success: function (response) {
                alert(response.message); // Show success message
                loadStories(); // Reload the stories table to reflect updated status
            },
            error: function (error) {
                console.error('Error updating story status:', error);
                alert('Failed to update story status.');
            }
        });
    });

    // Call the function to load stories when the document is ready
    loadStories();
});

</script>
@endsection
