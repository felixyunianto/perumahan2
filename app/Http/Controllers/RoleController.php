<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;


class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('role');
        $roles = Role::all();

        return view('pages.role.index', compact('roles'));
    }

    public function store(Request $request){
        $this->authorize('role');
        $rules = [
            'name' => 'required|min:3'
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong',
            'min' => 'Bidang :attribute minimal :min huruf'
        ];

        $this->validate($request, $rules, $message);
        $name = strtolower($request->name);
        $roles = Role::create([
            'name' => $name
        ]);

        return redirect()->route('role.index')->with('success', 'Data role telah ditambahkan!');
    }

    public function edit($role){
        $this->authorize('role');
        $roles = Role::find($role);
        return view('pages.role.edit', compact('roles'));
    }

    public function update($role, Request $request){
        $this->authorize('role');
        $roles = Role::findOrFail($role);
        $name = strtolower($request->name);
        $roles->update([
            'name' => $name
        ]);
        return redirect()->route('role.index')->with('success', 'Data role telah diubah!');
    }

    public function destroy($role){
        $this->authorize('role');
        $role = Role::findOrFail($role);
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Data role telah dihapus!');
    }
}
