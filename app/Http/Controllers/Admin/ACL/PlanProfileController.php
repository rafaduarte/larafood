<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

   public function __construct(plan $plan, Profile $profile)
   {
        $this->plan = $plan;
        $this->profile = $profile;    
   }


   public function profiles($idplan)
   {
    $plan = $this->plan->with('profiles')->find($idplan);

    if (!$plan) {
        return redirect()->back();
    }
    $profiles = $plan->profiles()->paginate();

    return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
   }


   public function plans($idPermission)
   {
    $profile = $this->profile->with('plans')->find($idPermission);

    if (!$profile) {
        return redirect()->back();
    }
    $plans = $profile->plans()->paginate();

    return view('admin.pages.profiles.plans.plans', compact('profile', 'plans'));
   }


   public function profilesAvailable(Request $request, $idplan)
   {    
    $plan = $this->plan->find($idplan);
       if (!$plan) {
        return redirect()->back();
    }

    $filters = $request->except('_token');
    //dd($request->filter); // filter nome do campo
    $profiles = $plan->profilesAvailable($request->filter);
    //1 $profiles = $this->profile->paginate();

    return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));

   }


   public function attachProfilesPlan(Request $request, $idplan)
   {    
    $plan = $this->plan->find($idplan);
     
    if (!$plan) {
        return redirect()->back();
    }

    if (!$request->profiles || count($request->profiles) == 0)
    {
        return redirect()
                ->back()
                ->with('info', 'Precisa escolher pelo menos uma plano');
    }
    
    $plan->profiles()->attach($request->profiles);

    return redirect()->route('plans.profiles', $plan->id);

   }


   public function detachPlanProfile($idplan, $idPermission)
   {
       $plan = $this->plan->find($idplan);
       $profile = $this->profile->find($idPermission);

       if (!$plan || ! $profile) {
           return redirect()-back();
       }

       $plan->profiles()->detach($profile);

       return redirect()->route('plans.profiles', $plan->id);
   }
}
