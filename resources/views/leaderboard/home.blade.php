@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-3 mb-5">Top 10 Contributors Leaderboard</h1>
    
    <!-- Container to hold the cards -->
    <div id="leaderboard-cards" class="row">
        <!-- Cards will be appended here dynamically -->
    </div>
</div>

<!-- AJAX script to load leaderboard -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Perform AJAX request to fetch top contributors
        $.ajax({
            url: '/api/leaderboard',  // Controller route for fetching leaderboard data
            method: 'GET',
            success: function (data) {
                // Get the leaderboard container
                let leaderboardCardsContainer = $('#leaderboard-cards');
                
                // If no contributors
                if (data.length === 0) {
                    leaderboardCardsContainer.html('<p>No contributors available.</p>');
                } else {
                    // Loop through data and create a card for each contributor
                    data.forEach(function (contributor, index) {
                        let card = `
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        ${index + 1}${getOrdinal(index + 1)} <!-- Adds "st", "nd", "rd", "th" suffix -->
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">${contributor.user.name}</h5>
                                        <p class="card-text">${contributor.total_word_count} words written</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        leaderboardCardsContainer.append(card);
                    });
                }
            },
            error: function (xhr, status, error) {
                alert('Failed to load leaderboard: ' + error);
            }
        });
        
        // Function to get the ordinal suffix (1st, 2nd, 3rd, 4th, etc.)
        function getOrdinal(n) {
            let s = ["th", "st", "nd", "rd"];
            let v = n % 100;
            return s[(v - 20) % 10] || s[v] || s[0];
        }
    });
</script>
@endsection
