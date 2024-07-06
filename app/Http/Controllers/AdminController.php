<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Application, Membership, Type, GroupPractice};
use Carbon\Carbon;

class AdminController extends Controller
{

    public function applications(){
        $new_applications = Application::where('status',0)->OrderBy('updated_at')->get();
        $processing_applications = Application::where('status',1)->OrderBy('updated_at')->get();
        $processed_applications = Application::whereIn('status',[2,3])->OrderByDesc('updated_at')->get();
        return view('admin.applications', compact('new_applications','processing_applications', 'processed_applications'));
    }

    public function application_edit_status(Request $request, $id){
        $application = Application::findOrFail($id);

        $currentStatus = $application->status;

        if ($currentStatus === 0) {
            $application->status = 1;
        } elseif ($currentStatus === 1) {
            $processType = $request->input('processType');
            if ($processType === 'success') {
                $application->status = 2;
            } elseif ($processType === 'declined') {
                $application->status = 3;
            }
        }
        $application->save();

        return redirect()->route('admin.applications');
    }

    public function menu(){
        return view('admin.menu');
    }

    public function memberships(){
        $currentDate = Carbon::now()->toDateString();
        $memberships = Membership::whereDate('paid_until', '>=', $currentDate)->get();
        $expired_memberships = Membership::whereDate('paid_until', '<', $currentDate)->get();

        $memberships->transform(function ($membership) {
            $daysLeft = Carbon::now()->diffInDays($membership->paid_until, false);
            $membership->days_left = $daysLeft;
            $type = Type::find($membership->group->practice->type_id);
            $membership->practice_type_name = $type->name;
            return $membership;
        });

        $expired_memberships->transform(function ($membership) {
            $type = Type::find($membership->group->practice->type_id);
            $membership->practice_type_name = $type->name;
            return $membership;
        });

        return view('admin.memberships', compact('memberships','expired_memberships'));
    }

    public function memberships_view($membership_id){
        $membership = Membership::find($membership_id);
        $type = Type::find($membership->group->practice->type_id);
        $membership->practice_type_name = $type->name;
    
        return view('admin.memberships_view', compact('membership'));
    }

    public function memberships_edit($membership_id){
        $membership = Membership::find($membership_id);

        $groups = GroupPractice::whereHas('memberships', function ($query) {
            $query->selectRaw('group_id, count(*) + 1 as count_memberships')
                  ->groupBy('group_id')
                  ->havingRaw('count_memberships <= group_practices.capacity');
        })->get();

        $groups->transform(function ($group) {
            $type = Type::find($group->practice->type_id);
            $group->practice_type_name = $type->name;
            return $group;
        });
        
        return view('admin.memberships_edit', compact('membership', 'groups'));
    }

    public function memberships_update(Request $request, $membership_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'date_of_birth' => 'required|date|before:today',
            'paid_until' => 'required|date|after:today',
            'group_id' => 'required|exists:group_practices,id',
        ]);

        $membership = Membership::find($membership_id);
        $membership->name = $validated['name'];
        $membership->phone = $validated['phone'];
        $membership->date_of_birth = $validated['date_of_birth'];
        $membership->paid_until = $validated['paid_until'];
        $membership->group_id = $validated['group_id'];
        $membership->save();

        return redirect()->route('admin.memberships_view', ['membership_id' => $membership->id])->with('success', 'Изменения успешно сохранены');
    }

    public function memberships_create($id = null){
        $application = null;

        if ($id !== null) {
            $application = Application::find($id);
        }

        $groups = GroupPractice::whereHas('memberships', function ($query) {
            $query->selectRaw('group_id, count(*) + 1 as count_memberships')
                  ->groupBy('group_id')
                  ->havingRaw('count_memberships <= group_practices.capacity');
        })->get();

        $groups->transform(function ($group) {
            $type = Type::find($group->practice->type_id);
            $group->practice_type_name = $type->name;
            return $group;
        });
        
        return view('admin.memberships_create', compact('groups', 'application'));
    }

    public function memberships_save(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'date_of_birth' => 'required|date|before:today',
            'paid_until' => 'required|date|after:today',
            'group_id' => 'required|exists:group_practices,id',
        ]);

        $membership = new Membership();
        $membership->name = $validated['name'];
        $membership->phone = $validated['phone'];
        $membership->date_of_birth = $validated['date_of_birth'];
        $membership->paid_until = $validated['paid_until'];
        $membership->group_id = $validated['group_id'];
        $membership->save();

        return redirect()->route('admin.memberships_view', ['membership_id' => $membership->id]);
    }

}
