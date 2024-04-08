
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

    <div class="flex gap-2">
        <!-- Toggle buttons for each navbar item -->
        <div id="navbar-controls" class="flex flex-col gap-2">
            @for ($i = 1; $i <= 7; $i++)
                <label class="switch">
                    <input type="checkbox" id="toggle-navbar-{{ $i }}">
                    <span class="slider round"></span>

                </label>
            @endfor
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

        <!-- Your navbar divs -->
        {{-- @for ($i = 1; $i <= 7; $i++)
            <div class="flex flex-col bg-red-500">
                <div id="navbar-{{ $i }}" class="navbar " style="display: none;">
                    <!-- Navbar item {{ $i }} content -->
                    Navbar Item {{ $i }}
                </div>
            </div>
        @endfor --}}
    </div>


    <script>
        // Function to toggle visibility of navbar div based on checkbox state
        function toggleNavbarVisibility(navbarId, checkboxId) {
            var navbarDiv = document.getElementById(navbarId);
            var checkbox = document.getElementById(checkboxId);

            navbarDiv.style.display = (checkbox.checked) ? 'block' : 'none';
            localStorage.setItem(checkboxId, checkbox.checked);
        }

        // Retrieve and set the initial state of each navbar div
        window.onload = function() {
            for (var i = 1; i <= 7; i++) {
                var checkboxId = 'toggle-navbar-' + i;
                var navbarId = 'navbar-' + i;
                var checkboxState = localStorage.getItem(checkboxId);

                if (checkboxState === 'true') {
                    document.getElementById(checkboxId).checked = true;
                    document.getElementById(navbarId).style.display = 'block';
                }
            }
        }

        // Attach event listeners to each toggle button
        for (var i = 1; i <= 7; i++) {
            (function() {
                var checkboxId = 'toggle-navbar-' + i;
                var navbarId = 'navbar-' + i;
                document.getElementById(checkboxId).addEventListener('change', function() {
                    toggleNavbarVisibility(navbarId, checkboxId);
                });
            })();
        }
    </script>
