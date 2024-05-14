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

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        if(auth()->user()->role == '1'){
            return view("user/addapplication");
        }
        elseif(auth()->user()->role == '2'){
            return view("admin/addapplication");
        }
        elseif(auth()->user()->role == '3'){
            return view("superadmin/addapplication");
        }
        elseif(auth()->user()->role == '5'){
            return view("user_assdss/addapplication");
        }
    }


    public function create($nic=null)
    {
        //get datas from Disease table
        $allData = Disease::select('id', 'disease_type')->get()->toArray();

        if(auth()->user()->role == '1'){
            return view('user/application', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '2'){
            return view('admin/application', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '3'){
            return view('superadmin/application', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '5'){
            return view('user_assdss/application', compact('nic', 'allData')); 
        } 
        
    }


    public function searcheach($nic = null)
    {
        //get datas from Disease table
        $allData = Disease::select('id', 'disease_type')->get()->toArray();

        if(auth()->user()->role == '1'){
            return view('user/application', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '2'){
            return view('admin/application', compact('nic', 'allData')); 
        }
        elseif(auth()->user()->role == '3'){
            return view('superadmin/application', compact('nic', 'allData')); 
        } 
        elseif(auth()->user()->role == '5'){
            return view('user_assdss/application', compact('nic', 'allData')); 
        }

    }


    public function view($id=null)
    {
        //get all the data
        if($id==null){
            $joinedData = DB::table('users')
            ->join('applications', 'users.id', '=', 'applications.user_id')
            ->join('diseases', 'applications.disease_id', '=', 'diseases.id')
            ->join('pdfrecords', 'pdfrecords.application_id', '=', 'applications.id' )
            ->select('users.name', 'applications.*', 'diseases.disease_type', 'pdfrecords.*')
            ->where('applications.delete_status','=','0')
            ->get()
            ->toArray();

            //dd($joinedData);
        }
        //get a single value
        else{
            $joinedData = DB::table('users')
            ->join('applications', 'users.id', '=', 'applications.user_id')
            ->join('diseases', 'applications.disease_id', '=', 'diseases.id')
            ->join('pdfrecords', 'pdfrecords.application_id', '=', 'applications.id' )
            ->select('users.name', 'applications.*', 'diseases.disease_type', 'pdfrecords.*')
            ->where('application_id','=' , $id)
            ->get()
            ->toArray();
        }
        
        if(auth()->user()->role == '1'){
            return view('user/viewapplication', compact('joinedData'));
        }
        elseif(auth()->user()->role == '2'){
            return view('admin/viewapplication', compact('joinedData'));
        }
        elseif(auth()->user()->role == '3'){
            return view('superadmin/viewapplication', compact('joinedData'));
        } 
        elseif(auth()->user()->role == '5'){
            return view('user_assdss/viewapplication', compact('joinedData'));
        } 

    }


    public function store(Request $request) :RedirectResponse
        {
            $request->validate([
            'patientnic' => 'required',
            'patientname' => 'required',   
            'patientaddress1' => 'required',  
            'patientaddress2' => 'required', 
            'patientphone' => 'required',              
            'pdfpath'  => 'required|mimes:pdf|max:10240' // PDF and maximum 10MB
        ]);   


        // Retrieve the uploaded file using $request->file('pdfpath')
        $file = $request->file('pdfpath');

        $nic = $request->patientnic;

        // Check if a file was uploaded
        if ($file) {
   
            $nextNo = Application::generateApplicationNo();

            //save to DB
            $application = Application::create([
                'user_id' => auth()->user()->id,
                'disease_id' => $request->diseaseid,
                'application_no' => $nextNo,
                'patient_nic' => $nic,
                'patient_name' => $request->patientname,
                'patient_address1' => $request->patientaddress1,
                'patient_address2' => $request->patientaddress2,
                'patient_phone' => $request->patientphone,
                'patient_remarks' => $request->patientremarks             

            ]);

            $applicationId = $application->id;
        
            // Save the file to the storage
            $path = $file->storeAs('uploads', uniqid().'.'.$file->getClientOriginalExtension(), 'public');
            
            $pdf = pdfrecords::create([
                'application_id' => $applicationId,
                'user_id' => auth()->user()->id,
                'pdf_path' => $path
            ]);
            
            
            return redirect()->route('application.view')->with('success', 'Your Application No is '.$nextNo.'!');

        } 
        else {
            return redirect()->back()->with('error', 'No Application uploaded.');
        }
    }


    public function search(Request $request)
    {
        //get Nic No
        $nic = $request->input('txtnic');
    
        // Active applications
        $checkacttive = Application::where('patient_nic', $nic)
                      ->where('delete_status', 0)
                      ->first();
        // check for ongoing inactive applications
        $checkinactive = Application::where('patient_nic', $nic)
                      ->where('delete_status', 1)
                      ->first();
    
        if ($checkacttive) {
            $id = $checkacttive ->id;
            // User with the given NIC found
            return redirect()->route('application.view',['id' => $id])->with('warning', 'Applicant is already in the system!');

        } 
        elseif($checkinactive){
            return redirect()->route('application.add')->with('error', 'Application is in the Inactivation Stage!');
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
                    $checknicnew1 = Application::where('patient_nic', $nic_new1)->first();
                    $checknicnew2 = Application::where('patient_nic', $nic_new2)->first();
                        if($checknicnew1){
                            $id = $checknicnew1 ->id;
                        }
                        if($checknicnew2){
                            $id = $checknicnew2 ->id;
                        }
                     
                        if(($checknicnew1)||($checknicnew2)){
                        
                            return redirect()->route('application.view',['id' => $id])->with('warning', 'Applicant is already in the system!');
                        }
                        else{
                         
                            return redirect()->route('application.create',['nic' => $nic])->with('info', 'Enter Allpication Details'); 
                        }
                    }

                else {
                        
                    $nic_old = "000".substr($nic,2,5).substr($nic,8,4);
                    $checknicold = Application::where('patient_nic', $nic_old)->first();
                    
                        if ($checknicold) {
                            $id = $checknicold ->id;
                            return redirect()->route('application.view',['id' => $id])->with('warning', 'Applicant is already in the system!');
                        }
                        else{
                            //dd("new check2");
                            return redirect()->route('application.create',['nic' => $nic])->with('info', 'Enter Allpication Details'); 
                        }   		
		            }  
            
        }
    }
    
    
    //store another pdf
    public function vieweach(string $application_id)
    {
        $joinedData = DB::table('users')
        ->join('applications', 'users.id', '=', 'applications.user_id')
        ->join('diseases', 'applications.disease_id', '=', 'diseases.id')
        ->join('pdfrecords', 'pdfrecords.application_id', '=', 'applications.id' )
        ->select('users.name', 'applications.*', 'diseases.disease_type', 'pdfrecords.*')
        ->where('application_id','=' , $application_id)
        ->get()
        ->toArray();

        if(auth()->user()->role == '1'){
            return view('user/vieweach', compact('joinedData'));
        }
        elseif(auth()->user()->role == '2'){
            return view('admin/vieweach', compact('joinedData'));
        }
        elseif(auth()->user()->role == '3'){
            return view('superadmin/vieweach', compact('joinedData'));
        }
        elseif(auth()->user()->role == '5'){
            return view('user_assdss/vieweach', compact('joinedData'));
        } 
       
    }
    

    public function vieweachinactive(string $application_id)
    {
        $joinedData = DB::table('applications')
            ->join('diseases', 'applications.disease_id', '=', 'diseases.id')
            ->join('pdfrecords', 'pdfrecords.application_id', '=', 'applications.id' )
            ->join('application_delete_reqs','application_delete_reqs.application_id','=','applications.id')
            ->join('users','users.id','=','application_delete_reqs.user_id')
            ->select(
                'application_delete_reqs.id as delete_req_id',
                'application_delete_reqs.application_id',
                'application_delete_reqs.user_message',
                'application_delete_reqs.delete_req_status',
                'applications.application_no',
                'applications.patient_nic',
                'applications.patient_name',
                'applications.patient_address1',
                'applications.patient_address2',
                'applications.patient_phone',
                'applications.patient_remarks',
                'applications.delete_status',
                'diseases.disease_type',
                'pdfrecords.*',
                'users.name'
            )
            ->where('applications.id','=' , $application_id)
            ->where('application_delete_reqs.delete_req_status', '=', '1')
            ->get()
            ->toArray();
            //dd($joinedData);

            if(auth()->user()->role == '2'){
                return view('admin/vieweachinactive', compact('joinedData'));
            }
            elseif(auth()->user()->role == '3'){
                return view('superadmin/vieweachinactive', compact('joinedData'));
            } 
       
    }

    public function inactive(Request $request)
    {

        $request->validate([
            'frmmessage' => 'required'
        ]);

        //update application id delete status to 1 so put in ask for inactive state

        //call the model for updation
        $appId = $request->frmappid;
        $applicationModel = new Application();
        $result = $applicationModel->updateDeleteStatus($appId);

        if ($result){
            //update application_delete_req table
            $inactive_request = application_delete_req::create([
                'application_id' => $request->frmappid,
                'user_id' => auth()->user()->id,
                'user_message' => $request->frmmessage,
                'delete_req_status' => 1         
            ]);

            return redirect()->route('application.view')->with('error', 'Application is submitted for inactivation!');
        }

    }

    public function appinactive(Request $request)
    {


        //update application id delete status to 1 so put in ask for inactive state

        //call the model for updation
        $appId = $request->frmappid;
        $applicationModel = new Application();
        $result = $applicationModel->applicationInactive($appId);

        if ($result){

            return redirect()->route('application.inactivelist')->with('error', 'Application is Inactivated!');
        }

    }

    public function notinactive(Request $request)
    {

        //update application id delete status to 1 so put in ask for inactive state

        //call the model for updation
        $appId = $request->frmappid;
        $drId = $request->frmdrid;

        $applicationModel = new Application();
        $result = $applicationModel->rollbackDeleteStatus($appId);

        $application_delete_req_model = new application_delete_req();
        $result2 = $application_delete_req_model->rollbackstatus($drId);


        return redirect()->route('application.inactivelist')->with('success', 'Application is not inactivated!');
        
    }

    public function storepdf(Request $request, $application_id)
    {
        if($request->file('pdfpath2')){
            
            $file = $request->file('pdfpath2');
       
            // Check if a file was uploaded
            if ($file) {
                // Save the file to the storage
                $path = $file->storeAs('uploads', uniqid().'.'.$file->getClientOriginalExtension(), 'public');
                
                $pdf = pdfrecords::where('application_id' , $application_id)->first();
            
                //dd($pdf);
                $pdf->update(['pdf_path2' => $path]);
            }}


        else if ($request->file('pdfpath3')){       

            $file = $request->file('pdfpath3');

        
            // Check if a file was uploaded
            if ($file) {
                // Save the file to the storage
                $path = $file->storeAs('uploads', uniqid().'.'.$file->getClientOriginalExtension(), 'public');
                
                $pdf = pdfrecords::where('application_id' , $application_id)->first();
            
                //dd($pdf);
                $pdf->update(['pdf_path3' => $path]);
            }}
   
            return redirect()->route('application.view')->with('success', 'File uploaded successfully!');
        
    }
    
     public function inactivelist()
    {
            $joinedData = DB::table('application_delete_reqs')
                ->join('applications', 'application_delete_reqs.application_id', '=', 'applications.id')
                ->join('diseases', 'applications.disease_id', '=', 'diseases.id')
                ->join('pdfrecords', 'pdfrecords.application_id', '=', 'applications.id' )
                ->join('users', 'users.id', '=', 'application_delete_reqs.user_id')
                ->select(
                    'application_delete_reqs.id as delete_req_id',
                    'application_delete_reqs.application_id',
                    'application_delete_reqs.user_message',
                    'application_delete_reqs.delete_req_status',
                    'applications.application_no',
                    'applications.patient_nic',
                    'applications.patient_name',
                    'applications.patient_address1',
                    'applications.patient_address2',
                    'applications.patient_phone',
                    'applications.patient_remarks',
                    'applications.delete_status',
                    'diseases.disease_type',
                    'pdfrecords.*',
                    'users.name'
                )
                ->where('applications.delete_status', '=', '1')
                ->where('application_delete_reqs.delete_req_status', '=', '1')
                ->get()
                ->toArray();
//dd($joinedData);


                if(auth()->user()->role == '2'){
                    return view("admin/viewinactivelist", compact('joinedData'));
                }
                elseif(auth()->user()->role == '3'){
                    return view("superadmin/viewinactivelist", compact('joinedData'));
                }
    }

    
    public function inactivedApp()
    {
            $joinedData = DB::table('application_delete_reqs')
                ->join('applications', 'application_delete_reqs.application_id', '=', 'applications.id')
                ->join('diseases', 'applications.disease_id', '=', 'diseases.id')
                ->join('pdfrecords', 'pdfrecords.application_id', '=', 'applications.id' )
                ->join('users', 'users.id', '=', 'application_delete_reqs.user_id')
                ->select(
                    'application_delete_reqs.id as delete_req_id',
                    'application_delete_reqs.application_id',
                    'application_delete_reqs.user_message',
                    'application_delete_reqs.delete_req_status',
                    'applications.application_no',
                    'applications.patient_nic',
                    'applications.patient_name',
                    'applications.patient_address1',
                    'applications.patient_address2',
                    'applications.patient_phone',
                    'applications.patient_remarks',
                    'applications.delete_status',
                    'diseases.disease_type',
                    'pdfrecords.*',
                    'users.name'
                )
                ->where('applications.delete_status', '=', '2')
                ->where('application_delete_reqs.delete_req_status', '=', '1')
                ->get()
                ->toArray();

            return view("superadmin/viewinactivatedlist", compact('joinedData'));
             
    }

    public function eachinactivated(string $application_id)
    {
        $joinedData = DB::table('applications')
            ->join('diseases', 'applications.disease_id', '=', 'diseases.id')
            ->join('pdfrecords', 'pdfrecords.application_id', '=', 'applications.id' )
            ->join('application_delete_reqs','application_delete_reqs.application_id','=','applications.id')
            ->join('users','users.id','=','application_delete_reqs.user_id')
            ->select(
                'application_delete_reqs.id as delete_req_id',
                'application_delete_reqs.application_id',
                'application_delete_reqs.user_message',
                'application_delete_reqs.delete_req_status',
                'applications.application_no',
                'applications.patient_nic',
                'applications.patient_name',
                'applications.patient_address1',
                'applications.patient_address2',
                'applications.patient_phone',
                'applications.patient_remarks',
                'applications.delete_status',
                'diseases.disease_type',
                'pdfrecords.*',
                'users.name'
            )
            ->where('applications.id','=' , $application_id)
            ->where('application_delete_reqs.delete_req_status', '=', '1')
            ->where('applications.delete_status', '=', '2')
            ->get()
            ->toArray();
            //dd($joinedData);


        return view('superadmin/vieweachinactivated', compact('joinedData'));
            
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
