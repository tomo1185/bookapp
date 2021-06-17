<?php

namespace App\Http\Controllers\MyPage;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProfileSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('verified');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // 1.入力情報を取得
        $login_user = Auth::id();
        $users = DB::table('users')
            ->select('id', 'email', 'password', 'profile_image')
            ->where('id', $login_user)
            ->first();
        // dd($profile_data);
        return view('mypage.profile-settings', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
                'max:255',
            ],
        ]);
        $users->profile_image= $request->file('profile_image');
        if ($users->profile_image) {
            // echo "1通過";
            //アップロードされた画像を保存する
            $path = $users->profile_image->store('uploads',"public");
            //画像の保存に成功したらDBに記録する
            if ($path) {
                // echo "2通過";
                $users->where('id', $id)
                ->update([
                    'email' => $request->input('email'),
                    // 'email_verified_at' => null,
                    'profile_image' => $path,
                    'password' => $request->input('password'),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
        return redirect('mypage/home');
    }
}
