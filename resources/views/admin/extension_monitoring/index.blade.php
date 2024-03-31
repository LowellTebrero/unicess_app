<x-admin-layout>

    <style>
        .active-tab {
               /* Add your active styles here */
               background-color: #5c8fff;
               color: #ffffff;
               border-top-left-radius: 4px;
               border-top-right-radius: 4px;
        }
        [x-cloak] { display: none; }
   </style>



<div class="bg-white p-2 rounded-lg h-full">
    <div class=" text-gray-700 relative overflow-hidden ">

        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
            <li class="me-2"  id="tab-extension">
                <a href="#" onclick="showTab('extension')" aria-current="page"  class="inline-block p-2 2xl:p-4 rounded-t-lg">Project Extension</a>
            </li>
            <li class="me-2"  id="tab-userextension">
                <a href="#" onclick="showTab('userextension')"  class="inline-block p-2 2xl:p-4 rounded-t-lg">Users Extension Ranking</a>
            </li>

        </ul>

        <div id="extension-content" class="tab-content">
            <livewire:extension-monitoring>
        </div>

        <div id="userextension-content" class="tab-content">
            <livewire:extension-user-rank-monitoring>
        </div>
    </div>
</div>


    <script>

        function openNav() {

            document.getElementById("nav").style.width = "10rem";

        }
        function closeNav() {

            document.getElementById("nav").style.width = "0";
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('SelectedMonitoringExtensions');
            if (storedTab) {
                // Show the stored tab content
                document.getElementById(storedTab + '-content').style.display = 'block';

                // Add 'active' class to the stored tab (if needed)
                document.querySelector('[onclick="showTab(\'' + storedTab + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-' + storedTab).classList.add('active-tab');
            } else {
                // If no stored tab, show the 'narrative-content' by default
                document.getElementById('extension-content').style.display = 'block';

                // Add 'active' class to the 'narrative' tab (if needed)
                document.querySelector('[onclick="showTab(\'extension\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-extension').classList.add('active-tab');
            }
        });

        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Remove 'active' class from all tabs (if needed)
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Remove 'active-tab' class from all <li> elements (if needed)
            document.querySelectorAll('li').forEach(function (li) {
                li.classList.remove('active-tab');
            });

            // Show the selected tab content
            document.getElementById(tabId + '-content').style.display = 'block';

            // Add 'active' class to the clicked tab (if needed)
            document.querySelector('[onclick="showTab(\'' + tabId + '\')"]').classList.add('active');

            // Add 'active-tab' class to the corresponding <li>
            document.getElementById('tab-' + tabId).classList.add('active-tab');

            // Store the selected tab in localStorage
            localStorage.setItem('SelectedMonitoringExtensions', tabId);
        }
    </script>






</x-admin-layout>
