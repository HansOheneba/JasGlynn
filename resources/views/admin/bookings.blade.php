<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Vite for Tailwind CSS -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">Bookings Dashboard</h1>

        @if(session('success'))
            <p class="text-center text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm bg-white border border-gray-200 rounded-lg shadow-lg">
                <thead class="text-xs uppercase text-gray-700">
                    <tr class="bg-gray-100">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-left">Venue</th>
                        <th class="py-3 px-6 text-left">Generator</th>
                        <th class="py-3 px-6 text-left">Event Description</th>
                        <th class="py-3 px-6 text-left">Event Date</th>
                        <th class="py-3 px-6 text-left">Guests</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 px-6">{{ $booking->name }}</td>
                            <td class="py-4 px-6">{{ $booking->email }}</td>
                            <td class="py-4 px-6">{{ $booking->phone }}</td>
                            <td class="py-4 px-6">{{ $booking->venue }}</td>
                            <td class="py-4 px-6">{{ $booking->backup_generator ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 w-52" data-truncate="30">{{ $booking->event_description }}</td>
                            <td class="py-4 px-6">{{ $booking->event_date }}</td>
                            <td class="py-4 px-6">{{ $booking->guests }}</td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 w-20 rounded-full flex justify-center
                                    {{ $booking->status == 'pending' ? 'bg-yellow-200 text-yellow-600' : ($booking->status == 'accepted' ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="flex py-4 px-6">
                                @if($booking->status == 'pending')
                                    <form action="/admin/bookings/{{ $booking->id }}/accept" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="/admin/bookings/{{ $booking->id }}/decline" method="POST" class="inline-block ml-2">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Decline
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const truncateElements = document.querySelectorAll('td[data-truncate]');

            truncateElements.forEach(td => {
                const maxLength = parseInt(td.getAttribute('data-truncate'));
                const originalText = td.textContent.trim();

                if (originalText.length > maxLength) {
                    td.textContent = originalText.slice(0, maxLength) + '...';
                }
            });
        });
    </script>
</body>
</html>
