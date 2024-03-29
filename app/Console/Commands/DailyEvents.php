<?php

namespace App\Console\Commands;

use App\Family;
use App\Family\CalendarEntryProvider;
use App\Family\TodoProvider;
use App\Mail\DailyEvents as DailyEventsEmail;
use App\Service\FamilyConnectService;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'piglet:events:daily-email {timezone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends emails to users in the provided timezone with the Events scheduled that day';

    /**
     * @var FamilyConnectService
     */
    private $connectService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FamilyConnectService $connectService)
    {
        $this->connectService = $connectService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(TodoProvider $todoProvider)
    {
        $timezone = $this->argument('timezone');

        $users = User::where(['timezone' => $timezone, 'email_verified' => true, 'events_email' => true])->get();

        foreach ($users as $user) {

            $today              = $user->today();
            $familyEntryDetails = [];

            foreach ($user->families->where('active', true) as $family) {
                $this->connectService->connectToFamily($family);

                $provider = new CalendarEntryProvider($today->year, $today->month, $today->day, $family->id);

                $events = $provider->events();

                $overdueTodos = $todoProvider->getOverdueTodosForMember($user->member, $user->today());

                $dueTodayTodos = $todoProvider->getDueTodayTodosForMember($user->member, $user->today());

                if (   $events->count() === 0
                    && $overdueTodos->count() === 0
                    && $dueTodayTodos->count() === 0
                ) {
                    continue;
                }

                $familyEntryDetails[] = [
                    'family' => $family,
                    'events' => $provider->events(),
                    'overdueTodos' => $overdueTodos,
                    'dueTodayTodos' => $dueTodayTodos,
                ];
            }

            if ($familyEntryDetails) {
                Mail::to($user)->send(new DailyEventsEmail($user, $familyEntryDetails));
            }
        }
    }
}
