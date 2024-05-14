<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Letter;
use App\Models\Disease;
use App\Models\pdfrecords;
use App\Models\user_role;
use App\Models\user_role_assign;
use App\Models\application_delete_req;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class LetterController extends Controller
{
    public function add()
    {
        if(auth()->user()->role == '1'){
            return view("apptracking/user/addapplicationdetails");
        }
        elseif(auth()->user()->role == '2'){
            return view("apptracking/admin/addapplicationdetails");
        }
        elseif(auth()->user()->role == '3'){
            return view("apptracking/superadmin/addapplicationdetails");
        }

        elseif(auth()->user()->role == '4'){
            return view("apptracking/user_ass/addapplicationdetails");
        }

        elseif(auth()->user()->role == '5'){
            return view("apptracking/user_assdss/addapplicationdetails");
        }
    }

    public function search(Request $request)
    {
        //get Nic No
        $nic = $request->input('txtnic');
    
        // patient's nic
        $checkpatient = Letter::where('patient_nic', $nic)
                      ->where('delete_status', 0)
                      ->first();
        // applicant's nic
        $checkapplicant = Letter::where('applicant_nic', $nic)
                      ->where('delete_status', 0)
                      ->first();
    
        if ($checkpatient) {
            $id = $checkpatient ->id;
            // User with the given NIC found
            return redirect()->route('letter.view',['id' => $id])->with('warning', 'Applicant is already in the system!');

        } 
        elseif($checkapplicant){
            $id = $checkapplicant ->id;
            // User with the given NIC found
            return redirect()->route('letter.view',['id' => $id])->with('warning', 'Applicant is already in the system!');

        } 
        
        else {
            //$nics;              
	        $nic_old = '';
            $nic_new1 = '';
            $nic_new2 = '';
	        $decade_s = substr($nic,0,2);
            $decade = (int) $decade_s;
                if($decade == 0) {
                    $nic_new1 = "19".substr($nic,3,5).'0'.substr($nic,8,4);
                    $nic_new2 = "19".substr($nic,3,5).'1'.substr($nic,8,4);
                    $checknicnew1 = Letter::where('patient_nic', $nic_new1)->first();
                    $checknicnew2 = Letter::where('patient_nic', $nic_new2)->first();
                    $checknicnew3 = Letter::where('applicant_nic', $nic_new1)->first();
                    $checknicnew4 = Letter::where('applicant_nic', $nic_new2)->first();
                        if($checknicnew1){
                            $id = $checknicnew1 ->id;
                        }
                        if($checknicnew2){
                            $id = $checknicnew2 ->id;
                        }
                        if($checknicnew3){
                            $id = $checknicnew3 ->id;
                        }
                        if($checknicnew4){
                            $id = $checknicnew4 ->id;
                        }
                     
                        if(($checknicnew1)||($checknicnew2)||($checknicnew3)||($checknicnew4)){
                        
                            return redirect()->route('letter.view',['id' => $id])->with('warning', 'Applicant is already in the system!');
                        }
                        else{
                         
                            // return redirect()->route('letter.create',['nic' => $nic])->with('info', 'Enter Allpication Details!');
                            return redirect()->route('letter.create')->with('info', 'Enter Allpication Details!'); 
                        }
                    }

                else {
                        
                    $nic_old = "000".substr($nic,2,5).substr($nic,8,4);
                    $checknicold1 = Letter::where('patient_nic', $nic_old)->first();
                    $checknicold2 = Letter::where('applicant_nic', $nic_old)->first();
                    
                        if ($checknicold1) {
                            $id = $checknicold1 ->id;
                            return redirect()->route('letter.view',['id' => $id])->with('warning', 'Applicant is already in the system!');
                        }
                        elseif ($checknicold2) {
                            $id = $checknicold2 ->id;
                            return redirect()->route('letter.view',['id' => $id])->with('warning', 'Applicant is already in the system!');
                        }
                        else{
                            //dd("new check2");
                            // return redirect()->route('letter.create',['nic' => $nic])->with('info', 'Enter Application Details'); 
                            return redirect()->route('letter.create')->with('info', 'Enter Application Details!'); 
                        }   		
		            }    
        }
    }

    public function view($id=null)
    {
        //get all the data
        if($id==null){
            $joinedData = DB::table('users')
            ->join('letters', 'users.id', '=', 'letters.user_id')
            ->join('diseases', 'letters.disease_id', '=', 'diseases.id')
            ->select('users.name', 'letters.*', 'diseases.disease_type')
            ->where('letters.delete_status','=','0')
            ->get()
            ->toArray();
        }
        //get a single value
        else{
            $joinedData = DB::table('users')
            ->join('letters', 'users.id', '=', 'letters.user_id')
            ->join('diseases', 'letters.disease_id', '=', 'diseases.id')
            ->select('users.name', 'letters.*', 'diseases.disease_type')
            ->where('letters.id','=' , $id)
            ->get()
            ->toArray();
        }
        
        if(auth()->user()->role == '1'){
            return view('apptracking/user/viewapplicationdetails', compact('joinedData'));
        }
        elseif(auth()->user()->role == '2'){
            return view('apptracking/admin/viewapplicationdetails', compact('joinedData'));
        }
        elseif(auth()->user()->role == '3'){
            return view('apptracking/superadmin/viewapplicationdetails', compact('joinedData'));
        }
        elseif(auth()->user()->role == '4'){
            return view('apptracking/user_ass/viewapplicationdetails', compact('joinedData'));
        } 
        elseif(auth()->user()->role == '5'){
            return view('apptracking/user_assdss/viewapplicationdetails', compact('joinedData'));
        }  

    }

    public function create($nic=null)
    {
        //get datas from Disease table
        $allData = Disease::select('id', 'disease_type')->get()->toArray();

        if(auth()->user()->role == '1'){
            return view('apptracking/user/createapplication', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '2'){
            return view('apptracking/admin/createapplication', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '3'){
            return view('apptracking/superadmin/createapplication', compact('nic', 'allData')); 
        } 
        elseif(auth()->user()->role == '4'){
            return view('apptracking/user_ass/createapplication', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '5'){
            return view('apptracking/user_assdss/createapplication', compact('nic', 'allData')); 
        }  
    }

    public function store(Request $request)
        {

        //     $request->validate([  
        //     'applicant_nic' => 'required',  
        //     'applicant_name' => 'required', 
        //     'phone' => 'required',  
        //     'city' => 'required',            
        // ]);   
        // dd('fdf');
        $nextNo = Letter::generateApplicationNo();
        
        $letter = new Letter;

        $letter->user_id = auth()->user()->id;
        $letter->disease_id = $request->diseaseid;
        $letter->app_no = $nextNo;
        $letter->patient_nic = $request->txtpnic;
        $letter->patient_name = $request->txtpname;
        $letter->applicant_nic = $request->txtappnic;
        $letter->applicant_name = $request->txtappname;
        $letter->phone = $request->txtphone;
        $letter->city = $request->txtcity;         
        
        $result = $letter->save();

        if ($result){

            return redirect()->route('letter.view')->with('success', 'Your Application No is '.$nextNo.'!');
        }          

    }
}
