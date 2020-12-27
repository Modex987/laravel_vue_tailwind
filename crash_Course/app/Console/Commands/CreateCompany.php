<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class CreateCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    /*
    protected $signature = 'contact:company {name} {phone=N/A}'; # default value
    // protected $signature = 'contact:company {name} {phone?}';
    */
    protected $signature = 'contact:company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A New Company';

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
     * @return int
     */
    public function handle()
    {
        /*
        $company = Company::create([
            'name' => $this->argument('name'),
            'phone' => $this->argument('phone')
            // 'phone' => $this->argument('phone') ?? 'N/A'
        ]);

        $this->info('Infos String Here');
        $this->warn('Warning String Here');
        $this->error('Error String Here');
        */

        # Interactive Shell

        $name = $this->ask('What is the company name ?');
        $phone = $this->ask('What is the company phone ?');

        if ($this->confirm('Are you Sure ?')) {
            $company = Company::create([
                'name' => $name,
                'phone' => $phone
            ]);

            $this->info('Company ' . $company->name . ' created Successfuly');
        } else {
            $this->warn('Company Wasn\'t Created');
        }
    }
}