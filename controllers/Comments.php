<?php

namespace Algad\Photography\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Algad\Photography\Models\Comment;

/**
 * Comments Back-end Controller
 */
class Comments extends Controller
{

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];
    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $requiredPermissions = [
        'algad.photography.manage_comments'
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Algad.Photography', 'photography', 'comments');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds))
        {

            foreach ($checkedIds as $commentId)
            {
                if ((!$comment = Comment::find($commentId)))
                    continue;
                $comment->delete();
            }
        }

        return $this->listRefresh();
    }

}
