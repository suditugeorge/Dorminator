<?php

namespace App\Console\Commands;

use App\Dorm;
use App\Institution;
use Illuminate\Console\Command;

class AddTestingInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dorminator:addTestingInfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adaugă date de test pentru aplicație';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Add FMI institution
        $institution = new Institution();
        $institution->name = 'Facultatea de Matematică și Informatică';
        $institution->code = 'INFO';
        $institution->save();

        //Add testing dorms
        $dorm = new Dorm();
        $dorm->name = 'Fundeni';
        $dorm->code = 'FN';
        $dorm->save();

        $dorm = new Dorm();
        $dorm->name = 'Kogalniceanu';
        $dorm->code = 'KG';
        $dorm->save();

        $dorm = new Dorm();
        $dorm->name = 'Grozavesti';
        $dorm->code = 'GR';
        $dorm->save();

    }
}
