<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.doctors');
    }
    public function schedules($doctor_key)
    {
        $schedules = Schedule::where('doctor_key',$doctor_key)->get();
        $doctor_id = $doctor_key;

        return view('admin.pages.schedules',compact('schedules','doctor_id'));
    }

    public function saveSchedules(Request $request)
    {


        $schedule = new Schedule();
        $schedule->doctor_key = $request->doctor_key;
        $schedule->title = $request->title;
        $schedule->description = $request->description;
        $schedule->start = $request->start;
        $schedule->time = $request->time;
        $schedule->save();

        return $schedule;
    }

    public function editSchedules(Request $request)
    {


        $schedule = Schedule::find($request->id);
        $schedule->title = $request->title;
        $schedule->description = $request->description;
        $schedule->time = $request->time;
        $schedule->save();

        return $schedule;
    }

    public function changDate(Request $request){
        $schedule = Schedule::find($request->id);
        $schedule->start = $request->start;
        $schedule->save();

        return $schedule;
    }

}
