<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\services;
use Illuminate\Support\Facades\DB;
use Auth;
use Helper;
use Session;
// use Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function services()
    {
        $services = services::orderBy('id', 'asc')->latest()->paginate(10);
        return view('services.index', compact('services'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function cms_store(Request $request)
    {
        $this->validate($request, [
            // 'type'=> 'required',
            'page' => 'required',
            'name' => 'required',
            'details' => 'required',
            'post_by' => 'required',
            'created_at' => 'required',
            // 'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:50000',
            // 'file'=> 'required|mimes:mp4,ppx,pdf,ogv,jpg,webm|max:100000',
        ]);
        if ($request->hasFile('img')) {
            $imgnumber = rand();
            $img = $request->file('img');
            $img->move(base_path('public/uploads/services'), '_' . $imgnumber . '.' . $img->getClientOriginalName());
            $imgNameToStore = 'uploads/services/' . '_' . $imgnumber . '.' . $img->getClientOriginalName();
            // dd($imgNameToStore);
        } else {
            $imgNameToStore = '';
        }
        if ($request->hasFile('file')) {
            $filenumber = rand();
            $file = $request->file('file');
            $file->move(base_path('public/uploads/services'), '_' . $filenumber . '.' . $file->getClientOriginalName());
            $fileNameToStore = 'uploads/services/' . '_' . $filenumber . '.' . $file->getClientOriginalName();
        } else {
            $fileNameToStore = '';
        }
        $cms = new services();

        $cms->page = $request->input('page');
        $cms->name = $request->input('name');
        $cms->slug = $request->input('slug');
        $cms->details = $request->input('details');
        $cms->user_id = $request->input('user_id');
        $cms->post_by = $request->input('post_by');
        $cms->created_at = $request->input('created_at');
        // $cms->file = $fileNameToStore;
        $cms->img = isset($imgNameToStore) ? $imgNameToStore : '';
        $cms->save();
        return redirect()
            ->route('cms_index')
            ->with('success', 'Created successfully.');
    }

    public function cms_edit($id, Request $request)
    {
        $data = DB::table('services')
            ->where('id', $id)
            ->first();
        return response()->json($data);
    }

    public function cms_show($id, Request $request)
    {
        $data = DB::table('services')
            ->where('id', $id)
            ->first();
        return response()->json($data);
    }

    public function cms_update(Request $request)
    {
        if ($request->img && $request->file) {
            $this->validate($request, [
                // 'type'=> 'required',
                'name' => 'required',
                'page' => 'required',
                'details' => 'required',
                'post_by' => 'required',
                'created_at' => 'required',
                //'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:50000',
                // 'file'=> 'required|mimes:mp4,ppx,pdf,ogv,jpg,webm|max:100000',
            ]);
        } elseif ($request->img) {
            $this->validate($request, [
                // 'type'=> 'required',
                'name' => 'required',
                'page' => 'required',
                'details' => 'required',
                'post_by' => 'required',
                'created_at' => 'required',
                //'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:50000',
            ]);
        } elseif ($request->file) {
            $this->validate($request, [
                // 'type'=> 'required',
                'name' => 'required',
                'page' => 'required',
                'details' => 'required',
                'post_by' => 'required',
                'created_at' => 'required',
                // 'file'=> 'required|mimes:mp4,ppx,pdf,ogv,jpg,webm|max:100000',
            ]);
        } else {
            $this->validate($request, [
                // 'type'=> 'required',
                'name' => 'required',
                'page' => 'required',
                'details' => 'required',
                'post_by' => 'required',
                'created_at' => 'required',
            ]);
        }

        $data = [];
        $id = $request->input('id');
        // $data['type'] = $request->input('type');
        $data['name'] = $request->input('name');
        $data['page'] = $request->input('page');
        $data['details'] = $request->input('details');
        $data['user_id'] = $request->input('user_id');
        $data['post_by'] = $request->input('post_by');
        $data['created_at'] = $request->input('created_at');
        if ($request->img) {
            $imgnumber = rand();
            // dd($imgnumber);
            $img = $request->file('img');
            $img->move(base_path('public/uploads/services'), '_' . $imgnumber . '.' . $img->getClientOriginalName());
            $imgNameToStore = 'uploads/services/' . '_' . $imgnumber . '.' . $img->getClientOriginalName();
            $data['img'] = $imgNameToStore;
        } else {
            $imgNameToStore = ' ';
        }
        if ($request->file) {
            $filenumber = rand();
            $file = $request->file('file');
            $file->move(base_path('public/uploads/services'), '_' . $filenumber . '.' . $file->getClientOriginalName());
            $fileNameToStore = 'uploads/services/' . '_' . $filenumber . '.' . $file->getClientOriginalName();
            $data['file'] = $fileNameToStore;
        } else {
            $fileNameToStore = ' ';
        }
        $cms = services::where('id', $id)->update($data);
        return redirect()
            ->route('cms_index')
            ->with('success', 'Updated successfully');
    }

    public function cms_destroy(services $id)
    {
        $id->delete();
        return redirect()
            ->route('cms_index')
            ->with('success', 'Deleted successfully');
    }

}
