<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $companies = $user->companies;

        if ($companies->count() === 0) {
            return view('no-companies');
        }

        if ($companies->count() === 1) {
            $company = $companies->first();
            return redirect(route('dashboard.switchCompany',$company->tax_account));
//            return view('dashboard', compact('company'));
        }

        return view('select-company', compact('companies'));
    }

    public function switchCompany($tax_account)
    {
        try{
            $company = Company::where('tax_account',$tax_account)->first();
            $company = auth()->user()->companies()->findOrFail($company->id);

            return view('dashboard', compact('company'));
        }catch (\Exception $e) {
            Log::error('Error in userController.switchCompany: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            ]);

            return view('error');
        }

    }

}
