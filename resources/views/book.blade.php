<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book an Event</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Vite for Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Flatpickr Theme -->
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        /* Custom CSS for opacity transition */
        .toast {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 9999;
        }

        .toast.show {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px] bg-white p-8 shadow-lg rounded-md">
            <h1 class="text-2xl font-semibold text-center text-[#07074D] mb-6">Book Us For an Event</h1>

            <div id="toast" class="toast text-sm fixed top-5 right-5 bg-white text-green-500 p-4 rounded-md shadow-lg">
                <i class="fa fa-solid fa-check text-xs bg-green-500 text-white rounded-full px-1 py-[2px] mx-2"></i>
                @if(session('success'))
                    {{ session('success') }}
                @endif
            </div>

            <script>
                // Function to show toast notification
                function showToast() {
                    const toast = document.getElementById('toast');

                    // Only show the toast if there is a message
                    if (toast.textContent.trim() !== '') {
                        toast.classList.add('show');

                        setTimeout(() => {
                            toast.classList.remove('show');
                        }, 5000); 
                    }
                }

                // Show the toast if there is a success message
                window.onload = function() {
                    showToast();
                };
            </script>

            <form action="/book" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-base font-medium text-[#07074D] mb-2">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name"
                        class="w-full rounded-md border border-gray-300 py-3 px-6 text-base text-gray-700 focus:border-indigo-500 focus:shadow-md"
                        required />
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-base font-medium text-[#07074D] mb-2">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email"
                        class="w-full rounded-md border border-gray-300 py-3 px-6 text-base text-gray-700 focus:border-indigo-500 focus:shadow-md"
                        required />
                </div>

                <div class="mb-5">
                    <label for="phone" class="block text-base font-medium text-[#07074D] mb-2">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number"
                        class="w-full rounded-md border border-gray-300 py-3 px-6 text-base text-gray-700 focus:border-indigo-500 focus:shadow-md"
                        required />
                </div>

                <div class="mb-5">
                    <label for="venue" class="block text-base font-medium text-[#07074D] mb-2">Select Venue</label>
                    <select name="venue" id="venue"
                        class="w-full rounded-md border border-gray-300 py-3 px-6 text-base text-gray-700 focus:border-indigo-500 focus:shadow-md"
                        required>
                        <option value="Diplomatic Hall">Diplomatic Hall</option>
                        <option value="Garden">Garden</option>
                    </select>
                </div>

                <div class="mb-5">
                    <label for="backup_generator" class="flex items-center">
                        <input type="checkbox" name="backup_generator" id="backup_generator" value="1"
                            class="mr-2 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                        Need Backup Generator?
                    </label>
                </div>

                <div class="mb-5">
                    <label for="event_description" class="block text-base font-medium text-[#07074D] mb-2">Describe Your Event</label>
                    <textarea id="event_description" name="event_description"
                        placeholder="Describe your event (e.g., Wedding, Corporate Event)"
                        class="w-full rounded-md border border-gray-300 py-3 px-6 text-base text-gray-700 focus:border-indigo-500 focus:shadow-md"
                        required></textarea>
                </div>

                <div class="mb-5">
                    <label for="eventDate" class="block text-base font-medium text-[#07074D] mb-2">Select Event Date</label>
                    <input type="text" id="eventDate" name="event_date" placeholder="Select a Date"
                        class="w-full rounded-md border border-gray-300 py-3 px-6 text-base text-gray-700 focus:border-indigo-500 focus:shadow-md"
                        required />
                </div>

                <div class="mb-5">
                    <label for="guests" class="block text-base font-medium text-[#07074D] mb-2">Number of Guests</label>
                    <input type="number" id="guests" name="guests" placeholder="Number of Guests"
                        class="w-full rounded-md border border-gray-300 py-3 px-6 text-base text-gray-700 focus:border-indigo-500 focus:shadow-md"
                        required />
                </div>

                <div>
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 py-3 px-8 text-center text-white font-semibold hover:bg-indigo-700">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </div>

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
