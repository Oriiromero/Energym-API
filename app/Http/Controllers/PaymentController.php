<?php

namespace App\Http\Controllers;

use App\Filters\PaymentFilter;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request) 
    {
        $filter = new PaymentFilter();
        $filterItems = $filter->transform($request);

        $bookings = Payment::where($filterItems);

        return new PaymentCollection($bookings->with('user', 'subscription')->paginate()->appends($request->query()));
    }

    public function store(StorePaymentRequest $request) 
    {
        $payment = Payment::create($request->all());

        return new PaymentResource($payment);
    }

    public function show(Payment $payment) 
    {
        return new PaymentResource($payment->load('user', 'subscription'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment) 
    {
        $payment->update($request->all());
    }

    public function destroy(Payment $payment) 
    {
        try 
        {
            $payment->delete();

            return response()->json(['message' => 'Payment deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete payment.', 'details' => $e->getMessage()], 500);
        }
    }
}
