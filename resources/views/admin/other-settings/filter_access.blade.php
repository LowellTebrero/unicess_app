
<style>
    /* Add your CSS styles here */
    /* Styles for the slider toggle */
    .switch {
        position: relative;
        display: inline-block;
        width: 30px; /* Adjust the width of the switch */
        height: 18px; /* Adjust the height of the switch */
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px; /* Rounded corners for the slider */
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 14px; /* Adjust the height of the slider button */
        width: 14px; /* Adjust the width of the slider button */
        left: 2px; /* Adjust the left position of the slider button */
        bottom: 2px; /* Adjust the bottom position of the slider button */
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%; /* Make the slider button circular */
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(12px); /* Adjust the distance the slider button moves */
        -ms-transform: translateX(12px);
        transform: translateX(12px);
    }
</style>

    <h1 class="mb-2">ADMIN NAVBAR ACCESS</h1>
    <div class="flex gap-2">
        <div class="flex flex-col gap-2">
            @foreach ($AccessData as $access )
            <label class="switch">
                <input type="checkbox" id="toggle-navbar-{{ $access->id }}" data-id="{{ $access->id }}" {{ $access->status === 'checked' ? 'checked' : '' }}
                onclick="return confirm ('Are you sure?')">
                <span class="slider round"></span>

            </label>
            @endforeach
            </div>

        <div class="flex flex-col text-sm gap-[0.35rem]">
            <h1>Dashboard</h1>
            <h1>Extension Monitoring</h1>
            <h1>Extension Evaluation</h1>
            <h1>Accounts</h1>
            <h1>Contents</h1>
            <h1>Settings</h1>
            <h1>Trash</h1>
        </div>

    </div>


    <script>
         // Wait for the DOM to load
         document.addEventListener('DOMContentLoaded', function() {
            var toggleSwitches = document.querySelectorAll('[id^="toggle-navbar-"]');

            toggleSwitches.forEach(function(toggleSwitch) {
                toggleSwitch.addEventListener('change', function() {
                    console.log(toggleSwitch);
                    var toggleState = this.checked;
                    var recordId = this.getAttribute('data-id');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '/admin/toggle-update-access/' + recordId, true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    console.log('Toggle state updated successfully!');
                                }
                            } else {
                                console.error('Error occurred: ' + xhr.status);
                            }
                        }
                    };

                    xhr.send(JSON.stringify({ state: toggleState }));
                });
            });
        });

    </script>
