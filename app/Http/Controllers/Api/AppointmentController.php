<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Appointment::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'booking_date'=>'required|date_format:Y-m-d H:i'
        ]);

        $isset_booking_date = Appointment::where('booking_date',$data['booking_date'])->first();

        if ($validator->fails()) {
            $error = $validator->errors()->first();

            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "title" => $error
            ]);

        }else if($isset_booking_date){

            return response()->json([
                "success" => false,
                "message" => "Appointment - Exist",
                "title" => "Appointment exist - change date"
            ]);

        }else{

            $appointment = new Appointment();
            $appointment->booking_date = $data['booking_date'];
            $appointment->status =  'available';
            $appointment->description = $data['description'] ?? null;
            $appointment->save();
    
             return $appointment;

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return $appointment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'booking_date'=>'required|date_format:Y-m-d H:i'
        ]);

        $isset_booking_date = Appointment::where('booking_date',$data['booking_date'])->first();


        if ($validator->fails()) {
            $error = $validator->errors()->first();

            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "title" => $error
            ]);

        }else if($isset_booking_date){

            return response()->json([
                "success" => false,
                "message" => "Appointment - Exist",
                "title" => "Appointment exist - change date"
            ]);

        }else{

            $appointment->booking_date = $data['booking_date'];
            $appointment->description = $data['description'] ?? null;
            $appointment->save();

            return $appointment;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        
        return response("", Response::HTTP_NO_CONTENT);
    }

    public function unavailable_appointments(){
        return Appointment::where('status','unavailable')->paginate();
    }
}
