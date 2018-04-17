<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentsRequest;
use App\Http\Requests\Admin\UpdateDepartmentsRequest;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('department_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('department_delete')) {
                return abort(401);
            }
            $departments = Department::onlyTrashed()->get();
        } else {
            $departments = Department::all();
        }

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating new Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('department_create')) {
            return abort(401);
        }
        return view('admin.departments.create');
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentsRequest $request)
    {
        if (! Gate::allows('department_create')) {
            return abort(401);
        }
        $department = Department::create($request->all());



        return redirect()->route('admin.departments.index');
    }


    /**
     * Show the form for editing Department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('department_edit')) {
            return abort(401);
        }
        $department = Department::findOrFail($id);

        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update Department in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentsRequest $request, $id)
    {
        if (! Gate::allows('department_edit')) {
            return abort(401);
        }
        $department = Department::findOrFail($id);
        $department->update($request->all());



        return redirect()->route('admin.departments.index');
    }


    /**
     * Display Department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('department_view')) {
            return abort(401);
        }
        $department = Department::findOrFail($id);

        return view('admin.departments.show', compact('department'));
    }


    /**
     * Remove Department from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.departments.index');
    }

    /**
     * Delete all selected Department at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Department::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Department from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        $department = Department::onlyTrashed()->findOrFail($id);
        $department->restore();

        return redirect()->route('admin.departments.index');
    }

    /**
     * Permanently delete Department from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('department_delete')) {
            return abort(401);
        }
        $department = Department::onlyTrashed()->findOrFail($id);
        $department->forceDelete();

        return redirect()->route('admin.departments.index');
    }
}
