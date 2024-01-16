<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Proposal;
use App\Models\AdminYear;
use App\Models\Evaluation;
use App\Models\UserFaculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\CustomizeAdminUserData;
use App\Notifications\UserAuthorizeNotification;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserFollowNotification;

class UserController extends Controller
{

    public function mainIndex()
    {
        return view ('admin.users.main');
    }

    public function show(User $user, $user_id)
    {

        $unreadNotifications = auth()->user()->unreadNotifications;

        foreach ($unreadNotifications as $notification) {
            $data = $notification->data;

            // Check if 'user_id' exists in the array and if it matches the provided $user_id
            if (isset($data['user_id']) && $data['user_id'] == $user_id) {
                // Mark the notification as read
                $notification->markAsRead();
            }
        }

        if($user_id){
            auth()->user()->unreadNotifications->where('id', $user_id)->markAsRead();
        }

        $toggle = User::where('id', $user->id)->first();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $customs = CustomizeAdminUserData::where('id', 1)->get();
        $evaluations = Evaluation::orderBy('created_at', 'DESC')->where('user_id', $user->id)->whereYear('created_at', date('Y'))->get();
        $proposals = Proposal::with(['proposal_members' => function ($query) use ($user) {
        $query->where('user_id', $user->id);
        }])->whereYear('created_at', date('Y'))->orderBy('created_at', 'DESC')->get();



        return view ('admin.users.role', compact('user',  'toggle', 'proposals', 'years', 'customs', 'evaluations'));
    }


    public function UserSearch(Request $request)
    {
        $users = User::where('first_name', 'like', '%'.$request->search_string. '%')
        ->orWhere('middle_name', 'like', '%' .$request->search_string. '%')
        ->orderBy('id', 'desc');

        if($users->count() >= 1){
            return view('admin.users.index', compact('users'))->render();
        }else {
            return response()->json([
                'status' => 'nothing found',

            ]);
        }
    }


    public function destroy(User $user)
    {
        if($user->hasRole('admin')){
            return back()->with('message', 'This has been admin');
        }
        $user->delete();

        return redirect(route('admin.users.main'))->with('message', 'Role has been deleted');

    }




    public function updateSystem(Request $request, $id)
    {
        // Find the record in the database
        $toggle = User::findOrFail($id);

        // Toggle the data in the table based on the current state
        $toggle->update([
            'authorize' => $request->input('state') ? 'checked' : 'close',
        ]);

        $users = User::where('id', $id)->get();

        Notification::send($users, new UserAuthorizeNotification($toggle));



        return response()->json(['success' => true]);

    }


    public function assignRole(Request $request , User $user)
    {
        if($user->hasRole($request->role)){
            return back()->with('message', 'Role exists.');
        }
        $user->assignRole($request->role);
        return back()->with('message', 'Role added.');
    }


    public function removeRole(User $user, Role $role)
    {
        if($user->hasRole($role)){
            ($user->removeRole($role));
            return back()->with('message', 'Role removed');
        }
        return back()->with('message', 'Role exists');
    }



    public function givePermission(Request $request , User $user)
    {
        if($user->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if($user->hasPermissionTo($permission)){
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoke successfully.');
        }
        return back()->with('message', 'Permission revoke not exist.');


    }


    public function search(Request $request, $id)
    {
        $query = $request->input('query');
        $toggle = User::where('id', $id)->first();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

        $proposals = Proposal::
            where(function ($query) {
                if($status = request('status')){
                    $query->where('authorize', $status);
                        }})
            ->where(function ($query) {
                if($years = request('years')){
                    $query->whereYear('created_at', $years);
                        }})
            ->when($query, function ($querys) use ($query) {
                return $querys->where('project_title', 'like', "%$query%");
                    })->with(['proposal_members' => function ($query) use ($id) {
                        $query->where('user_id', $id);
            }])->orderBy('created_at', 'DESC')->get();

        return view ('admin.users.role-filter._dashboard-proposal-filter', compact('toggle', 'proposals', 'years'));
    }

    public function FilterEvaluationYear($id)
    {
        $toggle = User::where('id', $id)->first();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

        $evaluations = Evaluation::
            where(function ($query) {
                if($status = request('status')){
                    $query->where('status', $status);
                        }})
            ->where(function ($query) {
                if($years = request('years')){
                    $query->whereYear('created_at', $years);
                        }})
            ->where('user_id', $id)->get();

        return view ('admin.users.role-filter._dashboard-evaluation-filter', compact('toggle', 'evaluations', 'years'));
    }

    public function FilterEvaluationStatus($id)
    {

        $toggle = User::where('id', $id)->first();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

        $evaluations = Evaluation::
                where(function ($query) {
                if($years = request('years')){
                    $query->whereYear('created_at', $years);
                }})
                ->where(function ($query) {
                if($status = request('status')){
                    $query->where('status', $status);
                }})

            ->where('user_id', $id)->get();

        return view ('admin.users.role-filter._dashboard-evaluation-filter', compact('toggle', 'evaluations', 'years'));
    }


    public function customize(Request $request, $id){
        // Find the model instance you want to update
        $model = CustomizeAdminUserData::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Update the model attributes based on the dropdown value
        $model->number = $request->input('customize');
        $model->save();

        return response()->json(['message' => 'Data updated successfully']);
        }

}
