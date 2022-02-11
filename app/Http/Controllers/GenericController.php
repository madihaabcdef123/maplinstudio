<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAttributes;
use App\Models\attributes;
use App\Models\orders;
use App\Models\role_assign;
use App\Models\User;
use App\Models\banner;
use App\Models\breakdown_img;
use Auth;
use Crypt;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;

class GenericController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $user = Helper::curren_user();

        // $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        // $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();

        // View()->share('att_tag',$att_tag);
        // View()->share('role_assign',$role_assign);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function roles()
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->back()->with('error', "No Link found");
        }
        $att_tag = attributes::where('is_active', 1)->select('attribute')->distinct()->get();
        $attributes = attributes::where('is_active', 1)->get();
        $role_assign = role_assign::where('is_active', 1)->where("role_id", $user->role_id)->first();

        return view('roles/roles')->with(compact('attributes', 'att_tag', 'role_assign'));
    }

    public function generic_submit(RequestAttributes $request)
    {
        // $user = User::find(Auth::user()->id);
        // $columns  = \Schema::getColumnListing("attributes");
        // $ignore = ['id' , 'is_active' ,'is_deleted' , 'created_at' , 'updated_at' ,'deleted_at'];
        //$push_in = array_diff($columns, $ignore);

        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);

        try {
            attributes::insert($post_feilds);
            return redirect()->back()->with('message', 'Information updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error will saving record');
        }
    }

    public function role_assign_modal()
    {
        $user = Auth::user();
        $role_assign = role_assign::where('is_active', 1)->where("role_id", $_POST['role_id'])->first();
        $att_tag = attributes::where('is_active', 1)->where("model", "!=", null)->select('attribute')->distinct()->get();
        $body = "";
        if ($att_tag) {
            $route = route('roleassign_submit');
            $body .= "<input type='hidden' name='role_id' id='fetch-role-id' value='" . $_POST['role_id'] . "'>";
            if ($role_assign) {
                $checker = unserialize($role_assign->assignee);
                $body .= "<input type='hidden' name='record_id' value='" . $role_assign->id . "'>";
            } else {
                $checker = [];
            }
            foreach ($att_tag as $key => $role) {
                $body .= "<tr><td>" . ucwords($role->attribute) . "</td><td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck1" . $key . "' ";
                if (in_array($role->attribute . "_1", $checker)) {
                    $body .= "checked";
                }
                $body .= " value='" . $role->attribute . "_1'>
                                  <label class='custom-control-label' for='customCheck1" . $key . "'>1</label></div></td>

                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck2" . $key . "' ";
                if (in_array($role->attribute . "_2", $checker)) {
                    $body .= "checked";
                }
                $body .= " value='" . $role->attribute . "_2'>
                                  <label class='custom-control-label' for='customCheck2" . $key . "'>2</label></div></td>

                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck3" . $key . "' ";
                if (in_array($role->attribute . "_3", $checker)) {
                    $body .= "checked";
                }
                $body .= " value='" . $role->attribute . "_3'>
                                  <label class='custom-control-label' for='customCheck3" . $key . "'>3</label></div></td>

                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck4" . $key . "' ";
                if (in_array($role->attribute . "_4", $checker)) {
                    $body .= "checked";
                }
                $body .= " value='" . $role->attribute . "_4'>
                                  <label class='custom-control-label' for='customCheck4" . $key . "'>4</label></div></td></tr>";
            }
        }

        $bod['body'] = $body;
        $response = json_encode($bod);
        return $response;
    }

    public function roleassign_submit(Request $request)
    {
        if (isset($request->record_id) && $request->record_id != 0) {
            $role_assign = role_assign::where('is_active', 1)->where("id", $request->record_id)->first();
        } else {
            $role_assign = new role_assign;
            $role_assign->role_id = $request->role_id;
        }

        $role_assign->assignee = serialize($request->assignee);
        $role_assign->save();
        return redirect()->back()->with('message', 'Role has been assigned successfully');
    }

    public function listing($slug = '')
    {
        $user = Auth::user();
        if (Auth::user()->role_id != 1) {
            return redirect()->back()->with('error', 'No Page Found');
        }

        $role_assign = role_assign::where('is_active', 1)->where("role_id", $user->role_id)->first();
        if ($role_assign) {
            $validator = Helper::check_rights($slug);
            if (is_null($validator)) {
                return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
            }
        } else {
            return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
        }

        $form = null;
        $table = null;
        $eloquent = '';

        if ($slug == "roles") {
            $att_tag = attributes::where('is_active', 1)->select('attribute')->distinct()->get();
            $attributes = attributes::where('is_active', 1)->where('attribute', $slug)->get();
            $is_hide = 0;
        } else {

            $att_tag = attributes::where('is_active', 1)->select('attribute')->distinct()->get();
            $attributes = attributes::where('is_active', 1)->where('attribute', $slug)->get();
            $get_eloquent = attributes::where('is_active', 1)->where('attribute', $slug)->first();
            // dd($get_eloquent);
            if ($slug == "users") {
                $slug = "User";
            }
            $eloquent = ($get_eloquent->model != '') ? $get_eloquent->model : '';
            $is_hide = 1;

            if ($eloquent != '') {
                $form = $this->generated_form($slug);
                $table = $this->generated_table($slug);
            }
            if ($slug == "User") {
                $slug = "users";
            }
        }

        return view('roles/crud')->with(compact('attributes', 'att_tag', 'role_assign', 'validator', 'slug', 'is_hide', 'eloquent', 'form', 'table'));
    }

    private function generated_form($slug = '')
    {
        $user = Auth::user();

        if ($slug == "billing") {
            $slug = "orders";
        }

        $body = '';
        $route_url = route('crud_generator', $slug);

        if ($slug == 'testimonials') {

            $body = '<form class="" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="detail" class="form-control" required=""></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;
        }
        else if($slug == 'banner'){

            $setImage = asset("images/no-img-avalible.png");

            $body = '<form class="" enctype="multipart/form-data" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">SEO Keywords:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="SEO Keywords" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Page Title:</label>
                                <div class="d-flex">
                                    <input id="slug" placeholder="Page Title" name="slug" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">SEO Description:</label>
                                <div class="d-flex">
                                    <textarea id="details" required name="details" class="form-control" required=""></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">File:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg" alt="banner"/>
                                    <a style="display:none;" class="btn btn-primary" href="" id="editVideo">
                                      Play on New Tab
                                    </a>
                                    <input type="file" name="img" value="'. old("img") .'" id="img" class="form-control mt-2 mb-2"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;

        }else if($slug == 'studios'){

            $setImage = asset("images/no-img-avalible.png");

            $body = '<form class="" enctype="multipart/form-data" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="details" class="form-control" required=""></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Banner Image:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg" alt="banner"/>
                                    <input type="file" name="banner_img" id="banner_img" class="form-control mt-2 mb-2" accept=".png,.jpg,.jpeg"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Inner Image 01:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg2" alt="banner"/>
                                    <input type="file" name="inner_1_img" id="inner_1_img" class="form-control mt-2 mb-2" accept=".png,.jpg,.jpeg"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Inner Image 02:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg3" alt="banner"/>
                                    <input type="file" name="inner_2_img" id="inner_2_img" class="form-control mt-2 mb-2" accept=".png,.jpg,.jpeg"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;

        }
        else if($slug == 'projects'){

            $setImage = asset("images/no-img-avalible.png");

            $body = '<form class="" enctype="multipart/form-data" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Price:</label>
                                <div class="d-flex">
                                    <input id="price" placeholder="Price" name="price" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Size:</label>
                                <div class="d-flex">
                                    <input id="size" placeholder="Size" name="size" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="details" class="form-control" required=""></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">File:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg" alt="banner"/>
                                    <a style="display:none;" class="btn btn-primary" href="" id="editVideo">
                                      Play on New Tab
                                    </a>
                                    <input type="file" name="img" value="'. old("img") .'" id="img" class="form-control mt-2 mb-2"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;

        }else if($slug == 'news'){

            $setImage = asset("images/no-img-avalible.png");

            $body = '<form class="" enctype="multipart/form-data" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="details" required name="details" class="form-control" required=""></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Long Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="long_details" class="form-control" required=""></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">File:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg" alt="banner"/>
                                    
                                    <input type="file" name="img" value="'. old("img") .'" id="img" class="form-control mt-2 mb-2"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;

        }else if($slug == 'expert'){

            $setImage = asset("images/no-img-avalible.png");

            $body = '<form class="" enctype="multipart/form-data" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Post Code:</label>
                                <div class="d-flex">
                                    <input id="postcode" placeholder="Post Code" name="postcode" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="details" required name="details" class="form-control" required=""></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Long Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="long_details" class="form-control" required=""></textarea>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">File:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg" alt="banner"/>
                                    
                                    <input type="file" name="img" accept=".png,jpeg,.jpg" id="img" class="form-control mt-2 mb-2"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;

        }else if($slug == 'teams'){

            $setImage = asset("images/no-img-avalible.png");

            $body = '<form class="" enctype="multipart/form-data" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Designation:</label>
                                <div class="d-flex">
                                    <input id="designation" placeholder="Designation" name="designation" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">File:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg" alt="banner"/>
                                    
                                    <input type="file" name="img" accept=".png,jpeg,.jpg" id="img" class="form-control mt-2 mb-2"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;

        }else if($slug == 'jobs'){

            $setImage = asset("web/images/Layer-22.png");

            $body = '<form class="" enctype="multipart/form-data" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Title:</label>
                                <div class="d-flex">
                                    <input id="job_title" placeholder="Title" name="job_title" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Work Location:</label>
                                <div class="d-flex">
                                    <input id="role_location" placeholder="Work Location" name="role_location" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">City:</label>
                                <div class="d-flex">
                                    <input id="city" placeholder="City" name="city" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Job Shift:</label>
                                <div class="d-flex">
                                    <input id="part_time" placeholder="Job Shift" name="part_time" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Job Type:</label>
                                <div class="d-flex">
                                    <input id="employment_type" placeholder="Job Type" name="employment_type" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Functional Area:</label>
                                <div class="d-flex">
                                    <input id="functional_area" placeholder="Functional Area" name="functional_area" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>


                        

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Department:</label>
                                <div class="d-flex">
                                    <input id="department" placeholder="Department" name="department" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Location:</label>
                                <div class="d-flex">
                                    <input id="location" placeholder="Location" name="location" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Gender:</label>
                                <div class="d-flex">
                                    <input id="gender" placeholder="Gender" name="gender" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Minimum Education:</label>
                                <div class="d-flex">
                                    <input id="min_education" placeholder="Minimum Education" name="min_education" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Degree Title:</label>
                                <div class="d-flex">
                                    <input id="degree" placeholder="Degree Title" name="degree" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Starting Salary:</label>
                                <div class="d-flex">
                                    <input id="starting_salary" placeholder="Starting Salary" name="starting_salary" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Ending Salary:</label>
                                <div class="d-flex">
                                    <input id="ending_salary" placeholder="Ending Salary" name="ending_salary" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Skills:</label>
                                <div class="d-flex">
                                    <input id="skills" placeholder="Skills" name="skills" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Opening Position:</label>
                                <div class="d-flex">
                                    <input id="positions" placeholder="Opening Position" name="positions" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Experience (In Year):</label>
                                <div class="d-flex">
                                    <input id="experience" placeholder="Experience" name="experience" class="form-control" type="number" min="0" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Job Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="job_description" class="form-control" required=""></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="'. $user->id .'">
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Company Name:</label>
                                <div class="d-flex">
                                    <input id="company_name" placeholder="Company Name" name="company_name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Company Description:</label>
                                <div class="d-flex">
                                    <textarea id="company_description" required name="company_description" class="form-control" required=""></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">File:</label>
                                <div class="d-flex">
                                    <img style="width:50px; height:50px" src="'. $setImage .'" id="editImg" alt="banner"/>
                                    
                                    <input type="file" name="img" id="img" class="form-control mt-2 mb-2"/>
                                </div>
                            </div>
                        </div>
                        


                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;

        }elseif ($slug == 'User') {
            $roles = attributes::where("attribute", "roles")->where("is_active", 1)->where("is_deleted", 0)->get();
            $services = DB::table('packages')->get();

            $body = '<form class="" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="role_id" id="role_id" value="4">

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">User Role:</label>
                                <div class="d-flex">
                                    <select name="role_id" id="role_id" class="form-control" required>
                                        <option value="" disabled>Please select any one</option>';
            foreach ($roles as $key => $value) {
                $body .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
            $body .= '</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Username:</label>
                                <div class="d-flex">
                                    <input id="username" placeholder="Username" name="username" class="form-control" type="text" data-column="username"  data-type="duplicate"  data-table="user" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Email:</label>
                                <div class="d-flex">
                                    <input id="email" placeholder="Email" name="email" class="form-control" data-column="email"  data-type="duplicate"  data-table="user" type="email" required="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Password:</label>
                                <div class="d-flex">
                                    <input id="password" placeholder="Password" name="password" class="form-control" type="password" required="" required/>
                                </div>
                            </div>
                        </div>
                        <input hidden type="submit" class="submit-button">
                    </div>
                </form>';
            return $body;
        }
        else if ($slug == 'packages') {
            $body = '<form class="" id="generic-form" method="POST" action="' . $route_url . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="record_id" id="record_id">
                        <div class="row">
                            <div id="assignrole"></div>
                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Service Name:</label>
                                    <div class="d-flex">
                                        <input id="name" placeholder="Service Name" onload="convertToSlug(this.value)"
                                               onkeyup="convertToSlug(this.value)" name="name" class="form-control" type="text" autocomplete="off" required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Service Slug:</label>
                                    <div class="d-flex">
                                        <input id="slug" placeholder="Service slug" name="slug" class="form-control" type="text" autocomplete="off" required=""/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Service Amount:</label>
                                    <div class="d-flex">
                                        <input id="amount" placeholder="Services Amount" name="amount" class="form-control" type="text" autocomplete="off" required=""/>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Package Payment ID:</label>
                                    <div class="d-flex">
                                        <input id="payment_id" placeholder="Stripe Product API" name="payment_id" class="form-control" type="text" autocomplete="off" required=""/>
                                    </div>
                                </div>
                            </div>-->

                            <!--<div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Package Period (In Month):</label>
                                    <div class="d-flex">
                                        <input id="period" placeholder="Package Period" name="period" class="form-control" type="text" autocomplete="off" required=""/>
                                    </div>
                                </div>
                            </div>-->

                            <div class="col-md-12 col-sm-6 col-12" id="role-label">
                                <div class="form-group end-date">
                                    <label for="end-date" class="">Description:</label>
                                    <div class="d-flex">
                                        <textarea name="desc" id="description" class="keyouttext form-control" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input hidden type="submit" class="submit-button">
                    </form>';
            return $body;
        }
        else if ($slug == 'faqs') {

            $body = '<form class="" id="generic-form" method="POST" action="' . $route_url . '">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="record_id" id="record_id" value="">

                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Question:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Question" name="name" class="form-control" type="text" autocomplete="off" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" name="desc" class="form-control" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input hidden type="submit" class="submit-button">
                </form>';
            return $body;
        }
        else if ($slug == 'orders') {

            /*$services =  DB::table('packages')->get();*/
            $users = DB::table('users')->where('is_active', 1)->where('role_id', 3)->get();
            $packages = DB::table('packages')->where('is_active', 1)->get();

            $body = '<form class="" id="generic-form" method="POST" action="' . $route_url . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="record_id" id="record_id">
                        <div class="row">
                            <div id="assignrole"></div>

                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Billing Customer:</label>
                                    <div class="d-flex">
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="" disabled>Please select any one</option>';
            foreach ($users as $key => $value) {
                $body .= '<option value="' . $value->id . '" >' . $value->email . '</option>';
            }
            $body .= '</select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Services:</label>
                                    <div class="d-flex">
                                        <select name="package_id" id="package_id" class="form-control" required>
                                            <option value="">Please select any one</option>';
            foreach ($packages as $key => $value) {

                $body .= '<option value="' . $value->id . '"  data-amount="' . $value->amount . '">' . $value->name . '</option>';

            }
            $body .= '</select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Service Amount:</label>
                                    <div class="d-flex">
                                        <input type="text" id="package_amount" name="amount" placeholder="Services Amount" class="form-control" readonly/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Payment Status:</label>
                                    <div class="d-flex">

                                        <select id="payment_status" name="payment_status" class="form-control" required>
                                            <option value="" disabled>Please select any one</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Confirm</option>
                                            <option value="2">Cancel</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Due Date :</label>
                                    <div class="d-flex">
                                        <input type="date" id="due_date" min="' . date('Y-m-d') . '" name="due_date" class="form-control datepicker hasDatepicker" value="">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <input hidden type="submit" class="submit-button">

                    </form>';
            return $body;
        }
        else {
            return $body;
        }
    }

    private function generated_table($slug = '')
    {
        $user = Auth::user();

        if ($slug == "billing") {
            $slug = "orders";
            $data = 'App\Models\\' . $slug;

            if ($user->role_id == 3) {

                $loop = $data::where("user_id", $user->id)->where("is_active", 1)->where("is_deleted", 0)->get();

            } else {

                $loop = $data::with("user")->has('user')->where("is_active", 1)->where("is_deleted", 0)->get();

            }

        }
        elseif ($slug == "User") {
            //$slug = "User";
            $data = 'App\Models\\' . $slug;
            $loop = $data::where("is_active", 1)->where("id", "!=", 1)->where("is_deleted", 0)->get();
        }
        else {
            $data = 'App\Models\\' . $slug;
            $loop = $data::where("is_active", 1)->where("is_deleted", 0)->get();
        }

        $body = '';

        if ($slug == "testimonials") {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $body .= '<tr>
                                          <td>' . ++$key . '</td>
                                          <td>' . $val->name . '</td>
                                          <td>' . $val->detail . '</td>
                                          <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-detail= "' . $val->detail . '" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                          </td>
                                       </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
            $script = '$("body").on("click",".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                
                                                $("#addevent").modal("show")
                                            })';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        else if($slug == "banner"){

            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $find = explode(".", $val->img);
                    
                    if (isset($find[1]) && $find[1] == "mp4") {
                        $tagline = "video";
                    }else{
                        $tagline = "image";
                    }
                    $body .= '<tr>
                                    <td>' . ++$key . '</td>
                                    <td>' . $val->name . '</td>
                                    <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                    <td>
                                        <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-details= "' . $val->details . '" data-slug= "' . $val->slug . '" data-img= "' . asset($val->img) . '" data-tagline= "' . $tagline . '" >Edit</button>
                                        <!-- <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button> -->
                                    </td>
                                </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
            



            $setImage = asset("");
                                    
            $script = '
            $(document).ready(function () {

                if($("#tbody tr").length > 1){

                    //$(".updateevent").hide();
                }

                
                
                $("body").on("click",".editor-form",function(){

                                                    $("#name").val($(this).data("name"));
                                                    
                                                    $("#record_id").val($(this).data("edit_id"));

                                                    $("#slug").val($(this).data("slug"));
                                                    $("#details").val($(this).data("details"));
                                                    
                                                    
                                                    
                                                    
                                                    if($(this).data("tagline") == "video"){
                                                        $("#editImg").hide();
                                                        $("#editVideo").show();
                                                        $("#editVideo").prop("href" , $(this).data("img"))    
                                                    }else{
                                                        $("#editVideo").hide();
                                                        $("#editImg").show();
                                                        $("#editImg").prop("src" , $(this).data("img"))    
                                                    }


                                                    if($(this).data("img") == ""){
                                                        $("#editVideo").hide();
                                                        $("#editImg").show();
                                                        $("#editImg").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }

                                                    $("#addevent").modal("show")
                                                })
                                            
                                            
            });';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;

            

        }
        else if($slug == "projects"){

            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    
                    $body .= '<tr>
                                    <td>' . ++$key . '</td>
                                    <td>' . $val->name . '</td>
                                    <td>' . $val->price . '</td>
                                    <td>' . $val->size . '</td>
                                    <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-warning redirect-url" data-edit_id= "' . $val->id . '" data-route= "' . route('upload_gallery',['projects',$val->id]) . '" > Upload Gallery</button>
                                        <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-details= "' . $val->details . '" data-price= "' . $val->price . '" data-size= "' . $val->size . '" data-img= "' . asset($val->img) . '" >Edit</button>
                                        <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                    </td>
                                </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Size</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                       </tr>
                                    </tfoot>';
            



            $setImage = asset("");
                                    
            $script = '
            $(document).ready(function () {

                if($("#tbody tr").length > 1){

                    //$(".updateevent").hide();
                }

                
                
                $("body").on("click",".redirect-url",function(){
                    var url = $(this).data("route")
                    window.location.href = url
                });

                $("body").on("click",".editor-form",function(){

                                                    $("#name").val($(this).data("name"));
                                                    
                                                    $("#record_id").val($(this).data("edit_id"));

                                                    $("#price").val($(this).data("price"));
                                                    $("#size").val($(this).data("size"));
                                                     var texta = $(this).data("details");
                                                CKEDITOR.instances.description.setData(texta);
                                                    
                                                    
                                                    
                                                    
                                                    if($(this).data("tagline") == "video"){
                                                        $("#editImg").hide();
                                                        $("#editVideo").show();
                                                        $("#editVideo").prop("href" , $(this).data("img"))    
                                                    }else{
                                                        $("#editVideo").hide();
                                                        $("#editImg").show();
                                                        $("#editImg").prop("src" , $(this).data("img"))    
                                                    }


                                                    if($(this).data("img") == ""){
                                                        $("#editVideo").hide();
                                                        $("#editImg").show();
                                                        $("#editImg").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }

                                                    $("#addevent").modal("show")
                                                })
                                            
                                            
            });';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;

            

        }else if($slug == 'news'){

            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">';
            if ($loop) {
                foreach ($loop as $key => $val) {
                     $img_path1 = asset($val->img);
                    $body .= '<tr>
                                    <td>' . ++$key . '</td>
                                    <td>' . $val->name . '</td>
                                    <td><a data-fancybox="gallery" href="' . $img_path1 . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview</a></td>
                                    <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-details= "' . $val->details . '" data-long_details= "' . $val->long_details . '" data-img= "' . asset($val->img) . '" >Edit</button>
                                        <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                    </td>
                                </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                       </tr>
                                    </tfoot>';
            



            $setImage = asset("");
                                    
            $script = '
            $(document).ready(function () {

                if($("#tbody tr").length > 1){

                    //$(".updateevent").hide();
                }

                
                
                $("body").on("click",".redirect-url",function(){
                    var url = $(this).data("route")
                    window.location.href = url
                });

                $("body").on("click",".editor-form",function(){

                                                    $("#name").val($(this).data("name"));
                                                    
                                                    $("#record_id").val($(this).data("edit_id"));
                                                    $("#details").val($(this).data("details"));
                                                    $("#editImg").prop("src" , $(this).data("img"))    
                                                   
                                                    if($(this).data("img") == ""){
                                                
                                                        $("#editImg").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }

                                                    var texta = $(this).data("long_details");
                                                    CKEDITOR.instances.description.setData(texta);

                                                    $("#addevent").modal("show")
                                                })
                                            
                                            
            });';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;

            

        }else if($slug == 'expert'){

            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Post Code</th>
                            <th>Image</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">';
            if ($loop) {
                foreach ($loop as $key => $val) {
                     $img_path1 = asset($val->img);
                    $body .= '<tr>
                                    <td>' . ++$key . '</td>
                                    <td>' . $val->name . '</td>
                                    <td>' . $val->postcode . '</td>
                                    <td><a data-fancybox="gallery" href="' . $img_path1 . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview</a></td>
                                    <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-postcode= "' . $val->postcode . '" data-details= "' . $val->details . '" data-long_details= "' . $val->long_details . '" data-img= "' . asset($val->img) . '" >Edit</button>
                                        <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                    </td>
                                </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Post Code</th>
                                            <th>Image</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                       </tr>
                                    </tfoot>';
            



            $setImage = asset("");
                                    
            $script = '
            $(document).ready(function () {

                if($("#tbody tr").length > 1){

                    //$(".updateevent").hide();
                }

                
                
                $("body").on("click",".redirect-url",function(){
                    var url = $(this).data("route")
                    window.location.href = url
                });

                $("body").on("click",".editor-form",function(){

                                                    $("#name").val($(this).data("name"));
                                                    $("#postcode").val($(this).data("postcode"));
                                                    
                                                    $("#record_id").val($(this).data("edit_id"));
                                                    $("#details").val($(this).data("details"));
                                                    $("#editImg").prop("src" , $(this).data("img"))    
                                                   
                                                    if($(this).data("img") == ""){
                                                
                                                        $("#editImg").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }

                                                    var texta = $(this).data("long_details");
                                                    CKEDITOR.instances.description.setData(texta);

                                                    $("#addevent").modal("show")
                                                })
                                            
                                            
            });';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;

            

        }else if($slug == 'teams'){

            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">';
            if ($loop) {
                foreach ($loop as $key => $val) {
                     $img_path1 = asset($val->img);
                    $body .= '<tr>
                                    <td>' . ++$key . '</td>
                                    <td>' . $val->name . '</td>
                                    <td>' . $val->designation . '</td>
                                    <td><a data-fancybox="gallery" href="' . $img_path1 . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview</a></td>
                                    <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-designation= "' . $val->designation . '"  data-img= "' . asset($val->img) . '" >Edit</button>
                                        <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                    </td>
                                </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Image</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                       </tr>
                                    </tfoot>';
            



            $setImage = asset("");
                                    
            $script = '
            $(document).ready(function () {

                if($("#tbody tr").length > 1){

                    //$(".updateevent").hide();
                }

                
                
                $("body").on("click",".redirect-url",function(){
                    var url = $(this).data("route")
                    window.location.href = url
                });

                $("body").on("click",".editor-form",function(){

                                                    $("#name").val($(this).data("name"));
                                                    $("#designation").val($(this).data("designation"));
                                                    $("#record_id").val($(this).data("edit_id"));
                                                    $("#editImg").prop("src" , $(this).data("img"))    
                                                    if($(this).data("img") == ""){
                                                        $("#editImg").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }
                                                    $("#addevent").modal("show")
                                                })
                                            
                                            
            });';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;

            

        }else if($slug == 'jobs'){

            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Company Name</th>
                            <th>Job Title</th>
                            <th>Salary Range</th>
                            <th>Employment Type</th>
                            <th>Position</th>
                            <th>City</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $img_path1 = asset($val->img);
                    $salary_range = $val->starting_salary . ' - '. $val->ending_salary;
                    $body .= '<tr>
                                    <td>' . ++$key . '</td>
                                    <td>' . $val->company_name . '</td>
                                    <td>' . $val->job_title . '</td>
                                    
                                    <td>' . $salary_range .'</td>
                                    <td>' . $val->employment_type . '</td>
                                    <td>' . $val->positions . '</td>
                                    <td>' . $val->city . '</td>
                                    <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-company_name= "' . $val->company_name . '" data-role_location= "' . $val->role_location . '" data-job_title= "' . $val->job_title . '" data-location= "' . $val->location . '" data-salary_range= "' . $salary_range . '" data-employment_type= "' . $val->employment_type . '" data-positions= "' . $val->positions . '" data-city= "' . $val->city . '" data-starting_salary= "' . $val->starting_salary . '" data-ending_salary= "' . $val->ending_salary . '"  data-currency= "' . $val->currency . '" data-skills= "' . $val->skills . '" data-company_description= "' . $val->company_description . '" data-job_description= "' . $val->job_description . '" data-min_education= "' . $val->min_education . '" data-city= "' . $val->city . '" data-part_time= "' . $val->part_time . '" data-gender= "' . $val->gender . '" data-department= "' . $val->department . '" data-experience= "' . $val->experience . '" data-degree= "' . $val->degree . '" data-functional_area= "' . $val->functional_area . '" data-img= "' . $img_path1 . '">Edit</button>
                                        <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                        
                                    </td>
                                </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                            <th>S. No</th>
                                            <th>Company Name</th>
                                            <th>Job Title</th>
                                            <th>Salary Range</th>
                                            <th>Employment Type</th>
                                            <th>Position</th>
                                            <th>City</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                       </tr>
                                    </tfoot>';
            



            $setImage = asset("");
                                    
            $script = '
            $(document).ready(function () {

                if($("#tbody tr").length > 1){

                    //$(".updateevent").hide();
                }

                
                
                $("body").on("click",".redirect-url",function(){
                    var url = $(this).data("route")
                    window.location.href = url
                });



                $("body").on("click",".editor-form",function(){

                                                    $("#record_id").val($(this).data("edit_id"));

                                                    $("#job_title").val($(this).data("job_title"));
                                                    $("#role_location").val($(this).data("role_location"));
                                                    $("#location").val($(this).data("location"));
                                                    $("#company_name").val($(this).data("company_name"));
                                                    $("#city").val($(this).data("city"));
                                                    $("#employment_type").val($(this).data("employment_type"));
                                                    $("#starting_salary").val($(this).data("starting_salary"));
                                                    $("#ending_salary").val($(this).data("ending_salary"));
                                                    $("#currency").val($(this).data("currency"));
                                                    $("#positions").val($(this).data("positions"));
                                                    $("#skills").val($(this).data("skills"));
                                                    $("#company_description").val($(this).data("company_description"));

                                                    var texta = $(this).data("job_description");
                                                    CKEDITOR.instances.description.setData(texta);
                                                    
                                                    $("#min_education").val($(this).data("min_education"));                     
                                                    $("#part_time").val($(this).data("part_time"));  
                                                    $("#gender").val($(this).data("gender"));                               
                                                    $("#department").val($(this).data("department"));
                                                    $("#experience").val($(this).data("experience"));
                                                    $("#degree").val($(this).data("degree"));
                                                    $("#functional_area").val($(this).data("functional_area"));

                                                     
                                                   
                                                    if($(this).data("img") == ""){
                                                
                                                        $("#editImg").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }else{
                                                        $("#editImg").prop("src" , $(this).data("img"))       
                                                    }

                                                    $("#addevent").modal("show")
                                                })
                                            
                                            
            });';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;

            

        }else if($slug == 'studios'){

            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Banner Image</th>
                            <th>Inner Image 01</th>
                            <th>Inner Image 02</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $img_path1 = asset($val->banner_img);
                    $img_path2 = asset($val->inner_1_img);
                    $img_path3 = asset($val->inner_2_img);
                    $body .= '<tr>
                                    <td>' . ++$key . '</td>
                                    <td>' . $val->name . '</td>
                                    <td><a data-fancybox="gallery" href="' . $img_path1 . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview Banner</a></td>
                                    <td><a data-fancybox="gallery" href="' . $img_path2 . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview Inner 01</a></td>
                                    <td><a data-fancybox="gallery" href="' . $img_path3 . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview Inner 02</a></td>
                                    <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-warning redirect-url" data-edit_id= "' . $val->id . '" data-route= "' . route('upload_gallery',['studios',$val->id]) . '" > Upload Gallery</button>
                                        <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-details= "' . $val->details . '" data-price= "' . $val->price . '" data-size= "' . $val->size . '" data-img= "' . asset($val->banner_img) . '" data-img2= "' . asset($val->inner_1_img) . '" data-img3= "' . asset($val->inner_2_img) . '" >Edit</button>
                                        <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                    </td>
                                </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Banner Image</th>
                                            <th>Inner Image 01</th>
                                            <th>Inner Image 02</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                       </tr>
                                    </tfoot>';
            



            $setImage = asset("");
                                    
            $script = '
            $(document).ready(function () {

                if($("#tbody tr").length > 1){

                    //$(".updateevent").hide();
                }

                
                
                $("body").on("click",".redirect-url",function(){
                    var url = $(this).data("route")
                    window.location.href = url
                });

                $("body").on("click",".editor-form",function(){

                                                    $("#name").val($(this).data("name"));
                                                    
                                                    $("#record_id").val($(this).data("edit_id"));

                                                    $("#price").val($(this).data("price"));
                                                    $("#size").val($(this).data("size"));
                                                     var texta = $(this).data("details");
                                                CKEDITOR.instances.description.setData(texta);
                                                    
                                                    $("#editImg").prop("src" , $(this).data("img"))  
                                                    $("#editImg2").prop("src" , $(this).data("img2"))  
                                                    $("#editImg3").prop("src" , $(this).data("img3"))  

                                                    if($(this).data("img") == ""){
                                                        $("#editImg").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }
                                                    if($(this).data("img2") == ""){
                                                        $("#editImg2").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }
                                                    if($(this).data("img3") == ""){
                                                        $("#editImg3").prop("src" , "'.asset("images/no-img-avalible.png").'") 
                                                    }

                                                    $("#addevent").modal("show")
                                                })
                                            
                                            
            });';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;

            

        }
        elseif ($slug == "weeklyBreakdown") {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Watch List</th>
                                          <th>Description</th>
                                          <th>Uploads</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $img_path = asset($val->image);
                    $body .= '<tr>
                                          <td>' . ++$key . '</td>
                                          <td>' . $val->whishlist . '</td>
                                          <td>' . implode(' ', array_slice(explode(' ', $val->details), 0, 5)) . '</td>
                                          <td><a data-fancybox="gallery" href="' . $img_path . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview </a></td>
                                          <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                          <td>

                                             <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                          </td>
                                       </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
            $script = '$("body").on("click",".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        elseif ($slug == "weeklyMidBreakdown") {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Watch List</th>
                                          <th>Description</th>
                                          <th>Uploads</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $img_path = asset($val->image);
                    $body .= '<tr>
                                          <td>' . ++$key . '</td>
                                          <td>' . $val->whishlist . '</td>
                                          <td>' . implode(' ', array_slice(explode(' ', $val->details), 0, 5)) . '</td>
                                          <td><a data-fancybox="gallery" href="' . $img_path . '" /> <i class="fa fa-eye" aria-hidden="true"></i> Preview </a></td>
                                          <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                          <td>

                                             <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                          </td>
                                       </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
            $script = '$("body").on("click",".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        elseif ($slug == "education") {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>By</th>
                                          <th>Type</th>
                                          <th>Title</th>
                                          <th>Detail</th>
                                          <th>Cover</th>
                                          <th>Link</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    if (!isset($val->User)) {
                        continue;
                    }
                    $cover = asset($val->cover);
                    if ($val->type == "book") {
                        $detail = "ISSBN : " . $val->issbn;
                    } else {
                        $detail = "Video Length : " . $val->issbn;
                    }


                    $body .= '<tr>
                                          <td>' . ++$key . '</td>
                                          <td>' . $val->user->name . '</td>
                                          <td>' . ucfirst($val->type) . '</td>
                                          <td>' . ucfirst($val->title) . '</td>
                                          <td>' . $detail . '</td>
                                          <td><a data-fancybox="gallery" href="' . $cover . '"> Cover <i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                                          <td><a href="' . asset($val->file_upload) . '" target="_blank"> Preview </a> </td>
                                          <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                          <td>

                                             <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                          </td>
                                       </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>By</th>
                                          <th>Type</th>
                                          <th>Title</th>
                                          <th>Detail</th>
                                          <th>Cover</th>
                                          <th>Link</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
            $script = '$("body").on("click",".editor-form",function(){
                                                $("#name").val($(this).data("type"))
                                                $("#record_id").val($(this).data("edit_id"))

                                                $("#addevent").modal("show")
                                            })';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        elseif ($slug == "User") {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Type</th>

                                          <th>Name</th>
                                          <th>Email</th>
                                         <!--<th>User Name</th>-->
                                          <!--<th>Contact Number</th>-->
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    if ($val->roles != null) {

                        $body .= '<tr>
                                          <td>' . ++$key . '</td>
                                          <td>' . $val->roles->name . '</td>

                                          <td>' . $val->name . '</td>
                                          <td>' . $val->email . '</td>
                                          <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-role_id= "' . $val->role_id . '" data-email= "' . $val->email . '" data-username= "' . $val->username . '" data-phonenumber= "' . $val->phonenumber . '" data-packageid="' . $val->package_id . '" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                          </td>
                                       </tr>';
                    }
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Type</th>

                                          <th>Name</th>
                                          <th>Email</th>
                                          <!--<th>User Name</th>-->
                                          <!--<th>Contact Number</th>-->
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
            $script = '$("body").on("click",".editor-form",function(){

                                                $("#username").removeClass("validator")
                                                $("#email").removeClass("validator")
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#name").val($(this).data("name"))
                                                $("#email").val($(this).data("email"))
                                                $("#package_id").val($(this).data("packageid"))

                                                $("#serviceAmount").val($(this).data("packageamount"));

                                                $("#username").val($(this).data("username"))
                                                $("#username").prop("disabled" , true)
                                                $("#username").prop("readonly" , true)

                                                $("#phonenumber").val($(this).data("phonenumber"))
                                                $("#password").prop("placeholder" , "Update Password");
                                                var role_id = $(this).data("role_id");



                                                $("#role_id option").each(function(i,e){
                                                    if($(e).val() == role_id){
                                                        $(e).prop("selected" , true);
                                                    }
                                                });
                                                $("#addevent").modal("show");

                                            })
                                            $("body").on("keyup" , "#password",function(){
                                                if($(this).val() != ""){
                                                    $(this).prop("name" , "password");
                                                    $(this).prop("required" , true);
                                                }else{
                                                    $(this).prop("name" , "");
                                                    $(this).prop("required" , false);
                                                }
                                            })

                                             $("#package_id").on("change",function(){

                                                var value = $(this).find(":selected").data("amount");

                                                $("#serviceAmount").val(value);

                                             });';


            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        elseif ($slug == 'orders') {

            $body = '<thead>
                              <tr>
                                <th>S.no</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Due Date</th>
                                <th>Package</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Transaction ID</th>

                                <th>Action</th>
                            </tr>
                     </thead>
                     <tbody>';

            if ($loop) {
                foreach ($loop as $key => $val) {
                    $time = strtotime($val->created_at);
                    $final = date("M d,Y", strtotime("+1 month", $time));

                    //$route = ['order_id' => $val->id, 'user_id' => $val->user_id, 'package_id' => $val->package_id];
                    $id = Crypt::encrypt($val->id);

                    $body .= '<tr>
                                  <td>' . ++$key . '</td>

                                  <td>' . ((!is_null($val->user)) ? $val->user->username : 'User not Exist') . '</td>
                                  <td>' . ((!is_null($val->user)) ? $val->user->email : 'User not Exist') . '</td>
                                  <td>' . date("M d,Y", strtotime($val->due_date)) . '</td>
                                  <td>' . $val->package->name . '</td>
                                  <td>' . $val->amount . '</td>

                                  <td>' . (($val->transaction_id != "") ? "Paid" : "Unpaid") . '</td>
                                  <td>' . $val->transaction_id . '</td>


                                  <td>';

                    if ($user->role_id == 3) {

                        //$body .= '<button type="button" class="btn btn-primary view-form" data-edit_id= "' . $val->id . '" data-user_id= "' . $val->user_id . '"  data-packageid="' . $val->package_id . '" data-paymentstatus="' . $val->payment_status . '" data-createdat="' . $val->created_at . '">View Invoice</button>';
                        $body .= '<a href="' . route('invoiceView', $id) . '" class="btn btn-primary">View Invoice</a>';

                    } else {

                        $body .= '<button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-user_id= "' . $val->user_id . '"  data-packageid="' . $val->package_id . '" data-paymentstatus="' . $val->payment_status . '" data-due_date="' . $val->due_date . '">Edit</button>
                                  <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>';

                    }
                    $body .= '</td>
                                </tr>';
                    //<button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-desc= "'.$val->desc.'" >Edit</button>
                }
            }

            $body .= '</tbody>
                            <tfoot>
                                <tr>
                                    <th>S.no</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Due Date</th>
                                    <th>Package</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>

                                    <th>Action</th>
                               </tr>
                            </tfoot>';

            $script = '$("body").on("click", ".editor-form", function () {

                            $("#record_id").val($(this).data("edit_id"));
                            $("#user_id").val($(this).data("user_id"));
                            $("#package_id").val($(this).data("packageid")).change();
                            $("#payment_status").val($(this).data("paymentstatus"));
                            $("#addevent").modal("show");
                            $("#due_date").val(moment($(this).data("due_date")).format("YYYY-MM-DD"));
                        });

                        $("#package_id").on("change", function () {
                            var amount = $(this).find("option:selected").data("amount");
                            $("#package_amount").val(amount).prop("readonly",true);
                        });


                          ';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        elseif ($slug == "packages") {
            $body = '<thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <!--<th>Product Payment API</th>-->
                            <!--<th>Period (Month)</th>-->
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $body .= '<tr>
                                          <td>' . ++$key . '</td>
                                          <td>' . $val->name . '</td>
                                          <td>' . $val->amount . '</td>

                                          <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-amount= "' . $val->amount . '" data-period= "' . $val->period . '" data-desc= "' . $val->desc . '" data-slug= "' . $val->slug . '" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                          </td>
                                       </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <!--<th>Product Payment API</th>
                                          <th>Period (Month)</th>-->
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';

            $script = '$("body").on("click",".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#slug").val($(this).data("slug"))
                                                $("#amount").val($(this).data("amount"))
                                                $("#description").val($(this).data("desc"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';

            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        elseif ($slug == "faqs") {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Question</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
            if ($loop) {
                foreach ($loop as $key => $val) {
                    $body .= '<tr>
                                          <td>' . ++$key . '</td>
                                          <td>' . $val->name . '</td>
                                          <td>' . $val->desc . '</td>
                                          <td>' . date("M d,Y", strtotime($val->created_at)) . '</td>
                                          <td>
                                            <button type="button" class="btn btn-primary editor-form" data-edit_id= "' . $val->id . '" data-name= "' . $val->name . '" data-desc= "' . $val->desc . '" >Edit</button>
                                            <button type="button" class="btn btn-danger delete-record" data-model="' . $data . '" data-id= "' . $val->id . '" >Delete</button>
                                          </td>
                                       </tr>';
                }
            }
            $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Question</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
            $script = '$("body").on("click",".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
            $resp['body'] = $body;
            $resp['script'] = $script;
            return $resp;
        }
        else {
            return $body;
        }
    }

    public function report_user($slug)
    {

        $user = Auth::user();

        $role_assign = role_assign::where('is_active', 1)->where("role_id", $user->role_id)->first();
        if ($role_assign) {
            $validator = Helper::check_rights($slug);
            if (is_null($validator)) {
                return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
            }
        } else {
            return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
        }

        $att_tag = attributes::where('is_active', 1)->select('attribute')->distinct()->get();
        $attributes = attributes::where('is_active', 1)->where('attribute', $slug)->get();
        return view('reports/report_generic_user')->with(compact('attributes', 'att_tag', 'role_assign', 'validator', 'slug'));
    }

    public function custom_report()
    {
        $status['status'] = 0;
        if (isset($_POST['role_id'])) {
            $attributes = attributes::find($_POST['role_id']);
            if ($attributes->attribute == "departments") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user', [$attributes->attribute, str::slug($attributes->name)]);

                return json_encode($status);
            } elseif ($attributes->attribute == "designations") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user', [$attributes->attribute, str::slug($attributes->name)]);
                return json_encode($status);
            } elseif ($attributes->attribute == "roles") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user', [$attributes->attribute, str::slug($attributes->role)]);
                return json_encode($status);
            } else {
                $status['status'] = 0;
                return json_encode($status);
            }
        } else {
            $status['status'] = 0;
            return json_encode($status);
        }
    }

    public function custom_report_user($slug = '', $slug2 = '')
    {
        $attributes = attributes::where("attribute", $slug)->first();
        $designation = attributes::where("is_active", 1)->get();
        $project_id = Session::get("project_id");
        if ($attributes) {

            if ($attributes->attribute == "departments") {
                $all_user = User::where("is_active", 1)->where("department", $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes', 'all_user', 'slug', 'designation'));
            } elseif ($attributes->attribute == "designations") {
                $slug2 = ucwords(str_replace('-', ' ', $slug2));
                $attributes = attributes::where("attribute", $slug)->where("name", "LIKE", $slug2)->first();
                $all_user = User::where("is_active", 1)->where("designation", $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes', 'all_user', 'slug', 'designation'));
            } elseif ($attributes->attribute == "roles") {
                $slug2 = ucwords(str_replace('-', ' ', $slug2));
                $attributes = attributes::where("attribute", $slug)->where("role", "LIKE", $slug2)->first();
                if (!$attributes) {
                    return redirect()->back()->with('error', "Didn't find any records.!");
                }
                $all_user = User::where("is_active", 1)->where("role_id", $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes', 'all_user', 'slug', 'designation'));
            } else {
                return redirect()->back()->with('error', "Didn't find any records.!");
            }
        } else {
            return redirect()->back()->with('error', "Didn't find any records..");
        }
    }

    public function crud_generator($slug = '', Request $request)
    {


        $token_ignore = ['_token' => '', 'record_id' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);
        $data = 'App\Models\\' . $slug;
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $path = '';
                if ($request->file('img') != '') {
                    $path = ($request->file('img'))->store('uploads/banner/'.md5(Str::random(20)), 'public');
                    $post_feilds['img'] = $path;
                }

                if ($request->file('banner_img') != '') {
                    $path = ($request->file('banner_img'))->store('uploads/'.$slug.'/'.md5(Str::random(20)), 'public');
                    $post_feilds['banner_img'] = $path;
                }
                if ($request->file('inner_1_img') != '') {
                    $path = ($request->file('inner_1_img'))->store('uploads/'.$slug.'/'.md5(Str::random(20)), 'public');
                    $post_feilds['inner_1_img'] = $path;
                }
                if ($request->file('inner_2_img') != '') {
                    $path = ($request->file('inner_2_img'))->store('uploads/'.$slug.'/'.md5(Str::random(20)), 'public');
                    $post_feilds['inner_2_img'] = $path;
                }
                

                $create = $data::where("id", $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";

            } else {

                if (isset($_POST['password'])) {
                    $post_feilds['password'] = Hash::make($_POST['password']);
                }
                
                $path = '';
                if ($request->file('img') != '') {
                    $path = ($request->file('img'))->store('uploads/banner/'.md5(Str::random(20)), 'public');
                    $post_feilds['img'] = $path;
                }
                if ($request->file('banner_img') != '') {
                    $path = ($request->file('banner_img'))->store('uploads/'.$slug.'/'.md5(Str::random(20)), 'public');
                    $post_feilds['banner_img'] = $path;
                }
                if ($request->file('inner_1_img') != '') {
                    $path = ($request->file('inner_1_img'))->store('uploads/'.$slug.'/'.md5(Str::random(20)), 'public');
                    $post_feilds['inner_1_img'] = $path;
                }
                if ($request->file('inner_2_img') != '') {
                    $path = ($request->file('inner_2_img'))->store('uploads/'.$slug.'/'.md5(Str::random(20)), 'public');
                    $post_feilds['inner_2_img'] = $path;
                }

                $create = $data::create($post_feilds);
                $msg = "Record has been created";
            }
            
            return redirect()->back()->with('message', $msg);

        } catch (Exception $e) {
            $error = $e->getMessage();
            return redirect()->back()->with('error', "Error Code: " . $error);
        }
    }

    public function delete_record(Request $request)
    {
        $token_ignore = ['_token' => '', 'id' => '', 'model' => ''];
        $post_feilds = array_diff_key($_POST, $token_ignore);
        $data = 'App\Models\\' . $_POST['model'];
        try {
            $update = $data::where("id", $_POST['id'])->update($post_feilds);
            $status['message'] = "Record has been deleted";
            $status['status'] = 1;
            return json_encode($status);
        } catch (Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }

    public function invoiceView()
    {
        // if ($order_id == "" || $order_id == null) {
        //     return redirect()->back()->with('message', "No order ID found");
        // }

        // try {
        //     $order_id  = Crypt::decrypt($order_id);
        // } catch (Exception $e) {
        //     $error = $e->getMessage();
        //     return redirect()->back()->with('error', "Error : ".$error);
        // }

        $user = Auth::user();

        $all_orders = orders::where("is_active", 1)->where("user_id", $user->id)->orderBy("id", "desc")->get();
        return view('roles/invoice')->with('title', 'Invoice')->with(compact('all_orders', 'user'));
    }
}

