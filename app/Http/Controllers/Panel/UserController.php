<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('all'))
        {
            return response()->json([
                'state' => true,
                'message' => 'success!',
                'data' => User::all(['id', 'first_name', 'last_name', 'username']),
            ]);
        }
        return response()->json([
            'state' => true,
            'message' => 'success!',
            'data' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->mobile = $request->input('mobile');
        $user->home_phone = $request->input('home_phone');
        $user->work_phone = $request->input('work_phone');
        $user->work_address = $request->input('work_address');
        $user->home_address = $request->input('home_address');

        if($user->save())
            return response()->json([
                'state' => true,
                'message' => 'Success',
                'data' => null
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = User::findOrFail($id);
        if(!$userId)
            return response()->json([
                'state' => true,
                'message' => 'not found!',
                'data' => null,
            ]);

        $userId = User::where('id', $id)
            ->select(['id', 'first_name', 'last_name', 'username'])
            ->get();

        return response()->json([
            'state' => true,
            'message' => 'Success',
            'data' => $userId,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->home_phone = $request->input('home_phone');
        $user->work_phone = $request->input('work_phone');
        $user->work_address = $request->input('work_address');
        $user->home_address = $request->input('home_address');
        $user->image = $request->input('image');

        if($user->save())
            return response()->json([
                'state' => true,
                'message' => 'Success',
                'data' => null,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'state' => true,
            'message' => 'Success',
            'data' => User::findOrFail($id)->delete(),
        ]);
    }
}
