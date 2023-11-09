<div class="mt-12 overflow-x-auto 2xl:h-[57vh]">
    <h1 class="text-base tracking-wider">Total of Proposal: {{ $count }}</h1>
  <table class="w-full text-left text-gray-500">
      <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200">
          <tr>
              <th scope="col" class="px-6 py-3 ">Uploaded</th>
              <th scope="col" class="px-6 py-3">Project Title</th>
              <th scope="col" class="px-6 py-3">Uploader</th>
              <th scope="col" class="px-6 py-3"> Status</th>
          </tr>
      </thead>

      <tbody>


          @if ($proposals == null)

          <tr>
              <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Proposal</td>
          </tr>

          @else

              @foreach ($proposals as $proposal )
              @foreach ($proposal->proposal_members as $prop )

              @if ($proposal->id == $prop->proposal_id)

                  <tr class="border-b text-gray-800 bg-white hover:bg-gray-100 text-xs">

                      <td class="px-6 py-4 xl:text-[.6rem] 2xl:text-[.7rem] ">
                          <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                              {{ \Carbon\Carbon::parse($proposal->created_at)->format('l,  F d, Y')}}</td>
                          </a>

                      <th scope="row" class="px-6 py-4 xl:text-[.8rem] font-thin ">
                          <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                              {{ Str::limit($proposal->project_title, 100)}}</th>
                          </a>

                      <td class="px-6 py-4 xl:text-[.6rem] 2xl:text-[.8rem]">
                          <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                              {{ $proposal->user->name}}
                          </a>
                       </td>
                      <td class="px-6 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">
                          <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                      @if ($proposal->authorize == 'pending')
                      <div class="text-md  text-red-400">{{ $proposal->authorize}}</div>
                      @elseif ($proposal->authorize == 'ongoing')
                      <div class="text-md  text-blue-500">{{ $proposal->authorize}}</div>
                      @elseif ($proposal->authorize == 'finished')
                      <div class="text-md  text-green-500">{{ $proposal->authorize}}</div>
                      @endif
                      </a>
                      </td>

                  </tr>
              @endif
              @endforeach
              @endforeach
              @endif
          </tbody>
  </table>
</div>
