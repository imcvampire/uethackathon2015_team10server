<?php

namespace App\Console\Commands;

use App\Contracts\Search;
use App\Subject;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AlgoliaIndexer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:index {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle(Search $search)
    {
        $table = $this->argument('table');

        $collection = collect(
            DB::table($table)->get()
        )->map(function($collect) {
            $collect->objectID = $collect->id;
            return (array) $collect;
        });

        $search->index($table)->saveObjects($collection);
        $this->info('All Done!');
    }
}
