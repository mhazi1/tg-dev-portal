<?php

namespace App\Http\Controllers;


use App\Models\Certificate;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // try {
        //     $certs = Certificate::latest()->paginate(8);
        //     return view('cert.index', ['certs' => $certs]);
        // } catch (QueryException $qe) {
        //     return redirect()->route('dashboard')->withErrors('Database error occurred. Please try again later.');
        // } catch (\Exception $e) {
        //     return redirect()->route('dashboard')->withErrors('Unable to retrieve certificates at this time. Please try again later.');
        // }
        $certs = Certificate::latest()->paginate(10);
        return view('cert.index', ['certs' => $certs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cert.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'common_name' => ['required', 'string'],
            'country' => ['required', 'max:3', 'string'],
            'organization' => ['required', 'string'],
            'expiry_date' => ['required', 'date'],
        ]);

        if ($request->has('expiry_date')) {
            $expiryDate = Carbon::parse($request->expiry_date);
            $currentDate = Carbon::now();
            $attributes['status'] = $expiryDate->greaterThan($currentDate) ? 'active' : 'revoked';
        }

        Certificate::create($attributes);

        return redirect('/certificates', 201)->with('success', 'Certificate has been successfully added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cert = Certificate::where('id', $id)->firstOrFail();
        return view('cert.update', ['cert' => $cert]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //

        $attributes = $request->validate([
            'id' => ['required'],
            'common_name' => ['sometimes', 'string'],
            'country' => ['sometimes', 'string', 'max:3'],
            'organization' => ['sometimes', 'string'],
            'expiry_date' => ['sometimes', 'date'],
        ]);

        $expiryDate = Carbon::parse($request->expiry_date);
        $currentDate = Carbon::now();

        if ($request->has('expiry_date')) {
            $expiryDate = Carbon::parse($request->expiry_date);
            $currentDate = Carbon::now();
            $attributes['status'] = $expiryDate->greaterThan($currentDate) ? 'active' : 'revoked';
        }

        $attributes['verified'] = true;

        Certificate::where('id', $attributes['id'])->update($attributes);

        return redirect()->route('certificates')->with('info', 'Certificate has been successfully verified!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $request->validate([
            'id' => ['required']
        ]);

        $cert = Certificate::where('id', $request->id)->firstOrFail();

        $cert->delete();

        return redirect()->route('certificates')->with('info', 'Certificate has been successfully deleted!');
    }
}
