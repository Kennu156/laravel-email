<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\Timetable;

class TimetableNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:timetable-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://tahvel.edu.ee/hois_back/timetableevents/timetableByGroup/38',[
            'from' => now()->startOfWeek()->addWeek()->toIsoString(),
            'lang' =>'ET',
            'thru' => now()->addWeek()->endOfWeek()->toIsoString(),
            'studentGroups' => '7596',
        ]);

        $data = collect($response->json()['timetableEvents'])->map(function($entry) {
                return [
                    'name' => data_get($entry, 'nameEt', ''),
                    'room' => data_get($entry, 'rooms.0.roomCode', ''),
                    'teacher' => data_get($entry, 'teachers.0.name', ''),
                    'date' => Carbon::parse(data_get($entry, 'date')),
                    'time_start' => data_get($entry, 'timeStart', ''),
                    'time_end' => data_get($entry, 'timeEnd', ''),
                ];
            })->sortBy(['date', 'time_start'])
            ->groupBy(function ($event) {
                return $event['date']->format('m-d');
            });

        //    return $data;
        Mail::to("hello@example.com")->send(new Timetable($data));
       // collect(['ken-martti.paju@ametikool.ee'])
       //     ->each(fn ($user) => Mail::to($user)->send(new Timetable($data)));
    }
}
