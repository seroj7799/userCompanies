<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::where(['role_id' => '2'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function blockUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_blocked = !$user->is_blocked;
            $user->save();
            return redirect()->back()->with('success', 'User status updated.');
        } catch (\Exception $e) {
            Log::error('Error in adminController.blockUser: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return view('error');
        }
    }

    public function showAssignedCompany($id)
    {
        $user = User::with('companies')->findOrFail($id);
        $companies = Company::where('isDeleted',0)->get();
        return view('admin.users.showAssignedCompany', compact('user', 'companies'));
    }

    public function addCompanyOnUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $createdBy = Auth::guard('admin')->id();

            DB::table('user_companies')->insert(
                [   'user_id' => $id,
                    'company_id' => $request->companyId,
                    'createdBy' => $createdBy,
                ]
            );
            return response()->json(['message' => 'Company assign successfully!']);

        } catch (\Exception $e) {
            Log::error('Error in adminController.addCompanyOnUser: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json(['message' => 'Something went wrong']);
        }

    }

    public function deleteCompanyOnUser(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            DB::table('user_companies')->where([
                'company_id' => $request->companyId,
                'user_id' => $id
            ])->delete();

            return response()->json(['message' => 'Company deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error in adminController.deleteCompanyOnUser: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json(['message' => 'Something went wrong']);
        }

    }
}
