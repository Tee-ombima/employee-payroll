<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deductions = Deduction::all();
        return view('deductions.index', compact('deductions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deductions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'is_percentage' => 'sometimes|boolean'
        ]);

        // Set default for checkbox if not submitted
        $validated['is_percentage'] = $request->has('is_percentage');

        Deduction::create($validated);

        return redirect()->route('deductions.index')
            ->with('success', 'Deduction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deduction $deduction)
    {
        return view('deductions.show', compact('deduction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deduction $deduction)
    {
        return view('deductions.edit', compact('deduction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deduction $deduction)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'is_percentage' => 'sometimes|boolean'
        ]);

        // Set default for checkbox if not submitted
        $validated['is_percentage'] = $request->has('is_percentage');

        $deduction->update($validated);

        return redirect()->route('deductions.index')
            ->with('success', 'Deduction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deduction $deduction)
    {
        $deduction->delete();

        return redirect()->route('deductions.index')
            ->with('success', 'Deduction deleted successfully.');
    }
}