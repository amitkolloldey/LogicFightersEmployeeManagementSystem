<?php

namespace App\Http\Controllers\Admin;

use App\Salery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSaleriesRequest;
use App\Http\Requests\Admin\UpdateSaleriesRequest;

class SaleriesController extends Controller
{
    /**
     * Display a listing of Salery.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('salery_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('salery_delete')) {
                return abort(401);
            }
            $saleries = Salery::onlyTrashed()->get();
        } else {
            $saleries = Salery::all();
        }

        return view('admin.saleries.index', compact('saleries'));
    }

    /**
     * Show the form for creating new Salery.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('salery_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('lfems.lf_please_select'), '');

        return view('admin.saleries.create', compact('users'));
    }

    /**
     * Store a newly created Salery in storage.
     *
     * @param  \App\Http\Requests\StoreSaleriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleriesRequest $request)
    {
        if (! Gate::allows('salery_create')) {
            return abort(401);
        }
        $salery = Salery::create($request->all());



        return redirect()->route('admin.saleries.index');
    }


    /**
     * Show the form for editing Salery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('salery_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('lfems.lf_please_select'), '');

        $salery = Salery::findOrFail($id);

        return view('admin.saleries.edit', compact('salery', 'users'));
    }

    /**
     * Update Salery in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleriesRequest $request, $id)
    {
        if (! Gate::allows('salery_edit')) {
            return abort(401);
        }
        $salery = Salery::findOrFail($id);
        $salery->update($request->all());



        return redirect()->route('admin.saleries.index');
    }


    /**
     * Display Salery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('salery_view')) {
            return abort(401);
        }
        $salery = Salery::findOrFail($id);

        return view('admin.saleries.show', compact('salery'));
    }


    /**
     * Remove Salery from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('salery_delete')) {
            return abort(401);
        }
        $salery = Salery::findOrFail($id);
        $salery->delete();

        return redirect()->route('admin.saleries.index');
    }

    /**
     * Delete all selected Salery at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('salery_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Salery::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Salery from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('salery_delete')) {
            return abort(401);
        }
        $salery = Salery::onlyTrashed()->findOrFail($id);
        $salery->restore();

        return redirect()->route('admin.saleries.index');
    }

    /**
     * Permanently delete Salery from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('salery_delete')) {
            return abort(401);
        }
        $salery = Salery::onlyTrashed()->findOrFail($id);
        $salery->forceDelete();

        return redirect()->route('admin.saleries.index');
    }
}
