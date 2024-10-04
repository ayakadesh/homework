<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\user;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            //bcrypt  تستخدم لتشفير كلمة المرور قبل تخزينها في القاعدة حيث لا تخزن كنص عادي وهي اكثر امانا من hash
            'password' => bcrypt($validatedData['password']),
        ]);
    
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 200);
    }
    

    public function show($id)
    {
        // findOrFailنستخدمها بدل findلانه قد لا يكون لدينا مستخدمين
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
    
}
