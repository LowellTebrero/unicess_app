<?php

namespace App\Http\Controllers\Admin;

use Google_Client;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use Google_Service_Calendar_Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Google_Service_Calendar_EventDateTime;
class GoogleCalendarController extends Controller
{
    public function GoogleCalendar(){

        $user = Auth()->user();
        $refreshToken = $user->google_refresh_token;

        $accessToken = $this->generateAccessTokenFromRefreshToken($refreshToken);

        try{
            $client = new Google_Client();
            $client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($client);

            $calendarId = 'primary';

            $results = $service->events->listEvents($calendarId);
            $events = $results->getItems();

              // Format events for FullCalendar
            $formattedEvents = [];
            foreach ($events as $event) {
                $formattedEvents[] = [
                    'title' => $event->getSummary(),
                    'start' => $event->getStart()->getDateTime(),
                    'end' => $event->getEnd()->getDateTime(),
                ];
            }

            return view('user.calendar.index', ['events' => $formattedEvents]);

        }catch(\Exception $ex){
            // dd($ex->getMessage());
            return back()->withErrors('Unable to complete this request, due to this error'. $ex->getMessage());
        }
    }

    private function generateAccessTokenFromRefreshToken($refreshToken){

        $newAccessToken = null;
        $googleClientId = config('services.google.client_id');
        $googleClientSecret = config('services.google.client_secret');

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [

            'grant_type' => 'refresh_token',
            'client_id' => $googleClientId,
            'client_secret' => $googleClientSecret,
            'refresh_token' => $refreshToken,

        ]);

        if($response->successful()){
            $data = $response->json();
            $newAccessToken = $data['access_token'];
            $newRefreshToken = $data['refresh_token'] ?? $refreshToken;
        }else{
            $error = $response->json();
        }
        return $newAccessToken;
    }
}
