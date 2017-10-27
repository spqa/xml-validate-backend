<?php

namespace App\Http\Controllers;

use App\CodeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeFileController extends Controller
{

    const ADD_NEW_CODE_FILE = "Added code file %s";
    const UPDATE_CODE_FILE = "Code file %s updated to %s";
    const CODE_FILE_RULES = [
        'name' => 'required|unique:code_file'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CodeFile::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), self::CODE_FILE_RULES);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->messages()
            ]);
        }

        $codeFile = new CodeFile();
        $codeFile->name = $request->get("name");
        $codeFile->save();
        return response()->json([
            'error' => false,
            'message' => sprintf(self::ADD_NEW_CODE_FILE, $codeFile->name)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CodeFile $codefile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodeFile $codefile)
    {
        $validator = Validator::make($request->all(), self::CODE_FILE_RULES);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->messages()
            ]);
        }

        $oldName = $codefile->name;
        $codefile->name = $request->get("name");
        $codefile->save();
        return response()->json([
            'error' => false,
            'message' => sprintf(self::UPDATE_CODE_FILE, $oldName, $codefile->name)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResourceFile $resourceFile
     * @return \Illuminate\Http\Response
     */
    public function show(CodeFile $codefile)
    {
        return response()->json($codefile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CodeFile $codeFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CodeFile $codeFile)
    {
        //
    }
}
