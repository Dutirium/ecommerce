<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountCodeRequest;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminDiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discountCodes = DiscountCode::latest()->get();

        return view(
            'admin.discountCodes.index',
            compact('discountCodes')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discountCodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountCodeRequest $request)
    {
        DiscountCode::create($request->validated());

        return redirect()
            ->route('admin.discountCodes.index')
            ->with(
                'success',
                'Discount code created successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountCode $discountCode)
    {
        return view(
            'admin.discountCodes.index',
            compact('discountCode')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountCode $discountCode)
    {
        return view(
            'admin.discountCodes.edit',
            compact('discountCode')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        DiscountCode $discountCode
    ) {
        $validated = $request->validate([

            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('discount_codes')
                    ->ignore($discountCode->id),
            ],

            'type' => [
                'required',
                'in:percentage,fixed',
            ],

            'value' => [
                'required',
                'numeric',
                'min:0',
            ],

            'minimum_order' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'usage_limit' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'used_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'expires_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        $discountCode->update($validated);

        return redirect()
            ->route('admin.discountCodes.index')
            ->with(
                'success',
                'Discount code updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountCode $discountCode)
    {
        $discountCode->delete();

        return redirect()
            ->route('admin.discountCodes.index')
            ->with(
                'success',
                'Discount code deleted successfully.'
            );
    }
}