<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ApiController extends Controller
{
    public function companyRegister(Request $request) {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email:filter,dns', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('company');

            DB::commit();

            $data = [
                'msg' => 'ok',
                'user' => $user,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'msg' => 'error',
                'err' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    public function companyMailPermissionChange(Request $request) {
        try {
            $target = Company::where('user_id', $request->id)->first();
            $target->update([
                'mail_permission' => $request->permission,
            ]);
        } catch (\Exception $e) {
            $data = [
                'msg' => 'error',
                'err' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
        return response()->json(['msg' => 'ok'], 200);
    }
}
