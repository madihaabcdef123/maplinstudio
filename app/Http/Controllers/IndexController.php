<?php

namespace App\Http\Controllers;

use App\Models\config;
use App\Models\inquiry;
use App\Models\orders;
use App\Models\packages;
use App\Models\User;
use App\Models\banner;
use App\Models\projects;
use App\Models\breakdown_img;
use App\Models\studios;
use App\Models\news;
use App\Models\jobs;
use App\Models\expert;
use App\Models\newsletter;
use App\Models\teams;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNewsLetter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Stripe;
use Auth;
use Crypt;
use DB;
use Helper;

// add new

class IndexController extends Controller
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
        $banner = banner::find(1);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $menu = "home";
        return view("web.index")->with(compact('banner', 'keywords', 'description', 'title','menu'));
    }

    public function planning()
    {
        $banner = banner::find(9);
        $inner_banner_1 = banner::find(14);
        $inner_banner_2 = banner::find(13);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $menu = "planning";
        return view("web.planning")->with(compact('banner', 'keywords', 'description', 'title', 'inner_banner_1', 'inner_banner_2','menu'));
    }

    public function signup()
    {
        $banner = banner::find(15);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;

        return view("web.signup")->with(compact('banner', 'keywords', 'description', 'title'));
    }



    public function project()
    {
        $banner = banner::find(2);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $projects = projects::where('is_active', 1)->where('is_deleted', 0)->get();
        $menu = "projects";
        return view("web.project")->with(compact('banner', 'keywords', 'description', 'title', 'projects','menu'));
    }

    public function studio()
    {
        $banner = banner::find(3);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $studios = studios::where('is_active', 1)->where('is_deleted', 0)->get();
        $menu = "studio";
        return view("web.studio")->with(compact('banner', 'keywords', 'description', 'title', 'studios','menu'));
    }

    public function about()
    {
        $banner = banner::find(4);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $inner_banner_1 = banner::find(14);
        $teams = teams::where('is_active', 1)->where('is_deleted', 0)->get();
        $menu = "about";
        return view("web.about")->with(compact('banner', 'keywords', 'description', 'title', 'inner_banner_1', 'teams','menu'));
    }

    public function contact()
    {
        $banner = banner::find(7);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $menu = "contact";
        return view("web.contact")->with(compact('banner', 'keywords', 'description', 'title','menu'));
    }

    public function news()
    {
        $banner = banner::find(5);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $news = news::where('is_active', 1)->where('is_deleted', 0)->get();
        $menu = "news";
        return view("web.news")->with(compact('banner', 'keywords', 'description', 'title', 'news','menu'));
    }
    public function news_detail_display($id = '')
    {

        if ($id == "" || $id == null) {
            return redirect()->back()->with('error', "Error: No record found");
        }
        $menu = "news";
        $project = projects::where("is_active", 1)->where("is_deleted", 0)->where("id", $id)->first();
        if (!$project) {
            return redirect()->back()->with('error', "Error: No record found");
        }
        $gallery = breakdown_img::where("is_active", 1)->where("model", "projects")->where("is_deleted", 0)->where("record_id", $id)->get();
        $projects = projects::where('is_active', 1)->where('is_deleted', 0)->get();
        $news_details = news::where('is_active', 1)->where('is_deleted', 0)->first();

        return view("web.news_details")->with(compact('news_details', 'project', 'gallery', 'projects','news'));
    }

    public function newsletter_submit(Request $request)
    {
        $newsletter = newsletter::where("email", $_POST['email'])->where("is_active", 1)->where("is_deleted", 0)->first();
        if ($newsletter) {
            return redirect()->route('welcome')->with('error', "This email is already registered!");
        }
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);
        $newsletter = newsletter::create($post_feilds);
        $details = [
            'type' => 'user',
            'body' => $_POST['email']
        ];
        try {
            Mail::to($_POST['email'])->send(new MailNewsLetter($details));
            $messages = "Congratulations, You’re Now on the list!";
        } catch (Exception $e) {
            $messages = "Congratulations, You’re Now on the list but unfortunatly we are working on the emails because of this you won’t get any email!";
        }
        $details = [
            'type' => 'admin',
            'body' => $_POST['email']
        ];
        //Mail::to(Helper::config('emailaddress'))->send(new MailNewsLetter($details));
        return redirect()->route('welcome')->with('message', $messages);
    }

    public function career()
    {
        $banner = banner::find(6);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $jobs = jobs::where("is_active", 1)->where("is_deleted", 0)->get();
        $job_title = jobs::distinct()->select('job_title')->where("is_active", 1)->where("is_deleted", 0)->get();
        $city = jobs::distinct()->select('city')->where("is_active", 1)->where("is_deleted", 0)->orderBy("city")->get();
        $job_type = jobs::distinct()->select('employment_type')->where("is_active", 1)->where("is_deleted", 0)->get();
        $skills = jobs::select('skills')->where("is_active", 1)->where("is_deleted", 0)->get();
        $all_skills = array();
        $string = "";
        foreach ($skills as $key => $value) {
            $string .= $value->skills . ",";
            $string = str_replace(".", "", $string);
            $string = str_replace(", ", ",", $string);
            $string = str_replace(" ,", ",", $string);
        }
        $all_skills = explode(",", $string);
        $all_skills = array_unique($all_skills);
        sort($all_skills);
        $menu = "career";
        $working_location = jobs::distinct()->select('role_location')->where("is_active", 1)->where("is_deleted", 0)->get();

        return view("web.career")->with(compact('banner', 'keywords', 'description', 'title', 'jobs', 'job_title', 'city', 'job_type', 'all_skills', 'working_location','menu'));
    }

    public function book_expert()
    {
        $banner = banner::find(8);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        $experts = expert::where("is_active", 1)->where("is_deleted", 0)->get();
        $menu = "expert";
        return view("web.book_expert")->with(compact('banner', 'keywords', 'description', 'title', 'experts','menu'));
    }

    public function book_expert_detail($id = '')
    {

        if ($id == "" || $id == null) {
            return redirect()->back()->with('error', "Error: No record found");
        }
        $menu = "expert";
        $getOneExpert = expert::where("is_active", 1)->where("is_deleted", 0)->where("id", $id)->first();
        $getAllExpert = expert::where("is_active", 1)->where("is_deleted", 0)->get();
        $user = Auth::user();

        if (!$getOneExpert) {
            return redirect()->back()->with('error', "Error: No record found");
        }

        return view("web.book_expert_detail")->with(compact('getOneExpert', 'getAllExpert','menu'));
    }



    public function career_detail($id = '')
    {

        if ($id == "" || $id == null) {
            return redirect()->back()->with('error', "Error: No record found");
        }
        $menu = "career";
        $job = jobs::where("is_active", 1)->where("is_deleted", 0)->where("id", $id)->first();
        if (!$job) {
            return redirect()->back()->with('error', "Error: Job is not active anymore");
        }
        $user = Auth::user();
        return view("web.career_detail")->with(compact('job', 'user','menu'));
    }

    public function project_detail($id = '')
    {

        if ($id == "" || $id == null) {
            return redirect()->back()->with('error', "Error: No record found");
        }

        $project = projects::where("is_active", 1)->where("is_deleted", 0)->where("id", $id)->first();
        if (!$project) {
            return redirect()->back()->with('error', "Error: No record found");
        }
        $gallery = breakdown_img::where("is_active", 1)->where("model", "projects")->where("is_deleted", 0)->where("record_id", $id)->get();

        $projects = projects::where('is_active', 1)->where('is_deleted', 0)->get();
        $menu = "projects";
        return view("web.project_detail")->with(compact('project', 'gallery', 'projects','menu'));
    }

    public function disclaimer()
    {

        $banner = banner::find(12);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        return view("web.disclaimer")->with(compact('banner', 'keywords', 'description', 'title'));
    }

    public function privacy()
    {

        $banner = banner::find(11);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        return view("web.privacy")->with(compact('banner', 'keywords', 'description', 'title'));
    }

    public function terms()
    {

        $banner = banner::find(10);
        $title = $banner->slug;
        $keywords = $banner->name;
        $description = $banner->details;
        return view("web.terms")->with(compact('banner', 'keywords', 'description', 'title'));
    }

    public function studio_detail($id = "")
    {

        if ($id == "" || $id == null) {
            return redirect()->back()->with('error', "Error: No record found");
        }
        $menu = "studio";
        $studio = studios::where("is_active", 1)->where("is_deleted", 0)->where("id", $id)->first();
        if (!$studio) {
            return redirect()->back()->with('error', "Error: No record found");
        }
        $gallery = breakdown_img::where("is_active", 1)->where("model", "studios")->where("is_deleted", 0)->where("record_id", $id)->get();
        return view("web.studio_detail")->with(compact('studio', 'gallery','menu'));
    }

    public function contact_submit(Request $request)
    {
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);
        $inquiry = inquiry::create($post_feilds);

        return redirect()->route('welcome')->with('message', "Inquiry has been submitted.");
    }


    public function upload_resume_submit(Request $request)
    {
        if (!empty($_FILES)) {
            $file = $request->file('file');
            $file_name = $request->file('file')->getClientOriginalName();
            $file_name = substr($file_name, 0, strpos($file_name, "."));
            $name = $file_name . "_" . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/resume/';
            $share = $request->file('file')->move($destinationPath, $name);
            $user = User::find(Auth::user()->id);
            $user->resume_doc = $name;
            $user->save();
            return redirect()->back()->with('message', 'Resume has been uploaded');
        } else {
            return redirect()->back()->with('error', 'Format not allowed');
        }
    }


    public function user_infoupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->personal_email = $request->personal_email;
        $user->phonenumber = $request->phonenumber;
        $user->emergency_number = $request->emergency_number;
        $user->cnic = $request->cnic;
        $user->residential_address = $request->residential_address;
        $user->blood_group = $request->blood_group;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->save();
        return redirect()->back()->with('message', 'Information updated successfully');
    }


    public function user_office_infoupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        // $user->emp_id = $request->emp_id;
        // $user->email = $request->email;
        // $user->designation = $request->designation;
        // $user->department = $request->department;
        // $user->join_date = $request->join_date;
        // $user->reporting_line = $request->reporting_line;
        $user->bank_account_number = $request->bank_account_number;
        $user->v_model_name = $request->v_model_name;
        $user->v_model_year = $request->v_model_year;
        $user->v_number_plate = $request->v_number_plate;

        $user->save();
        // Session::flash('message', 'This is a message!');
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back()->with('message', 'Information updated successfully');
    }

    public function profile_submit(Request $request)
    {
        $user = User::find(Auth::user()->id);
        // Avatar Upload
        if ($request->has('avatar')) {
            if ($request->file('avatar') != '') {
                $request->validate([
                    'avatar' => ['required', 'mimes:jpeg,png,jpg', 'max:2000']
                ]);
                $path_a = ($request->file('avatar'))->store('uploads/avatar/' . md5(Str::random(20)), 'public');
                $user->profile_pic = $path_a;
                $user->save();
                return redirect()->back()->with('message', 'Profile Picture been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your Profile Picture');
            }
        }
        // Resume Upload
        if ($request->has('cnic_file')) {
            if ($request->file('cnic_file') != '') {
                $request->validate([
                    'cnic_file' => ['required', 'mimes:jpeg,png,jpg', 'max:2000']
                ]);
                $path_c = ($request->file('cnic_file'))->store('uploads/cnic/' . md5(Str::random(20)), 'public');
                $user->cnic_doc = $path_c;
                $user->save();
                return redirect()->back()->with('message', 'NIC Picture has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your NIC Picture');
            }
        }
        // // CNIC Upload
        if ($request->has('cv_file')) {
            if ($request->file('cv_file') != '') {
                $request->validate([
                    'cv_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']
                ]);
                $path_r = ($request->file('cv_file'))->store('uploads/resume/' . md5(Str::random(20)), 'public');
                $user->resume_doc = $path_r;
                $user->save();
                return redirect()->back()->with('message', 'Resume/CV Document has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your Resume/CV Document');
            }
        }
        // // Education Upload
        if ($request->has('education_file')) {
            if ($request->file('education_file') != '') {
                $request->validate([
                    'education_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']
                ]);
                $path_e = ($request->file('education_file'))->store('uploads/education/' . md5(Str::random(20)), 'public');
                $user->education_doc = $path_e;
                $user->save();
                return redirect()->back()->with('message', 'Education Document has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'File not found, please update your Education Document');
            }
        }
    }

    // Add function end

    public function checkout()
    {
        // if (Auth::check()) {
        //     return redirect()->back()->with('error', "You're already logged In");
        // }
        $country = DB::table('country')->get();
        $package = null;
        if (isset($_GET) && isset($_GET['package'])) {
            $package = packages::where("is_active", 1)->where("slug", $_GET['package'])->first();
        }
        return view('web.checkout')->with(compact('package', 'country'));
    }

    public function checkout_submit()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
        } else {
            $token_ignore = ['_token' => ''];
            $post_feilds = array_diff_key($_POST, $token_ignore);
            foreach ($post_feilds as $key => $value) {
                if ($key == "password") {
                    $post_feilds[$key] = Hash::make($value);
                }
            }
            $user = User::create($post_feilds);
            $attempt = Auth::loginUsingId($user->id, $remember = true);
            // dd($attempt);
            //$attempt = Auth::attempt(['email' => $_POST['email'], 'password' => Hash::make($_POST['password'])]);
            // if ($attempt) {
            //    return redirect()->route('welcome')->with('message', 'Welcome '.$user->name.' to the Nexa Forex');
            // }else{
            //     return redirect()->back()->with('message', 'Your profile will be reviewed and will be activated once admin review.');
            // }
        }
        //$user = User::where("email" , $_POST['email'])->where("username" , $_POST['username'])->first();
        if (isset($_POST['package']) && $_POST['package'] != 0) {
            $package = packages::where("id", $_POST['package'])->where("is_active", 1)->first();
            $order = orders::where("is_active", 1)->where("user_id", $user->id)->where("package_id", $package->id)->first();
            // For Old package update
            if ($order) {
                // dd($order);
                return redirect()->back()->with('message', 'Already buy this Package');
            } else {
                // New Memeber
                $params = [
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'amount' => $package->amount,
                ];
                $order = orders::create($params);
                // Add user to telegram channel
                // $this->connect_telegram($_POST);
                if ($_POST['merchant'] == "Paypal") {
                    return redirect('/paylink-paypal/' . $order->id . '/' . md5($order->id));
                } else {
                    return redirect('/paylink-stripe/' . $order->id . '/' . md5($order->id));
                }
            }
        } else {
            return redirect()->back()->with('notify_error', 'No active link found.');
        }
    }

    public function paylink_paypal($oid = '', $code = '')
    {
        if ($code != md5($oid)) {
            return redirect()->back()->with('notify_error', 'No active link found.');
        }
        $order = orders::where("id", $oid)->first();
        if (!$order) {
            return redirect()->route('welcome')->with('notify_error', 'No record found.');
        }
        $order = orders::where("id", $oid)->where("is_active", 1)->where("paid_status", 1)->first();
        if ($order) {
            return redirect()->route('welcome')->with('notify_error', 'This is a Paid link, No more use of it.');
        }
        $order = orders::where("id", $oid)->first();
        $encrypt_id = Crypt::encrypt($oid);
        return view('web.paylink-paypal')->with('title', "Paylink")->with(compact('order', 'encrypt_id'));
    }

    public function paylink_stripe($oid = '', $code = '')
    {
        if ($code != md5($oid)) {
            return redirect()->back()->with('notify_error', 'No active link found.');
        }
        $order = orders::where("id", $oid)->first();
        if (!$order) {
            return redirect()->route('welcome')->with('notify_error', 'No record found.');
        }
        $order = orders::where("id", $oid)->where("is_active", 1)->where("paid_status", 'Paid')->first();
        if ($order) {
            return redirect()->route('welcome')->with('notify_error', 'This is a Paid link, No more use of it.');
        }
        $order = orders::where("id", $oid)->first();

        $encrypt_id = Crypt::encrypt($oid);
        return view('web.paylink-stripe')->with('title', "Paylink")->with(compact('order', 'encrypt_id', 'oid'));
    }

    private function connect_telegram($data)
    {
        $name = $data['name'];
        $username = $data['username'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://beta.nexaforex.com/tele/connect_to_telegram.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "name=" . $name . "&username=" . $username);

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

    public function payout(Request $request)
    {
        $id = Crypt::decrypt($request->recorder_token);
        $orders = orders::where("is_active", 1)->where("id", $id)->first();
        $order_data = orders::where("is_active", 1)->where("id", $id)->first()->toArray();
        if (!$orders) {
            return redirect()->back()->with('notify_error', 'No active link found.');
        }
        $payment_id = $request->payment_id;
        $payer_id = $request->payer_id;
        $payment_status = $request->payment_status;
        $response_result = $request->respon_data;
        $paid_status = 'Paid';
        orders::where('id', $id)->update(['transaction_id' => $payment_id, 'payer_id' => $payer_id, 'payment_status' => $payment_status, 'resp_data' => $response_result, 'paid_status' => $paid_status]);
        // logo
        $logo = "web/images/logo.png";
        // company name and email
        $config = config::find(2);
        $config['COMPANYEMAIL'] = $config->value;
        $config['COMPANY'] = "Nexa Forex";
        // user
        $user = user::where("is_active", 1)->where("id", $orders->user_id)->first();
        $user_array = array('name' => $user->name, 'username' => $user->username);
        $this->connect_telegram($user_array);
        // package
        $package = packages::where("is_active", 1)->where("id", $orders->package_id)->first();
        // User Email
        $user_body = "<html>
<head>
    <title>Order Confirmation</title>
</head>
<style>
    table tr:first-child > td > center{
        /*background: #ff0000;*/
    }
</style>
<body>
<table style='background:#000; border:#000 1px solid;' width='622' cellspacing='0' cellpadding='0' border='0'
       align='center'>
    <tbody>
    <tr class='first'>
        <td>
            <center>
                <img src='" . asset($logo) . "' style='padding: 15px;width: 150px;'>
            </center>
        </td>
    </tr>
    <tr>
        <td height='1'></td>
    </tr>
    <tr>
        <td style='font-family:Arial, Helvetica, sans-serif;' bgcolor='#f5f9f6'>
            <table width='622' cellspacing='0' cellpadding='0' border='0' align='center'>
                <tbody>
                <tr>
                   <td style='padding:8px 15px;'><p><strong>Dear ";
        $user_body .= $user['name'];
        $user_body .= "</strong></p></td>
                </tr>
                <tr>
                    <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;'>
                        This email is to let you know that we have received your order.
                        Thank you for shopping with us. Below are your order details:
                    </td>
                </tr>
                <tr style='margin:20px 0; float:left;height:86px; background-color:#000;' bgcolor='#68A13E'>
                    <td width='622'>
                        <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                               align='center'>
                            <tbody>
                            <tr style='color:#fff; '>
                                <td width='251' align='left '>Order # : <b>VSB-" . $order_data['id'] . "</b></td>
                                <td width='50'>&nbsp;</td>
                                <td width='50'>&nbsp;</td>
                                <td width='251' align='right'>Date : " . date('d M y', strtotime($order_data['created_at'])) . "</td>
                            </tr>
                            <tr style='color:#fff'>
                                <td width='350' align='left'>Payment Status :
                    <span style='font-size:13px;font-weight:bold'>
                      <span class='label label-danger'>Approved</span>
                                        </span>
                                </td>
";
        $total_amount = $order_data['amount'];
        $user_body .= "
                <td style='font-size:18px;' id='total_sum' width='400' align='right'><strong>Order Total =  $" . $total_amount . "</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;'>
                        <!-- <strong>
                            Expected delivery within 5 working days (please allow for up to 10 working days for delivery outside the UK).
                        </strong><br /> -->
                        Your email ID: " . $user['email'] . " <br>
                    </td>
                </tr>
                <tr style='margin:0px 0; float:left; height:50px;' bgcolor='#f6f5f5'>
                    <td width='622'>
                        <table style='margin-top:15px;' width='580' cellspacing='0' cellpadding='0' border='0'
                               align='center'>
                            <tbody>
                            <tr style='color:#000;'>
                                <td style='font-size:28px;' width='251' align='left '>Payment details</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style='float:left; padding:0 0 10px;border-bottom: 1px solid #cbcaca; margin-bottom:15px; '
                    bgcolor='#f6f5f5'>
                    <td width='622'>
                        <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                               align='center'>
                            <tbody>";
        $user_body .= "
                                <tr style='color:#000; height:30px'>
                                    <td colspan='3' width='251' align='left'>
                                        Package Name : " . $package['name'] . "
                                    </td>
                                </tr>
                                    <tr style='color:#000; height:30px'>
                                        <td width='251' align='left '>
                                        For " . $package['period'] . " Month
                                        </td>
                                        <td width='50'>&nbsp;</td>
                                        <td width='251' align='right'>Price =  $" . $package['amount'] . "</td>
                                    </tr>
                                ";
        $user_body .= "
                            <tr>
                                <td colspan='3' style='color:#000;font-weight:bold'>
                                    ------------------------------------------------------------------------------------------------------------
                                </td>
                            </tr>
                            <tr style='height:30px;'>
                                <td width='251' align='left'>Subtotal</td>
                                <td width='50'>&nbsp;</td>
                                <td width='251' align='right'>
                                     $" . $total_amount . "
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;'>
                        To make sure our emails reach your inbox, please add <a
                            href='mailto:" . $config['COMPANYEMAIL'] . "'>" . $config['COMPANYEMAIL'] . "</a> to your safe
                        list or address book.<br>
                        <!-- Please note that there will be a delivery charge for re-sending returned items if an incorrect address has been provided. <br /> -->
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>";
        // Admin
        $admin_body = "<html>
<head>
    <title>Order Confirmation</title>
</head>
<style>
    table tr:first-child > td > center{
        /*background: #ff0000;*/
    }
</style>
<body>
<table style='background:#000; border:#000 1px solid;' width='622' cellspacing='0' cellpadding='0' border='0'
       align='center'>
    <tbody>
    <tr class='first'>
        <td>
            <center>
                <img src='" . asset($logo) . "' style='padding: 15px;width: 150px;'>
            </center>
        </td>
    </tr>
    <tr>
        <td height='1'></td>
    </tr>
    <tr>
        <td style='font-family:Arial, Helvetica, sans-serif;' bgcolor='#f5f9f6'>
            <table width='622' cellspacing='0' cellpadding='0' border='0' align='center'>
                <tbody>
                <tr>
                   <td style='padding:8px 15px;'><p><strong>Dear Admin</strong></p></td>
                </tr>
                <tr>
                    <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;'>
                         This is a copy of received a package invoice. you can also check details in admin panel.
                    </td>
                </tr>
                <tr style='margin:20px 0; float:left;height:86px; background-color:#000;' bgcolor='#68A13E'>
                    <td width='622'>
                        <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                               align='center'>
                            <tbody>
                            <tr style='color:#fff; '>
                                <td width='251' align='left '>Order # : <b>VSB-" . $order_data['id'] . "</b></td>
                                <td width='50'>&nbsp;</td>
                                <td width='50'>&nbsp;</td>
                                <td width='251' align='right'>Date : " . date('d M y', strtotime($order_data['created_at'])) . "</td>
                            </tr>
                            <tr style='color:#fff'>
                                <td width='350' align='left'>Payment Status :
                    <span style='font-size:13px;font-weight:bold'>
                      <span class='label label-danger'>Approved</span>
                                        </span>
                                </td>
";
        $total_amount = $order_data['amount'];
        $admin_body .= "
                <td style='font-size:18px;' id='total_sum' width='400' align='right'><strong>Order Total =  $" . $total_amount . "</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style='margin:0px 0; float:left; height:50px;' bgcolor='#f6f5f5'>
                    <td width='622'>
                        <table style='margin-top:15px;' width='580' cellspacing='0' cellpadding='0' border='0'
                               align='center'>
                            <tbody>
                            <tr style='color:#000;'>
                                <td style='font-size:28px;' width='251' align='left '>Payment details</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style='float:left; padding:0 0 10px;border-bottom: 1px solid #cbcaca; margin-bottom:15px; '
                    bgcolor='#f6f5f5'>
                    <td width='622'>
                        <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                               align='center'>
                            <tbody>";
        $admin_body .= "
                                <tr style='color:#000; height:30px'>
                                    <td colspan='3' width='251' align='left'>
                                        Package Name : " . $package['name'] . "
                                    </td>
                                </tr>
                                    <tr style='color:#000; height:30px'>
                                        <td width='251' align='left '>
                                        For " . $package['period'] . " Month
                                        </td>
                                        <td width='50'>&nbsp;</td>
                                        <td width='251' align='right'>Price =  $" . $package['amount'] . "</td>
                                    </tr>
                                ";
        $admin_body .= "
                            <tr>
                                <td colspan='3' style='color:#000;font-weight:bold'>
                                    ------------------------------------------------------------------------------------------------------------
                                </td>
                            </tr>
                            <tr style='height:30px;'>
                                <td width='251' align='left'>Subtotal</td>
                                <td width='50'>&nbsp;</td>
                                <td width='251' align='right'>
                                     $" . $total_amount . "
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;'>
                        To make sure our emails reach your inbox, please add <a
                            href='mailto:" . $user['email'] . "'>" . $user['email'] . "</a> to your safe
                        list or address book.<br>
                        <!-- Please note that there will be a delivery charge for re-sending returned items if an incorrect address has been provided. <br /> -->
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <no-reply@nexaforex.com>' . "\r\n";
        $subject = $config["COMPANY"] . ' Order Inquiry';
        // Admin email
        $admin_email = $config["COMPANYEMAIL"];
        // $AdminMailSent=mail($admin_email,$subject,$admin_body,$headers);
        // if ($AdminMailSent==1) {
        // User email
        $user_email = $user['email'];
        // $UserMailSent=mail($user_email,$subject,$user_body,$headers);
        // }
        return redirect()->route('thank_you', $id)->with('notify_message', 'Thank you! Payment has been successfully completed, we will contact you shortly.');
    }

    public function payout_submit(Request $request)
    {
        $id = Crypt::decrypt($request->record_id);
        $orders = orders::where("is_active", 1)->where("id", $id)->first();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $grand_total = $orders->amount;
            if (Helper::config("tax") > 0) {
                $tax = Helper::config("tax");
                $tax_total = ($orders->amount / $tax);
                $grand_total = $tax_total + $orders->amount;
            }
            $charge = Stripe\Charge::create([
                "amount" => number_format($grand_total, 2) * 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "Payment from Nexa Forex.",
            ]);

            // Use Stripe's library to make requests...
        } catch (\Stripe\Exception\CardException $e) {
            return redirect()->back()->with('error', $e->getError()->message);
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            return redirect()->back()->with('error', $e->getError()->message);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            return redirect()->back()->with('error', $e->getError()->message);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            return redirect()->back()->with('error', $e->getError()->message);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            return redirect()->back()->with('error', $e->getError()->message);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            return redirect()->back()->with('error', $e->getError()->message);
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            return redirect()->back()->with('error', $e->getError()->message);
        }


        if (isset($charge) && isset($charge->id)) {
            $payment_id = $charge->id;
            $payer_id = $charge->balance_transaction;
            $payment_status = "Completed";
            $response_result = serialize($charge);
            $paid_status = 'Paid';
            orders::where('id', $id)->update([
                'transaction_id' => $payment_id, 'payer_id' => $payer_id,
                'payment_status' => $payment_status, 'resp_data' => $response_result, 'paid_status' => $paid_status, 'merchant' => "Stripe"
            ]);

            $order_data = orders::where("is_active", 1)->where("id", $id)->first()->toArray();
            if (!$orders) {
                return redirect()->back()->with('notify_error', 'No active link found.');
            }

            // logo
            $logo = "web/images/logo.png";
            // company name and email
            $config = config::find(2);
            $config['COMPANYEMAIL'] = $config->value;
            $config['COMPANY'] = "Nexa Forex";
            // user
            $user = user::where("is_active", 1)->where("id", $orders->user_id)->first();
            $user_array = array('name' => $user->name, 'username' => $user->username);
            $this->connect_telegram($user_array);
            // package
            $package = packages::where("is_active", 1)->where("id", $orders->package_id)->first();
            // User Email
            $user_body = "<html>
            <head>
                <title>Order Confirmation</title>
            </head>
                <style>
                    table tr:first-child > td > center{
                        /*background: #ff0000;*/
                    }
                </style>
            <body>
            <table style='background:#000; border:#000 1px solid;' width='622' cellspacing='0' cellpadding='0' border='0'
                   align='center'>
                <tbody>
                <tr class='first'>
                    <td>
                        <center>
                            <img src='" . asset($logo) . "' style='padding: 15px;width: 150px;'>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td height='1'></td>
                </tr>
                <tr>
                    <td style='font-family:Arial, Helvetica, sans-serif;' bgcolor='#f5f9f6'>
                        <table width='622' cellspacing='0' cellpadding='0' border='0' align='center'>
                            <tbody>
                            <tr>
                               <td style='padding:8px 15px;'><p><strong>Dear ";
            $user_body .= $user['name'];
            $user_body .= "</strong></p></td>
                            </tr>
                            <tr>
                                <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;'>
                                    This email is to let you know that we have received your order.
                                    Thank you for shopping with us. Below are your order details:
                                </td>
                            </tr>
                            <tr style='margin:20px 0; float:left;height:86px; background-color:#000;' bgcolor='#68A13E'>
                                <td width='622'>
                                    <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                                           align='center'>
                                        <tbody>
                                        <tr style='color:#fff; '>
                                            <td width='251' align='left '>Order # : <b>VSB-" . $order_data['id'] . "</b></td>
                                            <td width='50'>&nbsp;</td>
                                            <td width='50'>&nbsp;</td>
                                            <td width='251' align='right'>Date : " . date('d M y', strtotime($order_data['created_at'])) . "</td>
                                        </tr>
                                        <tr style='color:#fff'>
                                            <td width='350' align='left'>Payment Status :
                                <span style='font-size:13px;font-weight:bold'>
                                  <span class='label label-danger'>Approved</span>
                                                    </span>
                                            </td>
            ";
            $total_amount = $order_data['amount'];
            $user_body .= "
                            <td style='font-size:18px;' id='total_sum' width='400' align='right'><strong>Order Total =  $" . $total_amount . "</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;'>
                                    <!-- <strong>
                                        Expected delivery within 5 working days (please allow for up to 10 working days for delivery outside the UK).
                                    </strong><br /> -->
                                    Your email ID: " . $user['email'] . " <br>
                                </td>
                            </tr>
                            <tr style='margin:0px 0; float:left; height:50px;' bgcolor='#f6f5f5'>
                                <td width='622'>
                                    <table style='margin-top:15px;' width='580' cellspacing='0' cellpadding='0' border='0'
                                           align='center'>
                                        <tbody>
                                        <tr style='color:#000;'>
                                            <td style='font-size:28px;' width='251' align='left '>Payment details</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style='float:left; padding:0 0 10px;border-bottom: 1px solid #cbcaca; margin-bottom:15px; '
                                bgcolor='#f6f5f5'>
                                <td width='622'>
                                    <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                                           align='center'>
                                        <tbody>";
            $user_body .= "
                                            <tr style='color:#000; height:30px'>
                                                <td colspan='3' width='251' align='left'>
                                                    Package Name : " . $package['name'] . "
                                                </td>
                                            </tr>
                                                <tr style='color:#000; height:30px'>
                                                    <td width='251' align='left '>
                                                    For " . $package['period'] . " Month
                                                    </td>
                                                    <td width='50'>&nbsp;</td>
                                                    <td width='251' align='right'>Price =  $" . $package['amount'] . "</td>
                                                </tr>
                                            ";
            $user_body .= "
                                        <tr>
                                            <td colspan='3' style='color:#000;font-weight:bold'>
                                                ------------------------------------------------------------------------------------------------------------
                                            </td>
                                        </tr>
                                        <tr style='height:30px;'>
                                            <td width='251' align='left'>Subtotal</td>
                                            <td width='50'>&nbsp;</td>
                                            <td width='251' align='right'>
                                                 $" . $total_amount . "
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;'>
                                    To make sure our emails reach your inbox, please add <a
                                        href='mailto:" . $config['COMPANYEMAIL'] . "'>" . $config['COMPANYEMAIL'] . "</a> to your safe
                                    list or address book.<br>
                                    <!-- Please note that there will be a delivery charge for re-sending returned items if an incorrect address has been provided. <br /> -->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            </body>
            </html>";
            // Admin
            $admin_body = "<html>
            <head>
                <title>Order Confirmation</title>
            </head>
            <style>
                table tr:first-child > td > center{
                    /*background: #ff0000;*/
                }
            </style>
            <body>
            <table style='background:#000; border:#000 1px solid;' width='622' cellspacing='0' cellpadding='0' border='0'
                   align='center'>
                <tbody>
                <tr class='first'>
                    <td>
                        <center>
                            <img src='" . asset($logo) . "' style='padding: 15px;width: 150px;'>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td height='1'></td>
                </tr>
                <tr>
                    <td style='font-family:Arial, Helvetica, sans-serif;' bgcolor='#f5f9f6'>
                        <table width='622' cellspacing='0' cellpadding='0' border='0' align='center'>
                            <tbody>
                            <tr>
                               <td style='padding:8px 15px;'><p><strong>Dear Admin</strong></p></td>
                            </tr>
                            <tr>
                                <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;'>
                                     This is a copy of received a package invoice. you can also check details in admin panel.
                                </td>
                            </tr>
                            <tr style='margin:20px 0; float:left;height:86px; background-color:#000;' bgcolor='#68A13E'>
                                <td width='622'>
                                    <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                                           align='center'>
                                        <tbody>
                                        <tr style='color:#fff; '>
                                            <td width='251' align='left '>Order # : <b>VSB-" . $order_data['id'] . "</b></td>
                                            <td width='50'>&nbsp;</td>
                                            <td width='50'>&nbsp;</td>
                                            <td width='251' align='right'>Date : " . date('d M y', strtotime($order_data['created_at'])) . "</td>
                                        </tr>
                                        <tr style='color:#fff'>
                                            <td width='350' align='left'>Payment Status :
                                <span style='font-size:13px;font-weight:bold'>
                                  <span class='label label-danger'>Approved</span>
                                                    </span>
                                            </td>
            ";
            $total_amount = $order_data['amount'];
            $admin_body .= "
                            <td style='font-size:18px;' id='total_sum' width='400' align='right'><strong>Order Total =  $" . $total_amount . "</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style='margin:0px 0; float:left; height:50px;' bgcolor='#f6f5f5'>
                                <td width='622'>
                                    <table style='margin-top:15px;' width='580' cellspacing='0' cellpadding='0' border='0'
                                           align='center'>
                                        <tbody>
                                        <tr style='color:#000;'>
                                            <td style='font-size:28px;' width='251' align='left '>Payment details</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style='float:left; padding:0 0 10px;border-bottom: 1px solid #cbcaca; margin-bottom:15px; '
                                bgcolor='#f6f5f5'>
                                <td width='622'>
                                    <table style='margin-top:20px;' width='580' cellspacing='0' cellpadding='0' border='0'
                                           align='center'>
                                        <tbody>";
            $admin_body .= "
                                            <tr style='color:#000; height:30px'>
                                                <td colspan='3' width='251' align='left'>
                                                    Package Name : " . $package['name'] . "
                                                </td>
                                            </tr>
                                                <tr style='color:#000; height:30px'>
                                                    <td width='251' align='left '>
                                                    For " . $package['period'] . " Month
                                                    </td>
                                                    <td width='50'>&nbsp;</td>
                                                    <td width='251' align='right'>Price =  $" . $package['amount'] . "</td>
                                                </tr>
                                            ";
            $admin_body .= "
                                        <tr>
                                            <td colspan='3' style='color:#000;font-weight:bold'>
                                                ------------------------------------------------------------------------------------------------------------
                                            </td>
                                        </tr>
                                        <tr style='height:30px;'>
                                            <td width='251' align='left'>Subtotal</td>
                                            <td width='50'>&nbsp;</td>
                                            <td width='251' align='right'>
                                                 $" . $total_amount . "
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;'>
                                    To make sure our emails reach your inbox, please add <a
                                        href='mailto:" . $user['email'] . "'>" . $user['email'] . "</a> to your safe
                                    list or address book.<br>
                                    <!-- Please note that there will be a delivery charge for re-sending returned items if an incorrect address has been provided. <br /> -->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            </body>
            </html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <no-reply@nexaforex.com>' . "\r\n";
            $subject = $config["COMPANY"] . ' Order Inquiry';
            // Admin email
            $admin_email = $config["COMPANYEMAIL"];
            // $AdminMailSent=mail($admin_email,$subject,$admin_body,$headers);
            // if ($AdminMailSent==1) {
            // User email
            $user_email = $user['email'];
            // $UserMailSent=mail($user_email,$subject,$user_body,$headers);
            // }
            return redirect()->route('thank_you', $id)->with('notify_message', 'Thank you! Payment has been successfully completed, we will contact you shortly.');
        } else {
            return redirect()->back()->with('error', "Payment Fail, Please try again.");
        }
    }

    public function thank_you()
    {
        $menu = 'Thank You';
        return view('web.thank_you')->with('title', 'Thank You');
    }

    public function modal_form()
    {



        return view('web.extends.modal');
    }

    public function thank_you_upload()
    {



        return view('web.thank-you');
    }


    // Add function end

}