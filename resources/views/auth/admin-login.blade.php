<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div style="color:red">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
            @error('password') <div style="color:red">{{ $message }}</div> @enderror
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
