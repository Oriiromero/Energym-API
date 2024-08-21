<?php

namespace App\Http\Controllers;

use App\Filters\SubscriptionFilter;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionCollection;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Exception;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $subscription = Subscription::create($request->all());

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
        $subscription->update($request->all());
    }

    
    public function destroy(Subscription $subscription)
    {
        try 
        {
            $subscription->delete();

            return response()->json(['message' => 'Subscription deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete subscription.', 'details' => $e->getMessage()], 500);
        }
    }
}
