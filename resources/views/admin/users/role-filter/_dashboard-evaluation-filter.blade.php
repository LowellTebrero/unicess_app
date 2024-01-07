<div class="flex flex-col mt-2">
    <div class="-m-1.5">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-x-auto h-[32vh] lg:h-[26vh] xl:h-[42.5vh]">
          <table class="min-w-full divide-y divide-gray-200 ">
            <thead>
              <tr>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Period of Evaluation</th>
                <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Total Points</th>
                {{--  <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>  --}}
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">

                @foreach ($evaluations as $evaluation )

                    <tr class="hover:bg-gray-100">

                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-800">
                            <a href={{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $evaluation->created_at]) }} target="__blank">
                                {{ $evaluation->created_at}}
                            </a>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-xs text-center text-gray-800">
                            <a  href={{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $evaluation->created_at]) }} target="__blank">
                               @if ($evaluation->status == 'pending')
                                pending
                               @else
                               validated
                               @endif
                            </a>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-xs text-center text-gray-800">
                            <a  href={{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $evaluation->created_at]) }} target="__blank">
                                {{ $evaluation->period_of_evaluation}}
                            </a>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-xs text-center text-gray-800">
                            <a  href={{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $evaluation->created_at]) }} target="__blank">
                                {{$evaluation->total_points}}
                            </a>
                        </td>
                      </tr>

                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
