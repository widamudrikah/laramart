<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request) {
        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at', $todayDate)->paginate(10);

        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null, function($q) use ($request) {

                            return $q->whereDate('created_at', $request->date);
                        }, function($q) use ($todayDate){

                            return $q->whereDate('created_at', $todayDate);
                        })
                        ->when($request->status != null, function($q) use ($request) {

                            return $q->where('status_message', $request->status);
                        })
                        ->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function show($id) {
        $order = Order::where('id', $id)->first();
        if($order) {
            return view('admin.order.show', compact('order'));
        }else{
            return redirect()->back();
        }
    }

    public function updateStatus($id, Request $request) {
        $order = Order::where('id', $id)->first();
        if($order) {
            $order->update([
               'status_message' => $request->order_status
            ]);
            return redirect()->route('orders-detail-admin', $order->id)->with('message', 'Order updated successfully');
        }else{
            return redirect()->back();
        }
    }

    public function viewInvoice($id) {
        $order = Order::findOrFail($id);
        return view('admin.invoice.view-invoice', compact('order'));
    }

    public function generateInvoice($id) {
        $order = Order::findOrFail($id);
        $data = ['order' => $order];

        $pdf = Pdf::loadView('admin.invoice.view-invoice', $data);
        $todayDate = Carbon::now()->format('Y-m-d');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }
}
