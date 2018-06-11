<?php

namespace App\Http\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

    public function getRoleNames()
    {
        if (is_object($this->role))
            return $this->role->name;
    }
}
