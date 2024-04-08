<style>
    .bg-image {
        background-image: linear-gradient(to right, rgb(4, 46, 139), rgba(4, 47, 139, 0.918),rgba(4, 47, 139, 0.781), rgba(63, 92, 254, 0.575)), url('/img/about-bg.jpg');
        background-position: right;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<section class="bg-image h-[40vh] flex items-center flex-col justify-center mb-10 gap-12 text-white">
    <h1 class="text-2xl tracking-wider font-semibold">FACTS AND FIGURES</h1>
    <div class="flex gap-16">
        <div class="flex items-center flex-col justify-center gap-2">
            <h1 id="projectCount" class="text-[4rem] font-medium">0</h1>
            <h4>Total Extension Project</h4>
        </div>

        <div class="flex items-center flex-col justify-center gap-2">
            <h1 id="activeProjectCount" class="text-[4rem] font-medium">0</h1>
            <h4>Active Extension Project</h4>
        </div>

    </div>
</section>



<script>
    // Get the total project count from Blade variable
    const totalProject = {{ $totalProject }};
    // Get the element where the count will be displayed
    const projectCountElement = document.getElementById('projectCount');
    // Function to update the count with animation
    function updateCount(count) {
        // Interval time for each increment (in milliseconds)
        const intervalTime = 50;
        // Increment value for each interval
        const increment = Math.ceil(count / (4000 / intervalTime)); // 5000 milliseconds for 5 seconds animation
        // Variable to hold the current count
        let currentCount = 0;
        // Timer function to increment the count with animation
        const timer = setInterval(() => {
            currentCount += increment;
            // Update the count in the HTML element
            projectCountElement.textContent = currentCount.toLocaleString();
            // If reached or exceeded the total project count, clear the timer
            if (currentCount >= count) {
                clearInterval(timer);
                projectCountElement.textContent = count.toLocaleString();
            }
        }, intervalTime);
    }
    // Call the updateCount function with the total project count
    updateCount(totalProject);
</script>



<script>
    // Get the active project count from Blade variable
    const activeProject = {{ $ActiveProject }};
    // Get the element where the count will be displayed
    const activeProjectCountElement = document.getElementById('activeProjectCount');
    // Function to update the count with animation
    function updateActiveProjectCount(count) {
        // Interval time for each increment (in milliseconds)
        const intervalTime = 50;
        // Increment value for each interval
        const increment = Math.ceil(count / (5000 / intervalTime)); // 5000 milliseconds for 5 seconds animation
        // Variable to hold the current count
        let currentCount = 0;
        // Timer function to increment the count with animation
        const timer = setInterval(() => {
            currentCount += increment;
            // Update the count in the HTML element
            activeProjectCountElement.textContent = currentCount.toLocaleString();
            // If reached or exceeded the total active project count, clear the timer
            if (currentCount >= count) {
                clearInterval(timer);
                activeProjectCountElement.textContent = count.toLocaleString();
            }
        }, intervalTime);
    }
    // Call the updateActiveProjectCount function with the total active project count
    updateActiveProjectCount(activeProject);
</script>
