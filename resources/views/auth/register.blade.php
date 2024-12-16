@extends('layouts.app')

@section('content')
    <h1>Register</h1>
    <form id="register-form">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#register-form').submit(function (e) {
            e.preventDefault();

            const name = $('#name').val();
            const email = $('#email').val();
            const password = $('#password').val();

            $.ajax({
                url: '/api/register',
                type: 'POST',
                data: { name: name, email: email, password: password },
                success: function () {
                    alert('Registration successful! You can now login.');
                    window.location.href = '/login';
                },
                error: function (response) {
                    alert('Error: ' + response.responseJSON.message);
                }
            });
        });
    });
</script>
