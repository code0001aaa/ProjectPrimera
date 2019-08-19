<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class CacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "cache:regenerate {--c|clear-compiled=false : Run 'artisan clear-compiled'.}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Regenerate artisan cache. If set '-c' option, run 'artisan clear-compiled'.";

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
        $isClearCompiled = ($this->option("clear-compiled") !== 'false');

        // Cache clear.
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        if($isClearCompiled){
            Artisan::call('clear-compiled');
            $this->comment("Remember to run 'composer dump-autoload --optimize'.");
        }

        // Cache save.
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');

        $this->info('Regenerated artisan cache.');
        return 0;
    }
}
