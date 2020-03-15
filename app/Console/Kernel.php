<?php

namespace App\Console;

use App\Beacon;
use App\Iot;
use App\IotRecord;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $beacons = Beacon::all();

            foreach ($beacons as $beacon){
            $record = count($beacon->customers());
            $now = Jalalian::now()->format('%Y-%m-%d');
            $beacon_record = IotRecord::where('beacon_id' ,'=', $beacon->mac_address)->get();
            $old_record = $beacon_record->record;
            $new_record = $old_record->put($now , $record);
                DB::table('iot_records')
                    ->where('beacon_id' ,'=', $beacon->mac_address)
                    ->update(['record' => $new_record]);
            }
            $iots = Iot::all();
            foreach ($iots as $iot){
                $iot->count = '0';
            }
        })->dailyAt('02:30');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
