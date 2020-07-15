<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Http\Requests\CreateUpdateEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = Employee::paginate(10);

        $rows = collect($paginator->items())->map->only(['id', 'first_name', 'last_name', 'email', 'phone'])->toArray();

        return view(
            'admin.index',
            [
                'title' => 'Employees Listing',
                'create_link' => route('admin.employees.create'),
                'columns' => [
                    'First Name',
                    'Last Name',
                    'Email',
                    'Phone',
                ],
                'rows' => $rows,
                'paginator' => $paginator,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'admin.employee.create',
            [
                'title' => 'Create Employee',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUpdateEmployee $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateEmployee $request)
    {
        Employee::create($request->validated());

        return redirect()->route('admin.employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view(
            'admin.show',
            [
                'title' => 'View Employee',
                'model' => $employee
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view(
            'admin.employee.edit',
            [
                'title' => 'Edit Employee',
                'model' => $employee,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateUpdateEmployee $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateEmployee $request, Employee $employee)
    {
        $fields = $request->validated();

        if ($request->has('logo')) {
            $file = $request->file('logo');
            $filename = vsprintf(
                '%s_%s.%s',
                [
                    $employee->id,
                    md5(date('YmdHis')),
                    $file->getClientOriginalExtension(),

                ]
            );

            $file->move(storage_path('app/public/images'), $filename);

            $fields['logo'] = $filename;
        }

        $employee->update($fields);

        return redirect()->route('admin.employees.index');
    }
}
