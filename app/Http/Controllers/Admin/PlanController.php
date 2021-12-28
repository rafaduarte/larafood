<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{   
    private $repository;
    public function __construct(plan $plan)
    {
        $this->repository = $plan;

        //$this->middleware(['can:plans']);
    }

    public function index()
    {   
        //$plans = $this->repository->all();
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }
    public function create()
    {
        return view('admin.pages.plans.create');
    }
    public function store(StoreUpdatePlan $request)
    {
        //dd($request->all()); verificar se está pegando os dados
       // 1$data = $request->all();   
        //$data['url'] =  Str::kebab($request->name);
        //2$data['url'] = $request->name;
        //$this->repository->create($request->all());
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }
    public function show($url)
    {
        //o find pega pelo id, get retorna uma collection o first um único registro.
        $plan = $this->repository->where('url', $url)->first();
        
        if(!$plan)
            return redirect()-back();


        return view('admin.pages.plans.show',[
            'plan' => $plan,
        ]);
    }
    public function destroy($url)
    {
        //o find pega pelo id, get retorna uma collection o first um único registro.
        $plan = $this->repository->where('url', $url)->first();
        
        if(!$plan)
            return redirect()-back();


        if($plan->details->count() > 0 ) {
            return redirect()
                    ->back()
                    ->with('error', 'Existem detalhes vinculados a esses plano, portanto não pode excluir');
        }
        
        $plan->delete();

        return redirect()->route('plans.index');
    }
    public function search(Request $request)
    {
        //dd($request->all());
        //$filters = $request->all();
        $filters = $request->except('_token'); //pega todos os dados exceto o token

        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);

    }
    public function edit($url)
    {
        //o find pega pelo id, get retorna uma collection o first um único registro.
        $plan = $this->repository->where('url', $url)->first();
        
        if(!$plan)
            return redirect()-back();

        
       return view('admin.pages.plans.edit',[
           'plan' => $plan,
       ]);
    }
    public function update(StoreUpdatePlan $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();
        
        if(!$plan)
            return redirect()-back();
            
        //dd($request->all());
        $plan->update($request->all());

        return redirect()->route('plans.index');
    }
}
