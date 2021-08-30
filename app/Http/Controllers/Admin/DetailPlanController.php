<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPlan;
use App\Models\plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{   
    protected $repository;

   public function __construct(DetailPlan $detailPlan, plan $plan)
   {
       $this->repository = $detailPlan;
       $this->plan = $plan;
   }

   public function index($urlPlan)
   {

   }
}
