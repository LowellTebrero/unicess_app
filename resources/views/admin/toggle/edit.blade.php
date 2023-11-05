<x-admin-layout>

    <section class=" text-gray-700 p-4 2xl:min-h-[80vh] mx-12 mt-16 ">



        <div id="toggle-container">
            <label class="toggle-switch">
                <input type="checkbox" id="toggle" data-id="{{ $record->id }}" {{ $record->status === 'checked' ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
        </div>


    </section>


    <script>
        // Wait for the DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            var toggleSwitch = document.getElementById('toggle');

            toggleSwitch.addEventListener('change', function() {
                var toggleState = this.checked;
                var recordId = this.getAttribute('data-id');

                // Send an AJAX request to the Laravel API endpoint
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/api/toggle-update/' + recordId, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Handle the success response
                            console.log('Toggle state updated successfully!');
                        }
                    }
                };

                xhr.send(JSON.stringify({ state: toggleState }));
            });
        });
    </script>

</x-admin-layout>
