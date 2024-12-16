@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="my-3">Stories</h1>
    </div>
    <div class="row d-flex justify-content-end">
        <div class="col-2">
            <a class="ms-5 mb-5 btn btn-danger" href="{{ route('story.create') }}">Add New</a>
        </div>
    </div>
    
    
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
    const apiToken = 'Bearer YOUR_ACCESS_TOKEN';

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
            success: function (stories) {
                let html = '';
                stories.forEach((story, index) => {
                    const chapters = story.chapters.map((chapter, i) => `
                        <li>Chapter ${i + 1} 
                        <br><small class ="ms-5">By ${chapter.user.name} (${chapter.word_count} words)</small>
                        </li>
                    `).join('');

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
                            </td>
                        </tr>
                    `;
                });
                $('#storiesTable').html(html);
            },
            error: function (err) {
                alert('Failed to load stories.');
            }
        });
    }

    loadStories(); 
});
</script>
@endsection
