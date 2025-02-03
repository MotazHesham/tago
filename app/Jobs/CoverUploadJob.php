<?php

namespace App\Jobs; 

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CoverUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cover;
    protected $model;
    /**
     * Create a new job instance.
     */
    public function __construct($model, $cover)
    {
        $this->model = $model;
        $this->cover = $cover;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->model->addMedia($this->cover)
        ->preservingOriginal() // Prevents the file from being deleted
        ->toMediaCollection('cover');
    }
}
