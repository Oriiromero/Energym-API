<?php

namespace App\Http\Controllers;

use App\Filters\SubscriptionFilter;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionCollection;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Services\AuditLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }
    public function index(Request $request)
    {
        $filter = new SubscriptionFilter();
        $filterItems = $filter->transform($request);

        $includeMember = $request->query('includeMember');

        $subscriptions = Subscription::where($filterItems); 

        if($includeMember)
        {
            $subscriptions = $subscriptions->with('user');
        }

        return new SubscriptionCollection($subscriptions->paginate()->appends($request->query()));
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $user = Auth::user();

        $subscription = Subscription::create($request->all());

        $this->auditLogService->storeAction('store', 'subscriptions', $subscription->id, $user->id);

        return new SubscriptionResource($subscription);
    }

    public function show(Subscription $subscription)
    {
        $includeMember = request()->query('includeMember');

        if($includeMember)
        {
            return new SubscriptionResource($subscription->load('user'));
        }

        return new SubscriptionResource($subscription);
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $user = Auth::user();

        $this->auditLogService->storeAction('update', 'subscriptions', $subscription->id, $user->id);

        $subscription->update($request->all());
    }

    
    public function destroy(Subscription $subscription)
    {
        try 
        {
            $user = Auth::user();

            $subscription->delete();

            $this->auditLogService->storeAction('delete', 'subscriptions', $subscription->id, $user->id);

            return response()->json(['message' => 'Subscription deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete subscription.', 'details' => $e->getMessage()], 500);
        }
    }
}
