<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function createEmployee(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'job_id' => 'required',
            'hired_date' => 'required',
            'location_id' => 'required'

        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Employee Not Found',
                'errors' => $validator->errors()
            ], 401);
        }
        $employeeAll = $request->all();
        $employee = Employee::create($employeeAll);

        return response()->json([
            'status' => true,
            'message' => 'Employee Save Successfully',
            'data' => $employee
        ]);
    }

    public function list(Request $request){
        $employee = DB::table('employees')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Get Successfully',
            'data' => $employee
        ]);
    }

    public function employeeUpdate(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'job_id' => 'required',
            'hired_date' => 'required',
            'location_id' => 'required'

        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Employee Not Found',
                'errors' => $validator->errors()
            ], 401);
        }

        $employeeupdate = Employee::find($id);
        if(!$employeeupdate){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => $employeeupdate
            ]);
        }
        $requestAll = $request->all();
        $employee = $employeeupdate->update($request->all());
        return response()->json([
            'statuss' =>true,
            'message' => 'Data Update Successfully',
            'data' => $employee
        ]);
    }

    public function employeedelete(Request $request,$id){
        $empdelete = Employee::find($id);
        if(!$empdelete){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => $employeeupdate
            ]);
        }
        
        $employee = $empdelete->delete();
        return response()->json([
            'statuss' =>true,
            'message' => 'Data Update Successfully',
            'data' => $employee
        ]);
    }
}
