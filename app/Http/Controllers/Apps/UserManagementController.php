<?php

namespace App\Http\Controllers\Apps;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CrudService;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserManagementController extends Controller
{
    public $crudService;
    public function __construct(CrudService $crudService)
    {
        // $this->middleware('permission:client-list|client-create|client-edit|client-show|client-delete', ['only' => ['index']]);
        // $this->middleware('permission:client-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:client-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:client-show', ['only' => ['show']]);
        // $this->middleware('permission:client-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:client-restore', ['only' => ['restore']]);
        // $this->middleware('permission:client-trashed', ['only' => ['trashed']]);
        // $this->middleware('permission:client-forse-delete', ['only' => ['forseDelete']]);
        $this->crudService = $crudService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        $objects = User::get();
        return view('pages/apps.user-management.users.index',compact('objects'));
    }

    public function getUsersJson()
    {
        $users = User::orderBy('created_at','desc');
        return Datatables($users)

        // ->filterColumn('user.name' , function($query , $keyword){
        //     if(is_numeric($keyword)){
        //         $query->whereRelation('user','id', $keyword);
        //     }else{
        //         $query->whereRelation('user','name','LIKE',"%{$keyword}%");
        //     }
        // })
        // ->filterColumn('archive' , function($query , $keyword){
        //     $query->where('archive', $keyword);
        // })
        // ->addColumn('archive' , function(User $User){
        //     return '<span class="badge ' . (!$User->archive ? 'bg-danger' : 'bg-success') . ' text-uppercase">' . ($User->archive ? 'Archive' : 'Inarchive') . '</span>
        //      ';
        // })
        ->addColumn('actions', function (User $object) {
            return view('pages.apps.user-management.users.actions', compact('object'));
        })
        ->addColumn('checkbox', function (User $object) {
            return view('pages.apps.user-management.users.checkbox', compact('object'));
        })
        ->rawColumns(['actions'])
        ->editColumn('created_at','{{\Carbon\Carbon::parse($created_at)->format("d/m/Y")}}')
        ->editColumn('picture',function (User $object) {
            return view('pages.apps.user-management.users.image', compact('object'));
         })
        ->setRowAttr(['align'=>'center'])
        ->make(true);
    }

    public function profile()
    {
        $object = User::findOrFail(Auth::id());
        return view('pages/apps.user-management.users.profile',compact('object'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.apps.user-management.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , User $model)
    {
        // dd($request->all());
        try {
            $validated = $request->validated();
            $this->crudService->storeRecord($model, $request, $model->getFillable(), $model->getFiles(), 'client', 'clients');

            return redirect()->route('clients.index');
        } catch (ValidationException $e) {
            return redirect()->route('clients.create')->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $object = User::where('uuid',$uuid)->first();
        return view('pages.apps.user-management.users.show',compact('object'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $object = User::where('uuid',$uuid)->first();
        return view('pages.apps.user-management.users.edit',compact('object'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $object = USer::where('uuid',$request->id)->delete();
    }
}
