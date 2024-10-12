<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book an Event</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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

        <!-- Date Picker Input -->
        <input type="text" id="eventDate" name="event_date" placeholder="Select a Date" required><br>

        <input type="number" name="guests" placeholder="Number of Guests" required><br>
        <button type="submit">Submit</button>
    </form>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Get the booked dates from the backend
        const bookedDates = @json($bookedDates);

        // Initialize Flatpickr with disabled dates
        flatpickr("#eventDate", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: bookedDates
        });
    </script>
</body>
</html>
