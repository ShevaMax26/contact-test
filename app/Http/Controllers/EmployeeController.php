<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Phone;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('phones')->paginate(10);

        return [
            'employees' => EmployeeResource::collection($employees),
            'total' => $employees->total(),
            'currentPage' => $employees->currentPage(),
            'perPage' => $employees->perPage(),
        ];
    }

    public function store(Request $request)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
