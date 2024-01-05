<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use App\Models\Donor;
use App\Models\DonorHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class BloodController extends Controller
{
    // blood List
    function blood(){
        $bloods = Blood::all();
        return view('admin.blood.blood_list', [
            'bloods'=>$bloods,
        ]);
    }

    // blood group store
    function group_store(Request $request){
        $request->validate([
            'blood_group'=>'required|unique:bloods',
        ]);

        Blood::insert([
            'blood_group'=>$request->blood_group,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('blood_succ', 'Successfully blood gorup added');
    }

    // Blood delete
    function blood_delete($blood_id){
        Blood::find($blood_id)->delete();
        return back()->with('blood_del', 'Blood group Successfully Deleted');
    }

    // Blood Donor List
    function donor_list(){
        $donors = Donor::latest()->paginate(20);
        return view('admin.blood.blood_donor', [
            'donors'=>$donors,
        ]);
    }

    // Donor view
    function donor_view($donor_id){
        $donor_info = Donor::find($donor_id);
        return view('admin.blood.donor_info', [
            'donor_info'=>$donor_info,
        ]);
    }

    // Donor delete
    function donor_delete($donor_id){
        $present_img = Donor::find($donor_id);

        if($present_img->donor_img!=null){
            unlink(public_path('upload/donor/'.$present_img->donor_img));
        }

        Donor::find($donor_id)->delete();
        return back();
    }

    function donor_history($donor_id){
        $donor_info = DonorHistory::where('donor_id', $donor_id)->latest()->get();
        $donors = Donor::find($donor_id);
        return view('admin.blood.donor_history',[
            'donors'=>$donors,
            'donor_info'=>$donor_info,
        ]);
    }

    function donor_history_store(Request $request){

        $request->validate([
            'donate_date'=>'required',
        ]);
        DonorHistory::insert([
           'donate_date'=>$request->donate_date,
           'donor_id'=>$request->donor_id,
           'created_at'=>Carbon::now(),
            
        ]);
        return back();
    }

    function donor_history_delete($donor_id){
        DonorHistory::find($donor_id)->delete();

        return back();
    }

    function donor_history_download($donor_id){

        $data = DonorHistory::where('donor_id', $donor_id)->latest()->get();
        
        $pdf = PDF::loadView('admin.blood.download_donor_history', [
            'data'=>$data,
        ]);
        return $pdf->download('donorhistory.pdf');
    }
}
