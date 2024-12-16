@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <h1 class="my-3">Stories</h1>
    </div>

    <!-- Button to add new story -->
    <div class="row d-flex justify-content-end">
        <div class="col-2">
            <a class="ms-5 mb-5 btn btn-danger" href="{{ route('story.create') }}">Add New</a>
        </div>
    </div>

    <!-- Dynamic Cards Container -->
    <div class="row" id="storiesCards">
        <!-- Cards will be dynamically loaded here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    const apiToken = 'Bearer YOUR_ACCESS_TOKEN';  // You can dynamically set this value

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
                        <li>Chapter ${i + 1} <br><small class="ms-5">By ${chapter.user.name} (${chapter.word_count} words)</small></li>
                    `).join('');
                    
                    // Build HTML for each story card
                    html += `
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">${story.title}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">${story.description}</p>
                                    <h6>Author: ${story.user.name}</h6>
                                    <h6>Chapters:</h6>
                                    <ul>
                                        ${chapters || '<li><i>No chapters yet.</i></li>'}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                });
                // Append generated cards to the storiesCards container
                $('#storiesCards').html(html);
            },
            error: function (err) {
                alert('Failed to load stories.');
            }
        });
    }

    loadStories(); // Initial load of stories
});
</script>
@endsection

    


