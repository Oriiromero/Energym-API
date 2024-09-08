<?php

namespace App\Http\Controllers;

use App\Filters\ActivityFilter;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Services\AuditLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }

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
        $user = Auth::user();

        $activity = Activity::create($request->all());

        $this->auditLogService->storeAction('store', 'activities', $activity->id, $user->id);

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
        $user = Auth::user();

        $activity->update($request->all());

        $this->auditLogService->storeAction('update', 'activities', $activity->id,  $user->id);
    }

    public function destroy(Activity $activity) 
    {
        try 
        {
            $user = Auth::user();

            $activity->delete();

            $this->auditLogService->storeAction('delete', 'activities', $activity->id,  $user->id);

            return response()->json(['message' => 'Activity deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete activity.', 'details' => $e->getMessage()], 500);
        }
    }
}
