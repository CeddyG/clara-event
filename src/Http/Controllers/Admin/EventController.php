<?php

namespace CeddyG\ClaraEvent\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use CeddyG\ClaraEvent\Repositories\EventRepository;
use CeddyG\ClaraEvent\Repositories\EventCategoryRepository;

class EventController extends ContentManagerController
{
    private $oRepositoryCategory = null;
    
    public function __construct(EventRepository $oRepository, EventCategoryRepository $oRepositoryCategory)
    {
        $this->sPath            = 'clara-event::admin.event';
        $this->sPathRedirect    = 'admin/event';
        $this->sName            = __('clara-event::event.event');
        
        $this->oRepository          = $oRepository;
        $this->oRepositoryCategory  = $oRepositoryCategory;
        $this->sRequest             = 'CeddyG\ClaraEvent\Http\Requests\EventRequest';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $oCategories = $this->oRepositoryCategory->getFillFromView($this->sPath.'/index')
            ->all();
        
        return view($this->sPath.'/index', ['sPageTitle' => $this->sName, 'oCategories' => $oCategories]);
    }
}
