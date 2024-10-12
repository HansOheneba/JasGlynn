<!DOCTYPE html>
<html lang="en">
<head>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Bookings Dashboard</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Event Date</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->event_date }}</td>
                    <td>{{ $booking->guests }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        @if($booking->status == 'pending')
                            <form action="/admin/bookings/{{ $booking->id }}/accept" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Accept</button>
                            </form>
                            <form action="/admin/bookings/{{ $booking->id }}/decline" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Decline</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
