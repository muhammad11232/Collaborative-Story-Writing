@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Top Contributors Leaderboard</h1>
    
    <table class="table table-striped" id="leaderboard-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Contributor</th>
                <th>Total Word Count</th>
            </tr>
        </thead>
        <tbody>
            <!-- Leaderboard will be populated here using AJAX -->
        </tbody>
    </table>
</div>

<!-- AJAX script to load leaderboard -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Perform AJAX request to fetch top contributors
        $.ajax({
            url: '/api/leaderboard',  // Controller route
            method: 'GET',
            success: function (data) {
                let leaderboardTableBody = $('#leaderboard-table tbody');
                
                // If no contributors
                if (data.length === 0) {
                    leaderboardTableBody.html('<tr><td colspan="3">No contributors available.</td></tr>');
                } else {
                    // Loop through data and populate the leaderboard table
                    data.forEach(function (contributor, index) {
                        let contributorRow = `<tr>
                            <td>${index + 1}</td>
                            <td>${contributor.user.name}</td>
                            <td>${contributor.total_word_count}</td>
                        </tr>`;
                        leaderboardTableBody.append(contributorRow);
                    });
                }
            },
            error: function (xhr, status, error) {
                alert('Failed to load leaderboard: ' + error);
            }
        });
    });
</script>
@endsection
