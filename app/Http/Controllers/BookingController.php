<?php

namespace App\Http\Controllers;

use App\Filters\BookingFilter;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request) 
    {
        $filter = new BookingFilter();
        $filterItems = $filter->transform($request);

        $bookings = Booking::where($filterItems);

        return new BookingCollection($bookings->with('user', 'activity')->paginate()->appends($request->query()));
    }

    public function store(StoreBookingRequest $request) 
    {
        $booking = Booking::create($request->all());

        return new BookingResource($booking);
    }

    public function show(Booking $booking) 
    {
        return new BookingResource($booking->load('user', 'activity'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking) 
    {
        $booking->update($request->all());
    }

    public function destroy(Booking $booking) 
    {
        try 
        {
            $booking->delete();

            return response()->json(['message' => 'Booking deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'Failed to delete booking.', 'details' => $e->getMessage()], 500);
        }
    }
}
