<?php

namespace App\Http\Controllers;

use App\Filters\TrainersFilter;
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use App\Http\Resources\TrainerCollection;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
use Exception;
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

    public function store(StoreTrainerRequest $request) 
    {
        $trainer = Trainer::create($request->all());

        return new TrainerResource($trainer);

    }

    public function show(Trainer $trainer) {

        return new TrainerResource($trainer);

    }

    public function update(UpdateTrainerRequest $request, Trainer $trainer) {

        $trainer->update($request->all());

    }
    
    public function destroy(Trainer $trainer) {
        try 
        {
            $trainer->delete();

            return response()->json(['message' => 'Trainer deleted successfully'], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => 'Failed to delete trainer.', 'details' => $e->getMessage()], 500);
        }
    }
}
