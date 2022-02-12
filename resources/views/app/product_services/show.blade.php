@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('product-services.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.product_services.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.code')</h5>
                    <span>{{ $productService->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.name')</h5>
                    <span>{{ $productService->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.brand')</h5>
                    <span>{{ $productService->brand ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.condition')</h5>
                    <span>{{ $productService->condition ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.attribute')</h5>
                    <span>{{ $productService->attribute ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.problem')</h5>
                    <span>{{ $productService->problem ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.specification')</h5>
                    <span>{{ $productService->specification ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $productService->image ? \Storage::url($productService->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.status')</h5>
                    <span>{{ $productService->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.product_services.inputs.product_category_id')
                    </h5>
                    <span
                        >{{ optional($productService->productCategory)->name ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.product_services.inputs.user_id')</h5>
                    <span
                        >{{ optional($productService->user)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('product-services.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ProductService::class)
                <a
                    href="{{ route('product-services.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
