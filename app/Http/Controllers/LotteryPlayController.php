<?php

namespace App\Http\Controllers;

use App\Models\LotteryPlay;
use App\Http\Requests\StoreLotteryPlayRequest;
use App\Http\Requests\UpdateLotteryPlayRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LotteryPlayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $lotteryPlays = LotteryPlay::get();

            return DataTables::of($lotteryPlays)
            ->addIndexColumn()
            ->addColumn('lottery', function (LotteryPlay $lotteryPlay) {
                return $lotteryPlay->lottery->name;
            })
            ->editColumn('created_at', function(LotteryPlay $lotteryPlay){
                return $lotteryPlay->created_at->format('Y-m-d: h:m');
            })
            ->make(true);
        }

        return view('admin.lotteryPlay.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLotteryPlayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LotteryPlay $lotteryPlay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LotteryPlay $lotteryPlay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLotteryPlayRequest $request, LotteryPlay $lotteryPlay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LotteryPlay $lotteryPlay)
    {
        //
    }
}
