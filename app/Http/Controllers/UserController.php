<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
        $this->authorize('user');
        $users = User::with('role')->get();
        return view('pages.user.index', compact('users'));
    }

    public function create(){
        $this->authorize('user');
        $roles = Role::all();
        return view('pages.user.create',compact('roles'));
    }

    public function store(Request $request){
        $this->authorize('user');

        $rule = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
            'role_id' => 'required'
        ];

        $message = [
            'email' => 'Masukan email dengan benar.',
            'required' => 'Bidang ini harus diisi.',
            'unique' => 'Sudah ada :attribute yang terdaftar.',
            'same' => 'Password tidak sama'
        ];

        $this->validate($request, $rule, $message);
        $users = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);


        return redirect()->route('user.index')->with('success', 'Data user telah ditambahkan!');
    }
    
    public function edit($user){
        $users = User::find($user);
        $roles = Role::all();
        return view('pages.user.edit', compact('users','roles'));
    }

    public function update(Request $request, $user){
        $users = User::find($user);

        if(empty($request->password)){
            $users->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role_id' => $request->role_id
            ]);
        }else{
            $users->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Data user telah diubah!');
    }

    public function destroy($user){
        $users = User::findOrFail($user);
        if(Auth::user()->id == $user){
            return redirect()->route('user.index')->with('warning', 'Akun anda sendiri tidak dapat dihapus!');
        }else{
            $users->delete();
            return redirect()->route('user.index')->with('danger', 'Data berhasil dihapus!');
        }
    }
}
