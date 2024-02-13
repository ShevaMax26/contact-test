<?php

namespace Sheva\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sheva\Contacts\Http\Resources\EmployeeResource;
use Sheva\Contacts\Models\Employee;

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
