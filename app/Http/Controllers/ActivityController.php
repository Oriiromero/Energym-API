<?php

namespace App\Http\Controllers;

use App\Filters\ActivityFilter;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request) 
    {
        $filter = new ActivityFilter();
        $filterItems = $filter->transform($request);

        $includeTrainer = $request->query('includeTrainer');

        $activities = Activity::where($filterItems);

        if($includeTrainer) 
        {
            $activities = $activities->with('trainer');
        }

        return new ActivityCollection($activities->paginate()->appends($request->query()));
    }

    public function store(StoreActivityRequest $request) 
    {
        $activity = Activity::create($request->all());

        return new ActivityResource($activity);
    }

    public function show(Activity $activity) 
    {
        $includeTrainer = request()->query('includeTrainer');

        if($includeTrainer)
        {
            return new ActivityResource($activity->load('trainer'));
        }

        return new ActivityResource($activity);
    }

    public function update(UpdateActivityRequest $request, Activity $activity) 
    {
        $activity->update($request->all());
    }

    public function destroy(Activity $activity) 
    {
        try 
        {
            $activity->delete();

            return response()->json(['message' => 'Activity deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete activity.', 'details' => $e->getMessage()], 500);
        }
    }
}
