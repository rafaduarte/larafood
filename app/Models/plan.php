<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    //
    protected $fillable = ['name','url','price', 'description'];

    public function search($filter = null)
    {   
        // %% para pesquisa tanto no inicio quanto no final
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();
                // get para retornar todos os dados
                return $results;
    }
}
