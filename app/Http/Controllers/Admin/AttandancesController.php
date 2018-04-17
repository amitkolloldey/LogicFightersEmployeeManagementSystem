<?php

namespace App\Http\Controllers\Admin;

use App\Attandance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAttandancesRequest;
use App\Http\Requests\Admin\UpdateAttandancesRequest;

class AttandancesController extends Controller
{
    /**
     * Display a listing of Attandance.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('attandance_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('attandance_delete')) {
                return abort(401);
            }
            $attandances = Attandance::onlyTrashed()->get();
        } else {
            $attandances = Attandance::all();
        }

        return view('admin.attandances.index', compact('attandances'));
    }

    /**
     * Show the form for creating new Attandance.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('attandance_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id');

        return view('admin.attandances.create', compact('users'));
    }

    /**
     * Store a newly created Attandance in storage.
     *
     * @param  \App\Http\Requests\StoreAttandancesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttandancesRequest $request)
    {
        if (! Gate::allows('attandance_create')) {
            return abort(401);
        }
        $attandance = Attandance::create($request->all());



        return redirect()->route('admin.attandances.index');
    }


    /**
     * Show the form for editing Attandance.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('attandance_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id');

        $attandance = Attandance::findOrFail($id);

        return view('admin.attandances.edit', compact('attandance', 'users'));
    }

    /**
     * Update Attandance in storage.
     *
     * @param  \App\Http\Requests\UpdateAttandancesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttandancesRequest $request, $id)
    {
        if (! Gate::allows('attandance_edit')) {
            return abort(401);
        }
        $attandance = Attandance::findOrFail($id);
        $attandance->update($request->all());



        return redirect()->route('admin.attandances.index');
    }


    /**
     * Display Attandance.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('attandance_view')) {
            return abort(401);
        }
        $attandance = Attandance::findOrFail($id);

        return view('admin.attandances.show', compact('attandance'));
    }


    /**
     * Remove Attandance from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('attandance_delete')) {
            return abort(401);
        }
        $attandance = Attandance::findOrFail($id);
        $attandance->delete();

        return redirect()->route('admin.attandances.index');
    }

    /**
     * Delete all selected Attandance at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('attandance_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Attandance::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Attandance from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('attandance_delete')) {
            return abort(401);
        }
        $attandance = Attandance::onlyTrashed()->findOrFail($id);
        $attandance->restore();

        return redirect()->route('admin.attandances.index');
    }

    /**
     * Permanently delete Attandance from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('attandance_delete')) {
            return abort(401);
        }
        $attandance = Attandance::onlyTrashed()->findOrFail($id);
        $attandance->forceDelete();

        return redirect()->route('admin.attandances.index');
    }
}
