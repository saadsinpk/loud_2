<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\Poll;
use App\Http\Resources\PollCollection;
use App\Http\Resources\PollResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PollController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index(Request $request) {
        try {
            $qry = Poll::whereNotIn('id', ['0']);

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }

            if ($request->q) {
                $qry->where(function ($query) use ($request) {
                    $query->where('question', 'LIKE', '%' . $request->q . '%');
                });
            }

            if ($request->sort_by === 'trending' || $request->trending) {
                $qry->orderBy('view_count', 'desc');
            } else {
                $qry->orderBy('created_at', 'desc');
            }

            if ($request->mode === 'FREE') {
                $qry->where('is_free', 'YES');
            }

            $polls = $request->limit ? new PollCollection($qry->paginate($request->limit)) : PollResource::collection($qry->get());

            return response()->json($polls);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }


    public function single_poll($id) {
        try {
            $poll = Poll::where('id', $id)->first();
            $poll->update([
                'view_count' => $poll->view_count + 1,
            ]);
            return response()->json(new PollResource($poll));
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:150',
            'ends_in' => 'required|numeric|min:1',
            'options' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $poll = Poll::create([
                'user_id' => JWTAuth::user()->id,
                'question' => $request->question,
                'hide_creator_detail' => $request->hide_creator_detail ? 1 : 0,
                'is_people_share' => $request->is_people_share ? 1 : 0,
                'ends_in' => $request->ends_in,
            ]);

            foreach ($request->options as $option) {
                $poll->options()->create([
                    'name' => $option
                ]);
            }


            return response()->json([
                        'message' => __("polls.created_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll) {
        try {
            $poll->update([
                'view_count' => $poll->view_count + 1,
            ]);

            return response()->json(new PollResource($poll));
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll) {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:150',
            'ends_in' => 'required|numeric|min:1',
            'options' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $poll->update([
                'question' => $request->question,
                'hide_creator_detail' => $request->hide_creator_detail ? 1 : 0,
                'is_people_share' => $request->is_people_share ? 1 : 0,
                'ends_in' => $request->ends_in,
            ]);

            foreach (json_decode(json_decode($request->options, true)) as $option) {
                $poll->options()->updateOrCreate([
                    'option' => $option
                ]);
            }


            return response()->json([
                        'message' => __("polls.updated_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll) {
        try {
            $poll->delete();

            return response()->json([
                        'message' => __("polls.deleted_success")
                            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
