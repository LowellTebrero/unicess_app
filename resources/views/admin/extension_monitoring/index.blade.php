<x-admin-layout>

    <style>
        .active-tab {
               /* Add your active styles here */
               background-color: #999999;
               color: #ffffff;
               border-top-left-radius: 4px;
               border-top-right-radius: 4px;
        }
        .active-user {
               /* Add your active styles here */
               background-color: #eeeeee;
               color: #ffffff;
               border-top-left-radius: 4px;
               border-top-right-radius: 4px;
        }
        [x-cloak] { display: none; }
   </style>



    <div class="bg-white p-2 rounded-lg h-full">
        <div class=" text-gray-700 relative overflow-hidden">

            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
                <li class="me-2"  id="tab-extension">
                    <a href="#" onclick="showTab('extension')" aria-current="page"  class="inline-block p-2 2xl:p-4 rounded-t-lg">Project Extension</a>
                </li>
                <li class="me-2"  id="tab-userextension">
                    <a href="#" onclick="showTab('userextension')"  class="inline-block p-2 2xl:p-4 rounded-t-lg">Users Extensions Report</a>
                </li>

            </ul>

            <a href="{{ route('admin.dashboard.create') }}" class="bg-blue-400 hover:bg-blue-600 text-white rounded-lg py-1 px-2 absolute top-0 right-0 text-sm">+ Upload Project</a>

            <div id="extension-content" class="tab-content">
                <livewire:extension-monitoring>
            </div>

            <div id="userextension-content" class="tab-content mt-2">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 ">
                    <li class="me-2"  id="user-subuserextension">
                        <a href="#" onclick="showCad('subuserextension')"  class="inline-block p-2 2xl:p-4 rounded-t-lg text-xs text-gray-500">With Project Extension</a>
                    </li>
                    <li class="me-2"  id="user-subnoneuserextension">
                        <a href="#" onclick="showCad('subnoneuserextension')"  class="inline-block p-2 2xl:p-4 rounded-t-lg text-xs text-gray-500">No Project Extension</a>
                    </li>
                </ul>

                <div id="subuserextension-content" class="user-content border border-gray-400">
                    <livewire:extension-user-rank-monitoring>
                </div>

                <div id="subnoneuserextension-content" class="user-content border border-gray-400">
                    <livewire:extension-non-user-rank-monitoring>
                </div>


            </div>

        </div>
    </div>


    <script>


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



        document.addEventListener("DOMContentLoaded", function() {
            // Hide all cad contents
            document.querySelectorAll('.user-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored cad in localStorage
            var storedCad = localStorage.getItem('SelectedSubMonitoringExtensions');
            if (storedCad) {
                // Show the stored cad content
                document.getElementById(storedCad + '-content').style.display = 'block';

                // Add 'active' class to the stored cad (if needed)
                document.querySelector('[onclick="showCad(\'' + storedCad + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('user-' + storedCad).classList.add('active-user');
            } else {
                // If no stored cad, show the 'narrative-content' by default
                document.getElementById('subuserextension-content').style.display = 'block';

                // Add 'active' class to the 'narrative' cad (if needed)
                document.querySelector('[onclick="showCad(\'subuserextension\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('user-subuserextension').classList.add('active-user');
            }
        });

        function showCad(cadId) {
            // Hide all cad contents
            document.querySelectorAll('.user-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Remove 'active' class from all cads (if needed)
            document.querySelectorAll('.user').forEach(function (cad) {
                cad.classList.remove('active');
            });

            // Remove 'active-cad' class from all <li> elements (if needed)
            document.querySelectorAll('li').forEach(function (li) {
                li.classList.remove('active-user');
            });

            // Show the selected cad content
            document.getElementById(cadId + '-content').style.display = 'block';

            // Add 'active' class to the clicked cad (if needed)
            document.querySelector('[onclick="showCad(\'' + cadId + '\')"]').classList.add('active');

            // Add 'active-cad' class to the corresponding <li>
            document.getElementById('user-' + cadId).classList.add('active-user');

            // Store the selected cad in localStorage
            localStorage.setItem('SelectedSubMonitoringExtensions', cadId);
        }

    </script>






</x-admin-layout>
