<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User\Model\Event;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\User;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type == 0) {
            return Event::where('scheduled_at', '>', \DB::raw('NOW()'))->where('user_id', Auth::user()->id)->with('eventype')->orderBy('scheduled_at', 'ASC')->get();
        }
        if ($request->type == 1) {
            return Event::where('scheduled_at', '<', \DB::raw('NOW()'))->where('user_id', Auth::user()->id)->with('eventype')->get();
        }
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'scheduleCode' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $inputs = $request->all();
        $user = User::where('schedule_code', $inputs['scheduleCode'])->first();
        if(!$user) {
            return response()->json([
                'message' => 'We can\'t find a user'
            ], 404);
        }
        $inputs['user_id'] = $user->id;
        $event = Event::create($inputs);

        return response()->json($event, 201);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return response()->json($event, 200);
    }

    public function delete(Event $event)
    {
        $event->delete();

        return response()->json(null, 204);
    }
}
