<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function deleting(User $model)
    { 
        $model->email = $model->email . '_deleted_' . $model->id;
        if($model->phone_number){
            $model->phone_number = $model->phone_number . '_deleted_' . $model->id;
        }
        $model->save();
    }
}
