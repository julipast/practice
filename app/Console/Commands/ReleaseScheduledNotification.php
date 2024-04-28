<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\ReservationMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
class ReleaseScheduledNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:send-notification';

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
        $currentTime = Carbon::now()->setTimezone('Europe/Kiev');
        $reservations = Reservation::where('status', 0)
            ->where('start_date', '<=',  $currentTime)
            ->get();
        $this->info('Status update uh');
//        $url='https://uptime.betterstack.com/api/v1/heartbeat/qdP9Y8cisNEMi9hohEXZrVu1';
//        Http::get($url);


        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)->send(new ReservationMail($reservation));
            // Позначити, що сповіщення було відправлено
            $reservation->update(['status' => 1]);
        }

        $this->info('Reservation notifications sent successfully.');
    }

}
