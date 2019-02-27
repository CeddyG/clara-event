<?php

namespace CeddyG\ClaraEvent\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use Illuminate\Http\Request;
use CeddyG\ClaraEvent\Repositories\EventRepository;
use CeddyG\ClaraEvent\Repositories\EventCategoryRepository;

class EventController extends ContentManagerController
{
    protected $oRepositoryCategory = null;
    
    public function __construct(EventRepository $oRepository, EventCategoryRepository $oRepositoryCategory)
    {
        $this->sPath            = 'clara-event::admin.event';
        $this->sPathRedirect    = 'admin/event';
        $this->sName            = __('clara-event::event.calendar');
        
        $this->oRepository          = $oRepository;
        $this->oRepositoryCategory  = $oRepositoryCategory;
        $this->sRequest             = 'CeddyG\ClaraEvent\Http\Requests\EventRequest';
        $this->sTypeRoute           = app($this->sRequest)->is('api/*') ? 'api' : 'web';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $oRequest)
    {   
        if ($this->sTypeRoute == 'web')
        {
            $oCategories = $this->oRepositoryCategory->all(
                [
                    'id_event_category', 
                    'name_event_category', 
                    'color_event_category'
                ]
            );

            return view($this->sPath.'/index', ['sPageTitle' => $this->sName, 'oCategories' => $oCategories]);
        }
        else
        {
            $this->oRepository->setReturnCollection(false);
            $aInputs = $oRequest->all();
                
            return response()->json(
                $this->oRepository->findCustom(
                    function($oQuery) use ($aInputs) {
                        $oQuery->whereBetween(
                            'date_begin', 
                            [$aInputs['start'], $aInputs['end']]
                        )
                        ->orWhereBetween(
                            'date_end', 
                            [$aInputs['start'], $aInputs['end']]
                        );
                    },
                    ['title', 'start', 'end', 'color', 'description_event', 'type_name']
                ), 
                200
            );
        }
    }
}
