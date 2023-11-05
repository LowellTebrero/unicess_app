<div class="flex flex-col mt-2">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200 ">
            <thead>
              <tr>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploaded</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                {{--  <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>  --}}
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">

                @foreach ($proposals as $proposal )
                @foreach ($proposal->proposal_members as $prop )
                    @if ($proposal->id == $prop->proposal_id)

                    <tr class="hover:bg-gray-100 ">
                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-800">
                            <a href={{route('admin.inventory.proposal-show', $proposal->id)}} target="__blank">
                                {{ $proposal->created_at->diffForHumans()}}
                            </a>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-800">
                            <a href={{route('admin.inventory.proposal-show', $proposal->id)}} target="__blank">
                                {{ Str::limit($proposal->project_title, 110)}}
                            </a>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-800">
                            <a href={{route('admin.inventory.proposal-show', $proposal->id)}} target="__blank">
                                {{ $proposal->authorize}}
                            </a>
                        </td>
                      </tr>
                      @endif
                    @endforeach
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
