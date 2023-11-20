<form action="{{ route('login') }}" method="post">
    @csrf
    <label for="nik">NIK:</label>
    <input type="text" name="nik" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
