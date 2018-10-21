<?php

namespace CeddyG\ClaraEvent\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use CeddyG\ClaraEvent\Repositories\EventRepository;

class EventController extends ContentManagerController
{
    public function __construct(EventRepository $oRepository)
    {
        $this->sPath            = 'clara-event::admin.event';
        $this->sPathRedirect    = 'admin/event';
        $this->sName            = __('clara-event::event.event');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraEvent\Http\Requests\EventRequest';
    }
}
