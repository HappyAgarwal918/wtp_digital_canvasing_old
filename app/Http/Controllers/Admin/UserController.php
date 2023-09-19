<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CustomStorage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_page_title = 'Users';
        $items = User::paginate($this->itemPerPage);
        foreach($items as $value){
            if($value->user_label){
                $value->user_label =  $this->getTotalValue(unserialize($value->user_label));
            }else{
                $value->user_label = 'N/A';
            }
        }
        $sl = SLGenerator($items);
        return view('admin.user.index', compact('sl', 'items', 'admin_page_title'));
    }

    public function getTotalValue($items){
        $total = 0;
        foreach($items as $value){
            $total += $value;
        }
        return $total;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin_page_title = 'New User';

        $users = User::where('inactive', false)->get();
        foreach($users as $value){
            if($value->user_label){
                $value->manager = $this->checkManager(unserialize($value->user_label));
                $value->approved_users = $this->checkApprovedUsers(unserialize($value->user_label));
            }else{
                $value->manager = false;
                $value->approved_users = false;
            }
        }
        $managers = collect($users)->where('manager', true);
        $approved_users = collect($users)->where('approved_users', true);
        $access_labels = $this->accessLabels();

        return view('admin.user.create', compact('admin_page_title', 'managers', 'approved_users', 'access_labels'));
    }

    public function checkApprovedUsers($items){
        $status = in_array(2, $items);
        return $status;
    }
    public function checkManager($items){
        $status = in_array(4, $items);
        return $status;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'middle_initial' => 'nullable|string|max:2',
            'last_name' => 'required|string|max:100',
            'gender' => ['required', Rule::in(['m', 'f'])],
            'birthday' => 'required|date_format:"m/d/Y"',
            'last_4_ssn' => 'required|integer|digits_between: 3,4',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
            'zipcode' => 'required|integer|digits_between: 3,5',
            'phone' => 'required|integer|unique:users|digits_between: 7,10',
            'email' => 'required|string|email|max:255|unique:users',
            'voter_id' => 'required|integer|digits_between: 3,7',
            'approved_by_id' => 'nullable|integer|exists:users,id',
            'manager_id' => 'nullable|integer|exists:users,id',
            'username' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:8',
            'user_label' => 'nullable',
            // 'user_label' => ['required', 'integer', Rule::in([
                // '1','2','4', '8', '8','16','32'
                // 'approve_investgator',
                // 'work_review',
                // 'user_maintenance',
                // 'cohort_design',
                // 'works_assignments',
                // 'exporting_reporting',
            // ])],
            'notes' => 'nullable|string|max:255',
            'inactive' => 'nullable|boolean',
        ]);

        $item = new User();
        $item->first_name = $request->get('first_name');
        $item->middle_initial = $request->get('middle_initial');
        $item->last_name = $request->get('last_name');
        $item->gender = $request->get('gender');
        $item->birthday = $this->formatDate($request->get('birthday'));
        $item->last_4_ssn = $request->get('last_4_ssn');
        $item->street_address = $request->get('street_address');
        $item->city = $request->get('city');
        $item->state = $request->get('state');
        $item->zipcode = $request->get('zipcode');
        $item->phone = $request->get('phone');
        $item->email = $request->get('email');
        $item->voter_id = $request->get('voter_id');
        $item->approved_by_id = $request->get('approved_by_id');
        $item->manager_id = $request->get('manager_id');
        $item->username = $request->get('username');
        $item->password = Hash::make($request->get('password'));
        $item->user_label = $request->user_label ? serialize($request->user_label) : null;
        // $item->user_label = $request->get('user_label');
        $item->notes = $request->get('notes');
        $item->inactive = $request->get('inactive') ?? 0;
        $item->save();

        // $files_name_array=$request->get('files_name');
        $files_desc_array=$request->get('files_desc');

        if($request->hasFile('file_data')){
            $file_data = $request->file('file_data');
            foreach($file_data as $k=>$file){
                $extension = $file->getClientOriginalExtension();
                // $filename=$files_name_array[$k];
                $filedesc=$files_desc_array[$k];
                // echo "extension is $extension <br>";
                // echo "filename is $filename <br>";
                // echo "filedesc is $filedesc <br>";

                $custom_storage = new CustomStorage();
                $custom_storage->user_id = $item->id;
                $custom_storage->storage_type = $extension;
                $custom_storage->description = $filedesc;

                $file_name = 'user_'. $item->id.'_' . uniqid() . '.' . $extension;
                $path = $file->storeAs('users/'. $item->id, $file_name);

                $custom_storage->server_location = $path;

                $custom_storage->save();

            }
        }
        // print_r($file_data);

        return (($request->get('btn') == 'save') ? back() : redirect()->route('users.index'))->with('success', 'User Added Successful.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->birthday = $this->undoFormatDate($user->birthday);
        $user->user_label = $user->user_label ? unserialize($user->user_label) : array();
        $admin_page_title = 'Edit User '.$user->first_name.' '. $user->last_name;

        $users = User::where('inactive', false)->where('users.id', '!=', $user->id)->get();
        foreach ($users as $value) {
            if ($value->user_label) {
                $value->manager = $this->checkManager(unserialize($value->user_label));
                $value->approved_users = $this->checkApprovedUsers(unserialize($value->user_label));
            } else {
                $value->manager = false;
                $value->approved_users = false;
            }
        }
        $user->managers = collect($users)->where('manager', true);
        $user->approved_users = collect($users)->where('approved_users', true);

        $user->access_labels = $this->accessLabels();

        if($user->user_label){
            $user_label_total = 0;
            foreach ($user->user_label as $value) {
                $user_label_total += $value;
            }

            $user->user_label_total = $user_label_total;
        }else{
            $user->user_label_total = 'N/A';
        }

        $saved_storage_data = CustomStorage::where('user_id', $user->id)->get();
        //dd($saved_storage_data);
        $item = $user;

        return view('admin/user.edit', compact('admin_page_title', 'item', 'saved_storage_data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'middle_initial' => 'nullable|string|max:2',
            'last_name' => 'required|string|max:100',
            'gender' => ['required', Rule::in(['m', 'f'])],
            'birthday' => 'required|date_format:"m/d/Y"',
            'last_4_ssn' => 'required|integer|digits_between: 3,4',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
            'zipcode' => 'required|integer|digits_between: 3,5',
            "phone" => "nullable|integer|digits_between: 7,10|unique:users,phone," . $user->id,
            "email" => "nullable|email|unique:users,email," . $user->id,
            'voter_id' => 'required|integer|digits_between: 3,7',
            'approved_by_id' => 'nullable|integer|exists:users,id',
            'manager_id' => 'nullable|integer|exists:users,id',
            "username" => "nullable|string|unique:users,username," . $user->id,
            'password' => 'nullable|string|min:8',
            // 'user_label' => ['required', 'integer', Rule::in([
            //     '1', '2', '4', '8', '8', '16', '32'
            // ])],
            'user_label' => 'nullable',
            'notes' => 'nullable|string|max:255',
            'inactive' => 'nullable|boolean',
        ]);

        $user->first_name = $request->get('first_name');
        $user->middle_initial = $request->get('middle_initial');
        $user->last_name = $request->get('last_name');
        $user->gender = $request->get('gender');
        $user->birthday = $this->formatDate($request->get('birthday'));
        $user->last_4_ssn = $request->get('last_4_ssn');
        $user->street_address = $request->get('street_address');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->zipcode = $request->get('zipcode');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->voter_id = $request->get('voter_id');
        $user->approved_by_id = $request->get('approved_by_id');
        $user->manager_id = $request->get('manager_id');
        $user->username = $request->get('username');
        if(!empty($request->get('password'))){
            $user->password = Hash::make($request->get('password'));
        }
        // $user->user_label = $request->get('user_label');
        $user->user_label = $request->user_label ? serialize($request->user_label) : null;
        $user->notes = $request->get('notes');
        $user->inactive = $request->get('inactive') ?? 0;
        $user->update();

        if ($request->has('save_storage_data')) {
            $save_storage_data=$request->get('save_storage_data');
            foreach($save_storage_data as  $key=>$value){
                $custom_storage = CustomStorage::findOrFail($key);
                $custom_storage->description = $value;
                $custom_storage->update();
            }
        }

        $files_desc_array=$request->get('files_desc');

        if($request->hasFile('file_data')){
            $file_data = $request->file('file_data');
            foreach($file_data as $k=>$file){
                $extension = $file->getClientOriginalExtension();
                // $filename=$files_name_array[$k];
                $filedesc=$files_desc_array[$k];
                // echo "extension is $extension <br>";
                // echo "filename is $filename <br>";
                // echo "filedesc is $filedesc <br>";

                $custom_storage = new CustomStorage();
                $custom_storage->user_id = $user->id;
                $custom_storage->storage_type = $extension;
                $custom_storage->description = $filedesc;

                $file_name = 'user_'. $user->id.'_' . uniqid() . '.' . $extension;
                $path = $file->storeAs('users/'. $user->id, $file_name);
                $custom_storage->server_location = $path;
                $custom_storage->save();

            }
        }

        $message = 'User update Successfully';
        return ($request->get('btn') == 'update') ? back()->with('success', $message) : redirect()->route('users.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort('404');
    }
}
