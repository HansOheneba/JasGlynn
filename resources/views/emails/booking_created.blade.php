<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification</title>
</head>
<body>
    <h1>New Booking Created!</h1>
    <p>A new booking has been made:</p>
    <ul>
        <li><strong>Name:</strong> {{ $booking->name }}</li>
        <li><strong>Email:</strong> {{ $booking->email }}</li>
        <li><strong>Event Date:</strong> {{ $booking->event_date }}</li>
        <li><strong>Guests:</strong> {{ $booking->guests }}</li>
    </ul>
    <p>Thank you for choosing our event center!</p>
</body>
</html>
