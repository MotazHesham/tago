<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PhotoUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $photo;
    protected $model;
    /**
     * Create a new job instance.
     */
    public function __construct($model, $photo)
    {
        $this->model = $model;
        $this->photo = $photo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->model->addMedia($this->photo)
        ->preservingOriginal() // Prevents the file from being deleted
        ->toMediaCollection('photo');
    }
}
