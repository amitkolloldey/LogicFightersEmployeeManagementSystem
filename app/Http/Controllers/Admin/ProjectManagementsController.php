<?php

namespace App\Http\Controllers\Admin;

use App\ProjectManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectManagementsRequest;
use App\Http\Requests\Admin\UpdateProjectManagementsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ProjectManagementsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of ProjectManagement.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('project_management_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('project_management_delete')) {
                return abort(401);
            }
            $project_managements = ProjectManagement::onlyTrashed()->get();
        } else {
            $project_managements = ProjectManagement::all();
        }

        return view('admin.project_managements.index', compact('project_managements'));
    }

    /**
     * Show the form for creating new ProjectManagement.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('project_management_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id');

        return view('admin.project_managements.create', compact('users'));
    }

    /**
     * Store a newly created ProjectManagement in storage.
     *
     * @param  \App\Http\Requests\StoreProjectManagementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectManagementsRequest $request)
    {
        if (! Gate::allows('project_management_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        ProjectManagement::create($request->all());



        return redirect()->route('admin.project_managements.index');
    }


    /**
     * Show the form for editing ProjectManagement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('project_management_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id');

        $project_management = ProjectManagement::findOrFail($id);

        return view('admin.project_managements.edit', compact('project_management', 'users'));
    }

    /**
     * Update ProjectManagement in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectManagementsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectManagementsRequest $request, $id)
    {
        if (! Gate::allows('project_management_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $project_management = ProjectManagement::findOrFail($id);
        $project_management->update($request->all());

         return redirect()->route('admin.project_managements.index');
    }


    /**
     * Display ProjectManagement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('project_management_view')) {
            return abort(401);
        }
        $project_management = ProjectManagement::findOrFail($id);

        return view('admin.project_managements.show', compact('project_management'));
    }


    /**
     * Remove ProjectManagement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('project_management_delete')) {
            return abort(401);
        }
        $project_management = ProjectManagement::findOrFail($id);
        $project_management->deletePreservingMedia();

        return redirect()->route('admin.project_managements.index');
    }

    /**
     * Delete all selected ProjectManagement at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('project_management_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProjectManagement::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore ProjectManagement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('project_management_delete')) {
            return abort(401);
        }
        $project_management = ProjectManagement::onlyTrashed()->findOrFail($id);
        $project_management->restore();

        return redirect()->route('admin.project_managements.index');
    }

    /**
     * Permanently delete ProjectManagement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('project_management_delete')) {
            return abort(401);
        }
        $project_management = ProjectManagement::onlyTrashed()->findOrFail($id);
        $project_management->forceDelete();

        return redirect()->route('admin.project_managements.index');
    }
}
