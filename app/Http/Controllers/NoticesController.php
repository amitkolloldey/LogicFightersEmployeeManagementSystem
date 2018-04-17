<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNoticesRequest;
use App\Http\Requests\Admin\UpdateNoticesRequest;

class NoticesController extends Controller
{
    /**
     * Display a listing of Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('notice_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('notice_delete')) {
                return abort(401);
            }
            $notices = Notice::onlyTrashed()->get();
        } else {
            $notices = Notice::all();
        }

        return view('admin.notices.index', compact('notices'));
    }


    /**
     * Show the form for creating new Department.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('notice_create')) {
            return abort(401);
        }
        return view('admin.notices.create');
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param  \App\Http\Requests\StoreNoticesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticesRequest $request)
    {
        if (! Gate::allows('notice_create')) {
            return abort(401);
        }
        $notice = Notice::create($request->all());



        return redirect()->route('admin.notices.index');
    }


    /**
     * Show the form for editing Department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('notice_edit')) {
            return abort(401);
        }
        $notice = Notice::findOrFail($id);

        return view('admin.notices.edit', compact('notice'));
    }

    /**
     * Update Department in storage.
     *
     * @param  \App\Http\Requests\UpdateNoticesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoticesRequest $request, $id)
    {
        if (! Gate::allows('notice_edit')) {
            return abort(401);
        }
        $notice = Notice::findOrFail($id);
        $notice->update($request->all());



        return redirect()->route('admin.notices.index');
    }


    /**
     * Display Department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('notice_view')) {
            return abort(401);
        }
        $notice = Notice::findOrFail($id);

        return view('admin.notices.show', compact('notice'));
    }


    /**
     * Remove Department from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        $notice = Notice::findOrFail($id);
        $notice->delete();

        return redirect()->route('admin.notices.index');
    }

    /**
     * Delete all selected Department at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Notice::whereIn('id', $request->input('ids'))->get();

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
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        $notice = Notice::onlyTrashed()->findOrFail($id);
        $notice->restore();

        return redirect()->route('admin.notices.index');
    }

    /**
     * Permanently delete Department from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        $notice = Notice::onlyTrashed()->findOrFail($id);
        $notice->forceDelete();

        return redirect()->route('admin.notices.index');
    }
}
