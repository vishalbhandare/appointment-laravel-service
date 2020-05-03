<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\User\Model\EventType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class EventTypeController extends Controller
{
    public function index()
    {
        return EventType::where('user_id', Auth::user()->id)->get();
    }

    public function getEventTypeByScheduleCode($scheduleCode)
    {
        $user = User::where('schedule_code', $scheduleCode)->first();
        if(!$user) {
            return response()->json([
                'message' => 'We can\'t find a user'
            ], 404);
        }
        $eventlist = $user->eventtypes()->select('id', 'name', 'duration_min')->get();
        $response = ['name' => $user->name, 'eventtypes'=> $eventlist];
        return  $response;
    }

    public function show(EventType $eventType)
    {
        return $eventType;
    }

    public function store(Request $request)
    {
        $inputs = $request->all() + ['user_id' => Auth::user()->id];
        
        $eventType = EventType::create($inputs);

        return response()->json($eventType, 201);
    }

    public function update(Request $request, EventType $eventType)
    {
        $eventType->update($request->all());

        return response()->json($eventType, 200);
    }

    public function delete(EventType $eventType)
    {
        $eventType->delete();

        return response()->json(null, 204);
    }
}
