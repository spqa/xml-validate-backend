<?php

namespace App\Http\Controllers;

use App\ResourceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResourceFileController extends Controller
{

    const ADD_NEW_RESOURCE_FILE = "Added resource file %s";
    const UPDATE_RESOURCE_FILE = "Resource file %s updated to %s";
    const RESOURCE_FILE_RULES = [
        'name' => 'required|unique:resource_file'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourceFile::orderBy("name")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), self::RESOURCE_FILE_RULES);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->messages()
            ]);
        }

        $resourceFile = new ResourceFile();
        $resourceFile->name = $request->get("name");
        $resourceFile->save();
        return response()->json([
            'error' => false,
            'message' => sprintf(self::ADD_NEW_RESOURCE_FILE, $resourceFile->name)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResourceFile $resourceFile
     * @return \Illuminate\Http\Response
     */
    public function show(ResourceFile $resourcefile)
    {
        return $resourcefile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ResourceFile $resourcefile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResourceFile $resourcefile)
    {
        $validator = Validator::make($request->all(), self::RESOURCE_FILE_RULES);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->messages()
            ]);
        }

        $oldName = $resourcefile->name;
        $resourcefile->name = $request->get("name");
        $resourcefile->save();
        return response()->json([
            'error' => false,
            'message' => sprintf(self::UPDATE_RESOURCE_FILE, $oldName, $resourcefile->name)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResourceFile $resourceFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResourceFile $resourceFile)
    {
        //
    }

    public function messagesIndex($resourceFile)
    {
        $resource = ResourceFile::findOrFail($resourceFile);
        return $resource->messages()->get();
    }
}
