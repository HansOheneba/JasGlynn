<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book an Event</title>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <h1>Book Your Event</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="/book" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required><br>
        <input type="email" name="email" placeholder="Your Email" required><br>
        <input type="date" name="event_date" required><br>
        <input type="number" name="guests" placeholder="Number of Guests" required><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
