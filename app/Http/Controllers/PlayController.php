<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\Http\Requests\StorePlayRequest;
use App\Http\Requests\UpdatePlayRequest;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Lottery;
use App\Models\LotteryPlay;
use App\Models\ProhibitedNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

class PlayController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:play.index|play.create|play.show|play.edit|play.destroy', ['only'=>['index']]);
        $this->middleware('permission:play.create', ['only'=>['create','store']]);
        $this->middleware('permission:play.show', ['only'=>['show']]);
        $this->middleware('permission:play.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:play.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $play = session('play');
        if ($request->ajax()) {
            $plays = Play::get();

            return DataTables::of($plays)
            ->addIndexColumn()
            ->addColumn('lottery', function (Play $play) {
                return $play->lottery->name;
            })
            ->addColumn('edit', 'admin/play/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.play.index', compact('play'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = current_user();
        $cashRegister = CashRegister::where('user_id', $user->id)->where('status', 'open')->first();
        if ($cashRegister == null) {
            toast('Debes tener una caja abierta para realizar operaiones.','success');
            return back();
        }

        $days = array("domingo","lunes","martes","miercoles","jueves","viernes","sábado");
        //$months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        //echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        //Salida: Viernes 24 de Febrero del 2012
        $lotteryDay = $days[date('w')];
        $prohibitedNumbers = [];
        $lottery1 = Lottery::where('day', $lotteryDay)->get();
        $lottery2 = Lottery::where('code', '7days')->get();
        //$lotteries = $lottery1->concat($lottery2);
        $prohibiteds = ProhibitedNumber::get();
        $lotteries = Lottery::get();
        $date = Carbon::now();
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;
        if ($month < 10) {
            $month = 0 . $month;
        }
        if ($day < 10) {
            $day = 0 . $day;
        }
        $prohibitedNumbers[0] = $year;
        $prohibitedNumbers[1] = $month . $day;
        $prohibitedNumbers[2] = $day . $month;

        $cont = 3;
        foreach ($prohibiteds as $key => $prohibited) {
            $prohibitedNumbers[$cont] = $prohibited->number;
            $cont++;
        }
        return view('admin.play.create', compact('lotteries', 'prohibitedNumbers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayRequest $request)
    {
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        //dd($request->all());
        //variables Request
        $number = $request->number;
        $value = $request->value;
        $pay = $request->pay;
        $paymentMethod = $request->payment_method;
        $paymentForm = $request->payment_form;

        $play = new play;
        $play->total = $request->total;
        $play->pay = $pay;
        $play->date = $request->date;
        $play->payment_form = $request->payment_form;
        $play->payment_method = $request->payment_method;
        $play->lottery_id = $request->lottery_id;
        $play->save();

        for ($i=0; $i < count($number); $i++) {
            $lotteryPlay = new LotteryPlay();
            $lotteryPlay->type = $request->type[$i];
            $lotteryPlay->number = $number[$i];
            $lotteryPlay->value = $value[$i];
            $lotteryPlay->lottery_id = $request->lottery_id;
            $lotteryPlay->play_id = $play->id;
            $lotteryPlay->save();

            $cashRegister->value_play_total += $value[$i];
            $cashRegister->update();
        }

        $cashRegister->in_total += $pay;
        if ($paymentForm == 'contado') {
            if ($paymentMethod == 'nequi') {
                $cashRegister->nequi += $pay;
            } else {
                $cashRegister->cash_in_total += $pay;
            }
        } else {
            $cashRegister->credito += $pay;
        }
        $cashRegister->play += $pay;
        $cashRegister->update();


        session()->forget('play');
        session(['play' => $play->id]);
        toast('Juego Registrado satisfactoriamente.','success');

        return redirect('play');
    }

    /**
     * Display the specified resource.
     */
    public function show(Play $play)
    {
        $lotteryPlays = LotteryPlay::where('play_id', $play->id)->get();
        return view("admin.play.show", compact('play', 'lotteryPlays'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Play $play)
    {
        return view("admin.play.edit", compact('play'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayRequest $request, Play $play)
    {
        $play->total = $request->total;
        $play->date = $request->date;
        $play->update();

        return redirect('play');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Play $play)
    {
        $play->delete();
        toast('Juego eliminado con éxito.','success');
        return redirect('play');
    }

    public function posPlay(Request $request)
    {
            $plays = session('play');
            $play = Play::findOrFail($plays);
            session()->forget('play');
            $company = Company::findOrFail(1);
            $lotteryPlays = LotteryPlay::where('play_id', $play->id)->get();
            $playpos = "Juego-". $play->id;
            $view = \view('admin.play.pos', compact(
                'play',
                'lotteryPlays',
                'company',
            ))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

            return $pdf->stream('vista-pdf', "$playpos.pdf");
    }

    public function playPos(Request $request, $id)
    {
            $play = Play::findOrFail($id);
            $company = Company::findOrFail(1);
            $lotteryPlays = LotteryPlay::where('play_id', $play->id)->get();
            $playpos = "Juego-". $play->id;
            $view = \view('admin.play.pos', compact(
                'play',
                'lotteryPlays',
                'company',
            ))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper (array(0,0,226.76,497.64), 'portrait');

            return $pdf->stream('vista-pdf', "$playpos.pdf");
    }
}
