<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Http\Requests\CreateUpdateCompany;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = Company::paginate(10);

        $rows = collect($paginator->items())->map->only(['id', 'name', 'email', 'logo', 'website'])->toArray();

        return view(
            'admin.index',
            [
                'title' => 'Companies Listing',
                'entity_route_key' => 'companies',
                'columns' => [
                    'Name',
                    'Email',
                    'Logo',
                    'Website',
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
            'admin.company.create',
            [
                'title' => 'Create Company',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUpdateCompany $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateCompany $request)
    {
        Company::create($request->validated());

        return redirect()->route('admin.companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view(
            'admin.company.show',
            [
                'title' => 'View Company',
                'model' => $company
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view(
            'admin.company.edit',
            [
                'title' => 'Edit Company',
                'model' => $company,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateUpdateCompany $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateCompany $request, Company $company)
    {
        $fields = $request->validated();

        if ($request->has('logo')) {
            $file = $request->file('logo');
            $filename = vsprintf(
                '%s_%s.%s',
                [
                    $company->id,
                    md5(date('YmdHis')),
                    $file->getClientOriginalExtension(),

                ]
            );

            $file->move(storage_path('app/public/images'), $filename);

            $fields['logo'] = $filename;
        }

        $company->update($fields);

        return redirect()->route('admin.companies.index');
    }
}
