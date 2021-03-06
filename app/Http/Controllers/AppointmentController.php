<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    //

    public function getCalendarView(Request $request){
        $data = DB::table('appointments')->get();
        $name = auth()->user()->name;


        return view('appointments.calendar', ['data'=> $data, 'name'=> $name]);
    }
    public  function insertAppointment(Request $request){

        $datetime_start = $request->datetime_start;
        $datetime_end = $request->datetime_end;
        $description = $request->description;

        $appointment = new Appointment;
        $appointment->datetime_start = $datetime_start;
        $appointment->datetime_end = $datetime_end;
        $appointment->user = auth()->user()->email;
        $appointment->description = $description;
        $appointment->save();


        return response()->json(['data'=> $appointment]);
    }
    public  function deleteAppointment(Request $request){
        $id = $request->id;
        DB::table('appointments')->where('id','=', $id)->delete();
        return response()->json(['data'=> 'success']);
    }

    public  function updateAppointment(Request $request){
        $id = $request->id;
        $start = $request->start;
        $end = $request->end;
        DB::table('appointments')->where('id','=', $id)->update([
            'datetime_start'=> $start,
            'datetime_end' => $end ]);
        return response()->json(['data'=> 'success']);
    }

    public function getAllEvents(Request $request){

        $data = DB::table('appointments')->get()->toJson(JSON_PRETTY_PRINT);

       return  response($data,200);

    }
}
