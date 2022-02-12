@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('products.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.products.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.code')</h5>
                    <span>{{ $product->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.name')</h5>
                    <span>{{ $product->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.brand')</h5>
                    <span>{{ $product->brand ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.condition')</h5>
                    <span>{{ $product->condition ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.attribute')</h5>
                    <span>{{ $product->attribute ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.problem')</h5>
                    <span>{{ $product->problem ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.specification')</h5>
                    <span>{{ $product->specification ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $product->image ? \Storage::url($product->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.status')</h5>
                    <span>{{ $product->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.product_category_id')</h5>
                    <span
                        >{{ optional($product->productCategory)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.user_id')</h5>
                    <span>{{ optional($product->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Product::class)
                <a href="{{ route('products.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
