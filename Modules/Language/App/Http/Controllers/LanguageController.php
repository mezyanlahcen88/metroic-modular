<?php

namespace Modules\Language\app\Http\Controllers;

use App\Enums\StaticOptions;
use Illuminate\Http\Request;
use App\Services\CrudService;
use Modules\Language\app\Http\Requests\StoreLanguageRequest;
use Modules\Language\app\Http\Requests\UpdateLanguageRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;
use Modules\Language\app\Models\Language;
use App\Http\Controllers\Controller;



class LanguageController extends Controller
{

    public $staticOptions;
    public $crudService;
    public function __construct(CrudService $crudService, StaticOptions $staticOptions)
    {
        // $this->middleware('permission:language-list|language-create|language-edit|language-show|language-delete', ['only' => ['index']]);
        // $this->middleware('permission:language-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:language-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:language-show', ['only' => ['show']]);
        // $this->middleware('permission:language-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:language-restore', ['only' => ['restore']]);
        // $this->middleware('permission:language-trashed', ['only' => ['trashed']]);
        // $this->middleware('permission:language-forse-delete', ['only' => ['forseDelete']]);
        $this->staticOptions = $staticOptions;
        $this->crudService = $crudService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tableRows =(new Language())->getRowsTable();
        $objects = Language::get();
        return view('language::index',compact('tableRows','objects'));
    }

     public function getLanguagesJson()
    {
        $Languages = Language::orderBy('created_at','desc');
        return Datatables($Languages)

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
        ->addColumn('active' , function(Language $Language){
            return '<span class="badge ' . (!$Language->isactive ? 'bg-danger' : 'bg-success') . ' text-uppercase">' . ($Language->isactive ? 'Active' : 'Inactive') . '</span>
             ';
        })
        ->addColumn('actions', function (Language $object) {
            return view('language::actions', compact('object'));
        })
        ->addColumn('checkbox', function (Language $object) {
            return view('components.checkbox', compact('object'));
        })
        ->rawColumns(['active','actions'])
        ->editColumn('created_at','{{\Carbon\Carbon::parse($created_at)->format("d/m/Y")}}')
        ->editColumn('picture',function (Language $object) {
            return view('components.image', compact('object'));
         })
        ->setRowAttr(['align'=>'center'])
        ->make(true);
    }

    /**
     * Display a list of soft-deleted records.
     *
     * @return \Illuminate\View\View The view with the list of soft-deleted records.
     */
    public function trashed(Request $request)
    {
        $objects = Language::onlyTrashed()->get();
        $tableRows =(new Language())->getRowsTableTrashed();
        return view('language::trashedIndex', compact('tableRows','objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('language::create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLanguageRequest $request, Language $model)
    {
        try {
            $validated = $request->validated();
            $this->crudService->storeRecord($model, $request, $model->getFillable(), $model->getFiles(), 'language', 'languages');

            return redirect()->route('languages.index');
             } catch (ValidationException $e) {
            return redirect()->route('language::create')->withErrors($e->validator)->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $object = language::findOrfail($id);
        return view('language::edit',compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguageRequest $request,$id)
    {
        try {
            $validated = $request->validated();
             $object = Language::findOrFail($id);
            $this->crudService->updateRecord($object, $request, $object->getFillable(), $object->getFiles(), 'language', 'languages');

            return redirect()->route('language.index');
            } catch (ValidationException $e) {
            return redirect()->route('language::edit')->withErrors($e->validator)->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $object = Language::findOrFail($request->id)->delete();
    }

            /**
     * Restore a soft-deleted user.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param int $id The ID of the user to restore.
     * @return \Illuminate\Http\RedirectResponse The redirect response.
     */
    public function restore(Request $request, $id)
    {

        $object = Language::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('language::index');
    }

    /**
     * Force delete a record permanently.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param int $id The ID of the record to force delete.
     * @return void
     */
    public function forceDelete(Request $request, $id)
    {

        $object = Language::withTrashed()->findOrFail($id);
        deletePicture($object,'languages','flag_path');
        $object->forceDelete();

    }

    /**
     * Change the status (active/inactive) of a user.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $object = Language::findOrFail($id);
        $object->status = !$object->status;
        $object->save();
        return response()->json(['code' => 200, 'status' => $object->status, 'lang' => $object->name]);
    }
    // public function translations($id){
    //     $count = LanguageTranslate::where('language_id',$id)->first();
    //     if(!$count){
    //       alert()->error('Error', 'you should to activate this language');
    //     return redirect()->back();
    //     }else{
    //           $objects = LanguageTranslate::where('language_id',$id)->get();
    //     return view('languagetransations.index',compact('objects'));
    //     }
    // }

    // public function filterByKeyWord(Request $request,$id){
    //     $keyword = $request->keyword;
    //     $objects =  LanguageTranslate::where('language_id',$id)
    //     ->where(function ($query) use($keyword) {
    //         $query->where('label','like',"%".$keyword."%")
    //               ->orWhere('translation','like',"%".$keyword."%");
    //     })->paginate(30)->withQueryString();
    //     return view('languagetransations.index',compact('objects','id'));
    //  }
    public function changeDefault(Request $request)
    {
        $oldDefault = Language::where('isDefault', 1)->first();
        $oldDefault->isDefault = 0;
        $oldDefault->save();
        $id = $request->id;
        $object = Language::findOrFail($id);
        $object->isDefault = 1;
        $object->save();
        //  add code to check if this language is active first
        return response()->json(['code' => 200, 'lang' => $object->name]);
    }

    // public function setLocale($locale){
    //     App::setLocale($locale);
    //     Session::put('locale', $locale);
    //     return redirect()->back();
    // }
    // public function switchLang($lang)
    // {
    //         App::setLocale($lang);
    //         Session::put('applocale', $lang);
    //         return Redirect::back();
    // }
}
