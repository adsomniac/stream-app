<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' =>'required|email',
            'password'  => 'required|min:6',
        ]);

        $data = $request->except("_token");

        $isEmailExist = User::where('email', $request->email)->exists();
        if ($isEmailExist){
            return back()
            ->withErrors(['email'=>"This email already exist"])->withInput();
        }

        $data['role'] = 'member';
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('member.login');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
