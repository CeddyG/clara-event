<?php

namespace CeddyG\ClaraEvent\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class EventCategoryRepository extends QueryBuilderRepository
{
    protected $sTable = 'event_category';

    protected $sPrimaryKey = 'id_event_category';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'event'
    ];

    protected $aFillable = [
        'name_event_category',
		'color_event_category'
    ];
    
   
    public function event()
    {
        return $this->hasMany('CeddyG\ClaraEvent\Repositories\EventRepository', 'fk_event_category');
    }


}
