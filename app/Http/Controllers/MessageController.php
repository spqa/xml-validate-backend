<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    const MESSAGE_RULES = [
        'message_key' => "required",
        'resource_file_id' => "required"
    ];

    const MESSAGE_ADD = "Message added";
    const MESSAGE_UPDATE = "Message updated";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applied = request("applied");
        $perPage = request("perpage", 20);
        $codeFile = request("codefile");
        $final = request("final");
        $resourceFile = request("resourcefile");
        $queryBuilder = Message::orderBy("created_at", "desc");
        if ($applied) {
            $queryBuilder->where("applied",$applied);
        }
        if ($codeFile) {
            $queryBuilder->where("code_file_id", $codeFile);
        }
        if ($resourceFile) {
            $queryBuilder->where("resource_file_id", $resourceFile);
        }
        if ($final) {
            $queryBuilder->whereNull("final")->orWhere("final", "");
        }

        return $queryBuilder->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource_file_id = $request->resource_file_id;
        $message_key = $request->message_key;

        $checkUnique = Message::where("resource_file_id", $resource_file_id)
            ->where("message_key", $message_key);
        if ($checkUnique->count() > 0) {
            return response()->json([
                'error' => true,
                'message' => "Message Key and Resource File should be unique"
            ]);
        }

        $validator = Validator::make($request->all(), self::MESSAGE_RULES);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->messages()
            ]);
        }

        Message::create($request->all());
        return response()->json([
            'error' => false,
            'message' => self::MESSAGE_ADD
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return response()->json($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $result = $message->update($request->all());
        if($result) {
            return response()->json([
                'error' => false,
                'message' => self::MESSAGE_UPDATE
            ]);
        }else {
            return response()->json([
                'error' => true,
                'message' => "Update Error!"
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json([
            'error' => false,
            'message' => "Message deleted"
        ]);
    }

    public function search()
    {
        $query = request("query");
        $enResult = null;
        $jaResult = null;
        $viResult = null;
        $keyResult = null;
        $totalResult = null;

        if ($query && !empty($query)) {
            $enResult = Message::where("en", "like", "%" . $query . "%")->get();
            $jaResult = Message::where("ja", "like", "%" . $query . "%")->get();
            $viResult = Message::where("vi", "like", "%" . $query . "%")->get();
            $keyResult = Message::where("message_key", "like", "%" . $query . "%")->get();

            $totalResult = $enResult->merge($jaResult)->merge($viResult)->merge($keyResult);
            return response()->json([
                "data" => $totalResult
            ]);
        } else {
            return response()->json([]);
        }
    }
}
