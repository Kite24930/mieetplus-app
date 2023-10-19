<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Follower;
use App\Models\History;
use App\Models\StudentList;
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

    public function companyStatusChange(Request $request) {
        try {
            $target = Company::find($request->id);
            $target->update([
                'status' => $request->status,
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

    public function followedAdd(Request $request) {
        $student = StudentList::where('user_id', $request->student_id)->first();
        $values = [
            'company_id' => $request->company_id,
            'student_id' => $request->student_id,
        ];
        try {
            DB::beginTransaction();
            $followed = Follower::create($values);
            DB::commit();
            if (isset($student->univ_email) && isset($student->email_verified_at)) {
                $data = [
                    'msg' => 'ok',
                    'followed' => $followed,
                ];
                return response()->json($data, 200);
            } else {
                $data = [
                    'msg' => 'not_verified',
                    'followed' => $followed,
                ];
                return response()->json($data, 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'msg' => 'error',
                'err' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    public function followedDelete($company_id, $student_id) {
        $target = Follower::where('company_id', $company_id)->where('student_id', $student_id)->first();
        try {
            DB::beginTransaction();
            $target->delete();
            DB::commit();
            $data = [
                'msg' => 'ok',
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

    public function historyAdd(Request $request) {
        $target = History::where('company_id', $request->company_id)->where('student_id', $request->student_id)->whereDate('created_at', date('Y-m-d'))->first();
        if (!isset($target)) {
            $db = History::create([
                'company_id' => $request->company_id,
                'student_id' => $request->student_id,
            ]);
            $data = [
                'msg' => 'ok',
                'history' => $db,
            ];
        } else {
            $data = [
                'msg' => 'exist',
            ];
        }
        return response()->json($data, 200);
    }
}
