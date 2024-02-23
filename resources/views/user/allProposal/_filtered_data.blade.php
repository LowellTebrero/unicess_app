

    <style>
        .ui-bookmark {
        --icon-size: 24px;
        --icon-secondary-color: rgb(77, 77, 77);
        --icon-hover-color: rgb(97, 97, 97);
        --icon-primary-color: rgb(252, 54, 113);
        --icon-circle-border: 1px solid var(--icon-primary-color);
        --icon-circle-size: 35px;
        --icon-anmt-duration: 0.3s;
      }

      .ui-bookmark input {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        display: none;
      }

      .ui-bookmark .bookmark {
        width: var(--icon-size);
        height: auto;
        fill: var(--icon-secondary-color);
        cursor: pointer;
        -webkit-transition: 0.2s;
        -o-transition: 0.2s;
        transition: 0.2s;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        position: relative;
        -webkit-transform-origin: top;
        -ms-transform-origin: top;
        transform-origin: top;
      }

      .bookmark::after {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        -webkit-box-shadow: 0 30px 0 -4px var(--icon-primary-color),
          30px 0 0 -4px var(--icon-primary-color),
          0 -30px 0 -4px var(--icon-primary-color),
          -30px 0 0 -4px var(--icon-primary-color),
          -22px 22px 0 -4px var(--icon-primary-color),
          -22px -22px 0 -4px var(--icon-primary-color),
          22px -22px 0 -4px var(--icon-primary-color),
          22px 22px 0 -4px var(--icon-primary-color);
        box-shadow: 0 30px 0 -4px var(--icon-primary-color),
          30px 0 0 -4px var(--icon-primary-color),
          0 -30px 0 -4px var(--icon-primary-color),
          -30px 0 0 -4px var(--icon-primary-color),
          -22px 22px 0 -4px var(--icon-primary-color),
          -22px -22px 0 -4px var(--icon-primary-color),
          22px -22px 0 -4px var(--icon-primary-color),
          22px 22px 0 -4px var(--icon-primary-color);
        border-radius: 50%;
        -webkit-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
        padding: 1px;
      }

      .bookmark::before {
        content: "";
        position: absolute;
        border-radius: 50%;
        border: var(--icon-circle-border);
        opacity: 0;
      }

      /* actions */

      .ui-bookmark:hover .bookmark {
        fill: var(--icon-hover-color);
      }

      .ui-bookmark input:checked + .bookmark::after {
        -webkit-animation: circles var(--icon-anmt-duration)
          cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        animation: circles var(--icon-anmt-duration)
          cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        -webkit-animation-delay: var(--icon-anmt-duration);
        animation-delay: var(--icon-anmt-duration);
      }

      .ui-bookmark input:checked + .bookmark {
        fill: var(--icon-primary-color);
        -webkit-animation: bookmark var(--icon-anmt-duration) forwards;
        animation: bookmark var(--icon-anmt-duration) forwards;
        -webkit-transition-delay: 0.3s;
        -o-transition-delay: 0.3s;
        transition-delay: 0.3s;
      }

      .ui-bookmark input:checked + .bookmark::before {
        -webkit-animation: circle var(--icon-anmt-duration)
          cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        animation: circle var(--icon-anmt-duration)
          cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        -webkit-animation-delay: var(--icon-anmt-duration);
        animation-delay: var(--icon-anmt-duration);
      }

      @-webkit-keyframes bookmark {
        50% {
          -webkit-transform: scaleY(0.6);
          transform: scaleY(0.6);
        }

        100% {
          -webkit-transform: scaleY(1);
          transform: scaleY(1);
        }
      }

      @keyframes bookmark {
        50% {
          -webkit-transform: scaleY(0.6);
          transform: scaleY(0.6);
        }

        100% {
          -webkit-transform: scaleY(1);
          transform: scaleY(1);
        }
      }

      @-webkit-keyframes circle {
        from {
          width: 0;
          height: 0;
          opacity: 0;
        }

        90% {
          width: var(--icon-circle-size);
          height: var(--icon-circle-size);
          opacity: 1;
        }

        to {
          opacity: 0;
        }
      }

      @keyframes circle {
        from {
          width: 0;
          height: 0;
          opacity: 0;
        }

        90% {
          width: var(--icon-circle-size);
          height: var(--icon-circle-size);
          opacity: 1;
        }

        to {
          opacity: 0;
        }
      }

      @-webkit-keyframes circles {
        from {
          -webkit-transform: scale(0);
          transform: scale(0);
        }

        40% {
          opacity: 1;
        }

        to {
          -webkit-transform: scale(0.8);
          transform: scale(0.8);
          opacity: 0;
        }
      }

      @keyframes circles {
        from {
          -webkit-transform: scale(0);
          transform: scale(0);
        }

        40% {
          opacity: 1;
        }

        to {
          -webkit-transform: scale(0.8);
          transform: scale(0.8);
          opacity: 0;
        }
      }


        .hover .img:hover {
            transform: scale(1.2); /* Adjust the scale factor as needed */
            transition: transform 0.7s ease-in-out; /* Add transition for smooth scaling */
        }

    </style>

    <main class="rounded-lg m-5 overflow-x-auto h-[60] 2xl:h-[75vh]">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4">
            @foreach ($proposals as $proposal )

                <div class="max-w-md bg-white h-full border border-gray-200 rounded-lg shadow hover overflow-hidden">
                    <div class="overflow-hidden">

                        <a href={{ route('allProposal.show', $proposal->id) }}>
                        @foreach ($proposal->AdminProgram as $adminProgram)
                        <img class="rounded-t-lg img h-[25vh] w-full object-cover"
                        src="{{!empty($adminProgram->image) ? url('upload/image-folder/program-services-folder/' . $adminProgram->image) : url('upload/CESO.png') }}">
                        @endforeach

                            {{--  <img class="rounded-t-lg img"  src="{{  url('upload/CESO.png') }}" alt="" />  --}}
                        </a>
                    </div>

                    <div class="p-5 flex flex-col  justify-between h-[40%]">

                        <div class=" h-full">
                            <h5 class="text-sm 2xl:text-lg font-semibold tracking-tight text-gray-600 ">{{ Str::limit($proposal->project_title, 70)}}</h5>
                             {{--  <p class="mb-4 font-normal text-gray-400 text-xs">Here are the biggest enterprise technology acquisitions</p>  --}}
                        </div>

                        <div class="h-full pt-7 flex justify-between items-center ">

                            <div class="flex space-x-2 justify-center">

                                <img class="rounded-full"
                                src="{{!empty($proposal->user->avatar) ? url('upload/image-folder/profile-image/' . $proposal->user->avatar) : url('upload/profile.png') }}"
                                width="30" height="20">

                                <div class="text-gray-400">
                                    <h1 class="text-xs">{{ $proposal->user->first_name }}</h1>
                                    <h1 class="text-[.7rem]"> {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, Y ') }}</h1>
                                </div>
                            </div>

                            <div class="flex space-x-2 justify-center items-center">
                                <form id="likeForm_{{ $proposal->id }}" action="{{ route('proposal.like', ['proposal' => $proposal->id]) }}" method="POST">
                                    @csrf
                                    <label class="ui-bookmark">
                                        <!-- Use the proposal ID to make the input field ID unique -->
                                        <input id="likeCheckbox_{{ $proposal->id }}" type="checkbox" name="like" {{ $proposal->isLikedBy(auth()->id()) ? 'checked' : '' }}>
                                        <div class="bookmark">
                                            <svg viewBox="0 0 16 16" style="margin-top:4px" class="bi bi-heart-fill" height="25" width="25" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" fill-rule="evenodd"></path>
                                            </svg>
                                        </div>

                                    </label>
                                </form>
                                <!-- Display the like count next to the input field -->
                                <span class="text-gray-400 text-xs font-medium" id="likeCount_{{ $proposal->id }}">{{ $proposal->likes()->count() }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>


    </main>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle checkbox change event for all checkboxes whose ID starts with 'likeCheckbox_'
            $('[id^=likeCheckbox_]').change(function() {
                // Get the proposal ID from the checkbox ID
                var proposalId = $(this).attr('id').split('_')[1];
                // Form selector for the current proposal
                var formSelector = '#likeForm_' + proposalId;
                // Submit the form asynchronously
                $.ajax({
                    type: 'POST',
                    url: $(formSelector).attr('action'),
                    data: $(formSelector).serialize(),
                    success: function(response) {
                        // Fetch and update like count for the current proposal
                        fetchLikeCount(proposalId);
                        // Optionally, you can display a message if needed
                        console.log(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        // Function to fetch total like count for a specific proposal
        function fetchLikeCount(proposalId) {
            $.ajax({
                type: 'GET',
                url: '/proposals/' + proposalId + '/like-count',
                success: function(response) {
                    // Update the like count for the current proposal
                    $('#likeCount_' + proposalId).text(response.count);
                    console.log("Like count updated for proposal " + proposalId + ": " + response.count);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Initial fetch of total like count for all proposals
        $('[id^=likeCheckbox_]').each(function() {
            var proposalId = $(this).attr('id').split('_')[1];
            fetchLikeCount(proposalId);
        });

    </script>
