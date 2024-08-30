<?php

namespace Modules\Reports\Http\Controllers;

use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Branch\Repositories\BranchInterface;
use Modules\Customer\Repositories\CustomerInterface;
use Modules\Reports\Repositories\CustomerReport\CustomerReportInterface;

class CustomerReportController extends Controller
{
    protected $repo,$customerRepo,$branchRepo;
    public function __construct(CustomerReportInterface $repo,CustomerInterface $customerRepo,BranchInterface $branchRepo)
    { 
        $this->repo           = $repo;
        $this->customerRepo   = $customerRepo;
        $this->branchRepo     = $branchRepo;
    }
    public function index(Request $request)
    {
        $request['date']  =  Carbon::today()->format('m/d/Y').' - '.Carbon::today()->format('m/d/Y');
        $customers        = $this->customerRepo->getActiveCustomers(business_id());  
        $branches         = $this->branchRepo->getAll(business_id());
        return view('reports::customer_sale_report.index',compact('request','customers','branches'));
    }

    public function getReport(Request $request){ 
        ini_set('max_execution_time', 900); //900 seconds 
        $data = [];
        $data['get_total']  = $this->repo->getReport($request);
        $sales              = $this->repo->getSales($request);
        $customername       = $this->repo->getCustomerName($request);
        $branchname         = $this->repo->getBranchName($request);
        $data['view']       =  view('reports::customer_sale_report.sale_list',compact('request','sales','customername','branchname'))->render();
        return response()->json($data);
    }
}
