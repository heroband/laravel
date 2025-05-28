<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class CreateTaskInteractive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:create-interactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive task creation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = $this->ask('Enter task title');
        $description = $this->ask('Description (optional)');
        $dueDate = $this->ask('Deadline date in format YYYY-MM-DD');
        $status = $this->choice('Choose status', ['new', 'in_progress', 'done'], 0);
        $assignedTo = $this->ask('Assignee ID (or leave it empty)');
        $authorId = $this->ask('Author ID');
        $projectId = $this->ask('Project ID');

        $confirmation = $this->confirm('Create this task?', true);

        if (!$confirmation) {
            $this->warn('Creation cancelled');
            return;
        }

        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'due_date' => $dueDate,
            'assigned_to' => $assignedTo ?: null,
            'author_id' => $authorId,
            'project_id' => $projectId,
        ]);

        $this->info("Task '{$task->title}' with ID {$task->id} created");
    }
}
