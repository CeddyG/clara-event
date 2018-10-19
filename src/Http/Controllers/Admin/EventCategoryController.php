<?php

namespace CeddyG\ClaraEvent\Http\Controllers\Admin;

use CeddyG\ClaraEvent\Http\Controllers\ContentManagerController;

use CeddyG\ClaraEvent\Repositories\EventCategoryRepository;

class EventCategoryController extends ContentManagerController
{
    public function __construct(EventCategoryRepository $oRepository)
    {
        $this->sPath            = 'clara-event::admin.event-category';
        $this->sPathRedirect    = 'admin/event-category';
        $this->sName            = __('clara-event::event-category.event_category');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraEvent\Http\Requests\EventCategoryRequest';
    }
    
    public function storeAjax()
    {
        parent::store();
        
        return response()->json([
            'message' => 'Ok'
        ], 200);
    }
}
