<?php

namespace Algad\Photography;

use System\Classes\PluginBase;
use Algad\Photography\Helpers\PageUtils;
use Backend;
use Event;

/**
 * Algad Photography Plugin Information File.
 */
class Plugin extends PluginBase
{

    /**
     * Algad Photography plugin information.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'algad.photography::lang.plugin.name',
            'description' => 'algad.photography::lang.plugin.description',
            'author' => 'Alexandre GADIOU',
            'homepage' => 'http://alexandre-gadiou.appspot.com',
            'icon' => 'icon-camera'
        ];
    }

    /**
     * Add a tab 'Photography' in page settings
     *
     */
    public function register()
    {
        Event::listen('backend.form.extendFields', function($widget)
        {
            if (!$widget->model instanceof \Cms\Classes\Page)
                return;


            if ($widget->model->layout == 'album-list')
            {
                $widget->addFields([
                    'settings[albums_folder]' => [
                        'label' => 'Albums Folder',
                        'description' => 'Write the location where are stored your photo albums',
                        'tab' => 'Photography',
                        'default' => 'storage/app/media'
                    ]
                        ], 'primary');
            }
        });
    }

    public function registerPermissions()
    {
        return [
            'algad.photography.manage_comments' => ['tab' => 'algad.photography::lang.plugin.name', 'label' => 'algad.photography::lang.manage_comments']
        ];
    }

    public function registerNavigation()
    {
        return [
            'photography' => [
                'label' => 'algad.photography::lang.comment.menu_label',
                'url' => Backend::url('algad/photography/comments'),
                'icon' => 'icon-pencil',
                'permissions' => ['algad.photography.manage_comments'],
                'order' => 100,
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            'Algad\Photography\Components\AlbumList' => 'album_list',
            'Algad\Photography\Components\Album' => 'album',
            'Algad\Photography\Components\LastComments' => 'last_comments',
            'Algad\Photography\Components\LastPosts' => 'last_posts',
            'Algad\Photography\Components\FullPost' => 'full_post'
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'sha1' => function($value)
                {
                    return sha1($value);
                },
                'md5' => function($value)
                {
                    return md5($value);
                }
            ],
            'functions' => [
                'getAlbumTitle' => function($albumLocation)
                {
                    $albumTitle = PageUtils::getInstance()->getAlbumTitle($albumLocation);
                    return $albumTitle;
                }
            ]
        ];
    }

}
