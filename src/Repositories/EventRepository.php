<?php

namespace CeddyG\ClaraEvent\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class EventRepository extends QueryBuilderRepository
{
    protected $sTable = 'event';

    protected $sPrimaryKey = 'id_event';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'event_category'
    ];

    protected $aFillable = [
        'fk_event_category',
		'name_event',
		'date_begin',
		'date_end',
		'color_event',
		'description_event'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'title' => [
            'name_event',
            'event_category.name_event_category'
        ],
        'type_name' => [
            'event_category.name_event_category'
        ],
        'start' => [
            'date_begin'
        ],
        'end' => [
            'date_end'
        ],
        'color' => [
            'color_event'
        ]
    ];
   
    public function event_category()
    {
        return $this->belongsTo('CeddyG\ClaraEvent\Repositories\EventCategoryRepository', 'fk_event_category');
    }

    public function getTypeNameAttribute($oItem)
    {
        return $oItem->event_category->name_event_category;
    }

    public function getTitleAttribute($oItem)
    {
        return $oItem->event_category->name_event_category.' - '.$oItem->name_event;
    }

    public function getStartAttribute($oItem)
    {
        return $oItem->date_begin;
    }

    public function getEndAttribute($oItem)
    {
        return $oItem->date_end;
    }

    public function getColorAttribute($oItem)
    {
        return $oItem->color_event;
    }
}
