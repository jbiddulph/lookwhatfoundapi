<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AllArtworkController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artworks = Artwork::get();
        return response()->json($artworks->toArray());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user_id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $artwork = Artwork::find($id);

        $artwork->title = $request->title;
        $artwork->description = $request->description;
        $artwork->status = $request->status;
        $artwork->primary_art = $request->primary_art;
        $artwork->latitude = $request->latitude;
        $artwork->longitude = $request->longitude;
        $artwork->height = $request->height;
        $artwork->width = $request->width;
        $artwork->cost = $request->cost;
        $artwork->live = $request->live;
        $artwork->created_by = $request->created_by;
        $artwork->updated_at = $request->updated_at;

        $artwork->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function show(Artwork $allartwork)
    {
        return $allartwork;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'live' => 'required|boolean'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $artwork = Artwork::find($id);

        $artwork->title = $request->title;
        $artwork->description = $request->description;
        $artwork->status = $request->status;
        $artwork->primary_art = $request->primary_art;
        $artwork->height = $request->height;
        $artwork->width = $request->width;
        $artwork->cost = $request->cost;
        $artwork->live = $request->live;

        if($this->user->artworks()->save($artwork)){
            return response()->json([
                'status' => true,
                'artwork' => $artwork
                ]
            );
        } else {
            return response()->json([
                'status' => false,
                'message' => 'oops the artwork could not be saved'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artwork = Artwork::find($id);

        if($artwork->delete()) {
            return response()->json([
                'status' => true,
                'artwork' => $artwork
                ]
            );
        } else {
            return response()->json([
                'status' => false,
                'message' => 'oops the artwork could not be deleted'
            ]);
        }
    }

    protected function guard()
    {
        return Auth::guard();

    }
}
