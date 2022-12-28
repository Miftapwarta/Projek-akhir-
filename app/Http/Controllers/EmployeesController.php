<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use PDF;

class EmployeesController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Employees::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $data = Employees::paginate(5);
        }


        return view('datapegawai',compact('data'));
    }

    public  function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        //dd($request->all());
        $data = Employees::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Tambahkan');
    }

    public function tampilkandata($id){

        $data = Employees::find($id);
        //dd($data);
        return view('tampildata',compact('data'));
    }

    public function updatedata(request $request, $id){

        $data = Employees::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Update');
    }

    public function deletedata($id){
        $data = Employees::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Hapus');
    }

    public function exportpdf(){
        $data = Employees::all();
        
        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }
}
