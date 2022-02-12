@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.product_services.index_title')
                </h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="icon ion-md-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\ProductService::class)
                        <a
                            href="{{ route('product-services.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.code')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.brand')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.condition')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.attribute')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.problem')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.specification')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.image')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.status')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.product_category_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.product_services.inputs.user_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productServices as $productService)
                        <tr>
                            <td>{{ $productService->code ?? '-' }}</td>
                            <td>{{ $productService->name ?? '-' }}</td>
                            <td>{{ $productService->brand ?? '-' }}</td>
                            <td>{{ $productService->condition ?? '-' }}</td>
                            <td>{{ $productService->attribute ?? '-' }}</td>
                            <td>{{ $productService->problem ?? '-' }}</td>
                            <td>{{ $productService->specification ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $productService->image ? \Storage::url($productService->image) : '' }}"
                                />
                            </td>
                            <td>{{ $productService->status ?? '-' }}</td>
                            <td>
                                {{
                                optional($productService->productCategory)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($productService->user)->name ?? '-'
                                }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $productService)
                                    <a
                                        href="{{ route('product-services.edit', $productService) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $productService)
                                    <a
                                        href="{{ route('product-services.show', $productService) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $productService)
                                    <form
                                        action="{{ route('product-services.destroy', $productService) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12">
                                {!! $productServices->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
