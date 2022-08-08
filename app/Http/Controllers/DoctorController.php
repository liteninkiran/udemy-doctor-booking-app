<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::whereHas('role', function(Builder $query) {
            $query->where('name', '=', 'doctor');
        })->get();
        return view('admin.doctor.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'patient')->get();
        $departments = Department::all();
        return view('admin.doctor.create', compact('departments', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        $name = (new User)->userAvatar($request);

        $data['image'] = $name;
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->back()->with('message', 'Doctor added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        $user = User::find($id);
        return view('admin.doctor.delete', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $user = User::find($id);
        $roles = Role::where('name', '!=', 'patient')->get();
        $departments = Department::all();
        return view('admin.doctor.edit', compact('user', 'departments', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        $this->validateUpdate($request,$id);
        $data = $request->all();
        $user = User::find($id);
        $imageName = $user->image;
        $userPassword = $user->password;

        if($request->hasFile('image')) {
            $imageName =(new User)->userAvatar($request);
            unlink(public_path('images/' . $user->image));
        }

        $data['image'] = $imageName;

        if($request->password){
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $userPassword;
        }

        $user->update($data);

        return redirect()->route('doctor.index')->with('message', 'Doctor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        if(auth()->user()->id === $id) {
            abort(401);
        }

        $user = User::find($id);
        $userDelete = $user->delete();

        if($userDelete) {
            unlink(public_path('images/'.$user->image));
        }

        return redirect()->route('doctor.index')->with('message', 'Doctor deleted successfully');
    }

    private function validateStore(Request $request) {
        return $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:25',
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'department' => 'required',
            'phone_number' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'role_id' => 'required',
            'description' => 'required',
        ]);
    }

    private function validateUpdate(Request $request, int $id) {
        return $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'department' => 'required',
            'phone_number' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'role_id' => 'required',
            'description' => 'required',
        ]);
    }
}
