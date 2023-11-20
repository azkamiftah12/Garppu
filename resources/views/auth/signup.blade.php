<!-- resources/views/auth/signup.blade.php -->

<form action="{{ route('signup') }}" method="post">
    @csrf
    <label for="nik">NIK:</label>
    <input type="text" name="nik" required>
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required>
    <label for="noTelp">Nomor Telepon:</label>
    <input type="text" name="noTelp">
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Sign Up</button>
</form>
