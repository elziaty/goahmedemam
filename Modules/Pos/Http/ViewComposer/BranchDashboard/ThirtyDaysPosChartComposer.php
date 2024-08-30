<?php
namespace Modules\Pos\Http\ViewComposer\BranchDashboard;
 
use Illuminate\View\View;
use Modules\Pos\Repositories\PosInterface;

class ThirtyDaysPosChartComposer{
    protected $repo;
    public function __construct(PosInterface $repo)
    {   
        $this->repo = $repo;
    } 

    public function compose(View $view){
        $data  = $this->repo->branchThirtyDaysPosChart(); 
        $view->with('ThirtyDaysposData',$data);
    }
}