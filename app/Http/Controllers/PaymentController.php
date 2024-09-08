<?php

namespace App\Http\Controllers;

use App\Filters\PaymentFilter;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Services\AuditLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }
    public function index(Request $request) 
    {
        $filter = new PaymentFilter();
        $filterItems = $filter->transform($request);

        $bookings = Payment::where($filterItems);

        return new PaymentCollection($bookings->with('user', 'subscription')->paginate()->appends($request->query()));
    }

    public function store(StorePaymentRequest $request) 
    {
        $user = Auth::user();

        $payment = Payment::create($request->all());

        $this->auditLogService->storeAction('store', 'payments', $payment->id, $user->id);

        return new PaymentResource($payment);
    }

    public function show(Payment $payment) 
    {
        return new PaymentResource($payment->load('user', 'subscription'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment) 
    {
        $user = Auth::user();

        $payment->update($request->all());

        $this->auditLogService->storeAction('update', 'payments', $payment->id, $user->id);
    }

    public function destroy(Payment $payment) 
    {
        try 
        {
            $user = Auth::user();

            $payment->delete();

            $this->auditLogService->storeAction('delete', 'payments', $payment->id, $user->id);

            return response()->json(['message' => 'Payment deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete payment.', 'details' => $e->getMessage()], 500);
        }
    }
}
