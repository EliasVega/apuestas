<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Department;
use App\Models\Municipality;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:company.index|company.create|company.show|company.edit|company.destroy|company:companyStatus.status', ['only'=>['index']]);
        $this->middleware('permission:company.create', ['only'=>['create','store']]);
        $this->middleware('permission:company.show', ['only'=>['show']]);
        $this->middleware('permission:company.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:company.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:company.companyStatus', ['only'=>['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (request()->ajax()) {
            $companies = Company::where('id', current_user()->company_id)->get();

            return DataTables::of($companies)
            ->addIndexColumn()
            ->addColumn('department', function (Company $company) {
                return $company->department->name;
            })
            ->addColumn('municipality', function (Company $company) {
                return $company->municipality->name;
            })

            ->addColumn('accesos', 'admin/company/accesos')
            ->rawcolumns(['accesos'])
            ->make(true);
        }
        return view('admin.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        return view('admin.company.create', compact(
            'departments',
            'municipalities',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new company();
        $company->department_id = $request->department_id;
        $company->municipality_id = $request->municipality_id;
        $company->name = $request->name;
        $company->code = $request->code;
        $company->nit = $request->nit;
        $company->dv = $request->dv;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        //Handle File Upload
        if($request->hasFile('logo')){
            //Get filename with the extension
            $filenamewithExt = $request->file('logo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('logo')->guessClientExtension();

            $image = Image::make($request->file('logo'))->encode('jpg', 75);
            $image->resize(512,448,function($constraint) {
                $constraint->upsize();
            });
            //FileName to store
            $fileNameToStore = time() . '.jpg';
            $company->imageName = $fileNameToStore;
            //Upload Image
            Storage::disk('public')->put("images/logos/$fileNameToStore", $image->stream());
            $fileNameToStore = Storage::url("images/logos/$fileNameToStore");
        } else{
            $company->imageName = 'noimage.jpg';
            $fileNameToStore="/storage/images/logos/noimage.jpg";
        }
        $company->logo=$fileNameToStore;
        $company->save();

        Alert::success('Compañia','Creada Satisfactoriamente.');
        return redirect('company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */

     //Metodo redireccionar y crear Sucursal
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $departments    = Department::get();
        $municipalities = Municipality::get();
        return view("admin.company.edit", compact(
            'company',
            'departments',
            'municipalities',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->department_id = $request->department_id;
        $company->municipality_id = $request->municipality_id;
        $company->name = $request->name;
        $company->code = $request->code;
        $company->nit = $request->nit;
        $company->dv = $request->dv;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        //dd($request->all());
        $currentImage = $company->imageName;
        //Handle File Upload
        if($request->hasFile('logo')){
            if ($currentImage != 'noimage.jpg') {
                Storage::disk('public')->delete("images/logos/$currentImage");
            }
            //Get filename with the extension
            $filenamewithExt = $request->file('logo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('logo')->guessClientExtension();

            $image = Image::make($request->file('logo'))->encode('jpg', 75);
            $image->resize(512,448,function($constraint) {
                $constraint->upsize();
            });
            //FileName to store
            $fileNameToStore = time() . '.jpg';
            $company->imageName = $fileNameToStore;
            //Upload Image
            Storage::disk('public')->put("images/logos/$fileNameToStore", $image->stream());
            $fileNameToStore = Storage::url("images/logos/$fileNameToStore");
        } else{
            $company->imageName = 'noimage.jpg';
            $fileNameToStore="/storage/images/logos/noimage.jpg";
        }
        $company->logo=$fileNameToStore;
        $company->update();

        Alert::success('Compañia','Editada Satisfactoriamente.');
        return redirect('company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function status($id)
    {
        $company = Company::findOrFail($id);

        if ($company->status == 'active') {
            $company->status = 'inactive';
        } else {
            $company->status = 'active';
        }
        $company->update();

        return redirect('company');
    }
}
