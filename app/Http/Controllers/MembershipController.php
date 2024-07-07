<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Application, Membership, Type, GroupPractice};
use Carbon\Carbon;

class MembershipController extends Controller
{
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

        return view('memberships.memberships_page', compact('memberships','expired_memberships'));
    }

    public function view($membership_id){
        $membership = Membership::find($membership_id);
        $type = Type::find($membership->group->practice->type_id);
        $membership->practice_type_name = $type->name;
    
        return view('memberships.view', compact('membership'));
    }

    public function edit($membership_id){
        $membership = Membership::find($membership_id);

        $groups = GroupPractice::whereDoesntHave('memberships')
        ->orWhereHas('memberships', function ($query) {
            $query->havingRaw('COUNT(*) <= group_practices.capacity');
        })
        ->get();

        $groups->transform(function ($group) {
            $type = Type::find($group->practice->type_id);
            $group->practice_type_name = $type->name;
            return $group;
        });
        
        return view('memberships.edit', compact('membership', 'groups'));
    }

    public function update(Request $request, $membership_id)
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

        return redirect()->route('memberships.view', ['membership_id' => $membership->id])->with('success', 'Изменения успешно сохранены');
    }

    public function create($id = null){
        $application = null;

        if ($id !== null) {
            $application = Application::find($id);
        }

        $groups = GroupPractice::whereDoesntHave('memberships')
        ->orWhereHas('memberships', function ($query) {
            $query->havingRaw('COUNT(*) < group_practices.capacity');
        })
        ->get();

        $groups->transform(function ($group) {
            $type = Type::find($group->practice->type_id);
            $group->practice_type_name = $type->name;
            return $group;
        });
        
        return view('memberships.create', compact('groups', 'application'));
    }

    public function save(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'date_of_birth' => 'required|date|before:today',
            'paid_until' => 'required|date|after:today',
            'group_id' => 'required|exists:group_practices,id',
            'application_id' => 'required',
        ]);

        $membership = new Membership();
        $membership->name = $validated['name'];
        $membership->phone = $validated['phone'];
        $membership->date_of_birth = $validated['date_of_birth'];
        $membership->paid_until = $validated['paid_until'];
        $membership->group_id = $validated['group_id'];
        $membership->save();

        if ($validated['application_id'] != 0) {
            $application = Application::find($validated['application_id']);
            $application->status = 4;
            $application->save();
        }

        return redirect()->route('memberships.view', ['membership_id' => $membership->id]);
    }
}
