<?php

namespace App\Http\Controllers;

use App\Filters\TrainersFilter;
use App\Http\Resources\TrainerCollection;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index(Request $request) 
    {
        $filter = new TrainersFilter();
        $filterItems = $filter->transform($request);

        $trainers = Trainer::where($filterItems);

        return new TrainerCollection($trainers->paginate()->appends($request->query()));
    }

    public function store() {
        
    }

    public function show() {

    }

    public function update() {

    }
    
    public function destroy() {

    }
}
