@extends('layouts.app')

@section('content')
    <h1>Login</h1>
    <form id="login-form">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#login-form').submit(function (e) {
            e.preventDefault();

            const email = $('#email').val();
            const password = $('#password').val();

            $.ajax({
                url: '/api/login',
                type: 'POST',
                data: { email: email, password: password },
                success: function (response) {
                    localStorage.setItem('token', response.token);
                    alert('Login successful');
                    window.location.href = '/dashboard';
                },
                error: function () {
                    alert('Invalid credentials');
                }
            });
        });
    });
</script>
