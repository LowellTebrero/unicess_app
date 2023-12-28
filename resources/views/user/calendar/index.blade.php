<x-app-layout>

    <section class="min-h-[70vh]">
        <div id="calendar" class="w-[50%] bg-white p-10"></div>
    </section>



    {{--  <script>
        $(document).ready(function () {
            // Fetch your Google Calendar data and format it
            var events = [
                // Format your events data here
                // Example:
                {
                    title: 'Event 1',
                    start: '2023-01-01T10:00:00',
                    end: '2023-01-01T12:00:00'
                },
                {
                    title: 'Event 2',
                    start: '2023-01-02T14:00:00',
                    end: '2023-01-02T16:00:00'
                },
                // Add more events as needed
            ];

            // Initialize FullCalendar
            $('#calendar').fullCalendar({
                events: events,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                }
            });
        });
    </script>  --}}

    <script>
        $(document).ready(function () {
            var events = @json($events);

            $('#calendar').fullCalendar({
                events: events,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                }
            });
        });
    </script>

</x-app-layout>
