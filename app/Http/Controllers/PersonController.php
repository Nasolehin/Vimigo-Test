<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Helpers\APIHelpers;;
use App\Http\Requests\AddPersonRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonsImport;
use App\Exports\PersonsExport;

class PersonController extends Controller
{
    public function index()
    {
        $persons = auth()->user()->persons;

        return response()->json([
            'success' => true,
            'data' => $persons 
        ]);
    }

 
    public function show($id)
    {
        $person = auth()->user()->persons()->find($id);
 
        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $person->toArray()
        ], 400);
    }
 
    public function store(AddPersonRequest $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);
 
        $person = new Person();
        $person->name = $request->name;
        $person->email = $request->email;
 
        if (auth()->user()->persons()->save($person))
            return response()->json([
                'success' => true,
                'data' => $person->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Person not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $person = auth()->user()->persons()->find($id);
 
        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found'
            ], 400);
        }
 
        $updated = $person->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Person can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $person = auth()->user()->persons()->find($id);
 
        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => 'Person not found'
            ], 400);
        }
 
        if ($person->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Person can not be deleted'
            ], 500);
        }
    }

    public function fileImportExport()
    {
       return view('file-import');
    }

    public function fileImport(Request $request) 
    {
        Excel::import(new PersonsImport, $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport() 
    {
        return Excel::download(new PersonsExport, 'persons-collection.xlsx');
    } 
}