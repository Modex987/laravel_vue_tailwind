<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Events\NewCustomerCreated;
use Intervention\Image\Facades\Image;

class CustomersController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except('index');
    }

    public function index()
    {
        // $customers = Customer::all();
        # Less Amount Of Queries
        // $customers = Customer::with('company')->get();
        # pagination
        $customers = Customer::with('company')->paginate(7);
        // dd($customers->toArray());

        /*
        $ActiveCustomers = Customer::active()->get();
        $InactiveCustomers = Customer::inactive()->get();

        return view('customers.index', compact('InactiveCustomers', 'ActiveCustomers'));
        */

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $companies = Company::all();

        $customer = new Customer;

        // return view('customers', ['customers' => $customers]);

        return view('customers.create', compact('companies', 'customer'));
    }

    public function store(Request $request)
    {

        $this->authorize('create', Customer::class);

        // mass assignement
        $customer = Customer::create($this->validateRequest($request));

        $this->storeImg($customer, $request);

        /*
        $customer = new Customer;
        $customer->name = request('name');
        $customer->email = request('email');
        $customer->status = request('status');
        $customer->save();
        */

        event(new NewCustomerCreated($customer));

        return back();
    }

    // public function show($id)
    public function show(Customer $customer)
    {
        // $customer = Customer::find($id);

        // $customer = Customer::where('id', $id)->firstOrFail(); # 404 error 'Not Found'

        return view('customers.show', compact('customer'));
    }



    public function edit(Customer $customer)
    {
        $companies = Company::all();

        return view('customers.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer, Request $request)
    {
        $customer->update($this->validateRequest($request));
        $this->storeImg($customer, $request);

        return redirect('/customers/' . $customer->id);
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect('/customers')->with('status', 'Customer Deleted With Success');
    }

    private function validateRequest(Request $request)
    {
        /*
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'status' => 'required|digits_between:0,2',
            'company_id' => 'required',
            'profile_img' => 'sometimes|file|image|max:5000'
        ]);
        */

        return tap($request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'status' => 'required|digits_between:0,2',
            'company_id' => 'required'
        ]), function () {

            if (request()->hasFile('profile_img')) {
                request()->validate([
                    'profile_img' => 'file|image|max:5000'
                ]);
            }
        });
    }


    private function storeImg(Customer $customer, Request $request)
    {
        if ($request->has('profile_img') && $request->file('profile_img')->isValid()) {

            /*
            if ($customer->update([
                'profile_img' => $request->profile_img->store('uploads', 'public'),
            ])) {
                dd('saved');
            } else {
                dd('not saved');
            }
            */

            $customer->profile_img = $request->profile_img->store('uploads', 'public');
            $customer->save();

            $img = Image::make(public_path('storage/' . $customer->profile_img))->fit(300, 300);
            $img->save();
        }
    }
}