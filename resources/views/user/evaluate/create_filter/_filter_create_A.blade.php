<div class="flex xl:flex-col 2xl:flex-row  border-x border-b border-gray-400">

    <div class="w-full border-r border-gray-400 p-10">
        <h1 class=" text-md font-semibold tracking-wider ">I. Administrative Work</h1>
        <div class="mt-8">
        <h1 class="py-4  text-sm font-medium ">1. Chairmanship of Working Committees</h1>
        <div class="mb-4 flex space-x-12">
            <div class="w-full">
                <label class="block text-sm font mb-2" for="username">
                University Wide <span class="text-xs xl:inline-block"> (7 pts. per committee)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  text-sm leading-tight chairmanship_university" name="chairmanship_university" value="4" type="text" onkeypress="return isNumber(event)">
                <input type="file" name="chairmanship_wide[]" class="filepond my-1 text-xs  rounded file:rounded chairmanship_university_file" multiple credits="false" value="" data-filepond>

            </div>

            <div class="w-full">
                <label class="block  text-sm font mb-2" for="username">
                    College/Unit  <span class="text-xs xl:inline-block"> (4 pts. per committee) </span>
                </label>
            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="chairmanship_college" type="text" onkeypress="return isNumber(event)">
            <input type="file" name="chairmanship_unit[]" class="filepond my-1 text-xs rounded file:rounded" multiple credits="false">
            </div>
        </div>
        </div>

        <div class="mt-6">
        <h1 class="py-4  text-sm font-medium">2. Membership in Working Committee</h1>
        <div class="mb-4 flex space-x-12">
            <div class="w-full">
                <label class="block  text-sm font mb-2" for="username">
                University Wide <span class="text-xs xl:inline-block"> (5 pts. per committee)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="membership_university" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="membership_wide[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>

            <div class="w-full">
                <label class="block  text-sm font mb-2" for="username">
                    College/Unit  <span class="text-xs xl:inline-block"> (3 pts. per committee) </span>
                </label>
            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="membership_college" type="text" onkeypress="return isNumber(event)">
            <input type="file" multiple credits="false" name="membership_unit[]" class="filepond my-1 text-xs rounded file:rounded">
        </div>
        </div>
        </div>

        <div class="mt-6 ">
        <h1 class="py-4  text-sm font-medium">3. Advisorship of student organization/special assignment as trainer/coach   <span class="text-xs xl:inline-block"> (5 pts. per assignment)</span></h1>
        <div class="mb-4">
            <div>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="advisorship" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="advisorships[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>

        </div>
        </div>

        <div class="mt-6 ">
        <h1 class="py-4  text-sm font-medium">4. OIC Function (depends on the length of time and what level)   <span class="text-xs xl:block 2xl:inline-block"> (1 pt. fore every 2 cumulative days)</span> </h1>
        <div class="mb-4">
            <div>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="oic" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="oics[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>

        </div>
        </div>

        <div class="mt-6 ">
        <h1 class="py-4  text-sm font-medium">5. Judge  </h1>
        <div class="mb-4 ">
            <div>
                <label class="block  text-sm font mb-2" for="username">
                    Note: Only-extra-curricular activities which are academic in nature (e.g., debates, orations, quiz shows)
                 <span class="text-xs"> (3 pts.)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="judge" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="judges[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>

        </div>
        </div>
    </div>

    <div class="w-full p-10 ">
        <h1 class="text-md font-semibold tracking-wider">II. Institution Building</h1>

        <div class="mt-8 ">
        <h1 class="py-4  text-sm font-medium">1. Resource generation (eg. endowment, scholarships
            professional chair, acquisition of assorted books, and/or
            substantial library collection, equipment, etc)</h1>
        <div class="mb-4 ">
            <div class="w-full">
                <label class="block  text-sm font mb-2" for="username">
                 <span class="text-xs"> (1 point for every Php 10,000.00 worth of resource generated)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  text-sm leading-tight" name="resource" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="resource_generation[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>


        </div>
        </div>

        <div class="mt-6 ">
        <h1 class="py-4  text-sm font-medium">2.  Chairmanship/membership in local, regional, national,
            international committee etc., representing the
            University or within the University
            (eg, policy paper, curriculum development, etc)
        </h1>
        <div class="mb-4">
            <div class="w-full">
                <label class="block  text-sm font mb-2" for="username">
                <span class="text-xs"> (5 pts. per committee)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="chairmanship_membership" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="chairmanship[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>
        </div>
        </div>

        <div class="mt-6 ">
        <h1 class="py-4 text-sm font-medium">3. Facilitation of Linkages  </h1>
        <div class="mb-4">
            <div class="mb-4">
                <label class="block  text-sm font mb-2" for="username">
                 On-going <span class="text-xs"> (1 pl. per linkage)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_on_going" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="facilitation_ongoing[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>
            <div class="mb-4">
                <label class="block  text-sm font mb-2" for="username">
                Regional <span class="text-xs">  (3 pts per linkage) </span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_regional" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="facilitation_regional[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>
            <div class="mb-4">
                <label class="block  text-sm font mb-2" for="username">
                    National  <span class="text-xs"> (6 pts per linkage)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_national" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="facilitation_national[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>
            <div>
                <label class="block  text-sm font mb-2" for="username">
                    International <span class="text-xs"> (11 pts per linkage)</span>
                </label>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_international" type="text" onkeypress="return isNumber(event)">
                <input type="file" multiple credits="false" name="facilitation_international[]" class="filepond my-1 text-xs rounded file:rounded">
            </div>

        </div>
        </div>
    </div>
</div>



