<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Application};

class AdminController extends Controller
{
    public function admin_dash(){
        $new_applications = Application::where('status',0)->OrderBy('updated_at')->get();
        $processing_applications = Application::where('status',1)->OrderBy('updated_at')->get();
        $processed_applications = Application::whereIn('status',[2,3])->OrderByDesc('updated_at')->get();
        return view('admin.dash', compact('new_applications','processing_applications', 'processed_applications'));
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

        return redirect()->route('admin.dash');
    }
}
