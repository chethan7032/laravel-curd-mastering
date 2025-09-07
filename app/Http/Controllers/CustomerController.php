<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use File;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
   

        $customers = Customer::when(
            $request->has('search'),
            function ($query) use ($request) {
                $query->where('first_name', 'LIKE', "%$request->search")
                    ->orWhere('last_name', 'LIKE', "%$request->search")
                    ->orWhere('email', 'LIKE', "%$request->search")
                    ->orWhere('phone', 'LIKE', "%$request->search");
            }
        )->orderBy('id', $request->has('order')  && $request->order == 'asc' ? 'ASC' : 'DESC')->get();


        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $data = new Customer();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->store('', 'public');
            $filepath = '/uploads/' . $filename;
            $data->image = $filepath;
        }
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->bank_account_number = $request->account_number;
        $data->about = $request->about;
        $data->save();
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.detail', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerStoreRequest $request, string $id)
    {
        $data = Customer::findOrFail($id);
        // delete the previous image
        File::delete(public_path($data->image));

        //Handle file
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->store('', 'public');
            $filepath = '/uploads/' . $filename;
            $data->image = $filepath;
        }
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->bank_account_number = $request->account_number;
        $data->about = $request->about;
        $data->save();
        return redirect()->route('customer.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        // delete the previous image
        File::delete(public_path($customer->image));
        $customer->delete();
        return redirect()->route('customer.index');
    }

      public function trash(Request $request)
      {
         $customers = Customer::when(
            $request->has('search'),
            function ($query) use ($request) {
                $query->where('first_name', 'LIKE', "%$request->search")
                    ->orWhere('last_name', 'LIKE', "%$request->search")
                    ->orWhere('email', 'LIKE', "%$request->search")
                    ->orWhere('phone', 'LIKE', "%$request->search");
            }
        )->orderBy('id', $request->has('order')  && $request->order == 'asc' ? 'ASC' : 'DESC')->get();

        return view('customers.trash' , compact('customers'));
      }

}
