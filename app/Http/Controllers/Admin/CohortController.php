<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_page_title = 'Cohorts';
        $items = Cohort::paginate($this->itemPerPage);

        $sl = SLGenerator($items);
        return view('admin.cohort.index', compact('sl', 'items', 'admin_page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin_page_title = 'New Cohort';
        $cohorts = Cohort::get();
        return view('admin.cohort.create', compact('admin_page_title', 'cohorts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cohort $cohort)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cohort $cohort)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cohort $cohort)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cohort $cohort)
    {
        //
    }
}
