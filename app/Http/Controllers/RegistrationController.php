<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TelegramController;

use Illuminate\Http\Request;
use App\Http\Requests\RequestUser;
use App\Models\User;
use App\Models\role_assign;
use App\Models\attributes;
use App\Models\company;
use App\Models\packages;
use App\Models\orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Auth;
use Session;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
      {
        if (Auth::check()) {
            return redirect('/')->with('error', 'Kindly Logout to submit Employee Registration Form');
        }
        // return view('employee_registration');

        $departments = attributes::where('attribute' , 'departments')->where('is_active' ,1)->get();
        $designations = attributes::where('attribute' , 'designations')->where('is_active' ,1)->get();
        $projects = attributes::where('attribute' , 'project')->where('is_active' ,1)->get();

        // $departments = DB::table('departments')->select('name')->get();
        // $designations = DB::table('designations')->select('name')->get();
        return view('employee_registration')->with('title',"Employee Registration")->with(compact('departments','designations','projects'));
    }

    public function registration_submit()
    {
        
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        foreach ($post_feilds as $key => $value) {
            if ($key == "password") {
                $post_feilds[$key] = Hash::make($value);
            }
        }

        $user = User::create($post_feilds);
        
        //$user = User::where("email" , $_POST['email'])->where("username" , $_POST['username'])->first();
        if(isset($_POST['package']) && $_POST['package'] != 0){
            $package = packages::where("id" , $_POST['package'])->where("is_active" , 1)->first();
            $order = orders::where("is_active" , 1)->where("user_id" , $user->id)->where("package_id" , $package->id)->first();
            // For Old package update
            if($order){
                // dd($order);
            }else{
                // New Memeber
                $params = [
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'amount' => $package->amount,
                    ];
                $order = orders::create($params);
                        // Add user to telegram channel
                // $this->connect_telegram($_POST);
                return redirect('/payment-link/'.$order->id.'/'.md5($order->id));$order = orders::create($params);
                        // Add user to telegram channel
                // $this->connect_telegram($_POST);
            }
        }
        $attempt = Auth::loginUsingId($user->id, $remember = true);
        // dd($attempt);
        //$attempt = Auth::attempt(['email' => $_POST['email'], 'password' => Hash::make($_POST['password'])]);
        

    
        
        if ($attempt) {
           return redirect()->route('welcome')->with('message', 'Welcome '.$user->name.' to the Nexa Forex');
        }else{
            return redirect()->back()->with('message', 'Your profile will be reviewed and will be activated once admin review.');
        }
    }
    
    private function connect_telegram($data){
        $name = $data['name'];
        $username = $data['username'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://beta.nexaforex.com/tele/connect_to_telegram.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "name=".$name."&username=".$username);
        
        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        // echo "<pre>";
        // print_r($result);
        // echo "yes";
        // die();
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
    
    public function validator_check()
    {
        
        if ($_POST['type'] == "duplicate") {
            $slug = Str::slug($_POST['val'], '_');

            if ($_POST['table'] == "user") {
                
                if ($_POST['column'] == "email") {
                    $msg_fail = "User is already registered";
                    $msg_success = "";
                    $resp['data'] = $_POST['val'];
                    $record = User::where("email" , $_POST['val'])->first();
                }
                if ($_POST['column'] == "username") {
                    $msg_fail = "Username is already registered";
                    $msg_success = $slug;
                    $record = User::where("username" , $slug)->first();
                    $resp['data'] = $slug;
                }
            }
            
            if ($record) {
                $resp['status'] = 0;
                $resp['message'] = $msg_fail;
                return json_encode($resp);
            }else{
                $resp['status'] = 1;
                $resp['message'] = $msg_success;
                return json_encode($resp);
            }
        }
    }

    public function registrations_submit(RequestUser $request)
    {
        
        $user = new User;
        $user->project_id = $request->project_id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->personal_email = $request->personal_email;
        $user->phonenumber = $request->phonenumber;
        $user->emergency_number = $request->emergency_number;
        $user->cnic = $request->cnic;
        $user->residential_address = $request->residential_address;
        $user->blood_group = $request->blood_group;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->emp_id = $request->emp_id;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->department = $request->department;
        $user->join_date = $request->join_date;
        $user->reporting_line = $request->reporting_line;
        if (isset($request->company_vehicle)) {
            $user->v_model_name = $request->v_model_name;
            $user->v_model_year = $request->v_model_year;
            $user->v_number_plate = $request->v_number_plate;    
        }else{
            $user->v_model_name = "";
            $user->v_model_year = "";
            $user->v_number_plate = "";
        }
        
        $user->bank_account_number = $request->bank_account_number;
        $user->password = Hash::make("admin321");

        // Avatar Upload
        if ($request->file('avatar') != '') {
            $path_a = ($request->file('avatar'))->store('uploads/avatar/'.md5(Str::random(20)), 'public');
            $user->profile_pic = $path_a;
        }

        // Resume Upload
        if ($request->file('cv_file') != '') {
            $path_r = ($request->file('cv_file'))->store('uploads/resume/'.md5(Str::random(20)), 'public');
            $user->resume_doc = $path_r;
        }

        // CNIC Upload
        if ($request->file('cnic_file') != '') {
            $path_c = ($request->file('cnic_file'))->store('uploads/cnic/'.md5(Str::random(20)), 'public');
            $user->cnic_doc = $path_c;
        }

        // Education Upload
        if ($request->file('education_file') != '') {
            $path_e = ($request->file('education_file'))->store('uploads/education/'.md5(Str::random(20)), 'public');
            $user->education_doc = $path_e;
        }

        $user->save();

        return redirect()->back()->with('message', 'User has been successfully added');
    }
}
