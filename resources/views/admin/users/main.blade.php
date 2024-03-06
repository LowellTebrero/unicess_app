<x-admin-layout>

    <style>
        @media screen and (max-width: 767px) {
            .navoption1 {
                display: none;
            }
            .navoption2 {
                display: block;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 1536px) {
            .navoption1 {
                display: block;
            }
            .navoption2 {
                display: none;
            }

        }

    </style>

    @section('title', 'Accounts | ' . config('app.name', 'UniCESS'))
    <div class="h-full">
        <livewire:user-show>
    </div>




</x-admin-layout>
