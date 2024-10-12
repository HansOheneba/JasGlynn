<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book an Event</title>

    <!-- Flatpickr Theme -->
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
    <h1>Book Your Event</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="/book" method="POST">
        @csrf

        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" placeholder="Your Name" required><br>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" placeholder="Your Email" required><br>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="Phone Number" required><br>

        <label for="venue">Select Venue:</label>
        <select name="venue" id="venue" required>
            <option value="Diplomatic Hall">Diplomatic Hall</option>
            <option value="Garden">Garden</option>
        </select><br>

        <label for="backup_generator">
            <input type="checkbox" name="backup_generator" id="backup_generator" value="1">
            Need Backup Generator?
        </label><br>

        <label for="event_description">Describe Your Event:</label>
        <textarea name="event_description" id="event_description"
                  placeholder="Describe your event (e.g., Wedding, Corporate Event)"
                  required></textarea><br>

        <label for="eventDate">Select Event Date:</label>
        <input type="text" id="eventDate" name="event_date" placeholder="Select a Date" required><br>

        <label for="guests">Number of Guests:</label>
        <input type="number" id="guests" name="guests" placeholder="Number of Guests" required><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        // Get the booked dates from the backend
        const bookedDates = @json($bookedDates);

        // Initialize Flatpickr with disabled dates and minDate set to today
        flatpickr("#eventDate", {
            dateFormat: "Y-m-d",
            minDate: "today",  // Disable past dates
            disable: bookedDates  // Disable booked dates
        });
    </script>
</body>
</html>
