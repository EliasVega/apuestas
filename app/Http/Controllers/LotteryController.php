<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use App\Http\Requests\StoreLotteryRequest;
use App\Http\Requests\UpdateLotteryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LotteryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:lottery.index|lottery.create|lottery.show|lottery.edit|lottery.destroy', ['only'=>['index']]);
        $this->middleware('permission:lottery.create', ['only'=>['create','store']]);
        $this->middleware('permission:lottery.show', ['only'=>['show']]);
        $this->middleware('permission:lottery.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:lottery.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $lotteries = lottery::get();

            return DataTables::of($lotteries)
                ->addColumn('edit', 'admin/lottery/actions')
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.lottery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lottery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLotteryRequest $request)
    {
        $lottery = new Lottery;
        $lottery->code = $request->code;
        $lottery->name = $request->name;
        $lottery->day = $request->day;
        $lottery->save();

        return redirect('lottery');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lottery $lottery)
    {
        return view("admin.lottery.show", compact('lottery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lottery $lottery)
    {
        return view("admin.lottery.edit", compact('lottery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLotteryRequest $request, Lottery $lottery)
    {
        $lottery->code = $request->code;
        $lottery->name = $request->name;
        $lottery->day = $request->day;
        $lottery->update();

        return redirect('lottery');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lottery $lottery)
    {
        $lottery->delete();
        toast('Loteria eliminado con éxito.','success');
        return redirect('lottery');
    }
}
