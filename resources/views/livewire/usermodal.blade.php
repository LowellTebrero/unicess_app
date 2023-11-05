@php
$faculty_extensionist = Spatie\Permission\Models\Role::whereIn('name', ['Faculty extensionist'])->get();
$extenionist_coordinator = Spatie\Permission\Models\Role::whereIn('name', ['Extension coordinator'])->get();
$partners = Spatie\Permission\Models\Role::whereIn('name', ['Partners/Linkages'])->get();
$beneficiary = Spatie\Permission\Models\Role::whereIn('name', ['Beneficiary'])->get();
$faculties = App\Models\Faculty::orderBy('name')->pluck('name', 'id');
@endphp




<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="userModalLabel">Add User Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="saveUser">
      <div class="modal-body">

        <div class="flex mb-3 space-x-3">


            <div class="w-full">
                <label for="">First Name</label>
                <input type="text" wire:model="first_name" class ="form-control rounded-md">
                @error('first_name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="">Middle Name</label>
                <input type="text" wire:model="middle_name" class ="form-control rounded-md">
                @error('middle_name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="">Last Name</label>
                <input type="text" wire:model="last_name" class ="form-control rounded-md">
                @error('last_name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
            </div>


        </div>
        <div class="mb-3">
            <label for="">Gender</label>
            <input type="text" wire:model="gender" class ="form-control rounded-md">
            @error('gender') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" wire:model="email" class ="form-control rounded-md">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Address</label>
            <input type="text" wire:model="address" class ="form-control rounded-md">
            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Contact Number</label>
            <input type="text" wire:model="contact_number" class ="form-control rounded-md">
            @error('contact_number') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">

            <label for="">Role</label>
            <select onchange="yesnoCheck(this);" wire:model="role"  id="role"  class ="form-control rounded-md" type="text" name="role" :value="old('role')" required autofocus autocomplete="role">
                <option disabled selected value="disabled">Register as:</option>
                @foreach ($faculty_extensionist as $fac_ext )
                <option    value="Faculty extensionist" {{ $fac_ext->name }} > {{ $fac_ext->name }}</option>
                @endforeach
                @foreach ($extenionist_coordinator as $ext_coor )
                <option value="Extension coordinator" {{ $ext_coor->name }} > {{ $ext_coor->name }}</option>
                @endforeach
                @foreach ($partners as $partner )

                <option type="button" wire:click="unshowChange" value="Partners/Linkages"  {{ $partner->name }} > {{ $partner->name }}</option>
                @endforeach
                @foreach ($beneficiary as $benefits )
                <option value="Beneficiary" {{ $benefits->name }}  > {{ $benefits->name }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="">Faculty</label>
            <select id="faculty_id"  wire:model="faculty_id" class="form-control rounded-md" type="text" name="faculty_id" :value="old('faculty_id')"  autofocus autocomplete="faculty_id">
                <option disabled selected="" >Select Faculty:</option>
                @foreach ($faculties as $id => $name )
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('faculty_id') <span class="text-red-500">{{ $message }}</span> @enderror


        </div>
        <div class="w-full" id="beneficiaries"  style="display: none;" value= ""></div>
        <div class="w-full" id="partners"  style="display: none;" value= ""></div>


        <div class="mb-3">
            <label for="">Password</label>
            <input type="password" wire:model="password" class ="form-control rounded-md">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Confirm password</label>
            <input type="password" wire:model="confirm_password" class ="form-control rounded-md">
            @error('confirm_password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
      </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary bg-red-500"  wire:click="closeModal" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary bg-blue-500">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>




<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Edit Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="updateUser">
      <div class="modal-body">

        <div class="flex mb-3 space-x-3">
            <div class="w-full">
                <label for="">First Name</label>
                <input type="text" wire:model="first_name" class ="form-control rounded-md">
                @error('first_name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="">Middle Name</label>
                <input type="text" wire:model="middle_name" class ="form-control rounded-md">
                @error('middle_name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="">Last Name</label>
                <input type="text" wire:model="last_name" class ="form-control rounded-md">
                @error('last_name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
            </div>


        </div>
        <div class="mb-3">
            <label for="">Gender</label>
            <input type="text" wire:model="gender" class ="form-control rounded-md">
            @error('gender') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" wire:model="email" class ="form-control rounded-md">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Address</label>
            <input type="text" wire:model="address" class ="form-control rounded-md">
            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Contact Number</label>
            <input type="text" wire:model="contact_number" class ="form-control rounded-md">
            @error('contact_number') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Password</label>
            <input type="password" wire:model="password" class ="form-control rounded-md">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Confirm password</label>
            <input type="password" wire:model="confirm_password" class ="form-control rounded-md">
            @error('confirm_password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
      </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary bg-red-500" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary bg-blue-500">Update User</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteUserModalLabel">Delete User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="destroyUser">
      <div class="modal-body">
            <h4>Are you sure ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary bg-red-500" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary bg-blue-500">Yes, Delete</button>
      </div>
    </form>
    </div>
  </div>
</div>

























    <script>

        function yesnoCheck(that) {
            if (that.value == 'Faculty extensionist') {
                console.log("faculty-check");
                document.getElementById("faculties").style.display = "block";
                document.getElementById("partner").style.display = "none";
                document.getElementById("beneficiaries").style.display = "none";

                var fac = document.getElementById("faculty_id").value == 'Select Faculty';
                console.log(fac);


                }else if (that.value == "Extension coordinator") {
                console.log("partners-check");
                document.getElementById("faculties").style.display = "block";
                document.getElementById("partner").style.display = "none";
                document.getElementById("beneficiaries").style.display = "none";

                }else if (that.value == "Partners/Linkages") {
                console.log("partners-check");
                document.getElementById("partners").style.display = "block";
                document.getElementById("faculties").style.display = "none";
                document.getElementById("beneficiaries").style.display = "none";

                var part = document.getElementById("faculty_id").value = null;
                console.log(part);

                }else if (that.value == "Beneficiary") {
                console.log("beneficiary-check");
                document.getElementById("beneficiaries").style.display = "block";
                document.getElementById("faculties").style.display = "none";
                document.getElementById("partners").style.display = "none";

                var fac = document.getElementById("faculty_id").value = null;
                console.log(fac);
                }
            }

    </script>
