<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Http\Requests\StoreCashRegisterRequest;
use App\Http\Requests\UpdateCashRegisterRequest;
use App\Models\CashInflow;
use App\Models\CashOutflow;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class CashRegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cashRegister.index|cashRegister.create|cashRegister.show|cashRegister.edit', ['only'=>['index']]);
        $this->middleware('permission:cashRegister.create', ['only'=>['create','store']]);
        $this->middleware('permission:cashRegister.show', ['only'=>['show']]);
        $this->middleware('permission:cashRegister.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->role_id;

        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las cajas a admin y superadmin
                $cashRegisters = CashRegister::get();
            } else {
                //Consulta para mostrar Cajas de los demas roles
                $cashRegisters = CashRegister::where('user_id', $users->id)->get();
            }
            return DataTables::of($cashRegisters)
            ->addIndexColumn()
            ->addColumn('user', function (CashRegister $cashRegister) {
                return $cashRegister->user->name;
            })
            ->addColumn('total', function (CashRegister $cashRegister) {
                return $cashRegister->cash_in_total - $cashRegister->cash_out_total;
            })
            ->addColumn('status', function (CashRegister $cashRegister) {
                return $cashRegister->status == 'open' ? 'Abierta' : 'Cerrada';
            })
            ->editColumn('created_at', function(CashRegister $cashRegister){
                return $cashRegister->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/cash_register/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.cash_register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = current_user();
        $openCashRegister = CashRegister::where('user_id', '=', $users->id)->where('status', '=', 'open')->first();

        if ($openCashRegister) {
            toast('Ya tienes una cja Abierta.','success');
            return back();
        }
        return view("admin.cash_register.create", compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCashRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashRegisterRequest $request)
    {

        $cashRegister = new CashRegister();
        $cashRegister->cash_initial = $request->cash_initial;
        $cashRegister->in_cash = 0;
        $cashRegister->out_cash = 0;
        $cashRegister->in_total = 0;
        $cashRegister->out_total = 0;
        $cashRegister->cash_in_total = $request->cash_initial;
        $cashRegister->cash_out_total = 0;
        $cashRegister->value_play_total = 0;
        $cashRegister->nequi = 0;
        $cashRegister->credito = 0;
        $cashRegister->user_id = current_user()->id;
        $cashRegister->save();

        Alert::success('Caja','Creada Satisfactoriamente.');
        return redirect("cashRegister");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function show(CashRegister $cashRegister)
    {
        $user = current_user()->roles->pluck('name', 'name')->all();
        $cashRegister = CashRegister::findOrFail($cashRegister->user_id);
        $from = $cashRegister->created_at;
        $to = $cashRegister->updated_at;
        $cashOutflows = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashOutflow = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');
        $cashInflows = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashInflow = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');


        return view('admin.cash_register.show', compact(
            'cashRegister',

            'cashOutflows',
            'sumCashOutflow',

            'cashInflows',
            'sumCashInflow'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(CashRegister $cashRegister)
    {
        return view('admin.cash_register.edit', compact('cashRegister'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashRegisterRequest  $request
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashRegisterRequest $request, CashRegister $cashRegister)
    {
        $userClose = $request->user_close_id;

            $cashRegister->status = 'close';
            $cashRegister->update();

        return redirect("cashRegister")->with('success', 'Caja cerrada Satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashRegister $cashRegister)
    {
        //
    }

    //funcion para registrar una Salida de efectivo de la caja
    public function show_cashOutflow( $id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        if($cashRegister->status == 'close'){
            toast('Esta Caja ya esta cerrada.','warning');
            return redirect("cashRegister");
        }

        Session::put('cashRegister', $cashRegister->user_id, 60 * 24 * 365);
        Session::put('branch', $cashRegister->branch_id, 60 * 24 * 365);
        Session::put('user', $cashRegister->user_id, 60 * 24 * 365);

        $users = User::where('id', '!=', 1)->get();
        $cashRegisters = CashRegister::where('user_id', '=', Auth::user()->id)->where('status', '=', 'open')->first();

        return view("admin.cash_outflow.create", compact('users', 'cashRegister'));
    }

    //funcion para registrar una recarga a la caja de efectivo
    public function show_cashInflow( $id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        if($cashRegister->status == 'close'){
            return redirect("cashRegister")->with('warning', 'Esta Caja ya esta cerrada');
        }

        Session::put('cashRegister', $cashRegister->user_id, 60 * 24 * 365);
        Session::put('branch', $cashRegister->branch_id, 60 * 24 * 365);
        Session::put('user', $cashRegister->user_id, 60 * 24 * 365);

        $users = User::where('id', '!=', 1)->get();
        $cashRegisters = CashRegister::where('user_id', '=', Auth::user()->id)->where('status', '=', 'open')->first();

        return view("admin.cash_inflow.create", compact('users', 'cashRegister'));
    }

    //funcion para ver el cierre de caja de la caja
    public function cashRegisterClose($id)
    {
        $user     = Auth::user();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $cashRegister = CashRegister::findOrFail($id);
        $from     = $cashRegister->created_at;
        $to       = $cashRegister->updated_at;

        $cashInflows = CashInflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashInflows = CashInflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('cash');

        $cashOutflows = CashOutflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashOutflows = CashOutflow::where('user_id', $cashRegister->user_id)->whereBetween('created_at', [$from, $to])->sum('cash');

        return view('admin.cash_register.cashRegisterClose', compact(
            'cashRegister',
            'cashInflows',
            'sumCashInflows',
            'cashOutflows',
            'sumCashOutflows',

        ));
    }

     //funcion para ver el cierre de caja de la caja
     public function cashRegisterPos($id)
     {
        $userRole = current_user()->roles->pluck('name', 'name')->all();
        $cashRegister = CashRegister::findOrFail($id);
        $from     = $cashRegister->created_at;
        $to       = $cashRegister->updated_at;


        $cashInflows = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashInflows = CashInflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');

        $cashOutflows = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->get();
        $sumCashOutflows = CashOutflow::where('user_id', current_user()->id)->whereBetween('created_at', [$from, $to])->sum('cash');

        $company = Company::findOrFail(1);
        $view = \view('admin.cash_register.cashRegisterPos', compact(
            'company',
            'cashRegister',

            'cashInflows',
            'sumCashInflows',

            'cashOutflows',
            'sumCashOutflows',
        ))->render();

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper (array(0,0,226.76,497.64));

            return $pdf->stream('reporte_caja.pdf');
            /*
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper (array(0,0,226.76,497.64));

            return $pdf->stream('reporte_caja.pdf');

            $data = PDF::loadView('vista-pdf', $data)
            ->save(storage_path('app/public/') . 'archivo.pdf');*/
     }




}
