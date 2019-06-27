<?php

namespace App\Jobs;

use App\Models\RoomNumber;
use App\Models\Tenant;
use App\Models\Vacate;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VacateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $activeVacations=Vacate::where('is_active',true)->get();


        $today=Carbon::now();


        if ( $today->day==6){

            foreach ($activeVacations as $activeVacation){

                $room=RoomNumber::find($activeVacation->room_number_id);
                $room->is_vacant=true;
                $room->save();


                $tenant=Tenant::find($activeVacation->tenant_id);
                $tenant->is_active=false;
                $tenant->save();
            }


            Vacate::where('is_active',true)->update([
                'is_active'=>false
            ]);
        }
    }
}
