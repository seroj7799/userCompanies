<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all()->where("isDeleted",0);
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
            $validator = $request->validate([
                'name' => 'required|string|max:255',
                'tax_account' => 'required|string',
                'description' => 'required|min:6',
            ]);

        $company = Company::where('tax_account', $request->input('tax_account'))
                            ->where('isDeleted' , 0)
                            ->get();

        if(!$company->isEmpty())
            return redirect()->back()->withErrors(['message' => 'This company already exists']);

        $newCompany = new Company();
            $newCompany->name = $request->input('name');
            $newCompany->description = $request->input('description');
            $newCompany->tax_account = $request->input('tax_account');
            $newCompany->createdBy = Auth::id();
            $newCompany->save();

            return redirect()->route('companies.index')->with('success', 'Company created.');

    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::where('tax_account', $request->input('tax_account'))
            ->where('isDeleted' , 0)
            ->get();

        if(!$company->isEmpty())
            return redirect()->back()->withErrors(['message' => 'This company already exists']);

        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'tax_account' => 'required|string|',
            'description' => 'required|min:6',
        ]);

        $company = Company::findOrFail($id);
        $company->name = $request->input('name');
        $company->description = $request->input('description');
        $company->tax_account = $request->input('tax_account');
        $company->save();
        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Company updated.');

    }

    public function delete($id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->isDeleted = 1;
            $company->save();
            return redirect()->route('companies.index')->with('success', 'Company deleted.');
        } catch (\Exception $e) {
            Log::error('Error in companyController.delete: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return view('error');
        }
    }
}

