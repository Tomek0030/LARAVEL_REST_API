<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Appointment::where('status','available')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($appointment,$email)
    {
        $data = [
            'appointment' => $appointment,
            'email' => $email
        ];

         $validator = Validator::make($data, [
             'appointment'=>'required',
             'email'=>'required|email'
         ]);

          $isset_appointment = Appointment::find($appointment);
    
         if ($validator->fails()) {
            $error = $validator->errors()->first();

            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "title" => $error
            ]);

        }
        else if(!$isset_appointment){

            return response()->json([
                "success" => false,
                "message" => "Apointment does not exist                ",
                "title" => "Apointment does not exist - change apointment id"
            ]);

        }else{

            $booking_appointment = Appointment::find($appointment);
            $booking_appointment->status =  'unavailable';
            $booking_appointment->update();
    
            $booking = new Booking();
            $booking->appointment_id = $appointment;
            $booking->email =  $email;
            $booking->save();
    
            return response()->json([
                'id' => $appointment,
                'booking_date' => $booking_appointment->booking_date,
                'status' => 'unavailable',
                'description' => $booking_appointment->description,
                'email' =>  $email
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return $booking;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update($appointment,$email)
    {

        $isset_booking_appointment = Booking::where('appointment_id',$appointment)->where('email',$email)->first();

        if(!$isset_booking_appointment){

            return response()->json([
                "success" => false,
                "message" => "Apointment does not exist or invalid email",
                "title" => "Change apointment id or email"
            ]);

        }
        else{

            $booking_appointment = Appointment::find($isset_booking_appointment->appointment_id);
            $booking_appointment->status =  'available';
            $booking_appointment->update();

            $isset_booking_appointment->delete();

            return response()->json([
                'id' => $appointment,
                'booking_date' => $booking_appointment->booking_date,
                'status' => 'available',
                'description' => $booking_appointment->description
            ]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response("", Response::HTTP_NO_CONTENT);
    }
}
