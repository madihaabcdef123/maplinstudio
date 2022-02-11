<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\breakdown;
use App\Models\education;
use App\Models\User;
use App\Models\weeklyBreakdown;
use App\Models\signal_report;  
use App\Models\breakdown_img;  
use Illuminate\Support\Str;
use Auth;
class CustomerController extends Controller {

    // for index page
    public function index() 
      {
        $user = Auth::user();
        $orders = null;

        if ($user->role_id == 4) {
            $breakdown = breakdown::with("User")->where("is_active" ,1)->where("user_id" ,$user->id)->get();
            $education = education::with("User")->where("is_active" ,1)->where("user_id" ,$user->id)->get();

            // $orders = orders::where("is_active" ,1)->where()->get();    
        }else{
            $breakdown = breakdown::with("User")->where("is_active" ,1)->get();
            $education = education::with("User")->where("is_active" ,1)->get();
            $orders = orders::where("is_active" ,1)->where("user_id" , $user->id)->get();    
        }
        // dd($user->id);
        
        //$weekly= weeklyBreakdown::with("User")->where("is_active" ,1)->where("type" , 'weeklyBreakdown')->count();    
        //$mid_week =weeklyBreakdown::with("User")->where("is_active" ,1)->where("type" , 'weeklyMidBreakdown')->count();

        $book = $video = $weekly = $mid_week = 0;
                
        if($breakdown){
            foreach($breakdown as $break){
                if (isset($break->User)) {
                    if($break->type == "mid-week"){
                        $mid_week++;
                    }
                    if($break->type == "weekly"){
                        $weekly++;
                    }
                }
            }
        }

        if($education){
            foreach($education as $val){
                if (isset($val->User)) {
                    if($val->type == "book"){
                    $book++;
                    }
                    if($val->type == "video"){
                        $video++;
                    }
                }
            }
        }

        return view('customer.index')->with(compact('breakdown','mid_week','weekly','book','video','orders'));
    }
    // for Education page View
    public function education() {
        $user = Auth::user();
        if ($user->role_id == 4) {
            $education = education::with("User")->where("is_active" ,1)->where("user_id" ,$user->id)->get();
        }else{
            $education = education::with("User")->where("is_active" ,1)->get();   
        }
        
        return view('customer.education')->with(compact('education'));
    }
    // for Edit Profile page View
    public function edit_profile() {
        $user = Auth::user();
        return view('customer.edit-profile')->with(compact('user'));
    }
    // for reset Password page View
    public function reset_Password() {
        return view('customer.reset-password');
    }
    // for View Weekly Breakdown page
    public function view_Weeklybrekdown() {
        $user = Auth::user();
        if($user->role_id == 4){
            $weeklybreakdown=weeklyBreakdown::with("User")->where("user_id" , $user->id)->where('type','weeklyBreakdown')->orderBy('id', 'desc')->get();
        }else{
            $weeklybreakdown=weeklyBreakdown::with("User")->where('type','weeklyBreakdown')->orderBy('id', 'desc')->get();
        }
        return view('customer.view-weeklybreakdown')->with(compact('weeklybreakdown'));
    }
    // for View Mid week MArket page
    public function mid_Week_marketReview() {
        $user = Auth::user();
        if($user->role_id == 4){
            $weeklyMidbreakdown=weeklyBreakdown::with("User")->where("user_id" , $user->id)->where('type','weeklyMidBreakdown')->where('is_active',1)->orderBy('id', 'DESC')->get();
        }else{
            $weeklyMidbreakdown=weeklyBreakdown::with("User")->where('type','weeklyMidBreakdown')->where('is_active',1)->orderBy('id', 'DESC')->get();
        }
        return view('customer.mid-week-market-review')->with(compact('weeklyMidbreakdown'));
    }
    // for Monthly signals Report  page
    public function monthly_SignalReport() {
        $user = Auth::user();
        if ($user->role_id == 4) {
            $signal_report = signal_report::with("User")->where("is_active" ,1)->where("user_id" ,$user->id)->get();
        }else{
            $signal_report = signal_report::with("User")->where("is_active" ,1)->get();
        }
        
        return view('customer.monthly-signals-report')->with(compact('signal_report'));
    }
    // for economiccal  page  View
    public function economiccal() {
        return view('customer.economiccal');
    }
    // for Billing  page  View
    public function billing() {
        return view('customer.billing');
    }
    // for Edit payment Card  page  View
    public function edit_paymentcard() {
        return view('customer.edit-paymentcard');
    }
    // for All Invoices  page  View
    public function allinvoices() {
        $user =  Auth::user();
        $orders = orders::where("user_id" , $user->id)->get();
        return view('customer.allinvoices')->with(compact('orders'));
    }
    // for Edit Join Telegram  page  View
    public function edit_Jointelegram() {
        return view('customer.edit-join-telegram');
    }
    // for Edit Books  page  View
    public function edit_books() {
        return view('customer.edit-books');
     }
    // for Edit Vedios  page  View
    public function edit_vedios() {
        return view('customer.edit-videos');
    }
    // for edit_weekly_report  page  View
    public function edit_weekly_report() {
        return view('customer.edit-weekly-report');
    }    // for edit_weekly_report  page  View
    public function edit_mid_weekly_report() {
        return view('customer.edit-mid-weekly-report');
    }

    // for Weekly Breakdown  page  View
    public function weekly_breakdown() {
        return view('customer.weekly-breakdown');
    }

     // for Add Weekly Breakdown  page  View
    public function add_weekly_breakdown() {   
        $user =  Auth::user();
        if ($user->role_id != 4) {
              return redirect()->back()->with('message', 'No page found');
        }
        return view('customer.add-weekly-report');
      }

     // for Add Weekly Breakdown  page  View
    public function add_mid_weekly_breakdown() {  
        $user =  Auth::user();
        if ($user->role_id != 4) {
               return redirect()->back()->with('message', 'No page found');
        }
        return view('customer.add-mid-weekly-report');
    }

    // for Weekly Breakdown Data submit
     public function weekly_breakdown_submit(Request $request) {
        $user =  Auth::user();
        if (isset($_POST['record_id']) && $_POST['record_id'] != 0) {
            // dd($_POST);
            $id = $_POST['record_id'];
            $token_ignore = ['_token' => '' , 'record_id' => '' , 'editor1' => ''];
            $post_feilds = array_diff_key($_POST , $token_ignore);
            $post_feilds['details'] = $_POST['editor1'];
            if ($request->hasFile('file')) {
                foreach ($request->file as $key => $img_path) {
                    $filename =$img_path->getClientOriginalName();
                    $path = $img_path->storeAs('customer/weekbreakdown', $filename, 'public');
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    
                    if ($ext == "png" || $ext == "jpeg" || $ext == "jpg") {
                        $breakdown_img = new breakdown_img;
                        $breakdown_img->record_id = $weeklybreakdown->id;
                        $breakdown_img->user_id = $user->id;
                        $breakdown_img->name = $filename;
                        $breakdown_img->path = $path;
                        $breakdown_img->save();
                    }
                }
            }
            $weeklyBreakdown = weeklyBreakdown::where("id" , $id)->update($post_feilds);    
            return redirect()->back()->with('message', 'Record has been updated');
        }else{
            $weeklybreakdown= new weeklyBreakdown;
            $weeklybreakdown->user_id = Auth::user()->id;
            $weeklybreakdown->whishlist=$request->whishlist;
            $weeklybreakdown->type=$request->type;
            $weeklybreakdown->details=$request->editor1;
            $weeklybreakdown->save();
            if ($request->hasFile('file')) {
                foreach ($request->file as $key => $img_path) {

                    $filename =$img_path->getClientOriginalName();
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $path = $img_path->storeAs('customer/weekbreakdown', $filename, 'public');
                    if ($ext == "png" || $ext == "jpeg" || $ext == "jpg") {
                        $breakdown_img = new breakdown_img;
                        $breakdown_img->record_id = $weeklybreakdown->id;
                        $breakdown_img->user_id = $user->id;
                        $breakdown_img->name = $filename;
                        $breakdown_img->path = $path;
                        $breakdown_img->save();
                    }
                }
            }
            
            if ($request->type=='weeklyBreakdown') {
                return redirect()->route('view-weekly-breakdown')->with('message', 'Data has been Submit');
            }else{
                return redirect()->route('mid-week-market-review')->with('message', 'Data has been Submit');
            }
        }
     }
       
    // for Mid Week Review page  View
    public function mid_weekreview() {
        return view('customer.mid-week-review');
    }
    // forEdit Monthly Signals Report Page View
    public function edit_monthly_signalsreport() {
        return view('customer.edit-monthly-signalsreport');
    } 

    public function terms_policy() {
        return view('customer.terms-policy');
    }

    public function file_reader() {
        return view('file-reader');
    }

    public function add_record($slug='')
    {
        if ($slug == 'book') {
             return view('customer.edit-books');
        }elseif($slug == 'video'){
            return view('customer.edit-videos');
        }elseif($slug == 'signal'){
            $user = Auth::user();
            $months = array('January' , 'Feburary' , 'March' , 'April' , 'May' ,'June' , 'July' ,'August' ,'September' ,'October' ,'November','December');
            return view('customer.edit-monthly-signalsreport')->with(compact('months'));
        }else{
            return redirect()->back()->with('notify_error','No link found');
        }
    }
    
    public function upload_submit(Request $request)
      {
        if (isset($_POST['record_id']) && $_POST['record_id'] != 0) {
            $id = $_POST['record_id'];
            $token_ignore = ['_token' => '' , 'record_id' => ''];
            $post_feilds = array_diff_key($_POST , $token_ignore);

            if ($_POST['type'] == "book") {
                $cover_path = '';
                $file_path = '';
                if ($request->file('cover') != '') {
                    $cover_path = ($request->file('cover'))->store('uploads/cover/'.md5(Str::random(20)), 'public');
                    $post_feilds['cover']=$cover_path;
                }
                
                if ($request->file('file_upload') != '') {
                    $file_path = ($request->file('file_upload'))->store('uploads/book/'.md5(Str::random(20)), 'public');
                    $post_feilds['file_upload']=$file_path;
                }
                
            }

            if ($_POST['type'] == "video") {
                $cover_path = '';
                $file_path = '';
                if ($request->file('cover') != '') {
                    $cover_path = ($request->file('cover'))->store('uploads/cover/'.md5(Str::random(20)), 'public');
                }
                $post_feilds['cover']=$cover_path;
            }


            $education = education::where("id" , $id)->update($post_feilds);    
            $message = "Record has been updated";
        }else{
            $token_ignore = ['_token' => '' , 'record_id' => ''];
            $post_feilds = array_diff_key($_POST , $token_ignore);

            if ($_POST['type'] == "book") {
                $cover_path = '';
                $file_path = '';
                if ($request->file('cover') != '') {
                    $cover_path = ($request->file('cover'))->store('uploads/cover/'.md5(Str::random(20)), 'public');
                }
                $post_feilds['cover']=$cover_path;
                if ($request->file('file_upload') != '') {
                    $file_path = ($request->file('file_upload'))->store('uploads/book/'.md5(Str::random(20)), 'public');
                }
                $post_feilds['file_upload']=$file_path;
            }

            if ($_POST['type'] == "video") {
                $cover_path = '';
                $file_path = '';
                if ($request->file('cover') != '') {
                    $cover_path = ($request->file('cover'))->store('uploads/cover/'.md5(Str::random(20)), 'public');
                }
                $post_feilds['cover']=$cover_path;
            }

            $education = education::create($post_feilds);
            $message = "Record has been added";
        }
        return redirect()->back()->with('message',$message);
    }

    public function signal_upload_submit(Request $request)
    {
        if (isset($_POST['record_id']) && $_POST['record_id'] != 0) {
            $id = $_POST['record_id'];
            $token_ignore = ['_token' => '' , 'record_id' => ''];
            $post_feilds = array_diff_key($_POST , $token_ignore);

            if ($request->file('file_upload') != '') {
                $cover_path = ($request->file('file_upload'))->store('uploads/signal/'.md5(Str::random(20)), 'public');
            }
            $post_feilds['file_upload']=$cover_path;

            $education = signal_report::where("id" , $id)->update($post_feilds);    
            $message = "Record has been updated";
        }else{
            $token_ignore = ['_token' => '' , 'record_id' => ''];
            $post_feilds = array_diff_key($_POST , $token_ignore);

            $cover_path = '';
            if ($request->file('file_upload') != '') {
                $cover_path = ($request->file('file_upload'))->store('uploads/signal/'.md5(Str::random(20)), 'public');
            }
            $post_feilds['file_upload']=$cover_path;

            $education = signal_report::create($post_feilds);
            $message = "Record has been added";
        }
        return redirect()->back()->with('message',$message);
    }
    
    public function edit_record($slug='' , $id = 0)
    {

        $user =  Auth::user();
        if ($id == 0 || $id == '') {
            return redirect()->back()->with('error','No link found');
        }
        if ($slug == 'book') {
            $education = education::where("id" , $id)->where("user_id" ,$user->id)->first();  
            if (!$education) {
                return redirect()->back()->with('error','No link found');
            }
            return view('customer.edit-books')->with(compact('education'));
        }elseif($slug == 'video'){
            $education = education::where("id" , $id)->where("user_id" ,$user->id)->first();  
            if (!$education) {
                return redirect()->back()->with('error','No link found');
            }
            return view('customer.edit-videos')->with(compact('education'));
        }elseif($slug == 'mid-weekly-breakdown'){
            $midweeklyBreakdown = weeklyBreakdown::where("id" , $id)->where("user_id" ,$user->id)->first();  
            if (!$midweeklyBreakdown) {
                return redirect()->back()->with('error','No link founds');
            }
            return view('customer.edit-mid-weekly-report')->with(compact('midweeklyBreakdown'));
        }elseif($slug == 'weekly-breakdown'){
            $weeklyBreakdown = weeklyBreakdown::where("id" , $id)->where("user_id" ,$user->id)->first();  
            if (!$weeklyBreakdown) {
                return redirect()->back()->with('error','No link founds');
            }
            return view('customer.edit-weekly-report')->with(compact('weeklyBreakdown'));
        }elseif($slug == 'signal'){
            $months = array('January' , 'Feburary' , 'March' , 'April' , 'May' ,'June' , 'July' ,'August' ,'September' ,'October' ,'November','December');
            $signal_report = signal_report::where("id" , $id)->where("user_id" ,$user->id)->first(); 
        }else{
            return view('customer.edit-monthly-signalsreport')->with(compact('signal_report','months'));
            return redirect()->back()->with('error','No link found1');
        }
    }

    public function update_profile_submit(Request $request)
    {
        $user = Auth::user();
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);

        if ($request->file('profile_pic') != '') {
            $cover_path = ($request->file('profile_pic'))->store('uploads/avatar/'.md5(Str::random(20)), 'public');
            $post_feilds['profile_pic']=$cover_path;
        }
        
        $users = User::where("id" , $user->id)->update($post_feilds);
        return redirect()->back()->with('message',$user->name.' profile has been updated');
    }
}
