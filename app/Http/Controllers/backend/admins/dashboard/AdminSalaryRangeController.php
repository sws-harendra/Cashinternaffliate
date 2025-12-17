<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\SalaryRange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSalaryRangeController extends Controller
{
     /**
     * Display a listing of salary ranges.
     */
    public function index()
    {
        $ranges = SalaryRange::latest()->paginate(20);

        return view(
            'backend.admins.pages.salary_ranges.index',
            compact('ranges')
        );
    }

    /**
     * Show the form for creating a new salary range.
     */
    public function create()
    {
        return view('backend.admins.pages.salary_ranges.create');
    }

    /**
     * Store a newly created salary range.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label'      => 'required|string|max:100|unique:salary_ranges,label',
            'min_salary' => 'nullable|integer|min:0',
            'max_salary' => 'nullable|integer|gte:min_salary',
            'is_active'  => 'required|boolean',
        ]);

        SalaryRange::create([
            'label'      => $request->label,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'is_active'  => $request->is_active,
        ]);

        return redirect()
            ->route('admins.salary-ranges.index')
            ->with('success', 'Salary range created successfully.');
    }

    /**
     * Show the form for editing the specified salary range.
     */
    public function edit(SalaryRange $salaryRange)
    {
        return view(
            'backend.admins.pages.salary_ranges.edit',
            compact('salaryRange')
        );
    }

    /**
     * Update the specified salary range.
     */
    public function update(Request $request, SalaryRange $salaryRange)
    {
        $request->validate([
            'label'      => 'required|string|max:100|unique:salary_ranges,label,' . $salaryRange->id,
            'min_salary' => 'nullable|integer|min:0',
            'max_salary' => 'nullable|integer|gte:min_salary',
            'is_active'  => 'required|boolean',
        ]);

        $salaryRange->update([
            'label'      => $request->label,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'is_active'  => $request->is_active,
        ]);

        return redirect()
            ->route('admins.salary-ranges.index')
            ->with('success', 'Salary range updated successfully.');
    }

    /**
     * Remove the specified salary range.
     */
    public function destroy(SalaryRange $salaryRange)
    {
        $salaryRange->delete();

        return redirect()
            ->route('admins.salary-ranges.index')
            ->with('success', 'Salary range deleted successfully.');
    }
}
