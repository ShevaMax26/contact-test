<?php

namespace Sheva\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sheva\Contacts\Helpers\ClearPhone;
use Sheva\Contacts\Http\Requests\Employee\StoreRequest;
use Sheva\Contacts\Http\Resources\EmployeeResource;
use Sheva\Contacts\Models\Employee;
use Sheva\Contacts\Models\Phone;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('phones')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return [
            'employees' => EmployeeResource::collection($employees),
            'total' => $employees->total(),
            'currentPage' => $employees->currentPage(),
            'perPage' => $employees->perPage(),
        ];
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $employee = Employee::create($data);

        foreach ($data['phones'] as $phone) {
            $employee->phones()->create([
                'phone' => ClearPhone::clear($phone),
            ]);
        }

        $employee->load('phones');

        return EmployeeResource::make($employee);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['message' => 'Record deleted successfully.']);
    }
}
