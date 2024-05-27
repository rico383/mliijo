<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\customer;
use App\Models\product;
use App\Models\order;
use App\Models\user;
use App\Models\employee;
use App\Models\partner;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=[
            'productcount' => product::count(),
            'orderscount' => order::where('payment_status', NULL)->count(),
            'lunassum' => order::where('payment_status', 'Lunas')->sum('total_price'),
            'notlunassum' => order::where('payment_status', 'Belum lunas')->sum('total_price'),
            'lunascount' => order::where('payment_status', 'Lunas')->count(),
            'notlunascount' => order::where('payment_status', 'Belum lunas')->count(),
            'admincount' => user::count(),
            'customercount' => customer::count(),
            'employeecount' => employee::count(),
            'partnercount' => partner::count(),
            'cat1count' => product::where('category', 'Makeup')->count(),
            'cat2count' => product::where('category', 'Paket Wedding')->count(),
            'cat3count' => product::where('category', 'Extra Wedding')->count(),
            'cat4count' => product::where('category', 'Paket Foto')->count(),
        ];


            return view('dashboard.index')
            ->with('productcount', $data['productcount'])
            ->with('orderscount', $data['orderscount'])
            ->with('lunassum', $data['lunassum'])
            ->with('notlunassum', $data['notlunassum'])
            ->with('lunascount', $data['lunascount'])
            ->with('notlunascount', $data['notlunascount'])
            ->with('admincount', $data['admincount'])
            ->with('customercount', $data['customercount'])
            ->with('employeecount', $data['employeecount'])
            ->with('partnercount', $data['partnercount'])
            ->with('cat1count', $data['cat1count'])
            ->with('cat2count', $data['cat2count'])
            ->with('cat3count', $data['cat3count'])
            ->with('cat4count', $data['cat4count']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('main-layout.layout', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
