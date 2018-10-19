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
    
   
    public function event_category()
    {
        return $this->belongsTo('CeddyG\ClaraEvent\Repositories\EventCategoryRepository', 'fk_event_category');
    }


}
