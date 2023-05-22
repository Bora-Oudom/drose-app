<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = User::latest()->paginate(5);
  
        return view('users.index',['data' => $data])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $roles = Role::pluck('name', 'name')->all();
    //     return view('users.create',['roles' => $roles]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required',
    //         'roles' => 'required'
    //     ]);

    //     $input = $request->all();
    //     $input['password'] = Hash::make($input['password']);

    //     $user = User::create($input);
    //     $user->assignRole($request->input('roles'));

    //     return redirect()->route('users.index')->with('success','User created successfully');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('blogs')->find($id);
        return view('users.show', ['user' => $user]);
        // return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'userRole' => $userRole]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input fields

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'profile' => 'nullable|image'
        ]);

        // Get all input data and hash password if needed
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            // Use unset to remove password field from input array
            // unset($input['password']); 
            $input = Arr::except($input, array('password'));
        }

        // Find user by ID and update attributes
        $user = User::find($id);

        if(!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }
        if ($request->hasFile('profile')) {
            // Delete old profile image file if it exists
            Storage::delete($user->profile);
    
            // Upload new profile image file
            $path = $request->file('profile')->store('profile');
            $input['profile'] = $path;
        } else {
            unset($input['profile']); // Use default profile image if none is uploaded
        }

        $user->update($input);

        // Update user's roles
        $role = $request->input('roles');

        $validRole = Role::where('name', $role)->first();

        if (!$validRole) {
            return redirect()->route('users.index')->with('error', 'Role does not exist');
        }
    
        $user->syncRoles([$validRole]);

        return redirect()->route('users.index')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User has been deleted');
    }
}
