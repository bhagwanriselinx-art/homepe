@extends('admin.master_layout')
@section('title')
    <title>{{ __('admin.Edit Property Type') }}</title>
@endsection

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Edit Property Type') }}</h1>
        </div>

        @include('template-part.admin_lang_switcer')

        <div class="section-body">
            <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> {{ __('admin.Property Type') }}
            </a>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('admin.category.update', $category->id) }}" 
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="lang_code" value="{{ admin_lang() }}">

                                <div class="row">

                                    {{-- EXISTING ICON --}}
                                   

                                    {{-- CATEGORY TYPE --}}
                                    <div class="form-group col-12">
                                        <label>Property Category Type 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="category_type" 
                                                class="form-control" 
                                                required>
                                            <option value="residential" 
                                                {{ $category->category_type == 'residential' ? 'selected' : '' }}>
                                                Residential
                                            </option>
                                            <option value="commercial" 
                                                {{ $category->category_type == 'commercial' ? 'selected' : '' }}>
                                                Commercial
                                            </option>
                                        </select>
                                    </div>

                                    {{-- NAME --}}
                                    <div class="form-group col-12">
                                        <label>{{ __('admin.Name') }} 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               id="name" 
                                               class="form-control" 
                                               name="name"
                                               value="{{ $category->name }}" 
                                               required>
                                    </div>

                                    {{-- SLUG --}}
                                    @if (admin_lang() === 'en')
                                    <div class="form-group col-12">
                                        <label>{{ __('admin.Slug') }} 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               id="slug" 
                                               class="form-control" 
                                               name="slug"
                                               value="{{ $category->slug }}" 
                                               required>
                                    </div>
                                    @endif

                                    {{-- STATUS --}}
                                    @if (admin_lang() === 'en')
                                    <div class="form-group col-12">
                                        <label>{{ __('admin.Status') }} 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" class="form-control">
                                            <option value="1" 
                                                {{ $category->status == 1 ? 'selected' : '' }}>
                                                {{ __('admin.Active') }}
                                            </option>
                                            <option value="0" 
                                                {{ $category->status == 0 ? 'selected' : '' }}>
                                                {{ __('admin.InActive') }}
                                            </option>
                                        </select>
                                    </div>
                                    @endif

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary">
                                            {{ __('admin.Update') }}
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

{{-- SLUG AUTO GENERATE --}}
<script>
(function($) {
    "use strict";
    $(document).ready(function() {
        $("#name").on("focusout", function() {
            $("#slug").val(convertToSlug($(this).val()));
        });
    });
})(jQuery);

function convertToSlug(Text) {
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g, '')
        .replace(/ +/g, '-');
}
</script>

@endsection