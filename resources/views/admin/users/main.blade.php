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
       
        </style>

    @section('title', 'Accounts | ' . config('app.name', 'UniCESS'))
    <div>
        <livewire:user-show>
    </div>


    

</x-admin-layout>
