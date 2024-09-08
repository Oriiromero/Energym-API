<?php

namespace App\Http\Controllers;

use App\Filters\TrainersFilter;
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use App\Http\Resources\TrainerCollection;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
use App\Services\AuditLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }
    public function index(Request $request) 
    {
        $filter = new TrainersFilter();
        $filterItems = $filter->transform($request);

        $trainers = Trainer::where($filterItems);

        return new TrainerCollection($trainers->paginate()->appends($request->query()));
    }

    public function store(StoreTrainerRequest $request) 
    {
        $user = Auth::user();

        $trainer = Trainer::create($request->all());

        $this->auditLogService->storeAction('store', 'trainers', $trainer->id, $user->id);

        return new TrainerResource($trainer);

    }

    public function show(Trainer $trainer) 
    {

        return new TrainerResource($trainer);

    }

    public function update(UpdateTrainerRequest $request, Trainer $trainer) 
    {
        $user = Auth::user();

        $trainer->update($request->all());

        $this->auditLogService->storeAction('update', 'trainers', $trainer->id, $user->id);

    }
    
    public function destroy(Trainer $trainer) 
    {
        try 
        {
            $user = Auth::user();

            $trainer->delete();

            $this->auditLogService->storeAction('delete', 'trainers', $trainer->id, $user->id);

            return response()->json(['message' => 'Trainer deleted successfully'], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => 'Failed to delete trainer.', 'details' => $e->getMessage()], 500);
        }
    }
}
