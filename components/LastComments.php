<?php

namespace Algad\Photography\Components;

use Cms\Classes\ComponentBase;
use Algad\Photography\Models\Comment;

class LastComments extends ComponentBase
{

    public $commentList;

    public function componentDetails()
    {
        return [
            'name' => 'LastComments',
        ];
    }

    public function onRun()
    {
        $this->commentList = Comment::orderBy('created_at', 'desc')->get();
    }

    public function defineProperties()
    {
        return [];
    }

}
