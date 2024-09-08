<?php

namespace App\Http\Controllers;

use App\Filters\BookingFilter;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\AuditLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }

    public function index(Request $request) 
    {
        $filter = new BookingFilter();
        $filterItems = $filter->transform($request);

        $bookings = Booking::where($filterItems);

        return new BookingCollection($bookings->with('user', 'activity')->paginate()->appends($request->query()));
    }

    public function store(StoreBookingRequest $request) 
    {
        $user = Auth::user();

        $booking = Booking::create($request->all());

        $this->auditLogService->storeAction('store', 'bookings', $booking->id, $user->id);

        return new BookingResource($booking);
    }

    public function show(Booking $booking) 
    {
        return new BookingResource($booking->load('user', 'activity'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking) 
    {
        $user = Auth::user();

        $this->auditLogService->storeAction('update', 'bookings', $booking->id, $user->id);

        $booking->update($request->all());
    }

    public function destroy(Booking $booking) 
    {
        try 
        {
            $user = Auth::user();

            $booking->delete();

            $this->auditLogService->storeAction('delete', 'bookings', $booking->id, $user->id);

            return response()->json(['message' => 'Booking deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete booking.', 'details' => $e->getMessage()], 500);
        }
    }
}
