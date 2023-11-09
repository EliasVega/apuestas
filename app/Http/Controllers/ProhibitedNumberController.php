<?php

namespace App\Http\Controllers;

use App\Models\ProhibitedNumber;
use App\Http\Requests\StoreProhibitedNumberRequest;
use App\Http\Requests\UpdateProhibitedNumberRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProhibitedNumberController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:prohibitedNumber.index|prohibitedNumber.create|prohibitedNumber.show|prohibitedNumber.edit|prohibitedNumber.destroy', ['only'=>['index']]);
        $this->middleware('permission:prohibitedNumber.create', ['only'=>['create','store']]);
        $this->middleware('permission:prohibitedNumber.show', ['only'=>['show']]);
        $this->middleware('permission:prohibitedNumber.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:prohibitedNumber.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $prohibiteds = ProhibitedNumber::get();

            return DataTables::of($prohibiteds)
            ->addIndexColumn()
            ->editColumn('created_at', function(ProhibitedNumber $prohibited){
                return $prohibited->created_at->format('yy-m-d');
            })
            ->addColumn('edit', 'admin/prohibitedNumber/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.prohibitedNumber.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prohibitedNumber.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProhibitedNumberRequest $request)
    {
        $prohibitedNumber = new ProhibitedNumber;
        $prohibitedNumber->number = $request->number;
        $prohibitedNumber->save();

        return redirect('prohibitedNumber');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProhibitedNumber $prohibitedNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProhibitedNumber $prohibitedNumber)
    {
        return view("admin.prohibitedNumber.edit", compact('prohibitedNumber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProhibitedNumberRequest $request, ProhibitedNumber $prohibitedNumber)
    {
        $prohibitedNumber->number = $request->number;
        $prohibitedNumber->update();

        return redirect('prohibitedNumber');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProhibitedNumber $prohibitedNumber)
    {
        $prohibitedNumber->delete();
        toast('Numero prohibido eliminado con éxito.','success');
        return redirect('prohibitedNumber');
    }
}
