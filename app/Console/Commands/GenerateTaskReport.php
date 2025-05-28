<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class GenerateTaskReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:report {--project_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a tasks report based on a specified project or on all projects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projectId = $this->option('project_id');
        $query = Task::query();
        // $this->info('Project ID: ' . $projectId);

        if ($projectId) {
            $query->where('project_id', $projectId); 
        }

        $tasks = $query->get(['id', 'title', 'status', 'due_date']);

        if ($tasks->isEmpty()) {
            $this->warn('System has no tasks');
            return;
        }

        $this->table(
            ['ID', 'Title', 'Status', 'Deadline'],
            $tasks->toArray()
        );
    }
}
