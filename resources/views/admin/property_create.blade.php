@extends('admin.master_layout')

@section('title')
    <title>{{ isset($property) ? __('admin.Edit property') : __('admin.Create property') }}</title>
@endsection

@section('admin-content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>


.area-title{
display:flex;
align-items:center;
gap:8px;
}

.area-help{
position:relative;
cursor:pointer;
}

.area-help i{
color:#4a90e2;
font-size:16px;
}

.area-tooltip{
position:absolute;
top:25px;
left:0;
width:300px;
background:#fff;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.15);
padding:15px;
display:none;
z-index:1000;
}

.area-help:hover .area-tooltip{
display:block;
}

.area-tip-item{
margin-bottom:10px;
font-size:13px;
}
.furnishing-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:15px;
margin-top:15px;
}

.furnishing-item{
display:flex;
align-items:center;
gap:10px;
}

.furnishing-item button{
width:28px;
height:28px;
border-radius:50%;
border:1px solid #ddd;
background:#fff;
cursor:pointer;
font-size:16px;
}

.furnishing-item .count{
width:20px;
text-align:center;
}

.furnishing-item .label{
margin-left:8px;
font-size:14px;
}

.checkbox-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:12px;
margin-top:15px;
}
.config-wrapper{
max-width:420px;
font-family:Arial;
}

.section-head{
font-size:16px;
font-weight:600;
margin-bottom:10px;
}

.optional{
font-size:12px;
color:#777;
}

.area-box{
display:flex;
border:1px solid #ddd;
border-radius:6px;
overflow:hidden;
margin-bottom:12px;
}

.area-input{
flex:1;
border:none;
padding:10px;
}

.area-unit{
width:90px;
border:none;
border-left:1px solid #ddd;
padding:10px;
}

.dimension-box{
border:1px solid #ddd;
border-radius:6px;
margin-bottom:10px;
}

.dimension-box input{
border:none;
padding:10px;
width:100%;
}

.pill-group{
display:flex;
gap:8px;
flex-wrap:wrap;
margin-top:8px;
}

.pill{
border:1px solid #ddd;
border-radius:20px;
padding:6px 14px;
cursor:pointer;
font-size:13px;
}

.pill input{
margin-right:4px;
}


.config-wrapper{
max-width:420px;
font-family:Arial;
}

.config-title{
font-weight:600;
font-size:16px;
}

.config-sub{
font-size:12px;
color:#777;
margin-bottom:10px;
}

.area-box{
display:flex;
border:1px solid #ddd;
border-radius:6px;
margin-bottom:10px;
overflow:hidden;
}

.area-input{
flex:1;
border:none;
padding:10px;
}

.area-unit{
width:90px;
border:none;
border-left:1px solid #ddd;
padding:10px;
}

.section-head{
font-weight:600;
margin-top:18px;
}

.optional{
font-size:12px;
color:#888;
}

.small{
font-size:12px;
color:#777;
margin-bottom:8px;
}

.pill-group{
display:flex;
flex-wrap:wrap;
gap:8px;
margin-top:8px;
}

.pill{
border:1px solid #ddd;
border-radius:20px;
padding:6px 12px;
font-size:13px;
cursor:pointer;
}

.pill input{
margin-right:4px;
}
.area-section{
font-family: Arial;
max-width:420px;
}

.area-title{
font-weight:600;
font-size:16px;
}

.area-sub{
font-size:12px;
color:#777;
margin-bottom:10px;
}

.area-row{
display:flex;
border:1px solid #ddd;
border-radius:6px;
margin-bottom:10px;
overflow:hidden;
}

.area-input{
flex:1;
border:none;
padding:10px;
}

.area-unit{
width:90px;
border:none;
border-left:1px solid #ddd;
padding:10px;
background:#fff;
}

.room-section{
margin-top:20px;
}

.room-title{
font-weight:600;
margin-bottom:6px;
}

.room-sub{
font-size:13px;
margin-bottom:8px;
}

.pill-group{
display:flex;
gap:8px;
flex-wrap:wrap;
}

.pill{
border:1px solid #ddd;
border-radius:20px;
padding:6px 14px;
cursor:pointer;
font-size:13px;
}

.pill input{
margin-right:4px;
}

.room-actions{
display:flex;
align-items:center;
margin-top:12px;
}

.divider{
flex:1;
height:1px;
background:#ddd;
margin-right:10px;
}

.done-btn{
background:#1976d2;
border:none;
color:white;
padding:8px 18px;
border-radius:4px;
font-weight:500;
}
.property-config{
font-family: Arial;
}

.section-head{
font-size:18px;
font-weight:600;
margin-bottom:15px;
}

.config-block{
margin-bottom:25px;
}

.label-head{
font-weight:600;
}

.small-text{
font-size:12px;
color:#777;
margin-bottom:8px;
}

.area-box{
display:flex;
border:1px solid #ddd;
margin-top:8px;
border-radius:6px;
overflow:hidden;
}

.area-input{
flex:1;
border:none;
padding:10px;
}

.area-unit{
width:100px;
border:none;
border-left:1px solid #ddd;
padding:10px;
}

.config-title{
font-weight:600;
margin-bottom:8px;
display:block;
}

.pill-group{
display:flex;
gap:10px;
}

.pill{
border:1px solid #ddd;
padding:6px 12px;
border-radius:20px;
cursor:pointer;
}

.pill input{
margin-right:4px;
}

.facility-row{
display:flex;
gap:20px;
align-items:center;
}

.floor-row{
display:flex;
gap:10px;
margin-top:8px;
}

.floor-input{
flex:1;
padding:8px;
border:1px solid #ddd;
border-radius:6px;
}

.floor-select{
flex:1;
padding:8px;
border:1px solid #ddd;
border-radius:6px;
}
/* (same CSS as you had) */
.config-box{
background:#fff;
padding:20px;
border-radius:8px;
border:1px solid #eee;
}

.config-title{
font-size:16px;
font-weight:600;
}

.config-sub{
font-size:13px;
color:#777;
margin-bottom:10px;
}

.area-row{
display:flex;
gap:10px;
margin-bottom:10px;
}

.area-type{
flex:2;
}

.area-input{
flex:1;
}

.area-unit{
flex:1;
}

.add-area-link{
color:#007bff;
font-weight:500;
cursor:pointer;
}

.section-title{
margin-top:25px;
font-weight:600;
}

.form-row{
display:flex;
flex-wrap:wrap;
gap:15px;
}

.form-col{
width:48%;
}

.pill-group{
display:flex;
gap:10px;
margin-top:10px;
}

.pill{
border:1px solid #ddd;
padding:6px 14px;
border-radius:20px;
cursor:pointer;
}

.pill input{
margin-right:5px;
}
.property-wrapper{ display:flex; gap:25px; align-items:flex-start; margin-top:10px; }
.property-steps{ width:300px; background:#fff; border-radius:10px; padding:18px; box-shadow:0 6px 18px rgba(0,0,0,0.06); position:sticky; top:20px; height:fit-content; }
.property-steps ul{ list-style:none; padding:0; margin:0; }
.property-steps li{ padding:12px 14px; margin-bottom:10px; border-radius:8px; cursor:pointer; font-weight:600; transition:0.15s; background:#f8f9fa; border-left:4px solid transparent; color:#333; font-size:14px; }
.property-steps li small{ display:block; font-weight:500; font-size:12px; color:#6b7280; margin-top:4px; }
.property-steps li:hover{ background:#eef3ff; }
.property-steps li.active{ background:#eaf1ff; border-left:4px solid #0d6efd; color:#0d6efd; }
.step-section{ display:none; }
.step-section.active{ display:block; }
.card{ border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.04); border:none; }
.card-body{ padding:22px; }
.form-group label{ font-weight:600; }
.step-nav{ margin-top:18px; display:flex; justify-content:space-between; gap:12px; align-items:center; }
.step-btn{ min-width:130px; }
.plus_btn{ margin-top:30px; }
.save_btn{ min-width:160px; font-size:15px; }
#results-list{ position: absolute; z-index:1200; background:#fff; border:1px solid #e5e7eb; max-height:220px; overflow:auto; width:100%; display:none; padding:0; margin-top:6px; border-radius:6px; }
#results-list li{ list-style:none; padding:8px 12px; cursor:pointer; border-bottom:1px solid #f3f4f6; font-size:13px; }
#results-list li:hover{ background:#f3f4f6; }
.form-control-file{ padding:6px; background:#fff; }
@media(max-width:992px){ .property-wrapper{ flex-direction:column; } .property-steps{ width:100%; position:relative; top:auto; } }
.thumbnail-preview{ display:inline-block; margin-right:8px; margin-bottom:8px; position:relative; }
.thumbnail-preview img{ border-radius:6px; border:1px solid #e5e7eb; display:block; }
.thumbnail-preview .remove-existing{ position:absolute; top:4px; right:4px; background:rgba(0,0,0,0.6); color:#fff; border:none; padding:2px 6px; border-radius:4px; cursor:pointer; }
</style>
@php
$config = $property->configuration_json ?? [];
@endphp
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($property) ? __('admin.Edit property') : __('admin.Create property') }}</h1>
        </div>

        <div class="section-body property_box">

            <!-- Hidden templates -->
            <div id="hidden-location-box" class="d-none">
                <div class="delete-dynamic-location">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('admin.Nearest Location') }}</label>
                                <select name="nearest_locations[]" class="form-control">
                                    <option value="">{{ __('admin.Select') }}</option>
                                    @foreach ($nearest_locations as $nearest_location)
                                        <option value="{{ $nearest_location->id }}">{{ $nearest_location->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('admin.Distance(km)') }}</label>
                                <input type="text" class="form-control" name="distances[]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger nearest-row-btn removeNearestPlaceRow plus_btn">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="hidden-addition-box" class="d-none">
                <div class="delete-dynamic-additio">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('admin.Key') }}</label>
                                <input type="text" class="form-control" name="add_keys[]">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('admin.Value') }}</label>
                                <input type="text" class="form-control" name="add_values[]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger nearest-row-btn removeAdditioanRow plus_btn">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="hidden-plan-box" class="d-none">
                <div class="delete-dynamic-plan">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('admin.Image') }}</label>
                                <input type="file" class="form-control-file" name="plan_images[]">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger nearest-row-btn removePlanRow plus_btn">
                                <i class="fas fa-trash" aria-hidden="true"></i> {{ __('admin.Remove Plan') }}
                            </button>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('admin.Title') }}</label>
                                <input type="text" class="form-control" name="plan_titles[]">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('admin.Description') }}</label>
                                <textarea name="plan_descriptions[]" class="form-control text-area-5" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stepper + Form -->
            <div class="property-wrapper">

                <!-- LEFT: steps -->
               <div class="property-steps">
    <ul>
        <li class="active" data-step="1">
            Basic Details
            <br><small class="text-muted">Independent House / Villa ...</small>
        </li>

        <li data-step="2">
            Location Details
            <br><small class="text-muted">Step 2</small>
        </li>

        {{-- 🔥 NEW STEP ADDED --}}
        <li data-step="3">
            Property Configuration
            <br><small class="text-muted">Floor, Ownership, Staircase</small>
        </li>

        {{-- SHIFTED STEPS --}}
        <li data-step="4">
            Image & Video
            <br><small class="text-muted">Upload media</small>
        </li>

        <li data-step="5">
           Other & Pricing
            <br><small class="text-muted">Step 5</small>
        </li>

        <li data-step="6">
            Profile & Amenities
            <br><small class="text-muted">Step 6</small>
        </li>
          <li data-step="7">
           SEO
            <br><small class="text-muted">Step 7</small>
        </li>
    </ul>
</div>
                <!-- RIGHT: form (single form) -->
                <div style="flex:1;">
                    <a href="{{ route('admin.property.index') }}" class="btn btn-primary mb-3"><i class="fas fa-list"></i> {{ __('admin.Own Properties') }}</a>

                    <form id="property_form" action="{{ route('admin.property.finalize') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="property_id" id="property_id" value="{{ $property->id ?? '' }}">

                        <!-- STEP 1: Basic Information -->
                        <div class="step-section active" id="step-1">
                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.Basic Information') }}</h4>
                                    <hr>

                                   <div class="form-group d-none">
    <label>{{ __('admin.Property Owner') }}</label>

    <select name="owner_id" id="owner_id" class="form-control select2">
        <option value="0">Own Property</option>
        @foreach ($agents as $agent)
            <option value="{{ $agent->id }}"
                {{ (string) old('owner_id', $property->agent_id ?? '0') === (string) $agent->id ? 'selected' : '' }}>
                {{ $agent->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- 🔥 IMPORTANT: HIDDEN FIELD -->
<input type="hidden" name="owner_id" value="{{ old('owner_id', $property->agent_id ?? 0) }}">

                                    <div class="form-group">
                                        <label>{{ __('admin.Title') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $property->title ?? '') }}">
                                    </div>

                                    <div class="form-group">
<label class="small fw-semibold">
    {{ __('Property Link') }} <span class="text-danger">*</span> 
    <span class="text-muted">(Auto generated)</span>
</label>                                        <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug', $property->slug ?? '') }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Purpose <span class="text-danger">*</span></label>
                                                <select name="purpose" id="purpose" class="form-control">
                                                    <option value="sale" {{ old('purpose', $property->purpose ?? '')=='sale'?'selected':'' }}>For Sale</option>
                                                    <option value="rent" {{ old('purpose', $property->purpose ?? '')=='rent'?'selected':'' }}>For Rent</option>
                                                    <option value="pg" {{ old('purpose', $property->purpose ?? '')=='pg'?'selected':'' }}>PG</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Category <span class="text-danger">*</span></label>
                                                <select name="category_type" id="category_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="residential" {{ old('category_type', $property->category_type ?? '')=='residential'?'selected':'' }}>Residential</option>
                                                    <option value="commercial" {{ old('category_type', $property->category_type ?? '')=='commercial'?'selected':'' }}>Commercial</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Property Type <span class="text-danger">*</span></label>
                                                <select name="property_type_id" id="property_type_id" class="form-control">
                                                    <option value="">{{ __('admin.Select') }}</option>
                                                    {{-- property types loaded via ajax; selection set in JS --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 d-none" id="sub_type_box">
                                            <div class="form-group">
                                                <label>Sub Property Type</label>
                                                <select name="sub_property_type_id" id="sub_property_type_id" class="form-control">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 d-none" id="child_sub_type_box">
                                            <div class="form-group">
                                                <label>Child Sub Property Type</label>
                                                <select name="child_sub_property_type_id" id="child_sub_property_type_id" class="form-control">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>

                                       
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('admin.Description') }} <span class="text-danger">*</span></label>
                                                <textarea name="description" id="description" cols="30" rows="6" class="form-control">{{ old('description', $property->description ?? '') }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="step-nav">
                                <div></div>
                                <div>
                                    <button type="button" class="btn btn-primary step-next" data-next="2">Next: Location</button>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2: Location -->
<div class="step-section" id="step-2">
    <div class="card">
        <div class="card-body">
            <h4>{{ __('admin.Location') }}</h4>

 <div class="row">

    <!-- COUNTRY -->
    <div class="col-md-4">
        <div class="form-group">
            <label>Country</label>
            <select name="country_id" id="country_id" class="form-control select2">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ old('country_id', $property->country_id ?? '') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- STATE -->
    <div class="col-md-4">
        <div class="form-group">
            <label>State</label>
            <select name="state_id" id="state_id" class="form-control select2">
                <option value="">Select State</option>
            </select>
        </div>
    </div>

    <!-- CITY -->
    <div class="col-md-4">
        <div class="form-group">
            <label>City</label>
            <select name="city_id" id="city_id" class="form-control select2">
                <option value="">Select City</option>
            </select>
        </div>
    </div>



                {{-- ADDRESS SEARCH --}}
                <div class="col-12 position-relative">
                    <div class="form-group">
                        <label>{{ __('Address Search') }} <span class="text-danger">*</span></label>
                        <input type="text"
                               name="address"
                               id="address"
                               class="form-control"
                               required
                               autocomplete="off"
                               value="{{ old('address', $property->address ?? '') }}">
                        <ul id="results-list" class="autocomplete-results"></ul>
                    </div>
                </div>
<div class="col-md-6">
        <div class="form-group">
            <label>Building Name</label>
            <input type="text"
                   name="building_name"
                   class="form-control"
                   value="{{ old('building_name', $property->building_name ?? '') }}">
        </div>
    </div>
                {{-- LOCALITY --}}
               <div class="col-md-6 position-relative">
    <div class="form-group">
        <label>Locality</label>
        <input type="text"
               name="locality"
               id="locality"
               class="form-control"
               autocomplete="off"
               value="{{ old('locality', $property->locality ?? '') }}">
        <ul id="locality-results" class="autocomplete-results"></ul>
    </div>
</div>

<div class="col-md-6 position-relative">
    <div class="form-group">
        <label>Sub Locality</label>
        <input type="text"
               name="sub_locality"
               id="sub_locality"
               class="form-control"
               autocomplete="off"
               value="{{ old('sub_locality', $property->sub_locality ?? '') }}">
        <ul id="sublocality-results" class="autocomplete-results"></ul>
    </div>
</div>

                {{-- FULL ADDRESS --}}
                <div class="col-12">
                    <div class="form-group">
                        <label>Full Address</label>
                        <textarea name="full_address"
                                  id="full_address"
                                  class="form-control"
                                  rows="2">{{ old('full_address', $property->full_address ?? '') }}</textarea>
                    </div>
                </div>

                {{-- MAP --}}
                @if($setting->live_map == 'yes')
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('admin.Map') }} <span class="text-danger">*</span></label>
<div id="map" style="height:400px; width:100%; border-radius:8px;"></div>
                            <input type="hidden" id="lat" name="lat"
                                   value="{{ old('lat', $property->lat ?? '') }}">

                            <input type="hidden" id="lng" name="lng"
                                   value="{{ old('lng', $property->lon ?? '') }}">
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('admin.Google Map') }}</label>
                            <textarea name="google_map"
                                      class="form-control text-area-5"
                                      rows="3">{{ old('google_map', $property->google_map ?? '') }}</textarea>
                        </div>
                    </div>
                @endif

                {{-- ADDRESS DESCRIPTION --}}
                <div class="col-12">
                    <div class="form-group">
                        <label>{{ __('admin.Address Details') }} <span class="text-danger">*</span></label>
                        <textarea name="address_description"
                                  class="form-control text-area-5"
                                  rows="3">{{ old('address_description', $property->address_description ?? '') }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- STEP NAV --}}
    <div class="step-nav mt-3">
        <div>
            <button type="button"
                    class="btn btn-secondary step-prev"
                    data-prev="1">
                Previous
            </button>
        </div>

        <div>
            <button type="button"
                    class="btn btn-primary step-next"
                    data-next="3">
                Next: Configuration
            </button>
        </div>
    </div>
</div>
<!-- STEP 3: Property Configuration -->
<div class="step-section" id="step-3">
    <div class="card">
        <div class="card-body">
            <h4>Property Configuration</h4>
            <hr>

            <div class="row">

               
<div id="dynamic_config_fields"></div>

<input type="hidden" name="configuration_json" id="configuration_json" value="{{ json_encode($config) }}">            </div>
        </div>
    </div>

    <div class="step-nav">
        <div>
            <button type="button" class="btn btn-secondary step-prev" data-prev="2">Previous</button>
        </div>
        <div>
            <button type="button" class="btn btn-primary step-next" data-next="4">Next: Media</button>
        </div>
    </div>
</div>
                        <!-- STEP 3: Image & Video -->
                        <div class="step-section" id="step-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4>{{ __('admin.Image and Video') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('admin.Thumbnail Image') }} <span class="text-danger">*</span></label>
                                                @if(isset($property) && $property->thumbnail_image)
                                                    <div class="thumbnail-preview">
                                                        <img src="{{ asset($property->thumbnail_image) }}" width="140" alt="thumb">
                                                        <label class="d-block mt-2"><input type="checkbox" name="remove_thumbnail" value="1"> Remove thumbnail</label>
                                                    </div>
                                                @endif
                                                <input type="file" name="thumbnail_image" class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('admin.Slider Image') }} ({{ __('admin.Multiple') }})</label>

                                                {{-- existing sliders preview --}}
                                                <div id="existing-sliders" class="mb-2">
                                                    @if(!empty($existing_sliders) && $existing_sliders->count())
                                                        @foreach($existing_sliders as $slider)
                                                            <div class="thumbnail-preview" data-id="{{ $slider->id }}">
                                                                <img src="{{ asset($slider->image) }}" width="120" alt="slider">
                                                                <div>
                                                                    <label><input type="checkbox" name="remove_slider_ids[]" value="{{ $slider->id }}"> Remove</label>
                                                                    <input type="hidden" name="existing_slider_ids[]" value="{{ $slider->id }}">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <input type="file" name="slider_images[]" multiple class="form-control-file">
                                            </div>
                                        </div>

<!-- VIDEO THUMBNAIL (IMAGE) -->
<div class="col-12">
    <div class="form-group">
        <label>Video Thumbnail Image</label>

        @if(isset($property) && $property->video_thumbnail)
            <div class="thumbnail-preview">
                <img src="{{ asset($property->video_thumbnail) }}" width="120">
                <label class="d-block mt-2">
                    <input type="checkbox" name="remove_video_thumbnail" value="1">
                    Remove Thumbnail
                </label>
            </div>
        @endif

        <input type="file" name="video_thumbnail" accept="image/*" class="form-control-file">
    </div>
</div>


<!-- VIDEO FILE (MP4) -->
<div class="col-12">
    <div class="form-group">

        <label>Upload Video (MP4)</label>

        @if(isset($property) && $property->video_path)
            <div class="mb-2">

                <video width="250" controls>
                    <source src="{{ asset($property->video_path) }}" type="video/mp4">
                </video>

                <label class="d-block mt-2">
                    <input type="checkbox" name="remove_video" value="1">
                    Remove Video
                </label>

            </div>
        @endif

        <input type="file" name="video_file" accept="video/mp4" class="form-control-file">

    </div>
</div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('admin.Youtube video id') }}</label>
                                                <input type="text" name="video_id" class="form-control" value="{{ old('video_id', $property->video_id ?? '') }}">
                                                @if(isset($property) && $property->video_id)
    <div class="mt-3">
        <iframe width="300" height="180"
            src="https://www.youtube.com/embed/{{ $property->video_id }}"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>
@endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('admin.Video description') }}</label>
                                                <textarea name="video_description" class="form-control text-area-3" rows="3">{{ old('video_description', $property->video_description ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-nav">
                                <div>
                                    <button type="button" class="btn btn-secondary step-prev" data-prev="3">Previous</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary step-next" data-next="5">Next: Profile</button>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 4: Amenities / Nearest -->
                        <div class="step-section" id="step-6">
                            <div class="card">
                                <div class="card-body">
                                    
                                     <h4>{{ __('admin.Aminities') }}</h4>
                                    <hr>
                                    <div class="row">
                                        
                                        <div class="col">
                                            <div class="form-group">
                                                <div>
                                                    @foreach ($aminities as $aminity)
                                                        <div class="form-check form-check-inline">
                                                            <input value="{{ $aminity->id }}" type="checkbox" name="aminities[]" id="aminity{{ $aminity->id }}" class="form-check-input"
                                                                {{ (collect(old('aminities', isset($property) ? $property->aminities->pluck('id')->toArray() : []))->contains($aminity->id)) ? 'checked' : '' }}>
                                                            <label class="form-check-label mx-1" for="aminity{{ $aminity->id }}">{{ $aminity->aminity }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ðŸ”¥ EXTRA FIRE & OFFICE DETAILS (ADDED ONLY) --}}
<div class="col-md-12 mt-4">
    <hr>
    <h5 class="fw-bold">Fire Safety & Office Details</h5>
</div>

{{-- Fire Safety --}}
<div class="col-md-12 mt-3">
    <label class="fw-bold">Fire safety measures include</label>
    <div class="d-flex flex-wrap gap-2 mt-2">

        @php
            $fireSafety = ['Fire Extinguisher','Fire Sensors','Sprinklers','Fire Hose'];
            $selectedFire = old('fire_safety',
                json_decode($property->fire_safety ?? '[]', true) ?? []);
        @endphp

        @foreach($fireSafety as $item)
            <label class="feature-pill">
                <input type="checkbox"
                       name="fire_safety[]"
                       value="{{ $item }}"
                       {{ in_array($item, $selectedFire) ? 'checked' : '' }}>
                <span>{{ $item }}</span>
            </label>
        @endforeach

    </div>
</div>

{{-- CCTV --}}
<div class="col-md-6 mt-3">
    <label class="fw-bold">CCTV Available?</label>
    <div class="mt-2">
        <label class="me-3">
            <input type="radio" name="cctv_available" value="1"
                {{ old('cctv_available',$property->cctv_available ?? '')==1?'checked':'' }}>
            Available
        </label>
        <label>
            <input type="radio" name="cctv_available" value="0"
                {{ old('cctv_available',$property->cctv_available ?? '')==0?'checked':'' }}>
            Not Available
        </label>
    </div>
</div>

{{-- Staircases --}}
<div class="col-md-6 mt-3">
    <label class="fw-bold">No. of Staircases</label>

    <input type="number"
           name="no_of_staircases"
           class="form-control mt-2"
           min="0"
           placeholder="Enter number of staircases"
           value="{{ old('no_of_staircases', $property->no_of_staircases ?? '') }}">
</div>

{{-- NOC Certified --}}
<div class="col-md-6 mt-3">
    <label class="fw-bold">Is your office fire NOC certified?</label>
    <select name="noc_certified" class="form-control mt-2">
        <option value="">Select</option>
        <option value="1" {{ old('noc_certified',$property->noc_certified ?? '')==1?'selected':'' }}>Yes</option>
        <option value="0" {{ old('noc_certified',$property->noc_certified ?? '')==0?'selected':'' }}>No</option>
    </select>
</div>

{{-- Occupancy Certificate --}}
<div class="col-md-6 mt-3">
    <label class="fw-bold">Occupancy Certificate</label>
    <select name="occupancy_certificate" class="form-control mt-2">
        <option value="">Select</option>
        <option value="1" {{ old('occupancy_certificate',$property->occupancy_certificate ?? '')==1?'selected':'' }}>Yes</option>
        <option value="0" {{ old('occupancy_certificate',$property->occupancy_certificate ?? '')==0?'selected':'' }}>No</option>
    </select>
</div>

{{-- Previously Used For --}}
<div class="col-md-6 mt-3">
    <label class="fw-bold">Your office was previously used for</label>
    <select name="previously_used_for" class="form-control mt-2">
        <option value="">Select</option>
        <option value="IT Office">IT Office</option>
        <option value="Call Center">Call Center</option>
        <option value="Corporate Office">Corporate Office</option>
        <option value="Other">Other</option>
    </select>
</div>
                                   
                                </div>
                            </div>

                            {{-- nearest locations: show existing rows if available --}}
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h4>{{ __('admin.Nearest Location') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12" id="nearest-place-box">
                                            @if(!empty($existing_nearest_locations) && $existing_nearest_locations->count())
                                                @foreach($existing_nearest_locations as $nr)
                                                    <div class="row nearest-existing-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>{{ __('admin.Nearest Location') }}</label>
                                                                <select name="nearest_locations[]" class="form-control">
                                                                    <option value="">{{ __('admin.Select') }}</option>
                                                                    @foreach ($nearest_locations as $nearest_location)
                                                                        <option value="{{ $nearest_location->id }}" {{ (string)$nearest_location->id === (string)$nr->nearest_location_id ? 'selected' : '' }}>
                                                                            {{ $nearest_location->location }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>{{ __('admin.Distance(km)') }}</label>
                                                                <input type="text" class="form-control" name="distances[]" value="{{ $nr->distance }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-danger nearest-row-btn removeNearestPlaceRow plus_btn">
                                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                            <input type="hidden" name="existing_nearest_ids[]" value="{{ $nr->id }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.Nearest Location') }}</label>
                                                            <select name="nearest_locations[]" class="form-control">
                                                                <option value="">{{ __('admin.Select') }}</option>
                                                                @foreach ($nearest_locations as $nearest_location)
                                                                    <option value="{{ $nearest_location->id }}">{{ $nearest_location->location }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.Distance(km)') }}</label>
                                                            <input type="text" class="form-control" name="distances[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button id="addNearestPlaceRow" type="button" class="btn btn-success nearest-row-btn plus_btn"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- if existing rows exist, also show "Add more" button at end --}}
                                            @if(!empty($existing_nearest_locations) && $existing_nearest_locations->count())
                                                <div class="row mt-2">
                                                    <div class="col-md-12 text-right">
                                                        <button id="addNearestPlaceRow" type="button" class="btn btn-success nearest-row-btn plus_btn"><i class="fas fa-plus"></i> {{ __('admin.Add More') }}</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-nav">
                                <div>
                                    <button type="button" class="btn btn-secondary step-prev" data-prev="4">Previous</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary step-next" data-next="6">Next: Additional</button>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 5: Additional Info, Plan, SEO & Other -->
                        <div class="step-section" id="step-5">
                            <div class="card">
                                <div class="card-body">
                                     <div class="row">
                                        
                                        
                    <div id="dynamicStep4Form"></div>

<input type="hidden" name="config_json" id="config_json"
value="{{ old('config_json', $property->config_json ?? '') }}">
                                    <h4>{{ __('admin.Additional Information') }}</h4>
                                    <hr>
                                   


                                        <div class="col-12" id="additional-box">
                                            @if(!empty($existing_add_informations) && $existing_add_informations->count())
                                                @foreach($existing_add_informations as $info)
                                                    <div class="row delete-dynamic-additio">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>{{ __('admin.Key') }}</label>
                                                                <input type="text" class="form-control" name="add_keys[]" value="{{ $info->add_key }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>{{ __('admin.Value') }}</label>
                                                                <input type="text" class="form-control" name="add_values[]" value="{{ $info->add_value }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-danger nearest-row-btn removeAdditioanRow plus_btn">
                                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                            <input type="hidden" name="existing_add_info_ids[]" value="{{ $info->id }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-2">
                                                    <div class="col-md-12 text-right">
                                                        <button id="addAdditionalRow" type="button" class="btn btn-success nearest-row-btn plus_btn"><i class="fas fa-plus" aria-hidden="true"></i> {{ __('admin.Add More') }}</button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.Key') }}</label>
                                                            <input type="text" class="form-control" name="add_keys[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.Value') }}</label>
                                                            <input type="text" class="form-control" name="add_values[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button id="addAdditionalRow" type="button" class="btn btn-success nearest-row-btn plus_btn"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            

                            <div class="card mt-3">
                                <div class="card-body">
                                    <h4>{{ __('admin.Property Plan') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12" id="plan-box">
                                            {{-- existing plans --}}
                                            @if(!empty($existing_plans) && $existing_plans->count())
                                                @foreach($existing_plans as $plan)
                                                    <div class="row delete-dynamic-plan mb-2">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                @if($plan->image)
                                                                    <div class="thumbnail-preview">
                                                                        <img src="{{ asset($plan->image) }}" width="140" alt="plan">
                                                                        <label class="d-block mt-2"><input type="checkbox" name="remove_plan_ids[]" value="{{ $plan->id }}"> Remove</label>
                                                                    </div>
                                                                @endif
                                                                <label>{{ __('admin.Image') }}</label>
                                                                <input type="file" class="form-control-file" name="plan_images[]">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>{{ __('admin.Title') }}</label>
                                                                <input type="text" class="form-control" name="plan_titles[]" value="{{ $plan->title }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>{{ __('admin.Description') }}</label>
                                                                <textarea name="plan_descriptions[]" class="form-control text-area-5" cols="30" rows="4">{{ $plan->description }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 d-flex align-items-start">
                                                            <button type="button" class="btn btn-danger nearest-row-btn removePlanRow plus_btn">
                                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                            <input type="hidden" name="existing_plan_ids[]" value="{{ $plan->id }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-2">
                                                    <div class="col-md-12 text-right">
                                                        <button id="addNewPlan" type="button" class="btn btn-success nearest-row-btn plus_btn"><i class="fas fa-plus"></i> {{ __('admin.Add New Plan') }}</button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.Image') }}</label>
                                                            <input type="file" class="form-control-file" name="plan_images[]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <button id="addNewPlan" type="button" class="btn btn-success nearest-row-btn plus_btn"><i class="fas fa-plus"></i> {{ __('admin.New Plan') }}</button>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.Title') }}</label>
                                                            <input type="text" class="form-control" name="plan_titles[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>{{ __('admin.Description') }}</label>
                                                            <textarea name="plan_descriptions[]" class="form-control text-area-5" cols="30" rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="card mt-3">-->
                            <!--    <div class="card-body">-->
                            <!--        <h4>{{ __('admin.SEO Information and Others') }}</h4>-->
                            <!--        <hr>-->
                            <!--        <div class="row">-->
                            <!--            <div class="col-12">-->
                            <!--                <div class="form-group">-->
                            <!--                    <div class="control-label">{{ __('admin.Status') }}</div>-->
                            <!--                    <label class=" mt-2">-->
                            <!--                      <input type="checkbox" name="status" value="enable" class="custom-switch-input" {{ old('status', $property->status ?? '')=='enable' ? 'checked' : '' }}>-->
                            <!--                      <span class="custom-switch-indicator"></span>-->
                            <!--                      <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>-->
                            <!--                    </label>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="col-12" id="featured_box">-->
                            <!--                <div class="form-group">-->
                            <!--                    <div class="control-label">{{ __('admin.Featured') }}</div>-->
                            <!--                    <label class=" mt-2">-->
                            <!--                      <input type="checkbox" name="is_featured" value="enable" class="custom-switch-input" {{ old('is_featured', $property->is_featured ?? '')=='enable' ? 'checked' : '' }}>-->
                            <!--                      <span class="custom-switch-indicator"></span>-->
                            <!--                      <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>-->
                            <!--                    </label>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="col-12" id="top_box">-->
                            <!--                <div class="form-group">-->
                            <!--                    <div class="control-label">{{ __('admin.Top Property') }}</div>-->
                            <!--                    <label class=" mt-2">-->
                            <!--                      <input type="checkbox" name="is_top" value="enable" class="custom-switch-input" {{ old('is_top', $property->is_top ?? '')=='enable' ? 'checked' : '' }}>-->
                            <!--                      <span class="custom-switch-indicator"></span>-->
                            <!--                      <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>-->
                            <!--                    </label>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="col-12" id="urgent_box">-->
                            <!--                <div class="form-group">-->
                            <!--                    <div class="control-label">{{ __('admin.Urgent Property') }}</div>-->
                            <!--                    <label class=" mt-2">-->
                            <!--                      <input type="checkbox" name="is_urgent" value="enable" class="custom-switch-input" {{ old('is_urgent', $property->is_urgent ?? '')=='enable' ? 'checked' : '' }}>-->
                            <!--                      <span class="custom-switch-indicator"></span>-->
                            <!--                      <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>-->
                            <!--                    </label>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="col-12">-->
                            <!--                <div class="form-group">-->
                            <!--                    <label>{{ __('admin.SEO Title') }}</label>-->
                            <!--                    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $property->seo_title ?? '') }}">-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--            <div class="col-12">-->
                            <!--                <div class="form-group">-->
                            <!--                    <label>{{ __('admin.SEO Meta Description') }}</label>-->
                            <!--                    <textarea name="seo_meta_description" class="form-control text-area-5" rows="4">{{ old('seo_meta_description', $property->seo_meta_description ?? '') }}</textarea>-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="step-nav mt-3">
                                <div>
                                    <button type="button" class="btn btn-secondary step-prev" data-prev="5">Previous</button>
                                </div>
                                <div>
<button type="button" class="btn btn-primary save_btn" id="finalSave">Save and Next</button>                                </div>
                            </div>

                        </div><!-- end step-5 -->

                 

                </div><!-- end right -->
                
                
<!-- ================= STEP 7 : SEO ================= -->
<div class="card mt-3 step-section" id="step-7">
    <div class="card-body">

       <div class="card mt-3">
                                <div class="card-body">
                                    <h4>{{ __('admin.SEO Information and Others') }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Status') }}</div>
                                                <label class=" mt-2">
                                                  <input type="checkbox" name="status" value="enable" class="custom-switch-input" {{ old('status', $property->status ?? '')=='enable' ? 'checked' : '' }}>
                                                  <span class="custom-switch-indicator"></span>
                                                  <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12" id="featured_box">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Featured') }}</div>
                                                <label class=" mt-2">
                                                  <input type="checkbox" name="is_featured" value="enable" class="custom-switch-input" {{ old('is_featured', $property->is_featured ?? '')=='enable' ? 'checked' : '' }}>
                                                  <span class="custom-switch-indicator"></span>
                                                  <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12" id="top_box">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Top Property') }}</div>
                                                <label class=" mt-2">
                                                  <input type="checkbox" name="is_top" value="enable" class="custom-switch-input" {{ old('is_top', $property->is_top ?? '')=='enable' ? 'checked' : '' }}>
                                                  <span class="custom-switch-indicator"></span>
                                                  <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12" id="urgent_box">
                                            <div class="form-group">
                                                <div class="control-label">{{ __('admin.Urgent Property') }}</div>
                                                <label class=" mt-2">
                                                  <input type="checkbox" name="is_urgent" value="enable" class="custom-switch-input" {{ old('is_urgent', $property->is_urgent ?? '')=='enable' ? 'checked' : '' }}>
                                                  <span class="custom-switch-indicator"></span>
                                                  <span class="custom-switch-description">{{ __('admin.Enable / Disable') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('admin.SEO Title') }}</label>
                            <input type="text" name="seo_title" maxlength="60"
                                class="form-control"
                                value="{{ old('seo_title', $property->seo_title ?? '') }}">
                        </div>
                    </div>

                    <!-- SEO DESCRIPTION -->
                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('admin.SEO Meta Description') }}</label>
                            <textarea name="seo_meta_description" maxlength="160"
                                class="form-control text-area-5"
                                rows="4">{{ old('seo_meta_description', $property->seo_meta_description ?? '') }}</textarea>
                        </div>
                    </div>

                                    </div>
                                </div>
                            </div>

        <!-- BUTTON -->
         <div class="step-nav">
                                <div>
                                    <button type="button" class="btn btn-secondary step-prev" data-prev="6">Previous</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary step-next" data-next="7">Next: Additional</button>
                                </div>
                            </div>
                            
                               
    </div>
     </form>
</div>  
</div><!-- end wrapper -->

        </div>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script id="seo-auto-js">
document.addEventListener("DOMContentLoaded", function () {

    let titleInput = document.querySelector('[name="seo_title"]');
    let descInput  = document.querySelector('[name="seo_meta_description"]');

    // Change these selectors based on your form
    let propertyName = document.querySelector('[name="title"]');
    let city         = document.querySelector('[name="city"]');
    let state        = document.querySelector('[name="state"]');
    let summary      = document.querySelector('[name="description"]');

    function generateSEO() {
        let title = `${propertyName?.value || ''} ${city?.value || ''}`;
        let desc  = `${summary?.value || ''} in ${city?.value || ''}, ${state?.value || ''}`;

        // Only autofill if empty (so user can edit)
        if (!titleInput.value) {
            titleInput.value = title.substring(0, 60);
        }

        if (!descInput.value) {
            descInput.value = desc.substring(0, 160);
        }
    }

    // Trigger on change
    [propertyName, city, state, summary].forEach(el => {
        if (el) el.addEventListener('input', generateSEO);
    });

});
</script>
<script>
(function($){
    "use strict";
    $(document).ready(function(){

        // init select2
        if($.fn.select2){ $('.select2').select2({ width: '100%' }); }

        // Step nav click
        $(".property-steps li").on("click", function(){
            var step = $(this).data("step");
            $(".property-steps li").removeClass("active");
            $(this).addClass("active");
            $(".step-section").removeClass("active");
            $("#step-"+step).addClass("active");
            $('html, body').animate({ scrollTop: $(".property-wrapper").offset().top - 20 }, 200);
        });

        // slug helper
        function convertToSlug(Text) {
            return Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
        }
        $("#title").on("keyup", function(){
            let slug = convertToSlug($(this).val());
            $("#slug").val(slug);
            $.get("{{ url('/admin/check-slug') }}/" + slug).fail(function(err){
                if(err.status == 403 && err.responseJSON) {
                    if(typeof toastr !== 'undefined') toastr.error(err.responseJSON.message || 'Slug check error');
                }
            });
        });



$("#finalSave").on("click", function(e){
    e.preventDefault();

    let fd = new FormData($('#property_form')[0]);
    fd.append('step', 5);

    console.log("STEP 5 HIT");

    $.ajax({
        url: "{{ route('admin.property.save-step') }}",
        method: "POST",
        data: fd,
        contentType: false,
        processData: false,

        beforeSend: function(){
            $('.save_btn').prop('disabled', true);
        },

        success: function(res){

            $('.save_btn').prop('disabled', false);

            console.log("RESPONSE:", res);

            if(res.status === 'success' || res.status === true){

                // ✅ toastr message add kela
                if (typeof toastr !== 'undefined') {
                    toastr.success(res.message || 'Property Saved Successfully 🔥');
                }

            } else {

                if (typeof toastr !== 'undefined') {
                    toastr.error(res.message || "Save failed");
                }
            }
        },

        error: function(xhr){

            $('.save_btn').prop('disabled', false);

            console.log("ERROR:", xhr);

            let msg = "Server error";

            if(xhr.responseJSON && xhr.responseJSON.message){
                msg = xhr.responseJSON.message;
            }

            if (typeof toastr !== 'undefined') {
                toastr.error(msg);
            }
        }
    });
});        // owner change -> plan availability
        $("#owner_id").on("change", function(){
            let owner_id = $(this).val();
            if(owner_id != 0){
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/agent-plan-availability') }}/" + owner_id,
                    success: function(response){
                        if(response.top_property == 'disable') $("#top_box").addClass('d-none'); else $("#top_box").removeClass('d-none');
                        if(response.urgent_property == 'disable') $("#urgent_box").addClass('d-none'); else $("#urgent_box").removeClass('d-none');
                        if(response.featured_property == 'disable') $("#featured_box").addClass('d-none'); else $("#featured_box").removeClass('d-none');
                    },
                    error: function(err){
                        if(err.status == 403 && err.responseJSON){
                            if(typeof toastr !== 'undefined') toastr.error(err.responseJSON.message);
                            $("#top_box,#urgent_box,#featured_box").addClass('d-none');
                        }
                    }
                });
            } else {
                $("#top_box,#urgent_box,#featured_box").removeClass('d-none');
            }
        });

        // Purpose -> rent period & PG logic
        $("#purpose").on("change", function(){
            var purpose = $(this).val();
            if(purpose == 'rent') $("#rend_period_box").removeClass('d-none'); else $("#rend_period_box").addClass('d-none');

            if(purpose == 'pg'){
                $("#category_type option[value='commercial']").hide();
                $("#category_type").val('residential').trigger('change');
            } else {
                $("#category_type option[value='commercial']").show();
            }
        });

        // Category -> load property types
        $("#category_type").on("change", function(){
            let category = $(this).val();
            if(category != ''){
                $.get("{{ url('/admin/get-property-types') }}/"+category, function(data){
                    let html = '<option value="">Select</option>';
                    data.forEach(function(item){ html += `<option value="${item.id}">${item.name}</option>`; });
                    $("#property_type_id").html(html).trigger('change');
                    $("#sub_property_type_id").html('<option value="">Select</option>');
                });
            } else {
                $("#property_type_id").html('<option value="">Select</option>');
                $("#sub_property_type_id").html('<option value="">Select</option>');
            }
        });

    $(document).ready(function(){

    let propertyType = $("#property_type_id").val();

    // ✅ Trigger property type on load (CREATE + EDIT)
    if(propertyType){
        $("#property_type_id").trigger("change");
    }

});


// =====================
// PROPERTY → SUB TYPE
// =====================
$("#property_type_id").on("change", function(){

    let typeId = $(this).val();

    if(typeId){

        $.get("/admin/get-sub-types/" + typeId, function(data){

            let html = '<option value="">Select</option>';

            if(data.length > 0){

                $("#sub_type_box").removeClass("d-none");

                data.forEach(function(item){

                    let selected = (typeof existingSubType !== "undefined" && item.id == existingSubType) ? 'selected' : '';

                    html += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });

            } else {
                $("#sub_type_box").addClass("d-none");
            }

            $("#sub_property_type_id").html(html);

            // ✅ Trigger sub type if exists (EDIT)
            if(typeof existingSubType !== "undefined" && existingSubType){
                $("#sub_property_type_id").trigger("change");
            }

        });

    } else {

        $("#sub_type_box").addClass("d-none");
        $("#sub_property_type_id").html('<option value="">Select</option>');
    }

});


// =====================
// SUB → CHILD TYPE
// =====================
$("#sub_property_type_id").on("change", function(){

    let subTypeId = $(this).val();

    console.log("SubType ID:", subTypeId);

    if(subTypeId){

        $.get("/admin/get-child-sub-types/" + subTypeId, function(data){

            let html = '<option value="">Select</option>';

            if(data.length > 0){

                $("#child_sub_type_box").removeClass("d-none");

                data.forEach(function(item){

                    let selected = (typeof existingChildType !== "undefined" && item.id == existingChildType) ? 'selected' : '';

                    html += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });

            } else {
                $("#child_sub_type_box").addClass("d-none");
            }

            $("#child_sub_property_type_id").html(html);

        });

    } else {

        $("#child_sub_type_box").addClass("d-none");
        $("#child_sub_property_type_id").html('<option value="">Select</option>');
    }

});

        // Dynamic rows handlers (nearest, additional, plan)
        $("#addNearestPlaceRow").on("click", function(){
            var new_row = $("#hidden-location-box").html();
            $("#nearest-place-box").append(new_row);
        });
        $(document).on('click', '.removeNearestPlaceRow', function () { $(this).closest('.delete-dynamic-location, .nearest-existing-row').remove(); });

        $("#addAdditionalRow").on("click", function(){
            var new_row = $("#hidden-addition-box").html();
            $("#additional-box").append(new_row);
        });
        $(document).on('click', '.removeAdditioanRow', function () { $(this).closest('.delete-dynamic-additio').remove(); });
/* ==========================================
   STEP 5 â€“ BROKERAGE SHOW / HIDE
========================================== */

function toggleBrokerageFields() {
    let value = $('input[name="brokerage_required"]:checked').val();

    if (value == 1) {
        $('#brokerage_fields').slideDown(200);
    } else {
        $('#brokerage_fields').slideUp(200);
    }
}

// On change
$(document).on('change', 'input[name="brokerage_required"]', function () {
    toggleBrokerageFields();
});

// On page load
toggleBrokerageFields();



/* ==========================================
   STEP 5 â€“ PRELEASED SHOW / HIDE
========================================== */

function togglePreleasedFields() {
    if ($('#is_preleased').is(':checked')) {
        $('#preleased_fields').slideDown(200);
    } else {
        $('#preleased_fields').slideUp(200);
    }
}

// On change
$(document).on('change', '#is_preleased', function () {
    togglePreleasedFields();
});

// On page load
togglePreleasedFields();



/* ==========================================
   INDIAN PRICE FORMAT (Live Formatting)
========================================== */

function formatIndianCurrency(x) {
    x = x.replace(/,/g, '');

    if (isNaN(x) || x === '') return x;

    let lastThree = x.substring(x.length - 3);
    let otherNumbers = x.substring(0, x.length - 3);

    if (otherNumbers !== '') {
        lastThree = ',' + lastThree;
    }

    return otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
}

$(document).on('keyup', 'input[name="expected_price"]', function () {
    let value = $(this).val();
    $(this).val(formatIndianCurrency(value));
});



/* ==========================================
   EMI CALCULATOR (Optional if added in blade)
========================================== */

$(document).on('click', '#calculate_emi', function () {

    let P = parseFloat($('#loan_amount').val());
    let annualRate = parseFloat($('#interest_rate').val());
    let N = parseFloat($('#loan_tenure').val());

    if (!P || !annualRate || !N) {
        alert('Please fill all EMI fields');
        return;
    }

    let R = annualRate / 12 / 100;

    let EMI = (P * R * Math.pow(1 + R, N)) /
              (Math.pow(1 + R, N) - 1);

    $('#emi_result').text(EMI.toFixed(2));
});
        $("#addNewPlan").on("click", function(){
            var new_row = $("#hidden-plan-box").html();
            $("#plan-box").append(new_row);
        });
$(document).on('click', '.removePlanRow', function(){

    let row = $(this).closest('.delete-dynamic-plan');
    let planId = row.find('input[name="existing_plan_ids[]"]').val();

    if(planId){
        $('<input>').attr({
            type: 'hidden',
            name: 'remove_plan_ids[]',
            value: planId
        }).appendTo('#property_form');
    }

    row.remove();
});
        // AJAX country -> cities
        $("#country_id").change(function (){
            let id = this.value;
            let route = "{{ url('/admin/property/city/list/') }}/" + id;
            ajax_switch_country(route);
        });
        function ajax_switch_country(route) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (response) {
                    if(response.template) $('#country_selector').html(response.template);
                    else if(response.cities_html) $('#country_selector').html(response.cities_html);
                    // re-init select2 for new city select
                    if($.fn.select2) $('#country_selector .select2').select2({ width:'100%' });
                },
            });
        }

        // Map (leaflet) + reverse geocode
         var map, currentMarker;

        @if($setting->live_map == 'yes')
        try {

            const defaultLat = {{ $property->lat ?? 23.822350 }};
            const defaultLng = {{ $property->lon ?? 90.365417 }};

            map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            @if(isset($property) && $property->lat && $property->lon)
                currentMarker = L.marker([{{ $property->lat }}, {{ $property->lon }}]).addTo(map);
            @endif

            map.on('click', function(e){

                const lat = e.latlng.lat;
                const lng = e.latlng.lng;

                $('#lat').val(lat);
                $('#lng').val(lng);

                if(currentMarker) map.removeLayer(currentMarker);

                currentMarker = L.marker([lat, lng]).addTo(map);

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(res => res.json())
                    .then(data => {

                        if(data.display_name){
                            $('#address').val(data.display_name);
                            $('#full_address').val(data.display_name);
                        }

                        if(data.address){
                            const addr = data.address;

                            $('#locality').val(
                                addr.city || addr.town || addr.village || ''
                            );

                            $('#sub_locality').val(
                                addr.suburb || addr.neighbourhood || ''
                            );
                        }

                    }).catch(()=>{});
            });

        } catch(e){}
        @endif

// =========================================
// DYNAMIC PROPERTY CONFIGURATION SYSTEM
// =========================================


function loadDynamicFields(){
const areaUnits = `
<option value="sq.ft">sq.ft.</option>
<option value="sq.yards">sq.yards</option>
<option value="sq.m">sq.m.</option>
<option value="acres">acres</option>
<option value="marla">marla</option>
<option value="cents">cents</option>
<option value="bigha">bigha</option>
<option value="kottah">kottah</option>
<option value="kanal">kanal</option>
<option value="grounds">grounds</option>
<option value="ares">ares</option>
<option value="biswa">biswa</option>
<option value="guntha">guntha</option>
<option value="aankadam">aankadam</option>
<option value="hectares">hectares</option>
<option value="rood">rood</option>
<option value="chataks">chataks</option>
<option value="perch">perch</option>
`;
let purpose = $("#purpose").val();
let propertyType = $("#property_type_id").val();
let subType = $("#sub_property_type_id").val();
let childType = $("#child_sub_property_type_id").val();

let html = "";

/*
Example ID mapping

property type
office = 3

sub type
ready to move = 5
bare shell = 6
co working = 7
*/
if (purpose === "pg" && parseInt(propertyType) === 1) {

html += `

<div class="config-wrapper">

<h4>Your apartment is a</h4>

<div class="pill-group">
<label class="pill">
<input type="radio" name="bhk_type" value="2bhk"
class="config-field-radio" data-key="bhk_type"> 2 BHK
</label>

<label class="pill">
<input type="radio" name="bhk_type" value="3bhk"
class="config-field-radio" data-key="bhk_type"> 3 BHK
</label>

<label class="pill">
<input type="radio" name="bhk_type" value="other"
class="config-field-radio" data-key="bhk_type"> Other
</label>
</div>


<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>

<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bathrooms" value="1"
class="config-field-radio" data-key="bathrooms">1
</label>

<label class="pill">
<input type="radio" name="bathrooms" value="2"
class="config-field-radio" data-key="bathrooms">2
</label>

<label class="pill">
<input type="radio" name="bathrooms" value="3"
class="config-field-radio" data-key="bathrooms">3
</label>

<label class="pill">
<input type="radio" name="bathrooms" value="4"
class="config-field-radio" data-key="bathrooms">4
</label>

</div>


<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony" value="0"
class="config-field-radio" data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony" value="1"
class="config-field-radio" data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony" value="2"
class="config-field-radio" data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony" value="3"
class="config-field-radio" data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony" value="3+"
class="config-field-radio" data-key="balcony">More than 3
</label>

</div>

<h4 class="mt-4">Room Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="room_type" value="sharing"
class="config-field-radio room-type-radio"
data-key="room_type"> Sharing
</label>

<label class="pill">
<input type="radio" name="room_type" value="private"
class="config-field-radio room-type-radio"
data-key="room_type"> Private
</label>

</div>


<div id="sharing_people_box" style="display:none;margin-top:15px">

<h4>How many people can share this room?</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="share_people" value="2"
class="config-field-radio" data-key="share_people">2
</label>

<label class="pill">
<input type="radio" name="share_people" value="3"
class="config-field-radio" data-key="share_people">3
</label>

<label class="pill">
<input type="radio" name="share_people" value="4"
class="config-field-radio" data-key="share_people">4
</label>

<label class="pill">
<input type="radio" name="share_people" value="4+"
class="config-field-radio" data-key="share_people">4+
</label>

</div>

</div>


<h4 class="mt-4">Capacity and Availability</h4>

<input type="number"
class="form-control config-field"
placeholder="Total no. of beds in PG"
data-key="pg_total_beds">

<input type="number"
class="form-control config-field mt-2"
placeholder="No. of beds available in PG"
data-key="pg_available_beds">


<div class="mt-2">

<label>
<input type="checkbox"
class="config-field"
data-key="attached_bathroom"> Attached Bathroom
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="attached_balcony"> Attached Balcony
</label>

</div>


<h4 class="mt-4">Add Area Details</h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Un-furnished
</label>

</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>

<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">

<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>

</div>


<h4 class="mt-4">Available for</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="pg_for" value="girls"
class="config-field-radio" data-key="pg_for">Girls
</label>

<label class="pill">
<input type="radio" name="pg_for" value="boys"
class="config-field-radio" data-key="pg_for">Boys
</label>

<label class="pill">
<input type="radio" name="pg_for" value="any"
class="config-field-radio" data-key="pg_for">Any
</label>

</div>

<h4 class="mt-4">Suitable for</h4>

<label>
<input type="checkbox"
class="config-field"
data-key="students"> Students
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="working_professionals"> Working Professionals
</label>


</div>

`;
}
else if (purpose === "rent" && propertyType == 1){

html += `

<div class="config-wrapper">

<h4>Your apartment is a</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="bhk"
data-key="bhk"
class="config-field-radio"
value="1bhk"> 1 BHK
</label>

<label class="pill">
<input type="radio"
name="bhk"
data-key="bhk"
class="config-field-radio"
value="2bhk"> 2 BHK
</label>

<label class="pill">
<input type="radio"
name="bhk"
data-key="bhk"
class="config-field-radio"
value="other"> Other
</label>

</div>


<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony" value="0"
class="config-field-radio" data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony" value="1"
class="config-field-radio" data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony" value="2"
class="config-field-radio" data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony" value="3"
class="config-field-radio" data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony" value="3+"
class="config-field-radio" data-key="balcony">More than 3
</label>

</div>

<h4 class="mt-4">Add Area Details</h4>

<p class="small-text">Atleast one area type is mandatory</p>


<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field"
data-key="carpet_unit">
${areaUnits}
</select>

</div>


<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field"
data-key="builtup_unit">
${areaUnits}
</select>

</div>


<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field"
data-key="super_builtup_unit">
${areaUnits}
</select>

</div>


<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" value="pooja" class="config-field" data-key="pooja_room">+ Pooja Room</label>
<label class="pill"><input type="checkbox" value="study" class="config-field" data-key="study_room">+ Study Room</label>
<label class="pill"><input type="checkbox" value="servant" class="config-field" data-key="servant_room">+ Servant Room</label>
<label class="pill"><input type="checkbox" value="store" class="config-field" data-key="store_room">+ Store Room</label>
</div>




<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Un-furnished
</label>

</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>



<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="mt-4">Available from</h4>

<input type="date"
class="form-control config-field"
data-key="available_from">


<h4 class="mt-4">Willing to rent out to</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="family"> + Family
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="single_men"> + Single men
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="single_women"> + Single women
</label>

</div>

</div>

`;

}
else if (purpose === "sale" && propertyType == 1){


html += `

<div class="config-wrapper">
<h4>Your apartment is a</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="bhk_type"
class="config-field-radio"
data-key="bhk_type"
value="1bhk">
1 BHK
</label>

<label class="pill">
<input type="radio"
name="bhk_type"
class="config-field-radio"
data-key="bhk_type"
value="2bhk">
2 BHK
</label>

<label class="pill">
<input type="radio"
name="bhk_type"
class="config-field-radio"
data-key="bhk_type"
value="3bhk">
3 BHK
</label>

<label class="pill">
<input type="radio"
name="bhk_type"
class="config-field-radio"
data-key="bhk_type"
value="other">
Other
</label>

</div>
<h4>No. of Bedrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<h4 class="mt-3">No. of Bathrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>


<h4 class="mt-3">Balconies</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<p class="small-text">Atleast one area type is mandatory</p>


<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field"
data-key="carpet_unit">

${areaUnits}

</select>

</div>



<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field"
data-key="builtup_unit">

${areaUnits}

</select>

</div>



<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field"
data-key="super_builtup_unit">

${areaUnits}

</select>

</div>



<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" value="pooja" class="config-field" data-key="pooja_room">+ Pooja Room</label>
<label class="pill"><input type="checkbox" value="study" class="config-field" data-key="study_room">+ Study Room</label>
<label class="pill"><input type="checkbox" value="servant" class="config-field" data-key="servant_room">+ Servant Room</label>
<label class="pill"><input type="checkbox" value="store" class="config-field" data-key="store_room">+ Store Room</label>
</div>




<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Un-furnished
</label>

</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>


<h4 class="mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability" value="ready" class="availability-radio config-field-radio" data-key="availability">
Ready to move
</label>

<label class="pill">
<input type="radio" name="availability" value="construction" class="availability-radio config-field-radio" data-key="availability">
Under construction
</label>

</div>


<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>
</div>

</div>


<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}


if (purpose === "pg" && parseInt(propertyType) === 2) {
html += `

<div class="config-wrapper">

<h4>No. of Bedrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" class="config-field-radio" data-key="bedrooms" value="1">1</label>
<label class="pill"><input type="radio" name="bedrooms" class="config-field-radio" data-key="bedrooms" value="2">2</label>
<label class="pill"><input type="radio" name="bedrooms" class="config-field-radio" data-key="bedrooms" value="3">3</label>
<label class="pill"><input type="radio" name="bedrooms" class="config-field-radio" data-key="bedrooms" value="4">4</label>
</div>



<h4 class="mt-3">No. of Bathrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" class="config-field-radio" data-key="bathrooms" value="1">1</label>
<label class="pill"><input type="radio" name="bathrooms" class="config-field-radio" data-key="bathrooms" value="2">2</label>
<label class="pill"><input type="radio" name="bathrooms" class="config-field-radio" data-key="bathrooms" value="3">3</label>
<label class="pill"><input type="radio" name="bathrooms" class="config-field-radio" data-key="bathrooms" value="4">4</label>
</div>



<h4 class="mt-3">Balconies</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" class="config-field-radio" data-key="balcony" value="0">0</label>
<label class="pill"><input type="radio" name="balcony" class="config-field-radio" data-key="balcony" value="1">1</label>
<label class="pill"><input type="radio" name="balcony" class="config-field-radio" data-key="balcony" value="2">2</label>
<label class="pill"><input type="radio" name="balcony" class="config-field-radio" data-key="balcony" value="3">3</label>
<label class="pill"><input type="radio" name="balcony" class="config-field-radio" data-key="balcony" value="3+">More than 3</label>
</div>



<h4 class="mt-4">Room Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="room_type" value="sharing"
class="config-field-radio room-type-radio"
data-key="room_type"> Sharing
</label>

<label class="pill">
<input type="radio" name="room_type" value="private"
class="config-field-radio room-type-radio"
data-key="room_type"> Private
</label>

</div>

<div id="sharing_people_box" style="display:none;margin-top:15px">

<h4>How many people can share this room?</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="share_people"
value="2"
class="config-field-radio"
data-key="share_people">
2
</label>

<label class="pill">
<input type="radio" name="share_people"
value="3"
class="config-field-radio"
data-key="share_people">
3
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4"
class="config-field-radio"
data-key="share_people">
4
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4+"
class="config-field-radio"
data-key="share_people">
4+
</label>

</div>

</div>



<h4 class="mt-4">Capacity and Availability</h4>

<input type="number"
class="form-control config-field"
placeholder="Total no. of beds in PG"
data-key="pg_beds">


<div class="mt-2">

<label>
<input type="checkbox"
class="config-field"
data-key="attached_bathroom"> Attached Bathroom
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="attached_balcony"> Attached Balcony
</label>

</div>



<h4 class="mt-4">Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">
<input type="text" class="area-input config-field"
placeholder="Plot Area"
data-key="plot_area">

<select class="area-unit config-field"
data-key="plot_area_unit">
${areaUnits}
</select>
</div>


<div class="area-box mt-2">
<input type="text" class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field"
data-key="carpet_area_unit">
${areaUnits}
</select>
</div>


<div class="area-box mt-2">
<input type="text" class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field"
data-key="builtup_area_unit">
${areaUnits}
</select>
</div>



<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="pooja_room"> + Pooja Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="study_room"> + Study Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="servant_room"> + Servant Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="store_room"> + Store Room
</label>

</div>




<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Un-furnished
</label>

</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Available for</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="girls"> Girls
</label>

<label class="pill">
<input type="radio"
name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="boys"> Boys
</label>

<label class="pill">
<input type="radio"
name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="any"> Any
</label>

</div>



<h4 class="mt-4">Suitable for</h4>

<label>
<input type="checkbox"
class="config-field"
data-key="students"> Students
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="working_professionals"> Working Professionals
</label>


</div>

`;

}// READY TO MOVE OFFICE
else if (purpose === "rent" && propertyType == 2){
html += `

<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony" value="0"
class="config-field-radio" data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony" value="1"
class="config-field-radio" data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony" value="2"
class="config-field-radio" data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony" value="3"
class="config-field-radio" data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony" value="3+"
class="config-field-radio" data-key="balcony">More than 3
</label>

</div>

<h4 class="mt-4">Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">

<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">

<select class="area-unit config-field" data-key="plot_area_unit">
${areaUnits}
</select>

</div>


<div class="area-box mt-2">

<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>

</div>


<div class="area-box mt-2">

<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">

<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>

</div>


<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">

<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>

</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="furnished">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="semi">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="unfurnished">
Un-furnished
</label>

</div>


<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>
<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>

<h4 class="mt-4">Available from</h4>

<input type="date" class="form-control config-field" data-key="available_from">


<h4 class="mt-4">Willing to rent out to</h4>

<div class="pill-group">

<label class="pill"><input type="checkbox" class="config-field" data-key="tenant_family"> + Family</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="tenant_men"> + Single men</label>

<label class="pill"><input type="checkbox" class="config-field" data-key="tenant_women"> + Single women</label>

</div>


</div>

`;

}
else if (purpose === "sale" && propertyType == 2){

html += `

<div class="config-wrapper">

<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony" value="0"
class="config-field-radio" data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony" value="1"
class="config-field-radio" data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony" value="2"
class="config-field-radio" data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony" value="3"
class="config-field-radio" data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony" value="3+"
class="config-field-radio" data-key="balcony">More than 3
</label>

</div>

<h4 class="mt-4">Add Area Details</h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Other rooms <small>(Optional)</small></h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>
</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="furnished">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="semi">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="unfurnished">
Un-furnished
</label>

</div>


<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>

<h4 class="mt-4">Reserved Parking <small>(Optional)</small></h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>


<h4 class="mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>

</div>


<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>

</div>


<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}

if(propertyType == 12 && subType == 2){

html += `

<div class="config-box">

<h5 class="config-title">Add Area Details</h5>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-row">
<input type="number" class="area-input config-field" data-key="carpet_area" placeholder="Carpet Area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-row">
<input type="number" class="area-input config-field" data-key="super_builtup_area" placeholder="Super built-up Area">
<select class="area-unit config-field" data-key="super_builtup_unit">
${areaUnits}
</select>
</div>

</div>


<h5 class="section-title">Describe your office setup</h5>

<div class="form-row">

<div class="form-col">
<label>Min. no. of Seats</label>
<input type="number" class="form-control config-field" data-key="min_seats">
</div>

<div class="form-col">
<label>Max. no. of Seats (optional)</label>
<input type="number" class="form-control config-field" data-key="max_seats">
</div>

<div class="form-col">
<label>No. of Cabins</label>
<input type="number" class="form-control config-field" data-key="cabins">
</div>

<div class="form-col">
<label>No. of Meeting Rooms</label>
<input type="number" class="form-control config-field" data-key="meeting_rooms">
</div>

</div>


<h5 class="section-title">Washrooms</h5>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washrooms" value="available"
class="config-field-radio" data-key="washrooms">
Available
</label>

<label class="pill">
<input type="radio" name="washrooms" value="not_available"
class="config-field-radio" data-key="washrooms">
Not - Available
</label>

</div>


<h5 class="section-title">Conference Room</h5>

<div class="pill-group">

<label class="pill">
<input type="radio" name="conference_room" value="available"
class="config-field-radio" data-key="conference_room">
Available
</label>

<label class="pill">
<input type="radio" name="conference_room" value="not_available"
class="config-field-radio" data-key="conference_room">
Not - Available
</label>

</div>


<h5 class="section-title">Reception Area</h5>

<div class="pill-group">

<label class="pill">
<input type="radio" name="reception_area" value="available"
class="config-field-radio" data-key="reception_area">
Available
</label>

<label class="pill">
<input type="radio" name="reception_area" value="not_available"
class="config-field-radio" data-key="reception_area">
Not - Available
</label>

</div>


<h5 class="section-title">Pantry Type</h5>

<div class="pill-group">

<label class="pill">
<input type="radio" name="pantry_type" value="private"
class="config-field-radio pantry-radio" data-key="pantry_type">
Private
</label>

<label class="pill">
<input type="radio" name="pantry_type" value="shared"
class="config-field-radio pantry-radio" data-key="pantry_type">
Shared
</label>

<label class="pill">
<input type="radio" name="pantry_type" value="not_available"
class="config-field-radio pantry-radio" data-key="pantry_type">
Not - Available
</label>

</div>

<div id="pantry_size_box" style="display:none;margin-top:10px">

<input type="number"
class="area-input config-field"
placeholder="Pantry Size"
data-key="pantry_size">

<select class="area-unit config-field"
data-key="pantry_unit">
${areaUnits}
</select>

</div>


<h5 class="section-title">Please select the facilities available</h5>

<div class="facility-row">

<label>Furnishing</label>

<label>
<input type="radio" name="furnishing" value="available"
class="config-field-radio" data-key="furnishing">
Available
</label>

<label>
<input type="radio" name="furnishing" value="not_available"
class="config-field-radio" data-key="furnishing">
Not Available
</label>

</div>


<div class="facility-row">

<label>Central Air Conditioning</label>

<label>
<input type="radio" name="central_ac" value="available"
class="config-field-radio" data-key="central_ac">
Available
</label>

<label>
<input type="radio" name="central_ac" value="not_available"
class="config-field-radio" data-key="central_ac">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h5 class="section-title">Lifts</h5>

<div class="pill-group">

<label class="pill">
<input type="radio" name="lifts" value="available"
class="config-field-radio lifts-radio" data-key="lifts">
Available
</label>

<label class="pill">
<input type="radio" name="lifts" value="not_available"
class="config-field-radio lifts-radio" data-key="lifts">
Not - Available
</label>

</div>


<div id="lift_counter_box" style="display:none">

<label>Passenger Lifts</label>
<input type="number" class="form-control config-field" data-key="passenger_lifts">

<label>Service Lifts</label>
<input type="number" class="form-control config-field" data-key="service_lifts">

</div>


<h5 class="section-title">Parking</h5>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking" value="available"
class="config-field-radio parking-radio" data-key="parking">
Available
</label>

<label class="pill">
<input type="radio" name="parking" value="not_available"
class="config-field-radio parking-radio" data-key="parking">
Not - Available
</label>

</div>


<div id="parking_details_box" style="display:none">

<label><input type="checkbox" class="config-field" data-key="parking_basement"> Private Parking in Basement</label>

<label><input type="checkbox" class="config-field" data-key="parking_outside"> Private Parking Outside</label>

<label><input type="checkbox" class="config-field" data-key="public_parking"> Public Parking</label>

<input type="number"
class="form-control config-field"
placeholder="No. of Parking"
data-key="parking_count">

</div>

`;
}// BARE SHELL OFFICE
if(propertyType == 3 && subType == 6){

html += `

<div class="row">

<div class="col-md-6">
<label>Super Builtup Area</label>
<input type="text" class="form-control config-field" data-key="super_builtup_area">
</div>

<div class="col-md-6">
<label>Floor Height</label>
<input type="text" class="form-control config-field" data-key="floor_height">
</div>

<div class="col-md-6">
<label>Parking</label>
<input type="number" class="form-control config-field" data-key="parking">
</div>

</div>

`;

}

if(propertyType == 12 && subType == 4){

html += `

<div class="property-config">

<!-- AREA DETAILS -->
<div class="config-block">

<div class="label-head">
Add Area Details
<span class="area-help">
<i class="fa fa-question-circle"></i>
</span>
</div>

<div class="small-text">
Atleast one area type is mandatory
</div>


<div class="area-box">

<input type="number"
class="area-input config-field"
placeholder="Plot Area"
data-key="plot_area">

<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>

</div>


<div class="area-box">

<input type="number"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>

</div>


<div class="area-box">

<input type="number"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>

</div>

</div>



<!-- ROOM DETAILS -->
<div class="config-block">

<label class="config-title">
Add Room Details
</label>

<div class="small-text">
No. of Washrooms
</div>


<div class="pill-group">

<label class="pill">
<input type="radio" name="washrooms"
value="none"
class="config-field-radio"
data-key="washrooms">
None
</label>


<label class="pill">
<input type="radio" name="washrooms"
value="shared"
class="config-field-radio"
data-key="washrooms">
Shared
</label>


<label class="pill">
<input type="radio" name="washrooms"
value="1"
class="config-field-radio"
data-key="washrooms">
1
</label>


<label class="pill">
<input type="radio" name="washrooms"
value="2"
class="config-field-radio"
data-key="washrooms">
2
</label>


<label class="pill">
<input type="radio" name="washrooms"
value="3"
class="config-field-radio"
data-key="washrooms">
3
</label>


<label class="pill">
<input type="radio" name="washrooms"
value="4"
class="config-field-radio"
data-key="washrooms">
4
</label>

</div>



</div>


</div>

`;

}

if(propertyType == 13 && subType == 5 && childType == 5){

html += `

<div class="config-section">

<h4>Add Area Details</h4>

<p class="small-text">Carpet area is mandatory</p>

<div class="area-row">

<input type="number"
class="form-control config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field"
data-key="carpet_unit">
${areaUnits}
</select>

</div>


<div class="area-row">

<input type="number"
class="form-control config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field"
data-key="builtup_unit">
${areaUnits}
</select>

</div>



<h4 class="mt-4">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="washroom_type"
value="private"
class="config-field-radio"
data-key="washroom_type">
Private washrooms
</label>

<label class="pill">
<input type="radio"
name="washroom_type"
value="public"
class="config-field-radio"
data-key="washroom_type">
Public washrooms
</label>

<label class="pill">
<input type="radio"
name="washroom_type"
value="not_available"
class="config-field-radio"
data-key="washroom_type">
Not Available
</label>

</div>



<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>




<h4 class="mt-4">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="parking_type"
value="private"
class="config-field-radio"
data-key="parking_type">
Private Parking
</label>

<label class="pill">
<input type="radio"
name="parking_type"
value="public"
class="config-field-radio"
data-key="parking_type">
Public Parking
</label>

<label class="pill">
<input type="radio"
name="parking_type"
value="multilevel"
class="config-field-radio"
data-key="parking_type">
Multilevel Parking
</label>

<label class="pill">
<input type="radio"
name="parking_type"
value="not_available"
class="config-field-radio"
data-key="parking_type">
Not Available
</label>

</div>



<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>



<!-- AGE -->
<div id="age_section">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="age"
class="config-field-radio"
data-key="age"
value="0-1">0-1 years
</label>

<label class="pill">
<input type="radio" name="age"
class="config-field-radio"
data-key="age"
value="1-5">1-5 years
</label>

<label class="pill">
<input type="radio" name="age"
class="config-field-radio"
data-key="age"
value="5-10">5-10 years
</label>

<label class="pill">
<input type="radio" name="age"
class="config-field-radio"
data-key="age"
value="10+">10+ years
</label>

</div>

</div>



<!-- POSSESSION -->
<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>
</div>



<h4 class="mt-4">Shop facade size</h4>

<div class="row">

<div class="col-md-6">

<input type="number"
class="form-control config-field"
placeholder="Entrance width"
data-key="entrance_width">

</div>

<div class="col-md-6">

<select class="form-control config-field"
data-key="entrance_unit">

<option value="ft">ft.</option>
<option value="m">m</option>

</select>

</div>

</div>



<div class="row mt-3">

<div class="col-md-6">

<input type="number"
class="form-control config-field"
placeholder="Ceiling height"
data-key="ceiling_height">

</div>

<div class="col-md-6">

<select class="form-control config-field"
data-key="ceiling_unit">

<option value="ft">ft.</option>
<option value="m">m</option>

</select>

</div>

</div>


</div>

`;

}






// CO WORKING SPACE
if(propertyType == 12 && subType == 3){

html += `

<div class="property-config">

<h4 class="section-head">Tell us about your property</h4>

<!-- AREA DETAILS -->
<div class="config-block">

<div class="label-head">
Add Area Details
<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></div>

<div class="small-text">
Atleast one area type is mandatory
</div>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field" data-key="super_builtup_unit">
${areaUnits}
</select>

</div>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>

</div>

</div>


<!-- WASHROOM -->
<div class="config-block">

<label class="config-title">Washrooms</label>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="washrooms"
value="available"
class="config-field-radio"
data-key="washrooms">
Available
</label>

<label class="pill">
<input type="radio"
name="washrooms"
value="not_available"
class="config-field-radio"
data-key="washrooms">
Not built yet
</label>

</div>

</div>


<!-- PANTRY -->
<div class="config-block">

<label class="config-title">Pantry Type</label>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="pantry"
value="private"
class="config-field-radio"
data-key="pantry">
Private
</label>

<label class="pill">
<input type="radio"
name="pantry"
value="shared"
class="config-field-radio"
data-key="pantry">
Shared
</label>

<label class="pill">
<input type="radio"
name="pantry"
value="not_available"
class="config-field-radio"
data-key="pantry">
Not - Available
</label>

</div>

</div>


<!-- FACILITIES -->
<div class="config-block">

<label class="config-title">
Please select the facilities available
</label>

<div class="facility-row">

<span>Central Air Conditioning</span>

<label>
<input type="radio"
name="central_ac"
value="duct_only"
class="config-field-radio"
data-key="central_ac"> Duct Only
</label>

<label>
<input type="radio"
name="central_ac"
value="available"
class="config-field-radio"
data-key="central_ac"> Available
</label>

<label>
<input type="radio"
name="central_ac"
value="not_available"
class="config-field-radio"
data-key="central_ac"> Not Available
</label>

</div>

</div>


<!-- FLOOR DETAILS -->
<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>


<!-- LIFTS -->
<div class="config-block">

<label class="config-title">Lifts</label>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="lifts"
value="available"
class="config-field-radio"
data-key="lifts">
Available
</label>

<label class="pill">
<input type="radio"
name="lifts"
value="not_available"
class="config-field-radio"
data-key="lifts">
Not - Available
</label>

</div>

</div>


<!-- PARKING -->
<div class="config-block">

<label class="config-title">Parking</label>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="parking"
value="available"
class="config-field-radio"
data-key="parking">
Available
</label>

<label class="pill">
<input type="radio"
name="parking"
value="not_available"
class="config-field-radio"
data-key="parking">
Not - Available
</label>

</div>

</div>

</div>

`;

}



if (purpose === "pg" && parseInt(propertyType) === 3) {

html += `

<div class="config-wrapper">

<h4>Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>



<p class="mt-3">Balconies</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Room Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="room_type" value="sharing"
class="config-field-radio room-type-radio"
data-key="room_type"> Sharing
</label>

<label class="pill">
<input type="radio" name="room_type" value="private"
class="config-field-radio room-type-radio"
data-key="room_type"> Private
</label>

</div>

<div id="sharing_people_box" style="display:none;margin-top:15px">

<h4>How many people can share this room?</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="share_people"
value="2"
class="config-field-radio"
data-key="share_people">
2
</label>

<label class="pill">
<input type="radio" name="share_people"
value="3"
class="config-field-radio"
data-key="share_people">
3
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4"
class="config-field-radio"
data-key="share_people">
4
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4+"
class="config-field-radio"
data-key="share_people">
4+
</label>

</div>

</div>


<h4 class="mt-4">Capacity and Availability</h4>

<input type="number"
class="form-control config-field"
placeholder="Total no. of beds in PG"
data-key="pg_beds">

<div class="mt-2">

<label>
<input type="checkbox"
class="config-field"
data-key="attached_bathroom">
Attached Bathroom
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="attached_balcony">
Attached Balcony
</label>

</div>


<h4 class="mt-4">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">
<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field" data-key="super_builtup_area_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="study_room"> + Study Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="store_room"> + Store Room
</label>

</div>


<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<!-- ===================== Furnishing Section ===================== -->

<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Un-furnished
</label>

</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>

</div>


<h4 class="mt-4">Available from</h4>

<input type="date" class="form-control config-field" data-key="available_from">


<h4 class="mt-4">Available for</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="pg_for" class="config-field-radio" data-key="pg_for" value="girls">
Girls
</label>

<label class="pill">
<input type="radio" name="pg_for" class="config-field-radio" data-key="pg_for" value="boys">
Boys
</label>

<label class="pill">
<input type="radio" name="pg_for" class="config-field-radio" data-key="pg_for" value="any">
Any
</label>

</div>


<h4 class="mt-4">Suitable for</h4>

<label>
<input type="checkbox" class="config-field" data-key="students">
Students
</label>

<label class="ml-3">
<input type="checkbox" class="config-field" data-key="working_professionals">
Working Professionals
</label>

</div>

`;

}
else if (purpose === "rent" && propertyType == 3){

html += `

<div class="config-wrapper">

<h4>Select the type of Builder floor</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="builder_floor_type"
class="config-field-radio"
data-key="builder_floor_type"
value="single">
Single Floor
</label>

<label class="pill">
<input type="radio" name="builder_floor_type"
class="config-field-radio"
data-key="builder_floor_type"
value="duplex">
Duplex
</label>

<label class="pill">
<input type="radio" name="builder_floor_type"
class="config-field-radio"
data-key="builder_floor_type"
value="triplex">
Triplex
</label>

</div>



<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>




<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms"
value="1"
class="config-field-radio"
data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms"
value="2"
class="config-field-radio"
data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms"
value="3"
class="config-field-radio"
data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms"
value="4"
class="config-field-radio"
data-key="bedrooms">4
</label>

</div>



<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bathrooms"
value="1"
class="config-field-radio"
data-key="bathrooms">1
</label>

<label class="pill">
<input type="radio" name="bathrooms"
value="2"
class="config-field-radio"
data-key="bathrooms">2
</label>

<label class="pill">
<input type="radio" name="bathrooms"
value="3"
class="config-field-radio"
data-key="bathrooms">3
</label>

<label class="pill">
<input type="radio" name="bathrooms"
value="4"
class="config-field-radio"
data-key="bathrooms">4
</label>

</div>



<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony"
value="0"
class="config-field-radio"
data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony"
value="1"
class="config-field-radio"
data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony"
value="2"
class="config-field-radio"
data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony"
value="3"
class="config-field-radio"
data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony"
value="3+"
class="config-field-radio"
data-key="balcony">More than 3
</label>

</div>



<h4 class="mt-4">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Plot Area"
data-key="plot_area">

<select class="area-unit config-field"
data-key="plot_area_unit">

<option value="sq.yards">sq.yards</option>
${areaUnits}

</select>

</div>


<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field"
data-key="carpet_area_unit">

<option value="sq.yards">sq.yards</option>
${areaUnits}

</select>

</div>


<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field"
data-key="builtup_area_unit">

<option value="sq.yards">sq.yards</option>
${areaUnits}

</select>

</div>


<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field"
data-key="super_builtup_area_unit">

<option value="sq.yards">sq.yards</option>
${areaUnits}
</select>

</div>



<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="pooja_room">
+ Pooja Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="study_room">
+ Study Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="servant_room">
+ Servant Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="store_room">
+ Store Room
</label>

</div>



<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">

<label>Covered Parking</label>

<input type="number"
class="form-control config-field"
data-key="covered_parking">

</div>

<div class="col-md-6">

<label>Open Parking</label>

<input type="number"
class="form-control config-field"
data-key="open_parking">

</div>

</div>


<h4 class="mt-4">Highlights (Optional)</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="lift"> + Lift(s)</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="roof_rights"> + Roof Rights</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="security_guard"> + Security Guard</label>
</div>

<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>


<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>



<h4 class="mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="age"
value="0-1"
class="config-field-radio"
data-key="age">0-1 years
</label>

<label class="pill">
<input type="radio" name="age"
value="1-5"
class="config-field-radio"
data-key="age">1-5 years
</label>

<label class="pill">
<input type="radio" name="age"
value="5-10"
class="config-field-radio"
data-key="age">5-10 years
</label>

<label class="pill">
<input type="radio" name="age"
value="10+"
class="config-field-radio"
data-key="age">10+ years
</label>

</div>



<h4 class="mt-4">Available from</h4>

<input type="date"
class="form-control config-field"
data-key="available_from">



<h4 class="mt-4">Willing to rent out to</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="tenant_family"> Family
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="tenant_men"> Single men
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="tenant_women"> Single women
</label>

</div>

</div>

`;

}
else if (purpose === "sale" && propertyType == 3){

html += `

<div class="config-wrapper">

<h4>Select the type of Builder floor</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="builder_floor_type"
class="config-field-radio"
data-key="builder_floor_type"
value="single">
Single Floor
</label>

<label class="pill">
<input type="radio"
name="builder_floor_type"
class="config-field-radio"
data-key="builder_floor_type"
value="duplex">
Duplex
</label>

<label class="pill">
<input type="radio"
name="builder_floor_type"
class="config-field-radio"
data-key="builder_floor_type"
value="triplex">
Triplex
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony" value="0"
class="config-field-radio" data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony" value="1"
class="config-field-radio" data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony" value="2"
class="config-field-radio" data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony" value="3"
class="config-field-radio" data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony" value="3+"
class="config-field-radio" data-key="balcony">More than 3
</label>

</div>


<h4 class="mt-4">Add Area Details</h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_area_unit">
<option value="sq.yards">sq.yards</option>
${areaUnits}
</select>
</div>


<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_area_unit">
<option value="sq.yards">sq.yards</option>
${areaUnits}
</select>
</div>


<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_area_unit">
<option value="sq.yards">sq.yards</option>
${areaUnits}
</select>
</div>


<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Super built-up Area" data-key="super_builtup_area">
<select class="area-unit config-field" data-key="super_builtup_area_unit">
<option value="sq.yards">sq.yards</option>
${areaUnits}
</select>
</div>


<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>
</div>


<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<h4 class="mt-4">Highlights (Optional)</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="lift"> + Lift(s)</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="roof_rights"> + Roof Rights</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="security_guard"> + Security Guard</label>
</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="furnished">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="semi">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" class="config-field-radio furnishing-radio" data-key="furnishing" value="unfurnished">
Un-furnished
</label>

</div>


<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>
<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>
</div>
</div>

`;

}



if (purpose === "pg" && parseInt(propertyType) === 9) {

html += `

<div class="config-wrapper">

<h4>Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>



<p class="mt-3">Balconies</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Room Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="room_type" value="sharing"
class="config-field-radio room-type-radio"
data-key="room_type"> Sharing
</label>

<label class="pill">
<input type="radio" name="room_type" value="private"
class="config-field-radio room-type-radio"
data-key="room_type"> Private
</label>

</div>

<div id="sharing_people_box" style="display:none;margin-top:15px">

<h4>How many people can share this room?</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="share_people"
value="2"
class="config-field-radio"
data-key="share_people">
2
</label>

<label class="pill">
<input type="radio" name="share_people"
value="3"
class="config-field-radio"
data-key="share_people">
3
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4"
class="config-field-radio"
data-key="share_people">
4
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4+"
class="config-field-radio"
data-key="share_people">
4+
</label>

</div>

</div>
<h4 class="mt-4">Capacity and Availability</h4>

<input type="number"
class="form-control config-field"
placeholder="Total no. of beds in PG"
data-key="pg_beds">

<div class="mt-2">

<label>
<input type="checkbox"
class="config-field"
data-key="attached_bathroom">
Attached Bathroom
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="attached_balcony">
Attached Balcony
</label>

</div>


<h4 class="mt-4">Add Area Details  <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">
<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field" data-key="super_builtup_area_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox" class="config-field" data-key="pooja_room">
+ Pooja Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="study_room">
+ Study Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="servant_room">
+ Servant Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="store_room">
+ Store Room
</label>

</div>



<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Un-furnished
</label>

</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>

</div>


<h4 class="mt-4">Available from</h4>

<input type="date"
class="form-control config-field"
data-key="available_from">


<h4 class="mt-4">Available for</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="girls"> Girls
</label>

<label class="pill">
<input type="radio" name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="boys"> Boys
</label>

<label class="pill">
<input type="radio" name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="any"> Any
</label>

</div>


<h4 class="mt-4">Suitable for</h4>

<label>
<input type="checkbox"
class="config-field"
data-key="students">
Students
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="working_professionals">
Working Professionals
</label>

</div>

`;

}

else if (purpose === "rent" && parseInt(propertyType) === 9) {

html += `

<div class="config-wrapper">

<h4>No. of Bedrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<h4 class="mt-3">No. of Bathrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>



<h4 class="mt-3">Balconies</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Add Area Details</h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">

<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Super built-up Area" data-key="super_builtup_area">

<select class="area-unit config-field" data-key="super_builtup_area_unit">
${areaUnits}
</select>
</div>



<h4 class="mt-4">Other rooms (Optional)</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>
</div>



<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing"> Furnished</label>
<label class="pill"><input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing"> Semi-furnished</label>
<label class="pill"><input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing"> Un-furnished</label>
</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>
<h4 class="mt-4">Reserved Parking (Optional)</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number"
class="form-control config-field"
data-key="covered_parking"
min="0">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number"
class="form-control config-field"
data-key="open_parking"
min="0">
</div>

</div>

<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>




<h4 class="mt-4">Age of property</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>
</div>



<h4 class="mt-4">Available from</h4>

<input type="date" class="form-control config-field" data-key="available_from">



<h4 class="mt-4">Willing to rent out to</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="family"> + Family</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="single_men"> + Single men</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="single_women"> + Single women</label>
</div>


</div>

`;

}
else if (purpose === "sale" && parseInt(propertyType) === 9) {

html += `

<div class="config-wrapper">

<h4>No. of Bedrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<h4 class="mt-3">No. of Bathrooms</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>



<h4 class="mt-3">Balconies</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">
<strong>Carpet Area</strong>
<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>
</div>

<div class="area-tip-item">
<strong>Built-up Area</strong>
<p>Total carpet area + wall area.</p>
</div>

<div class="area-tip-item">
<strong>Super Built-up Area</strong>
<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>
</div>

</div>

</span></h4>


<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>


<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">

<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>


<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Super built-up Area" data-key="super_builtup_area">

<select class="area-unit config-field" data-key="super_builtup_area_unit">
${areaUnits}
</select>
</div>



<h4 class="mt-4">Other rooms <span class="optional">(Optional)</span></h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>
</div>



<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="furnishing" value="furnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="semi" class="config-field-radio furnishing-radio" data-key="furnishing">
Semi-furnished
</label>

<label class="pill">
<input type="radio" name="furnishing" value="unfurnished" class="config-field-radio furnishing-radio" data-key="furnishing">
Un-furnished
</label>

</div>

<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>

<h4 class="mt-4">Reserved Parking (Optional)</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number"
class="form-control config-field"
data-key="covered_parking"
min="0">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number"
class="form-control config-field"
data-key="open_parking"
min="0">
</div>

</div>



<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>




<h4 class="mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability" value="ready" class="availability-radio config-field-radio" data-key="availability">
Ready to move
</label>

<label class="pill">
<input type="radio" name="availability" value="construction" class="availability-radio config-field-radio" data-key="availability">
Under construction
</label>

</div>



<div id="age_section">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>
</div>

</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


</div>

`;

}



if(propertyType == 4){

html += `

<div class="config-wrapper">

<h4>Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Plot Area"
data-key="plot_area">

<select class="area-unit config-field"
data-key="plot_area_unit">

${areaUnits}

</select>

</div>


<h4 class="mt-4">Property Dimensions <span class="optional">(Optional)</span></h4>

<input type="text"
class="form-control config-field mt-2"
placeholder="Length of plot (in Ft.)"
data-key="plot_length">

<input type="text"
class="form-control config-field mt-2"
placeholder="Breadth of plot (in Ft.)"
data-key="plot_breadth">



<h4 class="mt-4">Floors Allowed For Construction</h4>

<input type="number"
class="form-control config-field"
placeholder="No. of floors"
data-key="floors_allowed">



<h4 class="mt-4">Is there a boundary wall around the property?</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="boundary_wall"
value="yes"
class="config-field-radio"
data-key="boundary_wall">
Yes
</label>

<label class="pill">
<input type="radio"
name="boundary_wall"
value="no"
class="config-field-radio"
data-key="boundary_wall">
No
</label>

</div>



<h4 class="mt-4">No. of open sides</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="open_sides"
value="1"
class="config-field-radio"
data-key="open_sides">1
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="2"
class="config-field-radio"
data-key="open_sides">2
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3"
class="config-field-radio"
data-key="open_sides">3
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3+"
class="config-field-radio"
data-key="open_sides">3+
</label>

</div>



<h4 class="mt-4">Any construction done on this property?</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="construction_done"
value="yes"
class="config-field-radio"
data-key="construction_done">
Yes
</label>

<label class="pill">
<input type="radio"
name="construction_done"
value="no"
class="config-field-radio"
data-key="construction_done">
No
</label>

</div>



<h4 class="mt-4">What type of construction has been done?</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_shed">
+ Shed
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_rooms">
+ Room(s)
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_washroom">
+ Washroom
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_other">
+ Other
</label>

</div>



<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

`;

}
if (purpose === "pg" && parseInt(propertyType) === 8) {

html += `

<div class="config-wrapper">

<h4>Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>



<p class="mt-3">Balconies</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Room Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="room_type" value="sharing"
class="config-field-radio room-type-radio"
data-key="room_type"> Sharing
</label>

<label class="pill">
<input type="radio" name="room_type" value="private"
class="config-field-radio room-type-radio"
data-key="room_type"> Private
</label>

</div>

<div id="sharing_people_box" style="display:none;margin-top:15px">

<h4>How many people can share this room?</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="share_people"
value="2"
class="config-field-radio"
data-key="share_people">
2
</label>

<label class="pill">
<input type="radio" name="share_people"
value="3"
class="config-field-radio"
data-key="share_people">
3
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4"
class="config-field-radio"
data-key="share_people">
4
</label>

<label class="pill">
<input type="radio" name="share_people"
value="4+"
class="config-field-radio"
data-key="share_people">
4+
</label>

</div>

</div>
<h4 class="mt-4">Capacity and Availability</h4>

<input type="number"
class="form-control config-field"
placeholder="Total no. of beds in PG"
data-key="pg_beds">

<div class="mt-2">

<label>
<input type="checkbox"
class="config-field"
data-key="attached_bathroom">
Attached Bathroom
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="attached_balcony">
Attached Balcony
</label>

</div>


<h4 class="mt-4">Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">
<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field" data-key="super_builtup_area_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox" class="config-field" data-key="pooja_room">
+ Pooja Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="study_room">
+ Study Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="servant_room">
+ Servant Room
</label>

<label class="pill">
<input type="checkbox" class="config-field" data-key="store_room">
+ Store Room
</label>

</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>



<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>



<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>

</div>


<h4 class="mt-4">Available from</h4>

<input type="date"
class="form-control config-field"
data-key="available_from">


<h4 class="mt-4">Available for</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="girls"> Girls
</label>

<label class="pill">
<input type="radio" name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="boys"> Boys
</label>

<label class="pill">
<input type="radio" name="pg_for"
class="config-field-radio"
data-key="pg_for"
value="any"> Any
</label>

</div>


<h4 class="mt-4">Suitable for</h4>

<label>
<input type="checkbox"
class="config-field"
data-key="students">
Students
</label>

<label class="ml-3">
<input type="checkbox"
class="config-field"
data-key="working_professionals">
Working Professionals
</label>

</div>

`;

}

else if (purpose === "sale" && parseInt(propertyType) === 8) {

html += `

<div class="config-wrapper">

<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony" value="0"
class="config-field-radio" data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony" value="1"
class="config-field-radio" data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony" value="2"
class="config-field-radio" data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony" value="3"
class="config-field-radio" data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony" value="3+"
class="config-field-radio" data-key="balcony">More than 3
</label>

</div>


<h4 class="mt-4">Add Area Details</h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Super built-up Area" data-key="super_builtup_area">
<select class="area-unit config-field" data-key="super_builtup_area_unit">
${areaUnits}
</select>
</div>



<h4 class="mt-4">Other rooms (Optional)</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>
</div>



<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>



<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Reserved Parking (Optional)</h4>

<div class="row">

<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>

</div>



<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>




<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}
else if (purpose === "rent" && parseInt(propertyType) === 8) {

html += `

<div class="config-wrapper">

<h4 class="mt-4">Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="bedrooms" value="1"
class="config-field-radio" data-key="bedrooms">1
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="2"
class="config-field-radio" data-key="bedrooms">2
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="3"
class="config-field-radio" data-key="bedrooms">3
</label>

<label class="pill">
<input type="radio" name="bedrooms" value="4"
class="config-field-radio" data-key="bedrooms">4
</label>

</div>


<p class="mt-3">Balconies</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="balcony" value="0"
class="config-field-radio" data-key="balcony">0
</label>

<label class="pill">
<input type="radio" name="balcony" value="1"
class="config-field-radio" data-key="balcony">1
</label>

<label class="pill">
<input type="radio" name="balcony" value="2"
class="config-field-radio" data-key="balcony">2
</label>

<label class="pill">
<input type="radio" name="balcony" value="3"
class="config-field-radio" data-key="balcony">3
</label>

<label class="pill">
<input type="radio" name="balcony" value="3+"
class="config-field-radio" data-key="balcony">More than 3
</label>

</div>


<h4 class="mt-4">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Carpet Area"
data-key="carpet_area">

<select class="area-unit config-field"
data-key="carpet_area_unit">

${areaUnits}
</select>

</div>


<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Built-up Area"
data-key="builtup_area">

<select class="area-unit config-field"
data-key="builtup_area_unit">

${areaUnits}

</select>

</div>


<div class="area-box mt-2">

<input type="text"
class="area-input config-field"
placeholder="Super built-up Area"
data-key="super_builtup_area">

<select class="area-unit config-field"
data-key="super_builtup_area_unit">

${areaUnits}
</select>

</div>



<h4 class="mt-4">Other rooms <span class="optional">(Optional)</span></h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="pooja_room"> + Pooja Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="study_room"> + Study Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="servant_room"> + Servant Room
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="store_room"> + Store Room
</label>

</div>



<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>



<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Reserved Parking</h4>

<div class="row">

<div class="col-md-6">

<label>Covered Parking</label>

<input type="number"
class="form-control config-field"
data-key="covered_parking">

</div>


<div class="col-md-6">

<label>Open Parking</label>

<input type="number"
class="form-control config-field"
data-key="open_parking">

</div>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>




<h4 class="mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="age"
value="0-1"
class="config-field-radio"
data-key="age">0-1 years
</label>

<label class="pill">
<input type="radio" name="age"
value="1-5"
class="config-field-radio"
data-key="age">1-5 years
</label>

<label class="pill">
<input type="radio" name="age"
value="5-10"
class="config-field-radio"
data-key="age">5-10 years
</label>

<label class="pill">
<input type="radio" name="age"
value="10+"
class="config-field-radio"
data-key="age">10+ years
</label>

</div>



<h4 class="mt-4">Available from</h4>

<input type="date"
class="form-control config-field"
data-key="available_from">



<h4 class="mt-4">Willing to rent out to</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="tenant_family"> Family
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="tenant_men"> Single men
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="tenant_women"> Single women
</label>

</div>


</div>

`;

}



if (purpose === "sale" && parseInt(propertyType) === 10) {

html += `

<div class="config-wrapper">

<h4>Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>



<p class="mt-3">Balconies</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Add Area Details</h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Other rooms</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>
</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>



<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Reserved Parking</h4>

<div class="row">
<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>
</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability" value="ready" class="availability-radio config-field-radio" data-key="availability">
Ready to move
</label>

<label class="pill">
<input type="radio" name="availability" value="construction" class="availability-radio config-field-radio" data-key="availability">
Under construction
</label>

</div>


<div id="age_section" style="display:none">

<h4 class="mt-4">Age of property</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>
</div>

</div>


<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}
else if (purpose === "rent" && parseInt(propertyType) === 10) {

html += `

<div class="config-wrapper">

<h4>Add Room Details</h4>

<p>No. of Bedrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bedrooms" value="1" class="config-field-radio" data-key="bedrooms">1</label>
<label class="pill"><input type="radio" name="bedrooms" value="2" class="config-field-radio" data-key="bedrooms">2</label>
<label class="pill"><input type="radio" name="bedrooms" value="3" class="config-field-radio" data-key="bedrooms">3</label>
<label class="pill"><input type="radio" name="bedrooms" value="4" class="config-field-radio" data-key="bedrooms">4</label>
</div>



<p class="mt-3">No. of Bathrooms</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="bathrooms" value="1" class="config-field-radio" data-key="bathrooms">1</label>
<label class="pill"><input type="radio" name="bathrooms" value="2" class="config-field-radio" data-key="bathrooms">2</label>
<label class="pill"><input type="radio" name="bathrooms" value="3" class="config-field-radio" data-key="bathrooms">3</label>
<label class="pill"><input type="radio" name="bathrooms" value="4" class="config-field-radio" data-key="bathrooms">4</label>
</div>



<p class="mt-3">Balconies</p>

<div class="pill-group">
<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>
<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>
<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>
<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>
<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>
</div>


<h4 class="mt-4">Add Area Details</h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_area_unit">
${areaUnits}
</select>
</div>

<div class="area-box mt-2">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_area_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Other rooms (Optional)</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="pooja_room"> + Pooja Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="study_room"> + Study Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="servant_room"> + Servant Room</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="store_room"> + Store Room</label>
</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>



<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>
<h4 class="mt-4">Reserved Parking</h4>

<div class="row">
<div class="col-md-6">
<label>Covered Parking</label>
<input type="number" class="form-control config-field" data-key="covered_parking">
</div>

<div class="col-md-6">
<label>Open Parking</label>
<input type="number" class="form-control config-field" data-key="open_parking">
</div>
</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>


<h4 class="mt-4">Age of property</h4>

<div class="pill-group">
<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>
<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>
<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>
<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>
</div>


<h4 class="mt-4">Available from</h4>

<input type="date" class="form-control config-field" data-key="available_from">


<h4 class="mt-4">Willing to rent out to</h4>

<div class="pill-group">
<label class="pill"><input type="checkbox" class="config-field" data-key="tenant_family"> + Family</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="tenant_men"> + Single men</label>
<label class="pill"><input type="checkbox" class="config-field" data-key="tenant_women"> + Single women</label>
</div>

</div>

`;

}

if(propertyType == 17 && subType == 15){

html += `

<div class="config-wrapper">

<h4>Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Add Room Details</h4>

<input type="number"
class="form-control config-field"
placeholder="Enter the total no. of rooms"
data-key="total_rooms">


<p class="mt-3">No. of Washrooms</p>

<div class="pill-group">

<label class="pill"><input type="radio" name="washrooms" value="none" class="config-field-radio" data-key="washrooms">None</label>

<label class="pill"><input type="radio" name="washrooms" value="shared" class="config-field-radio" data-key="washrooms">Shared</label>

<label class="pill"><input type="radio" name="washrooms" value="1" class="config-field-radio" data-key="washrooms">1</label>

<label class="pill"><input type="radio" name="washrooms" value="2" class="config-field-radio" data-key="washrooms">2</label>

<label class="pill"><input type="radio" name="washrooms" value="3" class="config-field-radio" data-key="washrooms">3</label>

<label class="pill"><input type="radio" name="washrooms" value="4" class="config-field-radio" data-key="washrooms">4</label>

</div>


<p class="mt-3">No. of Balconies</p>

<div class="pill-group">

<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>

<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>

<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>

<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>

<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>

</div>

<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>



<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>


<h4 class="mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability" value="ready" class="availability-radio">Ready to move
</label>

<label class="pill">
<input type="radio" name="availability" value="construction" class="availability-radio">Under construction
</label>

</div>


<div id="age_section" style="display:none;" class="mt-3">

<h4>Age of property</h4>

<div class="pill-group">

<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>

<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>

<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>

<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>

</div>

</div>


<div id="possession_section" style="display:none;" class="mt-3">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="mt-4">Quality Rating</h4>

<div class="pill-group">

<label class="pill"><input type="radio" name="rating" value="1" class="config-field-radio" data-key="rating">1 Star</label>

<label class="pill"><input type="radio" name="rating" value="2" class="config-field-radio" data-key="rating">2 Star</label>

<label class="pill"><input type="radio" name="rating" value="3" class="config-field-radio" data-key="rating">3 Star</label>

<label class="pill"><input type="radio" name="rating" value="4" class="config-field-radio" data-key="rating">4 Star</label>

<label class="pill"><input type="radio" name="rating" value="5" class="config-field-radio" data-key="rating">5 Star</label>

</div>

</div>

`;

}

if(propertyType == 17 && subType == 14){

html += `

<div class="config-wrapper">

<h4>Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Add Room Details</h4>

<input type="number"
class="form-control config-field"
placeholder="Enter the total no. of rooms"
data-key="total_rooms">


<p class="mt-3">No. of Washrooms</p>

<div class="pill-group">

<label class="pill"><input type="radio" name="washrooms" value="none" class="config-field-radio" data-key="washrooms">None</label>

<label class="pill"><input type="radio" name="washrooms" value="shared" class="config-field-radio" data-key="washrooms">Shared</label>

<label class="pill"><input type="radio" name="washrooms" value="1" class="config-field-radio" data-key="washrooms">1</label>

<label class="pill"><input type="radio" name="washrooms" value="2" class="config-field-radio" data-key="washrooms">2</label>

<label class="pill"><input type="radio" name="washrooms" value="3" class="config-field-radio" data-key="washrooms">3</label>

<label class="pill"><input type="radio" name="washrooms" value="4" class="config-field-radio" data-key="washrooms">4</label>

</div>


<p class="mt-3">No. of Balconies</p>

<div class="pill-group">

<label class="pill"><input type="radio" name="balcony" value="0" class="config-field-radio" data-key="balcony">0</label>

<label class="pill"><input type="radio" name="balcony" value="1" class="config-field-radio" data-key="balcony">1</label>

<label class="pill"><input type="radio" name="balcony" value="2" class="config-field-radio" data-key="balcony">2</label>

<label class="pill"><input type="radio" name="balcony" value="3" class="config-field-radio" data-key="balcony">3</label>

<label class="pill"><input type="radio" name="balcony" value="3+" class="config-field-radio" data-key="balcony">More than 3</label>

</div>


<h4 class="mt-4">Furnishing</h4>

<div class="pill-group">

<label class="pill">

<input type="radio"
name="furnishing"
value="furnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="semi"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Semi-furnished

</label>

<label class="pill">

<input type="radio"
name="furnishing"
value="unfurnished"
class="furnishing-radio config-field-radio"
data-key="furnishing">

Un-furnished

</label>

</div>



<div id="furnishing_items_box" style="display:none">

<div class="furnishing-grid">

<div class="form-group">
<label>Lights</label>
<input type="number" min="0" class="form-control config-field" data-key="light" placeholder="Enter number of lights">
</div>

<div class="form-group">
<label>Fans</label>
<input type="number" min="0" class="form-control config-field" data-key="fans" placeholder="Enter number of fans">
</div>

<div class="form-group">
<label>AC</label>
<input type="number" min="0" class="form-control config-field" data-key="ac" placeholder="Enter number of AC">
</div>

<div class="form-group">
<label>TV</label>
<input type="number" min="0" class="form-control config-field" data-key="tv" placeholder="Enter number of TVs">
</div>

<div class="form-group">
<label>Beds</label>
<input type="number" min="0" class="form-control config-field" data-key="beds" placeholder="Enter number of beds">
</div>

<div class="form-group">
<label>Wardrobe</label>
<input type="number" min="0" class="form-control config-field" data-key="wardrobe" placeholder="Enter number of wardrobes">
</div>

<div class="form-group">
<label>Geyser</label>
<input type="number" min="0" class="form-control config-field" data-key="geyser" placeholder="Enter number of geysers">
</div>

</div>

<hr>

<div class="checkbox-grid">

<label><input type="checkbox" class="config-field" data-key="sofa"> Sofa</label>
<label><input type="checkbox" class="config-field" data-key="washing_machine"> Washing Machine</label>
<label><input type="checkbox" class="config-field" data-key="fridge"> Fridge</label>
<label><input type="checkbox" class="config-field" data-key="microwave"> Microwave</label>
<label><input type="checkbox" class="config-field" data-key="chimney"> Chimney</label>
<label><input type="checkbox" class="config-field" data-key="stove"> Stove</label>
<label><input type="checkbox" class="config-field" data-key="water_purifier"> Water Purifier</label>
<label><input type="checkbox" class="config-field" data-key="modular_kitchen"> Modular Kitchen</label>
<label><input type="checkbox" class="config-field" data-key="dinning_table"> Dining Table</label>

</div>

</div>



<div id="furnishing_items" style="display:none;" class="mt-3">

<div class="row">

<div class="col-md-6">
<label><input type="checkbox" value="Light" class="config-field" data-key="furnish_items[]"> Light</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" value="Fans" class="config-field" data-key="furnish_items[]"> Fans</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" value="AC" class="config-field" data-key="furnish_items[]"> AC</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" value="TV" class="config-field" data-key="furnish_items[]"> TV</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" value="Beds" class="config-field" data-key="furnish_items[]"> Beds</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" value="Wardrobe" class="config-field" data-key="furnish_items[]"> Wardrobe</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" value="Fridge" class="config-field" data-key="furnish_items[]"> Fridge</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" value="Sofa" class="config-field" data-key="furnish_items[]"> Sofa</label>
</div>

</div>

</div>


<h4 class="mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability" value="ready" class="availability-radio">Ready to move
</label>

<label class="pill">
<input type="radio" name="availability" value="construction" class="availability-radio">Under construction
</label>

</div>


<div id="age_section" style="display:none;" class="mt-3">

<h4>Age of property</h4>

<div class="pill-group">

<label class="pill"><input type="radio" name="age" value="0-1" class="config-field-radio" data-key="age">0-1 years</label>

<label class="pill"><input type="radio" name="age" value="1-5" class="config-field-radio" data-key="age">1-5 years</label>

<label class="pill"><input type="radio" name="age" value="5-10" class="config-field-radio" data-key="age">5-10 years</label>

<label class="pill"><input type="radio" name="age" value="10+" class="config-field-radio" data-key="age">10+ years</label>

</div>

</div>


<div id="possession_section" style="display:none;" class="mt-3">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>
</div>


<h4 class="mt-4">Quality Rating</h4>

<div class="pill-group">

<label class="pill"><input type="radio" name="rating" value="1" class="config-field-radio" data-key="rating">1 Star</label>

<label class="pill"><input type="radio" name="rating" value="2" class="config-field-radio" data-key="rating">2 Star</label>

<label class="pill"><input type="radio" name="rating" value="3" class="config-field-radio" data-key="rating">3 Star</label>

<label class="pill"><input type="radio" name="rating" value="4" class="config-field-radio" data-key="rating">4 Star</label>

<label class="pill"><input type="radio" name="rating" value="5" class="config-field-radio" data-key="rating">5 Star</label>

</div>

</div>

`;

}
if(propertyType == 16 && subType == 13){

html += `

<div class="config-wrapper">

<h4 class="section-head">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="small-text">Atleast one area type is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head mt-4">Add Room Details</h4>
<p class="small-text">No. of Washrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washrooms" value="none" class="config-field-radio" data-key="washrooms">None
</label>

<label class="pill">
<input type="radio" name="washrooms" value="shared" class="config-field-radio" data-key="washrooms">Shared
</label>

<label class="pill">
<input type="radio" name="washrooms" value="1" class="config-field-radio" data-key="washrooms">1
</label>

<label class="pill">
<input type="radio" name="washrooms" value="2" class="config-field-radio" data-key="washrooms">2
</label>

<label class="pill">
<input type="radio" name="washrooms" value="3" class="config-field-radio" data-key="washrooms">3
</label>

<label class="pill">
<input type="radio" name="washrooms" value="4" class="config-field-radio" data-key="washrooms">4
</label>

</div>



<h4 class="section-head mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability_status" value="ready" class="availability-radio">Ready to move
</label>

<label class="pill">
<input type="radio" name="availability_status" value="construction" class="availability-radio">Under construction
</label>

</div>


<!-- READY TO MOVE SECTION -->
<div id="ready_section" style="display:none;">

<h4 class="section-head mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="age_property" value="0-1" class="config-field-radio" data-key="age_property">0-1 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="1-5" class="config-field-radio" data-key="age_property">1-5 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="5-10" class="config-field-radio" data-key="age_property">5-10 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="10+" class="config-field-radio" data-key="age_property">10+ years
</label>

</div>

</div>


<!-- UNDER CONSTRUCTION SECTION -->
<div id="construction_section" style="display:none;">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}
if(propertyType == 16 && subType == 12){

html += `

<div class="config-wrapper">

<h4 class="section-head">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="small-text">Atleast one area type is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head mt-4">Add Room Details</h4>
<p class="small-text">No. of Washrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washrooms" value="none" class="config-field-radio" data-key="washrooms">None
</label>

<label class="pill">
<input type="radio" name="washrooms" value="shared" class="config-field-radio" data-key="washrooms">Shared
</label>

<label class="pill">
<input type="radio" name="washrooms" value="1" class="config-field-radio" data-key="washrooms">1
</label>

<label class="pill">
<input type="radio" name="washrooms" value="2" class="config-field-radio" data-key="washrooms">2
</label>

<label class="pill">
<input type="radio" name="washrooms" value="3" class="config-field-radio" data-key="washrooms">3
</label>

<label class="pill">
<input type="radio" name="washrooms" value="4" class="config-field-radio" data-key="washrooms">4
</label>

</div>



<h4 class="section-head mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability_status" value="ready" class="availability-radio">Ready to move
</label>

<label class="pill">
<input type="radio" name="availability_status" value="construction" class="availability-radio">Under construction
</label>

</div>


<!-- READY TO MOVE SECTION -->
<div id="ready_section" style="display:none;">

<h4 class="section-head mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="age_property" value="0-1" class="config-field-radio" data-key="age_property">0-1 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="1-5" class="config-field-radio" data-key="age_property">1-5 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="5-10" class="config-field-radio" data-key="age_property">5-10 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="10+" class="config-field-radio" data-key="age_property">10+ years
</label>

</div>

</div>


<!-- UNDER CONSTRUCTION SECTION -->
<div id="construction_section" style="display:none;">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}

if(propertyType == 15 && subType == 10){

html += `

<div class="config-wrapper">

<h4 class="section-head">Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="small-text">Atleast one area type is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head mt-4">Add Room Details</h4>
<p class="small-text">No. of Washrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washrooms" value="none" class="config-field-radio" data-key="washrooms">None
</label>

<label class="pill">
<input type="radio" name="washrooms" value="shared" class="config-field-radio" data-key="washrooms">Shared
</label>

<label class="pill">
<input type="radio" name="washrooms" value="1" class="config-field-radio" data-key="washrooms">1
</label>

<label class="pill">
<input type="radio" name="washrooms" value="2" class="config-field-radio" data-key="washrooms">2
</label>

<label class="pill">
<input type="radio" name="washrooms" value="3" class="config-field-radio" data-key="washrooms">3
</label>

<label class="pill">
<input type="radio" name="washrooms" value="4" class="config-field-radio" data-key="washrooms">4
</label>

</div>



<h4 class="section-head mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability_status" value="ready" class="availability-radio">Ready to move
</label>

<label class="pill">
<input type="radio" name="availability_status" value="construction" class="availability-radio">Under construction
</label>

</div>


<!-- READY TO MOVE SECTION -->
<div id="ready_section" style="display:none;">

<h4 class="section-head mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="age_property" value="0-1" class="config-field-radio" data-key="age_property">0-1 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="1-5" class="config-field-radio" data-key="age_property">1-5 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="5-10" class="config-field-radio" data-key="age_property">5-10 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="10+" class="config-field-radio" data-key="age_property">10+ years
</label>

</div>

</div>


<!-- UNDER CONSTRUCTION SECTION -->
<div id="construction_section" style="display:none;">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}
if(propertyType == 15 && subType == 11){

html += `

<div class="config-wrapper">

<h4 class="section-head">Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span> </h4>
<p class="small-text">Atleast one area type is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head mt-4">Add Room Details</h4>
<p class="small-text">No. of Washrooms</p>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washrooms" value="none" class="config-field-radio" data-key="washrooms">None
</label>

<label class="pill">
<input type="radio" name="washrooms" value="shared" class="config-field-radio" data-key="washrooms">Shared
</label>

<label class="pill">
<input type="radio" name="washrooms" value="1" class="config-field-radio" data-key="washrooms">1
</label>

<label class="pill">
<input type="radio" name="washrooms" value="2" class="config-field-radio" data-key="washrooms">2
</label>

<label class="pill">
<input type="radio" name="washrooms" value="3" class="config-field-radio" data-key="washrooms">3
</label>

<label class="pill">
<input type="radio" name="washrooms" value="4" class="config-field-radio" data-key="washrooms">4
</label>

</div>



<h4 class="section-head mt-4">Availability Status</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="availability_status" value="ready" class="availability-radio">Ready to move
</label>

<label class="pill">
<input type="radio" name="availability_status" value="construction" class="availability-radio">Under construction
</label>

</div>


<!-- READY TO MOVE SECTION -->
<div id="ready_section" style="display:none;">

<h4 class="section-head mt-4">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="age_property" value="0-1" class="config-field-radio" data-key="age_property">0-1 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="1-5" class="config-field-radio" data-key="age_property">1-5 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="5-10" class="config-field-radio" data-key="age_property">5-10 years
</label>

<label class="pill">
<input type="radio" name="age_property" value="10+" class="config-field-radio" data-key="age_property">10+ years
</label>

</div>

</div>


<!-- UNDER CONSTRUCTION SECTION -->
<div id="construction_section" style="display:none;">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

</div>

`;

}


if(propertyType == 14 && subType == 9){

html += `

<div class="config-wrapper">

<h4 class="section-head">
Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span>
</h4>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Plot Area"
data-key="plot_area">

<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>

</div>



<h4 class="section-head mt-4">
Property Dimensions <span class="optional">(Optional)</span>
</h4>

<div class="dimension-box">

<input type="text"
class="form-control config-field"
placeholder="Length of plot (in Ft.)"
data-key="plot_length">

</div>

<div class="dimension-box">

<input type="text"
class="form-control config-field"
placeholder="Breadth of plot (in Ft.)"
data-key="plot_breadth">

</div>



<h4 class="section-head mt-4">
No. of open sides <span class="info">ⓘ</span>
</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="open_sides"
value="1"
class="config-field-radio"
data-key="open_sides">1
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="2"
class="config-field-radio"
data-key="open_sides">2
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3"
class="config-field-radio"
data-key="open_sides">3
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3+"
class="config-field-radio"
data-key="open_sides">3+
</label>

</div>



<h4 class="section-head mt-4">
Any construction done on this property? <span class="info">ⓘ</span>
</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="construction_done"
value="yes"
class="config-field-radio construction-radio"
data-key="construction_done">
Yes
</label>

<label class="pill">
<input type="radio"
name="construction_done"
value="no"
class="config-field-radio construction-radio"
data-key="construction_done">
No
</label>

</div>



<!-- CONSTRUCTION TYPE -->
<div id="construction_type_box" style="display:none">

<h4 class="section-head mt-4">
What type of construction has been done?
</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_shed">
+ Shed
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_rooms">
+ Room(s)
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_washroom">
+ Washroom
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_other">
+ Other
</label>

</div>

</div>



<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

`;

}
if(propertyType == 14 && subType == 8){

html += `

<div class="config-wrapper">

<h4 class="section-head">
Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span>
</h4>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Plot Area"
data-key="plot_area">

<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>

</div>



<h4 class="section-head mt-4">
Property Dimensions <span class="optional">(Optional)</span>
</h4>

<div class="dimension-box">

<input type="text"
class="form-control config-field"
placeholder="Length of plot (in Ft.)"
data-key="plot_length">

</div>

<div class="dimension-box">

<input type="text"
class="form-control config-field"
placeholder="Breadth of plot (in Ft.)"
data-key="plot_breadth">

</div>



<h4 class="section-head mt-4">
No. of open sides <span class="info">ⓘ</span>
</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="open_sides"
value="1"
class="config-field-radio"
data-key="open_sides">1
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="2"
class="config-field-radio"
data-key="open_sides">2
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3"
class="config-field-radio"
data-key="open_sides">3
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3+"
class="config-field-radio"
data-key="open_sides">3+
</label>

</div>



<h4 class="section-head mt-4">
Any construction done on this property? <span class="info">ⓘ</span>
</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="construction_done"
value="yes"
class="config-field-radio construction-radio"
data-key="construction_done">
Yes
</label>

<label class="pill">
<input type="radio"
name="construction_done"
value="no"
class="config-field-radio construction-radio"
data-key="construction_done">
No
</label>

</div>



<!-- CONSTRUCTION TYPE -->
<div id="construction_type_box" style="display:none">

<h4 class="section-head mt-4">
What type of construction has been done?
</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_shed">
+ Shed
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_rooms">
+ Room(s)
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_washroom">
+ Washroom
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_other">
+ Other
</label>

</div>

</div>



<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

`;

}
if(propertyType == 14 && subType == 7){

html += `

<div class="config-wrapper">

<h4 class="section-head">
Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span>
</h4>

<div class="area-box">

<input type="text"
class="area-input config-field"
placeholder="Plot Area"
data-key="plot_area">

<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>

</div>



<h4 class="section-head mt-4">
Property Dimensions <span class="optional">(Optional)</span>
</h4>

<div class="dimension-box">

<input type="text"
class="form-control config-field"
placeholder="Length of plot (in Ft.)"
data-key="plot_length">

</div>

<div class="dimension-box">

<input type="text"
class="form-control config-field"
placeholder="Breadth of plot (in Ft.)"
data-key="plot_breadth">

</div>



<h4 class="section-head mt-4">
No. of open sides <span class="info">ⓘ</span>
</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="open_sides"
value="1"
class="config-field-radio"
data-key="open_sides">1
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="2"
class="config-field-radio"
data-key="open_sides">2
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3"
class="config-field-radio"
data-key="open_sides">3
</label>

<label class="pill">
<input type="radio"
name="open_sides"
value="3+"
class="config-field-radio"
data-key="open_sides">3+
</label>

</div>



<h4 class="section-head mt-4">
Any construction done on this property? <span class="info">ⓘ</span>
</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="construction_done"
value="yes"
class="config-field-radio construction-radio"
data-key="construction_done">
Yes
</label>

<label class="pill">
<input type="radio"
name="construction_done"
value="no"
class="config-field-radio construction-radio"
data-key="construction_done">
No
</label>

</div>



<!-- CONSTRUCTION TYPE -->
<div id="construction_type_box" style="display:none">

<h4 class="section-head mt-4">
What type of construction has been done?
</h4>

<div class="pill-group">

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_shed">
+ Shed
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_rooms">
+ Room(s)
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_washroom">
+ Washroom
</label>

<label class="pill">
<input type="checkbox"
class="config-field"
data-key="construction_other">
+ Other
</label>

</div>

</div>


<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

`;

}
if(propertyType == 13 && subType == 5 && childType == 4){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>
</div>


<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}

if(propertyType == 13 && subType == 6 && childType == 5){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>

<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}


if(propertyType == 13 && subType == 6 && childType == 11){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}


if(propertyType == 13 && subType == 5 && childType == 10){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>


<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}

if(propertyType == 13 && subType == 6 && childType == 9){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>


<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}

if(propertyType == 13 && subType == 5 && childType == 8){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span>
</h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}

if(propertyType == 13 && subType == 6 && childType == 6){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>

<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}

if(propertyType == 13 && subType == 5 && childType == 7){

html += `

<div class="config-wrapper">

<h4 class="config-title">Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="config-sub">Carpet area is mandatory</p>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Plot Area" data-key="plot_area">
<select class="area-unit config-field" data-key="plot_unit">
${areaUnits}
</select>
</div>

<div class="area-box">
<input type="text" class="area-input config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="section-head">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
+ Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
+ Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="none" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>


<h4 class="section-head">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
+ Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
+ Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multi" class="config-field-radio" data-key="parking_type">
+ Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="none" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>
</div>

<h4 class="section-head">Shop facade size <span class="optional">(Optional)</span></h4>
<p class="small">Shop - front related details</p>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

<div class="row mt-2">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling Height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option>ft.</option>
<option>m</option>
</select>
</div>

</div>

</div>

`;

}

if(propertyType == 13 && subType == 6 && childType == 3){

html += `

<div class="config-section">

<h4>Add Area Details<span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="small-text">Carpet area is mandatory</p>

<div class="area-row">
<input type="text" class="form-control config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-row">
<input type="text" class="form-control config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="not_available" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>




<h4 class="mt-4">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multilevel" class="config-field-radio" data-key="parking_type">
Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="not_available" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>


<h4 class="mt-4">Shop facade size</h4>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option value="ft">ft.</option>
<option value="m">m</option>
</select>
</div>

</div>


<div class="row mt-3">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option value="ft">ft.</option>
<option value="m">m</option>
</select>
</div>

</div>

</div>

`;

}

if(propertyType == 13 && subType == 5 && childType == 2){

html += `

<div class="config-section">

<h4>Add Area Details <span class="area-help">

<i class="fa fa-question-circle"></i>

<div class="area-tooltip">

<div class="area-tip-item">

<strong>Carpet Area</strong>

<p>Carpet area that you can cover with a carpet. Doesn't include common areas like lift, lobby etc.</p>

</div>

<div class="area-tip-item">

<strong>Built-up Area</strong>

<p>Total carpet area + wall area.</p>

</div>

<div class="area-tip-item">

<strong>Super Built-up Area</strong>

<p>Built-up area + common areas like lift, lobby, stairs, elevator etc.</p>

</div>

</div>

</span></h4>
<p class="small-text">Carpet area is mandatory</p>

<div class="area-row">
<input type="text" class="form-control config-field" placeholder="Carpet Area" data-key="carpet_area">
<select class="area-unit config-field" data-key="carpet_unit">
${areaUnits}
</select>
</div>

<div class="area-row">
<input type="text" class="form-control config-field" placeholder="Built-up Area" data-key="builtup_area">
<select class="area-unit config-field" data-key="builtup_unit">
${areaUnits}
</select>
</div>


<h4 class="mt-4">Washroom details</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="washroom_type" value="private" class="config-field-radio" data-key="washroom_type">
Private washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="public" class="config-field-radio" data-key="washroom_type">
Public washrooms
</label>

<label class="pill">
<input type="radio" name="washroom_type" value="not_available" class="config-field-radio" data-key="washroom_type">
Not Available
</label>

</div>


<h4 class="mt-4">Floor Details</h4>

<div class="row">

    <!-- Total Floors -->
    <div class="col-md-6">
        <input type="number"
               class="form-control config-field"
               placeholder="Total Floors"
               data-key="total_floors"
               id="totalFloors"
               min="0">
    </div>

    <!-- Property Floor -->
    <div class="col-md-6">
        <select class="form-control config-field"
                data-key="property_floor"
                id="propertyFloor">
            <option value="">Property on floor</option>
        </select>
    </div>

</div>



<h4 class="mt-4">Parking Type</h4>

<div class="pill-group">

<label class="pill">
<input type="radio" name="parking_type" value="private" class="config-field-radio" data-key="parking_type">
Private Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="public" class="config-field-radio" data-key="parking_type">
Public Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="multilevel" class="config-field-radio" data-key="parking_type">
Multilevel Parking
</label>

<label class="pill">
<input type="radio" name="parking_type" value="not_available" class="config-field-radio" data-key="parking_type">
Not Available
</label>

</div>


<h4 class="mt-4">Availability Status</h4>

<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="ready">

Ready to move

</label>


<label class="pill">

<input type="radio"
name="availability"
class="config-field-radio availability-radio"
data-key="availability"
value="construction">

Under construction

</label>



<div id="age_section" style="display:none">

<h4 class="mt-3">Age of property</h4>

<div class="pill-group">

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="0-1"> 0-1 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="1-5"> 1-5 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="5-10"> 5-10 years
</label>

<label class="pill">
<input type="radio"
name="age"
data-key="age"
class="config-field-radio"
value="10+"> 10+ years
</label>

</div>
</div>



<div id="possession_section" style="display:none">

<h4 class="mt-3">Possession By</h4>

<select class="form-control config-field" data-key="possession_by">
    <option value="">Expected by</option>

    <!-- Duration -->
    <option value="1_month">1 Month</option>
    <option value="3_month">3 Months</option>
    <option value="6_month">6 Months</option>
    <option value="1_year">1 Year</option>

    <!-- Divider -->
   

    <!-- Years (Dynamic Blade) -->
    @php
        $currentYear = date('Y');
    @endphp

    @for($i = 0; $i <= 5; $i++)
        <option value="year_{{ $currentYear + $i }}">
            {{ $currentYear + $i }}
        </option>
    @endfor

</select>

</div>

<h4 class="mt-4">Shop facade size</h4>

<div class="row">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Entrance width" data-key="entrance_width">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="entrance_unit">
<option value="ft">ft.</option>
<option value="m">m</option>
</select>
</div>

</div>


<div class="row mt-3">

<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Ceiling height" data-key="ceiling_height">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="ceiling_unit">
<option value="ft">ft.</option>
<option value="m">m</option>
</select>
</div>

</div>

</div>

`;

}
$("#dynamic_config_fields").html(html);

if(purpose == existingPurpose && propertyType == existingPropertyType){

populateDynamicFields(existingConfig);

}
}


// trigger when type change
$("#purpose").change(loadDynamicFields);
$("#property_type_id").change(loadDynamicFields);
$("#sub_property_type_id").change(loadDynamicFields);
$("#child_sub_property_type_id").change(loadDynamicFields);

$("#dynamic_config_fields .config-field-radio:checked").each(function(){
let key = $(this).data("key");
let value = $(this).val();
data[key] = value;
});
// =========================================
// GENERATE JSON DATA
// =========================================

function generateConfigurationJSON(){

let data = {};

// text, number, select
$("#dynamic_config_fields .config-field").each(function(){

let key = $(this).data("key");

if($(this).attr("type") === "checkbox"){

data[key] = $(this).is(":checked") ? 1 : 0;

}else{

data[key] = $(this).val();

}

});

// radio buttons
$("#dynamic_config_fields .config-field-radio:checked").each(function(){

let key = $(this).data("key");

data[key] = $(this).val();

});

$("#configuration_json").val(JSON.stringify(data));

}
function populateDynamicFields(data){

if(!data) return;

/* TEXT / NUMBER / SELECT */
$("#dynamic_config_fields .config-field").each(function(){

let key = $(this).data("key");

if(!key) return;

if(data[key] !== undefined){

if($(this).attr("type") !== "checkbox"){
$(this).val(data[key]);
}

}

});


/* RADIO BUTTONS */
$("#dynamic_config_fields .config-field-radio").each(function(){

let key = $(this).data("key");

if(!key) return;

if(data[key] == $(this).val()){
$(this).prop("checked", true);
}

});


/* CHECKBOX */
$("#dynamic_config_fields input[type='checkbox']").each(function(){

let key = $(this).data("key");

if(!key) return;


/* ARRAY CHECKBOX (example other_rooms[]) */

if(key.includes("[]")){

let baseKey = key.replace("[]","");

if(Array.isArray(data[baseKey]) && data[baseKey].includes($(this).val())){
$(this).prop("checked", true);
}

}

/* NORMAL CHECKBOX */

else{

if(data[key] == 1 || data[key] == true){
$(this).prop("checked", true);
}

}

});

}        // Debounce
        function debounce(func, wait){
            let timeout;
            return function(){
                clearTimeout(timeout);
                timeout = setTimeout(()=>func.apply(this, arguments), wait);
            };
        }

        // Address autocomplete
(function(){

    const addressInput = document.getElementById('address');
    const resultsElement = document.getElementById('results-list');

    const localityInput = document.getElementById('locality');
    const subLocalityInput = document.getElementById('sub_locality');

    const localityResults = document.getElementById('locality-results');
    const subLocalityResults = document.getElementById('sublocality-results');

    if (!addressInput || !resultsElement) return;

    let controller;

    // =========================
    // ADDRESS SEARCH
    // =========================
    addressInput.addEventListener('keyup', debounce(function(){

        const keyword = this.value.trim();

        if(keyword.length < 2){
            resultsElement.style.display='none';
            return;
        }

        if(controller) controller.abort();
        controller = new AbortController();

        resultsElement.innerHTML = "<li>Loading...</li>";
        resultsElement.style.display='block';

        fetch(`https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&q=${encodeURIComponent(keyword)}`,{
            signal: controller.signal
        })
        .then(r=>r.json())
        .then(data=>{

            resultsElement.innerHTML='';

            if(data && data.length){

                let html='';

                data.slice(0,5).forEach(function(v){

                    html += `
                        <li 
                            data-lat="${v.lat}" 
                            data-lon="${v.lon}" 
                            data-full="${v.display_name}">
                            ${v.display_name}
                        </li>`;
                });

                resultsElement.innerHTML=html;
                resultsElement.style.display='block';

            }else{
                resultsElement.innerHTML = "<li>No result found</li>";
            }

        })
        .catch(()=>{
            resultsElement.style.display='none';
        });

    },400));


    // =========================
    // ADDRESS SELECT
    // =========================
    resultsElement.addEventListener('click', function(e){

        if(e.target.tagName.toLowerCase()==='li'){

            const lat = e.target.dataset.lat;
            const lon = e.target.dataset.lon;
            const full = e.target.dataset.full;

            $('#address').val(full);
            $('#full_address').val(full);
            $('#lat').val(lat);
            $('#lng').val(lon);

            if(typeof map !== "undefined" && map){
                map.setView([lat,lon],14);

                if(typeof currentMarker !== "undefined" && currentMarker){
                    map.removeLayer(currentMarker);
                }

                currentMarker = L.marker([lat,lon]).addTo(map);
            }

            // reverse for locality
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
            .then(res=>res.json())
            .then(data=>{

                if(data.address){

                    const addr = data.address;

                    let city = addr.city || addr.town || addr.village || addr.state_district || '';
                    let locality = addr.suburb || addr.neighbourhood || addr.hamlet || '';
                    let sub = addr.neighbourhood || addr.suburb || '';

                    if(!locality) locality = city;
                    if(!sub) sub = locality;

                    $('#city').val(city);
                    $('#locality').val(locality);
                    $('#sub_locality').val(sub);
                }

            });

            resultsElement.style.display='none';
        }

    });


    // =========================
    // 🔥 LOCALITY SEARCH (NEW)
    // =========================
    function setupSearch(input, resultsBox){

        if(!input || !resultsBox) return;

        let ctrl;

        input.addEventListener('keyup', debounce(function(){

            const keyword = this.value.trim();

            if(keyword.length < 2){
                resultsBox.style.display='none';
                return;
            }

            if(ctrl) ctrl.abort();
            ctrl = new AbortController();

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(keyword)}`,{
                signal: ctrl.signal
            })
            .then(res=>res.json())
            .then(data=>{

                resultsBox.innerHTML='';

                if(data.length){

                    let html = '';

                    data.slice(0,5).forEach(v=>{
                        html += `<li>${v.display_name}</li>`;
                    });

                    resultsBox.innerHTML = html;
                    resultsBox.style.display='block';

                }else{
                    resultsBox.style.display='none';
                }

            });

        },400));

        // select
        resultsBox.addEventListener('click', function(e){

            if(e.target.tagName.toLowerCase()==='li'){
                input.value = e.target.innerText;
                resultsBox.style.display='none';
            }

        });

    }

    // init locality search
    setupSearch(localityInput, localityResults);
    setupSearch(subLocalityInput, subLocalityResults);


    // =========================
    // CLICK OUTSIDE CLOSE
    // =========================
    document.addEventListener('click', function(e){

        if(!addressInput.contains(e.target) && !resultsElement.contains(e.target)){
            resultsElement.style.display='none';
        }

        if(localityResults && !localityInput.contains(e.target) && !localityResults.contains(e.target)){
            localityResults.style.display='none';
        }

        if(subLocalityResults && !subLocalityInput.contains(e.target) && !subLocalityResults.contains(e.target)){
            subLocalityResults.style.display='none';
        }

    });

})();
        // -------------------------
        // AJAX step save (on Next)
        // -------------------------
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
$(document).on("click","#add_area_row",function(){

let row = `

<div class="area-row">

<select class="area-type config-field" data-key="area_type">
<option value="carpet">Carpet Area</option>
<option value="super_builtup">Super built-up Area</option>
<option value="builtup">Built-up Area</option>
</select>

<input type="number" class="area-input config-field" data-key="area_value">

<select class="area-unit config-field" data-key="area_unit">
${areaUnits}
</select>

</div>

`;

$("#area_container").append(row);

});
$("#area_container .area-row").each(function(){

let type = $(this).find('[data-key="area_type"]').val();
let value = $(this).find('[data-key="area_value"]').val();
let unit = $(this).find('[data-key="area_unit"]').val();

areas.push({
type:type,
value:value,
unit:unit
});

});


$(document).on("change",".availability-radio",function(){

let value = $(this).val();

if(value == "ready"){

$("#ready_section").show();
$("#construction_section").hide();

}

if(value == "construction"){

$("#ready_section").hide();
$("#construction_section").show();

}

});


$(document).on("change",".availability-radio",function(){

let val = $(this).val();

if(val == "ready"){

$("#age_section").show();
$("#possession_section").hide();

}

if(val == "construction"){

$("#age_section").hide();
$("#possession_section").show();

}

});


$(document).on("change",".furnishing-radio",function(){

let val = $(this).val();

if(val == "furnished" || val == "semi"){

$("#furnishing_items").show();

}else{

$("#furnishing_items").hide();

}

});
$(document).on("change",".furnishing-radio",function(){

let val = $(this).val();

if(val == "furnished" || val == "semi"){
$("#furnishing_items_box").show();
}else{
$("#furnishing_items_box").hide();
}

});
$(document).on("change",".room-type-radio",function(){

let val = $(this).val();

if(val === "sharing"){
$("#sharing_people_box").show();
}else{
$("#sharing_people_box").hide();
}

});



$(document).on("click",".plus",function(){

let parent=$(this).closest(".furnishing-item");
let count=parent.find(".count");

let value=parseInt(count.text());
value++;

count.text(value);
parent.find(".furnishing-value").val(value);

});

$(document).on("click",".minus",function(){

let parent=$(this).closest(".furnishing-item");
let count=parent.find(".count");

let value=parseInt(count.text());

if(value>0){
value--;
}

count.text(value);
parent.find(".furnishing-value").val(value);

});


$(document).on("click",".plus",function(){

let counter=$(this).siblings(".parking-count");

let val=parseInt(counter.text());

counter.text(val+1);

});


$(document).on("click",".minus",function(){

let counter=$(this).siblings(".parking-count");

let val=parseInt(counter.text());

if(val>0){
counter.text(val-1);
}

});
function goToStep(step) {

    $('.step-section').hide();
    $('#step-' + step).show();

    if (step == 2) {

        setTimeout(function () {

            if (!map) {
                initLeafletMap();
            }

            map.invalidateSize(); // 🔥 MAIN FIX

        }, 500);
    }
}
        function collectStepData(stepId) {
            const fd = new FormData();
            const propId = $("#property_id").val();
            if (propId) fd.append('property_id', propId);
            fd.append('step', stepId);

            $('#property_form').find('input, select, textarea').each(function() {
                const el = $(this);
                const name = el.attr('name');
                if (!name) return;

                // File handling
                if (el.attr('type') === 'file') {
                    const files = el[0].files;
                    if (files && files.length) {
                        if (el.prop('multiple')) {
                            for (let i = 0; i < files.length; i++) fd.append(name, files[i]);
                        } else {
                            fd.append(name, files[0]);
                        }
                    }
                    return;
                }

                // checkboxes and radio: append only checked
                if (el.is(':checkbox')) {
                    if (name.endsWith('[]')) {
                        if (el.is(':checked')) fd.append(name, el.val());
                    } else {
                        if (el.is(':checked')) fd.append(name, el.val());
                    }
                    return;
                }

                // normal inputs (including arrays)
                if (name.endsWith('[]')) {
                    fd.append(name, el.val());
                } else {
                    fd.append(name, el.val());
                }
            });

            return fd;
        }

$(".step-next").off('click').on("click", function(e){
    e.preventDefault();

    generateConfigurationJSON();

    // CURRENT STEP
    var current = $(".step-section.active").attr("id").replace("step-","");
    var next = $(this).data("next");

    var fd = new FormData($('#property_form')[0]);
    fd.append('step', current);

    console.log("Saving Step:", current);

    $.ajax({
        url: "{{ route('admin.property.save-step') }}",
        method: "POST",
        data: fd,
        contentType: false,
        processData: false,

        beforeSend: function(){
            $('.step-next, .step-prev, .save_btn').prop('disabled', true);
        },

        success: function(res){


            $('.step-next, .step-prev, .save_btn').prop('disabled', false);

            if (res.status === 'success' || res.status === true) {

                // PROPERTY ID
                if (res.property_id) {
                    $("#property_id").val(res.property_id);
                }

                // STEP UI
                $(".property-steps li").removeClass("active");
                $('.property-steps li[data-step="'+next+'"]').addClass("active");

                $(".step-section").removeClass("active");
                $("#step-"+next).addClass("active");

                // 🔥🔥🔥 MAP FIX (MAIN ADD)
                if (next == 2) {
                    setTimeout(function () {

                        if (typeof map !== "undefined" && map) {
                            map.invalidateSize(); // 🔥 MAIN FIX
                        }

                    }, 500);
                }

                // SCROLL
                $('html, body').animate({
                    scrollTop: $(".property-wrapper").offset().top - 20
                }, 200);

                // SUCCESS
                if (typeof toastr !== 'undefined') {
                    toastr.success(res.message || 'Step saved successfully');
                }

            } else {

                let msg = res.message || "Something went wrong";

                if (typeof toastr !== 'undefined') {
                    toastr.error(msg);
                } else {
                    alert(msg);
                }
            }
        },

        error: function(xhr){

            $('.step-next, .step-prev, .save_btn').prop('disabled', false);

            let msg = "Server error occurred";

            if (xhr.status === 422 && xhr.responseJSON) {

                let errors = xhr.responseJSON.errors || xhr.responseJSON;
                msg = '';

                if (typeof errors === 'object') {
                    $.each(errors, function(k, v){
                        msg += (v[0] ? v[0] : v) + '\n';
                    });
                }

            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }

            if (typeof toastr !== 'undefined') {
                toastr.error(msg);
            } else {
                alert(msg);
            }
        }
    });
});


// PREVIOUS BUTTON
$(".step-prev").off('click').on("click", function(e){
    e.preventDefault();

    var prev = $(this).data("prev");

    $(".property-steps li").removeClass("active");
    $('.property-steps li[data-step="'+prev+'"]').addClass("active");

    $(".step-section").removeClass("active");
    $("#step-"+prev).addClass("active");

    // 🔥 OPTIONAL MAP FIX (BACK PE BHI)
    if (prev == 2) {
        setTimeout(function () {
            if (typeof map !== "undefined" && map) {
                map.invalidateSize();
            }
        }, 500);
    }

    $('html, body').animate({
        scrollTop: $(".property-wrapper").offset().top - 20
    }, 200);
});    // -------------------------
        // On page load: set dynamic selects for edit case
        // -------------------------
        @if(isset($property))
            // If category exists, trigger load types then set property_type_id
            var existingCategory = "{{ $property->category_type ?? '' }}";
            var existingType = "{{ $property->property_type_id ?? '' }}";
            var existingSubType = "{{ $property->sub_property_type_id ?? '' }}";
            var existingChildSub = "{{ $property->child_sub_property_type_id ?? '' }}";

            if(existingCategory){
                // request types then set selected
                $.get("{{ url('/admin/get-property-types') }}/"+existingCategory, function(data){
                    let html = '<option value="">Select</option>';
                    data.forEach(function(item){ html += `<option value="${item.id}">${item.name}</option>`; });
                    $("#property_type_id").html(html).val(existingType).trigger('change');
                }).fail(function(){ $("#property_type_id").val(existingType).trigger('change'); });

                // load sub types after property_type loaded
                if(existingType){
                    $.get("/admin/get-sub-types/"+existingType, function(data){
                        if(data.length > 0){
                            $("#sub_type_box").removeClass("d-none");
                            let html = '<option value="">Select</option>';
                            data.forEach(function(item){ html += `<option value="${item.id}">${item.name}</option>`; });
                            $("#sub_property_type_id").html(html).val(existingSubType).trigger('change');
                        }
                    });
                }

                // load child sub types after sub selected
                if(existingSubType){
                    $.get("/admin/get-child-sub-types/"+existingSubType, function(data){
                        if(data.length > 0){
                            $("#child_sub_type_box").removeClass("d-none");
                            let html = '<option value="">Select</option>';
                            data.forEach(function(item){ html += `<option value="${item.id}">${item.name}</option>`; });
                            $("#child_sub_property_type_id").html(html).val(existingChildSub);
                        }
                    });
                }
            }

            // load cities for selected country
           // LOAD STATE + CITY ON EDIT
let existingCountry = "{{ $property->country_id ?? '' }}";
let existingState   = "{{ $property->state_id ?? '' }}";
let existingCity    = "{{ $property->city_id ?? '' }}";

// 🔥 LOADING TEMPLATE
function loadingOption(text = "Loading..."){
    return `<option value="">${text}</option>`;
}

// 🔥 COUNTRY CHANGE → LOAD STATES
$('#country_id').on('change', function () {

    let countryId = $(this).val();

    $('#state_id').html(loadingOption('Loading states...')).trigger('change');
    $('#city_id').html('<option value="">Select City</option>').trigger('change');

    if(countryId){

        $.ajax({
             url: `/get-states/${countryId}`,// ✅ correct path
            type: "GET",

            success: function(states){

                let options = '<option value="">Select State</option>';

                if(states && states.length > 0){
                    states.forEach(state => {
                        options += `<option value="${state.id}">${state.name}</option>`;
                    });
                } else {
                    options = '<option value="">No states found</option>';
                }

                $('#state_id').html(options).trigger('change');

                // 🔥 EDIT MODE AUTO STATE
                if(existingState){
                    $('#state_id').val(existingState).trigger('change');
                    existingState = null;
                }
            },

            error: function(xhr){
                console.error("State error:", xhr.responseText);
                $('#state_id').html('<option value="">Error loading states</option>').trigger('change');
            }
        });

    } else {
        $('#state_id').html('<option value="">Select State</option>').trigger('change');
    }
});


// 🔥 STATE CHANGE → LOAD CITIES
$('#state_id').on('change', function () {

    let stateId = $(this).val();

    $('#city_id').html(loadingOption('Loading cities...')).trigger('change');

    if(stateId){

        $.ajax({
            url: `/get-cities/${stateId}`,
            type: "GET",

            success: function(cities){

                let options = '<option value="">Select City</option>';

                if(cities && cities.length > 0){
                    cities.forEach(city => {
                        options += `<option value="${city.id}">${city.name}</option>`;
                    });
                } else {
                    options = '<option value="">No cities found</option>';
                }

                $('#city_id').html(options).trigger('change');

                // 🔥 EDIT MODE AUTO CITY
                if(existingCity){
                    $('#city_id').val(existingCity).trigger('change');
                    existingCity = null;
                }
            },

            error: function(xhr){
                console.error("City error:", xhr.responseText);
                $('#city_id').html('<option value="">Error loading cities</option>').trigger('change');
            }
        });

    } else {
        $('#city_id').html('<option value="">Select City</option>').trigger('change');
    }
});


// 🔥 PAGE LOAD AUTO (EDIT MODE)
$(document).ready(function(){
    if(existingCountry){
        $('#country_id').trigger('change');
    }
});


// 🔥 PAGE LOAD (EDIT MODE AUTO)
$(document).ready(function(){
    if(existingCountry){
        $('#country_id').trigger('change');
    }
});
            
            
            

            // show/hide rent period if purpose = rent
            var purposeVal = "{{ $property->purpose ?? '' }}";
            if(purposeVal == 'rent'){ $("#rend_period_box").removeClass('d-none'); }
        @endif

    });
})(jQuery);



</script>
<script>
$(document).on("change",".pantry-radio",function(){
if($(this).val() != "not_available"){
$("#pantry_size_box").show();
}else{
$("#pantry_size_box").hide();
}
});

$(document).on("change",".lifts-radio",function(){
if($(this).val()=="available"){
$("#lift_counter_box").show();
}else{
$("#lift_counter_box").hide();
}
});

$(document).on("change",".parking-radio",function(){
if($(this).val()=="available"){
$("#parking_details_box").show();
}else{
$("#parking_details_box").hide();
}
});


let existingConfig = @json(
    optional($property)->configuration_json
        ? json_decode(optional($property)->configuration_json, true)
        : []
);

let existingPurpose = "{{ $property->purpose ?? '' }}";
let existingPropertyType = "{{ $property->property_type_id ?? '' }}";
$(document).on("change",".construction-radio",function(){

if($(this).val()=="yes"){

$("#construction_type_box").slideDown();

}else{

$("#construction_type_box").slideUp();

}

});
</script>


<script>
$(document).ready(function(){

    const container = $('#step-5 #dynamicStep4Form');

    $('#property_type_id, #sub_property_type_id, #child_sub_property_type_id, #purpose').on('change', function(){
        loadStep4Form();
    });

    loadStep4Form();
setTimeout(function(){
    setOldData();
    triggerAllToggles();
}, 200);
    function loadStep4Form(){

        let propertyType = $('#property_type_id').val();
        let subType = $('#sub_property_type_id').val();
        let childType = $('#child_sub_property_type_id').val();
        let purpose = $('#purpose').val();

        let html = '';


        // =========================
        // 🟢 SALE + RESIDENTIAL
        // =========================
        if(purpose == 'sale' && propertyType == 1){

            html += `
         
<div class="card mt-3">
    <div class="card-body">


        <h5>Ownership</h5>

        <div class="mb-3">
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="freehold"> Freehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="leasehold"> Leasehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="cooperative"> Co-operative society</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="poa"> Power of Attorney</label>
        </div>

        <h5>Price Details</h5>

        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Expected Price" data-key="expected_price">
            </div>

            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Price per sq.ft." data-key="price_per_sqft">
            </div>
        </div>
<div class="mt-2 text-success font-weight-bold" id="priceInWords"></div>

        <div class="mt-2">
            <label>
                <input type="checkbox" class="config-field" data-key="all_inclusive" value="1">
                All inclusive price
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="tax_excluded" value="1">
                Tax and Govt. charges excluded
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="negotiable" value="1">
                Price Negotiable
            </label>
        </div>

        <h6 class="mt-3">Additional Pricing Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Expected rental" data-key="expected_rent">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Annual dues payable" data-key="annual_dues">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
   <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="0"> No
        </label>

        <!-- 🔥 Hidden Section -->
        <div id="brokerage_section" style="display:none;" class="mt-3">

            <div class="mb-2">

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="fixed">
                    Fixed
                </label>

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="percentage">
                    Percentage of Price
                </label>

            </div>

            <input type="number" class="form-control config-field"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" 
                data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        placeholder="Share some details about your property like spacious rooms, well maintained facilities..."
        rows="4"></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;
        }

        // =========================
        // 🔴 RENT + RESIDENTIAL
        // =========================
         else if(purpose == 'rent' && propertyType == 1){

html += `
<div class="card mt-3">
    <div class="card-body">

        <h5>Preferred agreement type</h5>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="company">
            Company lease agreement
        </label>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="any">
            Any
        </label>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>Rent Details</h5>

        <input type="number" class="form-control config-field mt-2"
        placeholder="₹ Expected Rent" data-key="expected_rent">

<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
        <label class="mt-2">
            <input type="checkbox" class="config-field" data-key="electricity_included" value="1">
            Electricity & Water charges excluded
        </label>

        <label class="ml-3">
            <input type="checkbox" class="config-field" data-key="rent_negotiable" value="1">
            Price Negotiable
        </label>

        <h6 class="mt-3">Additional Rent Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Security deposit (Optional)</h5>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed">
            Fixed
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple">
            Multiple of Rent
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none">
            None
        </label>

        <div id="deposit_input" class="mt-2" style="display:none;">
            <input type="number" class="form-control config-field"
            placeholder="Deposit value / No. of months"
            data-key="deposit_value">
        </div>

    </div>
</div>

<!-- 🔥 BROKERAGE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No
        </label>

        <div id="brokerage_section" style="display:none;" class="mt-3">

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed">
                Fixed
            </label>

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage">
                Percentage of Price
            </label>

            <input type="number" class="form-control config-field mt-2"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<!-- 🔥 AGREEMENT DURATION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Duration of agreement (Optional)</h5>

        <select class="form-control config-field" data-key="agreement_duration">
            <option value="">Select</option>
            <option value="11_months">11 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select>

    </div>
</div>

<!-- 🔥 NOTICE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Months of Notice (Optional)</h5>

        <div>
            ${['none','1','2','3','4','5','6'].map(v=>`
            <label class="pill">
                <input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
                ${v=='none'?'None':v+' months'}
            </label>`).join('')}
        </div>

    </div>
</div>

<!-- 🔥 DESCRIPTION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        rows="4"
        placeholder="Share some details about your property..."></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;    
         }
else if(purpose == 'pg'){

html += `

<!-- 🔥 RENT DETAILS -->
<div class="card mt-3"><div class="card-body">

<h5>Rent Details</h5>

<input type="number" class="form-control config-field mt-2"
placeholder="₹ Expected Rent" data-key="expected_rent">
<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>

<h6 class="mt-3">Additional Rent Details (Optional)</h6>

<div class="row">
<div class="col-md-6">
<input type="text" class="form-control config-field" placeholder="Maintenance" data-key="maintenance">
</div>

<div class="col-md-6">
<select class="form-control config-field" data-key="maintenance_type">
<option value="monthly">Monthly</option>
</select>
</div>

<div class="col-md-6 mt-2">
<input type="number" class="form-control config-field" placeholder="Booking Amount" data-key="booking_amount">
</div>

<div class="col-md-6 mt-2">
<input type="number" class="form-control config-field" placeholder="Membership charge" data-key="membership_charge">
</div>
</div>

</div></div>


<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3"><div class="card-body">

<h5>Security deposit</h5>

<label class="pill"><input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed"> Fixed</label>
<label class="pill"><input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple"> Multiple of Rent</label>
<label class="pill"><input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none"> None</label>

<div id="deposit_input" style="display:none;">
<input type="number" class="form-control config-field mt-2"
placeholder="Deposit value / No. of months" data-key="deposit_value">
</div>

</div></div>


<!-- 🔥 BROKERAGE -->
<div class="card mt-3"><div class="card-body">

<h5>Do you charge brokerage?</h5>

<label><input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes</label>
<label class="ml-3"><input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No</label>

<div id="brokerage_section" style="display:none;" class="mt-2">

<label class="pill"><input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed"> Fixed</label>
<label class="pill"><input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage"> Percentage of Price</label>

<input type="number" class="form-control config-field mt-2"
placeholder="Enter brokerage here" data-key="brokerage_amount">

<label class="mt-2">
<input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1"> Brokerage Negotiable
</label>

</div>

</div></div>


<!-- 🔥 TOTAL PRICE INCLUDES -->
<div class="card mt-3"><div class="card-body">

<h5>Total price includes</h5>

${['Laundry','Electricity','Water','Wifi','Housekeeping','DTH','None'].map(v=>`
<label class="pill"><input type="checkbox" class="config-field" data-key="include_${v.toLowerCase()}" value="1"> ${v}</label>
`).join('')}

</div></div>


<!-- 🔥 SERVICES -->
<div class="card mt-3"><div class="card-body">

<h5>Services Excluding Price</h5>

${['Laundry','Water','Wifi','Housekeeping','DTH','Electricity'].map(v=>`
<div class="mt-2">
<p>${v}</p>
<label><input type="radio" name="${v}" class="config-field" data-key="${v.toLowerCase()}" value="no"> Not available</label>
<label class="ml-2"><input type="radio" name="${v}" class="config-field" data-key="${v.toLowerCase()}" value="extra"> Available for extra charge</label>
</div>
`).join('')}

</div></div>


<!-- 🔥 FOOD -->
<div class="card mt-3"><div class="card-body">

<h5>Food details</h5>

<label class="pill">
<input type="radio" name="food_available" class="config-field food-toggle" data-key="food_available" value="1"> Available
</label>

<label class="pill">
<input type="radio" name="food_available" class="config-field food-toggle" data-key="food_available" value="0"> Not Available
</label>

<div id="food_section" style="display:none;">

<h6 class="mt-2">Meal type</h6>
<label class="pill"><input type="radio" name="meal_type" class="config-field" data-key="meal_type" value="veg"> Only Veg</label>
<label class="pill"><input type="radio" name="meal_type" class="config-field" data-key="meal_type" value="both"> Veg & Non Veg</label>

<h6 class="mt-2">Availability of meal on weekdays</h6>
${['breakfast','lunch','dinner'].map(v=>`
<label class="pill">
<input type="checkbox" class="config-field" data-key="weekday_${v}" value="1"> ${v}
</label>`).join('')}

<h6 class="mt-2">Availability of meal on weekends</h6>
${['breakfast','lunch','dinner'].map(v=>`
<label class="pill">
<input type="checkbox" class="config-field" data-key="weekend_${v}" value="1"> ${v}
</label>`).join('')}

<h6 class="mt-2">Charges for Food</h6>

<label class="pill">
<input type="radio" name="food_charge_type" class="config-field food-charge-toggle" data-key="food_charge_type" value="included">
Included in rent
</label>

<label class="pill">
<input type="radio" name="food_charge_type" class="config-field food-charge-toggle" data-key="food_charge_type" value="per_meal">
Per meal basis
</label>

<label class="pill">
<input type="radio" name="food_charge_type" class="config-field food-charge-toggle" data-key="food_charge_type" value="fixed">
Fixed monthly amount
</label>

<!-- 🔥 PER MEAL -->
<div id="per_meal_section" style="display:none;">
<input type="number" class="form-control config-field mt-2" placeholder="Breakfast" data-key="breakfast_price">
<input type="number" class="form-control config-field mt-2" placeholder="Lunch" data-key="lunch_price">
<input type="number" class="form-control config-field mt-2" placeholder="Dinner" data-key="dinner_price">
</div>

<!-- 🔥 FIXED -->
<div id="fixed_food_section" style="display:none;">
<input type="number" class="form-control config-field mt-2" placeholder="Enter food charges" data-key="food_fixed_price">
</div>

</div>

</div></div>

<!-- 🔥 CONTRACT -->
<div class="card mt-3"><div class="card-body">

<h5>Minimum contract duration</h5>

<select class="form-control config-field" data-key="contract_duration">
<option value="0">0 months</option>
<option value="6">6 months</option>
<option value="12">12 months</option>
</select>

</div></div>


<!-- 🔥 NOTICE -->
<div class="card mt-3"><div class="card-body">

<h5>Months of Notice</h5>

${['none','1','2','3','4','5','6'].map(v=>`
<label class="pill"><input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
${v=='none'?'None':v+' month'}
</label>`).join('')}

</div></div>


<!-- 🔥 EARLY EXIT -->
<div class="card mt-3"><div class="card-body">

<h5>Early leaving charges</h5>

<label class="pill">
<input type="radio" name="early" class="config-field early-toggle" data-key="early" value="none"> None
</label>

<label class="pill">
<input type="radio" name="early" class="config-field early-toggle" data-key="early" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="early" class="config-field early-toggle" data-key="early" value="multiple"> Multiple of Rent
</label>

<div id="early_fixed" style="display:none;">
<input type="number" class="form-control config-field mt-2"
placeholder="Enter Fixed Amount"
data-key="early_fixed_amount">
</div>

<div id="early_multiple" style="display:none;">
<input type="number" class="form-control config-field mt-2"
placeholder="Enter no. of Months"
data-key="early_months">
</div>

</div></div>


<!-- 🔥 RULES -->
<div class="card mt-3"><div class="card-body">

<h5>House Rules</h5>

${['Pets','Visitors','Smoking','Alcohol','Party'].map(v=>`
<div>
<label>${v} allowed</label>
<label><input type="radio" name="${v}" class="config-field" data-key="${v.toLowerCase()}" value="yes"> Yes</label>
<label><input type="radio" name="${v}" class="config-field" data-key="${v.toLowerCase()}" value="no"> No</label>
</div>
`).join('')}


<div class="mt-3">

    <label>Last entry time</label>

    <select class="form-control config-field" data-key="last_entry_time">
        <option value="">Select</option>
        <option value="7 PM">7 PM</option>
        <option value="7:30 PM">7:30 PM</option>
        <option value="8 PM">8 PM</option>
        <option value="8:30 PM">8:30 PM</option>
        <option value="9 PM">9 PM</option>
        <option value="9:30 PM">9:30 PM</option>
        <option value="10 PM">10:30 PM</option>
        <option value="10:30 PM">11 PM</option>
        <option value="11:00 PM">11:30 PM</option>
        <option value="11:30 PM">12 AM</option>
    </select>

</div>


</div></div>

<div class="card mt-3"><div class="card-body">

    <h5>Have any other rule?</h5>

    <textarea class="form-control config-field"
    placeholder="Type any other rules that guests should follow..."
    data-key="other_rules"
    rows="4"></textarea>

</div></div>



<!-- 🔥 DESCRIPTION -->
<div class="card mt-3"><div class="card-body">

<h5>What makes your property unique</h5>

<textarea class="form-control config-field"
data-key="description"
rows="4"></textarea>

</div></div>

`;
}
        // =========================
        // 🏢 SUB TYPE BASED (EXTRA)
        // =========================
               if(purpose == 'sale' && propertyType == 2){

            html += `
         
<div class="card mt-3">
    <div class="card-body">

        <h5>Ownership</h5>

        <div class="mb-3">
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="freehold"> Freehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="leasehold"> Leasehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="cooperative"> Co-operative society</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="poa"> Power of Attorney</label>
        </div>

        <h5>Price Details</h5>

        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Expected Price" data-key="expected_price">
            </div>

            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Price per sq.ft." data-key="price_per_sqft">
            </div>
        </div>
<div class="mt-2 text-success font-weight-bold" id="priceInWords"></div
        <div class="mt-2">
            <label>
                <input type="checkbox" class="config-field" data-key="all_inclusive" value="1">
                All inclusive price
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="tax_excluded" value="1">
                Tax and Govt. charges excluded
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="negotiable" value="1">
                Price Negotiable
            </label>
        </div>

        <h6 class="mt-3">Additional Pricing Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Expected rental" data-key="expected_rent">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Annual dues payable" data-key="annual_dues">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
   <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="0"> No
        </label>

        <!-- 🔥 Hidden Section -->
        <div id="brokerage_section" style="display:none;" class="mt-3">

            <div class="mb-2">

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="fixed">
                    Fixed
                </label>

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="percentage">
                    Percentage of Price
                </label>

            </div>

            <input type="number" class="form-control config-field"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" 
                data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        placeholder="Share some details about your property like spacious rooms, well maintained facilities..."
        rows="4"></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;
        }

        // =========================
        // 🔴 RENT + RESIDENTIAL
        // =========================
         else if(purpose == 'rent' && propertyType == 2){

html += `
<div class="card mt-3">
    <div class="card-body">

        <h5>Preferred agreement type</h5>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="company">
            Company lease agreement
        </label>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="any">
            Any
        </label>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>Rent Details</h5>

        <input type="number" class="form-control config-field mt-2"
        placeholder="₹ Expected Rent" data-key="expected_rent">
<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>

        <label class="mt-2">
            <input type="checkbox" class="config-field" data-key="electricity_included" value="1">
            Electricity & Water charges excluded
        </label>

        <label class="ml-3">
            <input type="checkbox" class="config-field" data-key="rent_negotiable" value="1">
            Price Negotiable
        </label>

        <h6 class="mt-3">Additional Rent Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Security deposit (Optional)</h5>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed">
            Fixed
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple">
            Multiple of Rent
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none">
            None
        </label>

        <div id="deposit_input" class="mt-2" style="display:none;">
            <input type="number" class="form-control config-field"
            placeholder="Deposit value / No. of months"
            data-key="deposit_value">
        </div>

    </div>
</div>

<!-- 🔥 BROKERAGE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No
        </label>

        <div id="brokerage_section" style="display:none;" class="mt-3">

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed">
                Fixed
            </label>

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage">
                Percentage of Price
            </label>

            <input type="number" class="form-control config-field mt-2"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<!-- 🔥 AGREEMENT DURATION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Duration of agreement (Optional)</h5>

        <select class="form-control config-field" data-key="agreement_duration">
            <option value="">Select</option>
            <option value="11_months">11 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select>

    </div>
</div>

<!-- 🔥 NOTICE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Months of Notice (Optional)</h5>

        <div>
            ${['none','1','2','3','4','5','6'].map(v=>`
            <label class="pill">
                <input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
                ${v=='none'?'None':v+' months'}
            </label>`).join('')}
        </div>

    </div>
</div>

<!-- 🔥 DESCRIPTION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        rows="4"
        placeholder="Share some details about your property..."></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;    
         }
     
     
     
     if(purpose == 'sale' && propertyType == 3){

            html += `
         
<div class="card mt-3">
    <div class="card-body">

        <h5>Ownership</h5>

        <div class="mb-3">
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="freehold"> Freehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="leasehold"> Leasehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="cooperative"> Co-operative society</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="poa"> Power of Attorney</label>
        </div>

        <h5>Price Details</h5>

        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Expected Price" data-key="expected_price">
            </div>

            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Price per sq.ft." data-key="price_per_sqft">
            </div>
        </div>
<div class="mt-2 text-success font-weight-bold" id="priceInWords"></div

        <div class="mt-2">
            <label>
                <input type="checkbox" class="config-field" data-key="all_inclusive" value="1">
                All inclusive price
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="tax_excluded" value="1">
                Tax and Govt. charges excluded
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="negotiable" value="1">
                Price Negotiable
            </label>
        </div>

        <h6 class="mt-3">Additional Pricing Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Expected rental" data-key="expected_rent">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Annual dues payable" data-key="annual_dues">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
   <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="0"> No
        </label>

        <!-- 🔥 Hidden Section -->
        <div id="brokerage_section" style="display:none;" class="mt-3">

            <div class="mb-2">

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="fixed">
                    Fixed
                </label>

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="percentage">
                    Percentage of Price
                </label>

            </div>

            <input type="number" class="form-control config-field"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" 
                data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        placeholder="Share some details about your property like spacious rooms, well maintained facilities..."
        rows="4"></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;
        }

        // =========================
        // 🔴 RENT + RESIDENTIAL
        // =========================
         else if(purpose == 'rent' && propertyType == 3){

html += `
<div class="card mt-3">
    <div class="card-body">

        <h5>Preferred agreement type</h5>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="company">
            Company lease agreement
        </label>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="any">
            Any
        </label>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>Rent Details</h5>

        <input type="number" class="form-control config-field mt-2"
        placeholder="₹ Expected Rent" data-key="expected_rent">
<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>

        <label class="mt-2">
            <input type="checkbox" class="config-field" data-key="electricity_included" value="1">
            Electricity & Water charges excluded
        </label>

        <label class="ml-3">
            <input type="checkbox" class="config-field" data-key="rent_negotiable" value="1">
            Price Negotiable
        </label>

        <h6 class="mt-3">Additional Rent Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Security deposit (Optional)</h5>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed">
            Fixed
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple">
            Multiple of Rent
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none">
            None
        </label>

        <div id="deposit_input" class="mt-2" style="display:none;">
            <input type="number" class="form-control config-field"
            placeholder="Deposit value / No. of months"
            data-key="deposit_value">
        </div>

    </div>
</div>

<!-- 🔥 BROKERAGE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No
        </label>

        <div id="brokerage_section" style="display:none;" class="mt-3">

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed">
                Fixed
            </label>

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage">
                Percentage of Price
            </label>

            <input type="number" class="form-control config-field mt-2"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<!-- 🔥 AGREEMENT DURATION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Duration of agreement (Optional)</h5>

        <select class="form-control config-field" data-key="agreement_duration">
            <option value="">Select</option>
            <option value="11_months">11 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select>

    </div>
</div>

<!-- 🔥 NOTICE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Months of Notice (Optional)</h5>

        <div>
            ${['none','1','2','3','4','5','6'].map(v=>`
            <label class="pill">
                <input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
                ${v=='none'?'None':v+' months'}
            </label>`).join('')}
        </div>

    </div>
</div>

<!-- 🔥 DESCRIPTION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        rows="4"
        placeholder="Share some details about your property..."></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;    
         }
     
if(purpose == 'sale' && propertyType == 4){

            html += `
         
<div class="card mt-3">
    <div class="card-body">

        <h5>Ownership</h5>

        <div class="mb-3">
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="freehold"> Freehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="leasehold"> Leasehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="cooperative"> Co-operative society</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="poa"> Power of Attorney</label>
        </div>

        <h5>Price Details</h5>

        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Expected Price" data-key="expected_price">
            </div>

            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Price per sq.ft." data-key="price_per_sqft">
            </div>
        </div>

<div class="mt-2 text-success font-weight-bold" id="priceInWords"></div
        <div class="mt-2">
            <label>
                <input type="checkbox" class="config-field" data-key="all_inclusive" value="1">
                All inclusive price
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="tax_excluded" value="1">
                Tax and Govt. charges excluded
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="negotiable" value="1">
                Price Negotiable
            </label>
        </div>

        <h6 class="mt-3">Additional Pricing Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Expected rental" data-key="expected_rent">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Annual dues payable" data-key="annual_dues">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
   <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="0"> No
        </label>

        <!-- 🔥 Hidden Section -->
        <div id="brokerage_section" style="display:none;" class="mt-3">

            <div class="mb-2">

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="fixed">
                    Fixed
                </label>

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="percentage">
                    Percentage of Price
                </label>

            </div>

            <input type="number" class="form-control config-field"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" 
                data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        placeholder="Share some details about your property like spacious rooms, well maintained facilities..."
        rows="4"></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;
        }

        // =========================
        // 🔴 RENT + RESIDENTIAL
        // =========================
         else if(purpose == 'rent' && propertyType == 4){

html += `
<div class="card mt-3">
    <div class="card-body">

        <h5>Preferred agreement type</h5>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="company">
            Company lease agreement
        </label>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="any">
            Any
        </label>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>Rent Details</h5>

        <input type="number" class="form-control config-field mt-2"
        placeholder="₹ Expected Rent" data-key="expected_rent">

<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
        <label class="mt-2">
            <input type="checkbox" class="config-field" data-key="electricity_included" value="1">
            Electricity & Water charges excluded
        </label>

        <label class="ml-3">
            <input type="checkbox" class="config-field" data-key="rent_negotiable" value="1">
            Price Negotiable
        </label>

        <h6 class="mt-3">Additional Rent Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Security deposit (Optional)</h5>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed">
            Fixed
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple">
            Multiple of Rent
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none">
            None
        </label>

        <div id="deposit_input" class="mt-2" style="display:none;">
            <input type="number" class="form-control config-field"
            placeholder="Deposit value / No. of months"
            data-key="deposit_value">
        </div>

    </div>
</div>

<!-- 🔥 BROKERAGE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No
        </label>

        <div id="brokerage_section" style="display:none;" class="mt-3">

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed">
                Fixed
            </label>

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage">
                Percentage of Price
            </label>

            <input type="number" class="form-control config-field mt-2"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<!-- 🔥 AGREEMENT DURATION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Duration of agreement (Optional)</h5>

        <select class="form-control config-field" data-key="agreement_duration">
            <option value="">Select</option>
            <option value="11_months">11 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select>

    </div>
</div>

<!-- 🔥 NOTICE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Months of Notice (Optional)</h5>

        <div>
            ${['none','1','2','3','4','5','6'].map(v=>`
            <label class="pill">
                <input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
                ${v=='none'?'None':v+' months'}
            </label>`).join('')}
        </div>

    </div>
</div>

<!-- 🔥 DESCRIPTION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        rows="4"
        placeholder="Share some details about your property..."></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;    
         }
     



if(purpose == 'sale' && propertyType == 8){

            html += `
         
<div class="card mt-3">
    <div class="card-body">

        <h5>Ownership</h5>

        <div class="mb-3">
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="freehold"> Freehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="leasehold"> Leasehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="cooperative"> Co-operative society</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="poa"> Power of Attorney</label>
        </div>

        <h5>Price Details</h5>

        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Expected Price" data-key="expected_price">
            </div>

            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Price per sq.ft." data-key="price_per_sqft">
            </div>
        </div>
<div class="mt-2 text-success font-weight-bold" id="priceInWords"></div

        <div class="mt-2">
            <label>
                <input type="checkbox" class="config-field" data-key="all_inclusive" value="1">
                All inclusive price
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="tax_excluded" value="1">
                Tax and Govt. charges excluded
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="negotiable" value="1">
                Price Negotiable
            </label>
        </div>

        <h6 class="mt-3">Additional Pricing Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Expected rental" data-key="expected_rent">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Annual dues payable" data-key="annual_dues">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
   <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="0"> No
        </label>

        <!-- 🔥 Hidden Section -->
        <div id="brokerage_section" style="display:none;" class="mt-3">

            <div class="mb-2">

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="fixed">
                    Fixed
                </label>

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="percentage">
                    Percentage of Price
                </label>

            </div>

            <input type="number" class="form-control config-field"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" 
                data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        placeholder="Share some details about your property like spacious rooms, well maintained facilities..."
        rows="4"></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;
        }

        // =========================
        // 🔴 RENT + RESIDENTIAL
        // =========================
         else if(purpose == 'rent' && propertyType == 8){

html += `
<div class="card mt-3">
    <div class="card-body">

        <h5>Preferred agreement type</h5>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="company">
            Company lease agreement
        </label>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="any">
            Any
        </label>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>Rent Details</h5>

        <input type="number" class="form-control config-field mt-2"
        placeholder="₹ Expected Rent" data-key="expected_rent">

<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
        <label class="mt-2">
            <input type="checkbox" class="config-field" data-key="electricity_included" value="1">
            Electricity & Water charges excluded
        </label>

        <label class="ml-3">
            <input type="checkbox" class="config-field" data-key="rent_negotiable" value="1">
            Price Negotiable
        </label>

        <h6 class="mt-3">Additional Rent Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Security deposit (Optional)</h5>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed">
            Fixed
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple">
            Multiple of Rent
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none">
            None
        </label>

        <div id="deposit_input" class="mt-2" style="display:none;">
            <input type="number" class="form-control config-field"
            placeholder="Deposit value / No. of months"
            data-key="deposit_value">
        </div>

    </div>
</div>

<!-- 🔥 BROKERAGE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No
        </label>

        <div id="brokerage_section" style="display:none;" class="mt-3">

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed">
                Fixed
            </label>

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage">
                Percentage of Price
            </label>

            <input type="number" class="form-control config-field mt-2"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<!-- 🔥 AGREEMENT DURATION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Duration of agreement (Optional)</h5>

        <select class="form-control config-field" data-key="agreement_duration">
            <option value="">Select</option>
            <option value="11_months">11 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select>

    </div>
</div>

<!-- 🔥 NOTICE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Months of Notice (Optional)</h5>

        <div>
            ${['none','1','2','3','4','5','6'].map(v=>`
            <label class="pill">
                <input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
                ${v=='none'?'None':v+' months'}
            </label>`).join('')}
        </div>

    </div>
</div>

<!-- 🔥 DESCRIPTION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        rows="4"
        placeholder="Share some details about your property..."></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;    
         }
     
     
     
     if(purpose == 'sale' && propertyType == 9){

            html += `
         
<div class="card mt-3">
    <div class="card-body">

        <h5>Ownership</h5>

        <div class="mb-3">
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="freehold"> Freehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="leasehold"> Leasehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="cooperative"> Co-operative society</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="poa"> Power of Attorney</label>
        </div>

        <h5>Price Details</h5>

        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Expected Price" data-key="expected_price">
            </div>

            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Price per sq.ft." data-key="price_per_sqft">
            </div>
        </div>
<div class="mt-2 text-success font-weight-bold" id="priceInWords"></div

        <div class="mt-2">
            <label>
                <input type="checkbox" class="config-field" data-key="all_inclusive" value="1">
                All inclusive price
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="tax_excluded" value="1">
                Tax and Govt. charges excluded
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="negotiable" value="1">
                Price Negotiable
            </label>
        </div>

        <h6 class="mt-3">Additional Pricing Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Expected rental" data-key="expected_rent">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Annual dues payable" data-key="annual_dues">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
   <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="0"> No
        </label>

        <!-- 🔥 Hidden Section -->
        <div id="brokerage_section" style="display:none;" class="mt-3">

            <div class="mb-2">

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="fixed">
                    Fixed
                </label>

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="percentage">
                    Percentage of Price
                </label>

            </div>

            <input type="number" class="form-control config-field"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" 
                data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        placeholder="Share some details about your property like spacious rooms, well maintained facilities..."
        rows="4"></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;
        }

        // =========================
        // 🔴 RENT + RESIDENTIAL
        // =========================
         else if(purpose == 'rent' && propertyType == 9){

html += `
<div class="card mt-3">
    <div class="card-body">

        <h5>Preferred agreement type</h5>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="company">
            Company lease agreement
        </label>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="any">
            Any
        </label>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>Rent Details</h5>

        <input type="number" class="form-control config-field mt-2"
        placeholder="₹ Expected Rent" data-key="expected_rent">

<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
        <label class="mt-2">
            <input type="checkbox" class="config-field" data-key="electricity_included" value="1">
            Electricity & Water charges excluded
        </label>

        <label class="ml-3">
            <input type="checkbox" class="config-field" data-key="rent_negotiable" value="1">
            Price Negotiable
        </label>

        <h6 class="mt-3">Additional Rent Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Security deposit (Optional)</h5>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed">
            Fixed
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple">
            Multiple of Rent
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none">
            None
        </label>

        <div id="deposit_input" class="mt-2" style="display:none;">
            <input type="number" class="form-control config-field"
            placeholder="Deposit value / No. of months"
            data-key="deposit_value">
        </div>

    </div>
</div>

<!-- 🔥 BROKERAGE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No
        </label>

        <div id="brokerage_section" style="display:none;" class="mt-3">

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed">
                Fixed
            </label>

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage">
                Percentage of Price
            </label>

            <input type="number" class="form-control config-field mt-2"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<!-- 🔥 AGREEMENT DURATION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Duration of agreement (Optional)</h5>

        <select class="form-control config-field" data-key="agreement_duration">
            <option value="">Select</option>
            <option value="11_months">11 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select>

    </div>
</div>

<!-- 🔥 NOTICE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Months of Notice (Optional)</h5>

        <div>
            ${['none','1','2','3','4','5','6'].map(v=>`
            <label class="pill">
                <input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
                ${v=='none'?'None':v+' months'}
            </label>`).join('')}
        </div>

    </div>
</div>

<!-- 🔥 DESCRIPTION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        rows="4"
        placeholder="Share some details about your property..."></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;    
         }
     
     
     
     if(purpose == 'sale' && propertyType == 10){

            html += `
         
<div class="card mt-3">
    <div class="card-body">

        <h5>Ownership</h5>

        <div class="mb-3">
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="freehold"> Freehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="leasehold"> Leasehold</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="cooperative"> Co-operative society</label>
            <label class="pill"><input type="radio" name="ownership" class="config-field" data-key="ownership" value="poa"> Power of Attorney</label>
        </div>

        <h5>Price Details</h5>

        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Expected Price" data-key="expected_price">
            </div>

            <div class="col-md-6">
                <input type="number" class="form-control config-field"
                placeholder="₹ Price per sq.ft." data-key="price_per_sqft">
            </div>
        </div>
<div class="mt-2 text-success font-weight-bold" id="priceInWords"></div

        <div class="mt-2">
            <label>
                <input type="checkbox" class="config-field" data-key="all_inclusive" value="1">
                All inclusive price
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="tax_excluded" value="1">
                Tax and Govt. charges excluded
            </label>

            <label class="ml-3">
                <input type="checkbox" class="config-field" data-key="negotiable" value="1">
                Price Negotiable
            </label>
        </div>

        <h6 class="mt-3">Additional Pricing Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Expected rental" data-key="expected_rent">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Annual dues payable" data-key="annual_dues">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
   <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" 
            class="config-field brokerage-toggle" 
            data-key="brokerage_required" value="0"> No
        </label>

        <!-- 🔥 Hidden Section -->
        <div id="brokerage_section" style="display:none;" class="mt-3">

            <div class="mb-2">

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="fixed">
                    Fixed
                </label>

                <label class="pill">
                    <input type="radio" name="brokerage_type" 
                    class="config-field" data-key="brokerage_type" value="percentage">
                    Percentage of Price
                </label>

            </div>

            <input type="number" class="form-control config-field"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" 
                data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        placeholder="Share some details about your property like spacious rooms, well maintained facilities..."
        rows="4"></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;
        }

        // =========================
        // 🔴 RENT + RESIDENTIAL
        // =========================
         else if(purpose == 'rent' && propertyType == 10){

html += `
<div class="card mt-3">
    <div class="card-body">

        <h5>Preferred agreement type</h5>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="company">
            Company lease agreement
        </label>

        <label class="pill">
            <input type="radio" name="agreement_type" class="config-field" data-key="agreement_type" value="any">
            Any
        </label>

    </div>
</div>

<div class="card mt-3">
    <div class="card-body">

        <h5>Rent Details</h5>

        <input type="number" class="form-control config-field mt-2"
        placeholder="₹ Expected Rent" data-key="expected_rent">

<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
        <label class="mt-2">
            <input type="checkbox" class="config-field" data-key="electricity_included" value="1">
            Electricity & Water charges excluded
        </label>

        <label class="ml-3">
            <input type="checkbox" class="config-field" data-key="rent_negotiable" value="1">
            Price Negotiable
        </label>

        <h6 class="mt-3">Additional Rent Details (Optional)</h6>

        <div class="row mt-2">
            <div class="col-md-6">
                <input type="text" class="form-control config-field"
                placeholder="Maintenance" data-key="maintenance">
            </div>

            <div class="col-md-6">
                <select class="form-control config-field" data-key="maintenance_type">
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Booking Amount" data-key="booking_amount">
            </div>

            <div class="col-md-6 mt-2">
                <input type="number" class="form-control config-field"
                placeholder="Membership charge" data-key="membership_charge">
            </div>
        </div>

    </div>
</div>

<!-- 🔥 SECURITY DEPOSIT -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Security deposit (Optional)</h5>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="fixed">
            Fixed
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="multiple">
            Multiple of Rent
        </label>

        <label class="pill">
            <input type="radio" name="deposit_type" class="config-field deposit-toggle" data-key="deposit_type" value="none">
            None
        </label>

        <div id="deposit_input" class="mt-2" style="display:none;">
            <input type="number" class="form-control config-field"
            placeholder="Deposit value / No. of months"
            data-key="deposit_value">
        </div>

    </div>
</div>

<!-- 🔥 BROKERAGE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Do you charge brokerage?</h5>

        <label>
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="1"> Yes
        </label>

        <label class="ml-3">
            <input type="radio" name="brokerage_required" class="config-field brokerage-toggle" data-key="brokerage_required" value="0"> No
        </label>

        <div id="brokerage_section" style="display:none;" class="mt-3">

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="fixed">
                Fixed
            </label>

            <label class="pill">
                <input type="radio" name="brokerage_type" class="config-field" data-key="brokerage_type" value="percentage">
                Percentage of Price
            </label>

            <input type="number" class="form-control config-field mt-2"
            placeholder="Enter brokerage here"
            data-key="brokerage_amount">

            <label class="mt-2">
                <input type="checkbox" class="config-field" data-key="brokerage_negotiable" value="1">
                Brokerage Negotiable
            </label>

        </div>

    </div>
</div>

<!-- 🔥 AGREEMENT DURATION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Duration of agreement (Optional)</h5>

        <select class="form-control config-field" data-key="agreement_duration">
            <option value="">Select</option>
            <option value="11_months">11 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select>

    </div>
</div>

<!-- 🔥 NOTICE -->
<div class="card mt-3">
    <div class="card-body">

        <h5>Months of Notice (Optional)</h5>

        <div>
            ${['none','1','2','3','4','5','6'].map(v=>`
            <label class="pill">
                <input type="radio" name="notice" class="config-field" data-key="notice" value="${v}">
                ${v=='none'?'None':v+' months'}
            </label>`).join('')}
        </div>

    </div>
</div>

<!-- 🔥 DESCRIPTION -->
<div class="card mt-3">
    <div class="card-body">

        <h5>What makes your property unique</h5>

        <textarea class="form-control config-field"
        data-key="description"
        rows="4"
        placeholder="Share some details about your property..."></textarea>

        <small class="text-muted">Minimum 30 characters required</small>

    </div>
</div>
`;    
         }
     
     
     
 if(purpose == 'rent' && subType == 2){

html += `

<!-- RENT DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5>Rent Details</h5>

<input type="number" class="form-control config-field mt-2"
placeholder="₹ Expected Rent"
data-key="expected_rent">
<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
<label class="mt-2">
<input type="checkbox" class="config-field"
data-key="electricity_excluded" value="1">
Electricity & Water charges excluded
</label>

<label class="ml-3">
<input type="checkbox" class="config-field"
data-key="rent_negotiable" value="1">
Price Negotiable
</label>

<h6 class="mt-3">Additional Rent Details</h6>

<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control config-field"
        placeholder="Maintenance"
        data-key="maintenance">
    </div>

    <div class="col-md-6">
        <select class="form-control config-field"
        data-key="maintenance_type">
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div class="col-md-6 mt-2">
        <input type="number" class="form-control config-field"
        placeholder="Booking Amount"
        data-key="booking_amount">
    </div>

    <div class="col-md-6 mt-2">
        <input type="number" class="form-control config-field"
        placeholder="Membership charge"
        data-key="membership_charge">
    </div>
</div>

</div>
</div>


<!-- SECURITY DEPOSIT -->
<div class="card mt-3">
<div class="card-body">

<h5>Security deposit</h5>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="multiple"> Multiple of Rent
</label>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="none"> None
</label>

<div id="deposit_input" class="mt-2" style="display:none;">
<input type="number" class="form-control config-field"
placeholder="Deposit value / months"
data-key="deposit_value">
</div>

</div>
</div>


<!-- BROKERAGE -->
<div class="card mt-3">
<div class="card-body">

<h5>Do you charge brokerage?</h5>

<label>
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="1"> Yes
</label>

<label class="ml-3">
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="0"> No
</label>

<div id="brokerage_section" style="display:none;" class="mt-3">

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="percentage"> Percentage
</label>

<input type="number" class="form-control mt-2 config-field"
placeholder="Enter brokerage"
data-key="brokerage_amount">

<label class="mt-2">
<input type="checkbox" class="config-field"
data-key="brokerage_negotiable" value="1">
Brokerage Negotiable
</label>

</div>

</div>
</div>


<!-- AGREEMENT -->
<div class="card mt-3">
<div class="card-body">

<h5>Agreement Duration</h5>

<select class="form-control config-field"
data-key="agreement_duration">
    <option value="">Select</option>
    <option value="11_months">11 Months</option>
    <option value="1_year">1 Year</option>
    <option value="2_years">2 Years</option>
</select>

</div>
</div>


<!-- NOTICE -->
<div class="card mt-3">
<div class="card-body">

<h5>Notice Period</h5>

<div>
${['none','1','2','3','4','5','6'].map(v=>`
<label class="pill">
<input type="radio" name="notice"
class="config-field"
data-key="notice" value="${v}">
${v=='none'?'None':v+' months'}
</label>
`).join('')}
</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5>Description</h5>

<textarea class="form-control config-field"
data-key="description"
rows="4"
placeholder="Describe property"></textarea>

</div>
</div>

`;
}
else if(purpose == 'rent' && subType == 3){

html += `

<!-- RENT DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5>Rent Details</h5>

<input type="number" class="form-control config-field mt-2"
placeholder="₹ Expected Rent"
data-key="expected_rent">
<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
<label class="mt-2">
<input type="checkbox" class="config-field"
data-key="electricity_excluded" value="1">
Electricity & Water charges excluded
</label>

<label class="ml-3">
<input type="checkbox" class="config-field"
data-key="rent_negotiable" value="1">
Price Negotiable
</label>

<h6 class="mt-3">Additional Rent Details</h6>

<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control config-field"
        placeholder="Maintenance"
        data-key="maintenance">
    </div>

    <div class="col-md-6">
        <select class="form-control config-field"
        data-key="maintenance_type">
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div class="col-md-6 mt-2">
        <input type="number" class="form-control config-field"
        placeholder="Booking Amount"
        data-key="booking_amount">
    </div>

    <div class="col-md-6 mt-2">
        <input type="number" class="form-control config-field"
        placeholder="Membership charge"
        data-key="membership_charge">
    </div>
</div>

</div>
</div>


<!-- SECURITY DEPOSIT -->
<div class="card mt-3">
<div class="card-body">

<h5>Security deposit</h5>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="multiple"> Multiple of Rent
</label>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="none"> None
</label>

<div id="deposit_input" class="mt-2" style="display:none;">
<input type="number" class="form-control config-field"
placeholder="Deposit value / months"
data-key="deposit_value">
</div>

</div>
</div>


<!-- BROKERAGE -->
<div class="card mt-3">
<div class="card-body">

<h5>Do you charge brokerage?</h5>

<label>
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="1"> Yes
</label>

<label class="ml-3">
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="0"> No
</label>

<div id="brokerage_section" style="display:none;" class="mt-3">

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="percentage"> Percentage
</label>

<input type="number" class="form-control mt-2 config-field"
placeholder="Enter brokerage"
data-key="brokerage_amount">

<label class="mt-2">
<input type="checkbox" class="config-field"
data-key="brokerage_negotiable" value="1">
Brokerage Negotiable
</label>

</div>

</div>
</div>


<!-- AGREEMENT -->
<div class="card mt-3">
<div class="card-body">

<h5>Agreement Duration</h5>

<select class="form-control config-field"
data-key="agreement_duration">
    <option value="">Select</option>
    <option value="11_months">11 Months</option>
    <option value="1_year">1 Year</option>
    <option value="2_years">2 Years</option>
</select>

</div>
</div>


<!-- NOTICE -->
<div class="card mt-3">
<div class="card-body">

<h5>Notice Period</h5>

<div>
${['none','1','2','3','4','5','6'].map(v=>`
<label class="pill">
<input type="radio" name="notice"
class="config-field"
data-key="notice" value="${v}">
${v=='none'?'None':v+' months'}
</label>
`).join('')}
</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5>Description</h5>

<textarea class="form-control config-field"
data-key="description"
rows="4"
placeholder="Describe property"></textarea>

</div>
</div>

`;
}
else if(purpose == 'rent' && subType == 4){

html += `

<!-- RENT DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5>Rent Details</h5>

<div class="row">
    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Expected Rent"
        data-key="expected_rent">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Price per sq.ft."
        data-key="price_per_sqft">
    </div>
</div>
<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
<div class="mt-2">

    <label>
        <input type="checkbox" class="config-field"
        data-key="electricity_excluded" value="1">
        Electricity & Water charges excluded
    </label>

    <label class="ml-3">
        <input type="checkbox" class="config-field"
        data-key="rent_negotiable" value="1">
        Price Negotiable
    </label>

</div>

<div class="mt-2">
    <a href="javascript:void(0)" id="togglePricing" >+ Add more pricing details</a>
</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5>What makes your property unique</h5>

<small class="text-muted">
Adding description will increase your listing visibility
</small>

<textarea class="form-control config-field mt-2"
rows="4"
maxlength="5000"
data-key="description"
placeholder="Share some details about your property like spacious rooms, well maintained facilities..."></textarea>

<small class="text-muted">
Minimum 30 characters required
<span style="float:right;">0/5000</span>
</small>

</div>
</div>

`;
}
else if ((purpose == 'rent') && (subType == 5 || subType == 6)) {
html += `

<!-- RENT DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5>Rent Details</h5>

<input type="number" class="form-control config-field mt-2"
placeholder="₹ Expected Rent"
data-key="expected_rent">
<div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
<label class="mt-2">
<input type="checkbox" class="config-field"
data-key="electricity_excluded" value="1">
Electricity & Water charges excluded
</label>

<label class="ml-3">
<input type="checkbox" class="config-field"
data-key="rent_negotiable" value="1">
Price Negotiable
</label>

<h6 class="mt-3">Additional Rent Details</h6>

<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control config-field"
        placeholder="Maintenance"
        data-key="maintenance">
    </div>

    <div class="col-md-6">
        <select class="form-control config-field"
        data-key="maintenance_type">
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div class="col-md-6 mt-2">
        <input type="number" class="form-control config-field"
        placeholder="Booking Amount"
        data-key="booking_amount">
    </div>

    <div class="col-md-6 mt-2">
        <input type="number" class="form-control config-field"
        placeholder="Membership charge"
        data-key="membership_charge">
    </div>
</div>

</div>
</div>


<!-- SECURITY DEPOSIT -->
<div class="card mt-3">
<div class="card-body">

<h5>Security deposit</h5>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="multiple"> Multiple of Rent
</label>

<label class="pill">
<input type="radio" name="deposit_type"
class="config-field deposit-toggle"
data-key="deposit_type" value="none"> None
</label>

<div id="deposit_input" class="mt-2" style="display:none;">
<input type="number" class="form-control config-field"
placeholder="Deposit value / months"
data-key="deposit_value">
</div>

</div>
</div>


<!-- BROKERAGE -->
<div class="card mt-3">
<div class="card-body">

<h5>Do you charge brokerage?</h5>

<label>
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="1"> Yes
</label>

<label class="ml-3">
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="0"> No
</label>

<div id="brokerage_section" style="display:none;" class="mt-3">

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="percentage"> Percentage
</label>

<input type="number" class="form-control mt-2 config-field"
placeholder="Enter brokerage"
data-key="brokerage_amount">

<label class="mt-2">
<input type="checkbox" class="config-field"
data-key="brokerage_negotiable" value="1">
Brokerage Negotiable
</label>

</div>

</div>
</div>


<!-- AGREEMENT -->
<div class="card mt-3">
<div class="card-body">

<h5>Agreement Duration</h5>

<select class="form-control config-field"
data-key="agreement_duration">
    <option value="">Select</option>
    <option value="11_months">11 Months</option>
    <option value="1_year">1 Year</option>
    <option value="2_years">2 Years</option>
</select>

</div>
</div>


<!-- NOTICE -->
<div class="card mt-3">
<div class="card-body">

<h5>Notice Period</h5>

<div>
${['none','1','2','3','4','5','6'].map(v=>`
<label class="pill">
<input type="radio" name="notice"
class="config-field"
data-key="notice" value="${v}">
${v=='none'?'None':v+' months'}
</label>
`).join('')}
</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5>Description</h5>

<textarea class="form-control config-field"
data-key="description"
rows="4"
placeholder="Describe property"></textarea>

</div>
</div>

`;
}
else if (purpose == 'rent' && [7,8,9,10,11,12,13,14,15].includes(parseInt(subType))) {

html += `

<!-- RENT DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5>Rent Details</h5>

<div class="row">
    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Expected Rent"
        data-key="expected_rent">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Price per sq.ft."
        data-key="price_per_sqft">
    </div>
    
    <div class="mt-2 text-success font-weight-bold" id="rentInWords"></div>
</div>

<div class="mt-2">

    <label>
        <input type="checkbox" class="config-field"
        data-key="electricity_excluded" value="1">
        Electricity & Water charges excluded
    </label>

    <label class="ml-3">
        <input type="checkbox" class="config-field"
        data-key="rent_negotiable" value="1">
        Price Negotiable
    </label>

</div>

<div class="mt-2">
    <a href="javascript:void(0)" id="togglePricing" >+ Add more pricing details</a>
</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5>What makes your property unique</h5>

<small class="text-muted">
Adding description will increase your listing visibility
</small>

<textarea class="form-control config-field mt-2"
rows="4"
maxlength="5000"
data-key="description"
placeholder="Share some details about your property like spacious rooms, well maintained facilities..."></textarea>

<small class="text-muted">
Minimum 30 characters required
<span style="float:right;">0/5000</span>
</small>

</div>
</div>

`;
}

 if (purpose == 'sale' && subType == 2) {

html += `

<!-- PRICE DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-3">Price Details</h5>

<div class="row">
    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Expected Price"
        data-key="expected_price">

    </div>

    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Price per sq.ft."
        data-key="price_per_sqft">
    </div>
    <div class="mt-2 text-success font-weight-bold" id="priceInWords"></div
</div>

<div class="mt-3">

<label class="mr-3">
<input type="checkbox" class="config-field"
data-key="tax_excluded" value="1">
Tax and Govt. charges excluded
</label>

<label class="mr-3">
<input type="checkbox" class="config-field"
data-key="dg_included" value="1">
DG & UPS Price Included
</label>

<label>
<input type="checkbox" class="config-field"
data-key="price_negotiable" value="1">
Price Negotiable
</label>

</div>

<div class="mt-2">
<a href="javascript:void(0)" id="togglePricing" class="text-primary">
+ Add more pricing details
</a>
</div>
<div id="morePricingSection" style="display:none;" class="mt-3">

    <div class="row">
        <div class="col-md-6">
            <input type="number" class="form-control config-field"
                   placeholder="Maintenance"
                   data-key="maintenance">
        </div>

        <div class="col-md-6">
            <select class="form-control config-field" data-key="maintenance_type">
                <option value="">Select Type</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
    </div>

</div>
</div>
</div>


<!-- BROKERAGE -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-3">Do you charge brokerage?</h5>

<div class="d-flex mb-2">

<label class="mr-3">
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="1"> Yes
</label>

<label>
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="0"> No
</label>

</div>

<div id="brokerage_section" style="display:none;">

<div class="d-flex mb-2">

<label class="pill mr-2">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="percentage"> Percentage of Price
</label>

</div>

<input type="number" class="form-control config-field mb-2"
placeholder="Enter brokerage here"
data-key="brokerage_amount">

<label>
<input type="checkbox" class="config-field"
data-key="brokerage_negotiable" value="1">
Brokerage Negotiable
</label>

</div>

</div>
</div>


<!-- PRE-LEASED -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-2">Is it Pre-leased / Pre-Rented?</h5>

<small class="text-muted d-block mb-2">
For properties that are already rented out
</small>

<div class="d-flex mb-2">

<label class="pill mr-2">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="1"> Yes
</label>

<label class="pill">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="0"> No
</label>

</div>

<div id="prelease_section" style="display:none;">

<h6 class="mt-2 mb-2">Pre-leased / Pre-Rented Details</h6>

<small class="text-muted d-block mb-2">
Lease / Rent related details of your property
</small>

<input type="number" class="form-control config-field mt-2"
placeholder="₹ Current rent per month"
data-key="current_rent">

<input type="number" class="form-control config-field mt-2"
placeholder="Lease tenure in years"
data-key="lease_tenure">

<input type="number" class="form-control config-field mt-2"
placeholder="Annual rent increase in % (Optional)"
data-key="annual_rent_increase">

<input type="text" class="form-control config-field mt-2"
placeholder="Leased to - Business Type (Optional)"
data-key="leased_to">

</div>
</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-2">Describe your property</h5>

<p class="text-muted" style="font-size:13px;">
Writing a description helps improve your property's visibility
</p>

<textarea class="form-control config-field"
rows="4"
maxlength="5000"
data-key="description"
placeholder="Write here what makes your property unique"></textarea>

<div class="d-flex justify-content-between mt-1">
<small class="text-muted">Minimum 30 characters required</small>
<small class="text-muted">0/5000</small>
</div>

</div>
</div>

`;
}
 if (purpose == 'sale' && subType == 4) {

html += `

<!-- PRICE DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-3">Price Details</h5>

<div class="row">
    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Expected Price"
        data-key="expected_price">

    </div>

    <div class="col-md-6">
        <input type="number" class="form-control config-field"
        placeholder="₹ Price per sq.ft."
        data-key="price_per_sqft">
    </div>
    <div class="mt-2 text-success font-weight-bold" id="priceInWords"></div
</div>

<div class="mt-3">

<label class="mr-3">
<input type="checkbox" class="config-field"
data-key="tax_excluded" value="1">
Tax and Govt. charges excluded
</label>

<label class="mr-3">
<input type="checkbox" class="config-field"
data-key="dg_included" value="1">
DG & UPS Price Included
</label>

<label>
<input type="checkbox" class="config-field"
data-key="price_negotiable" value="1">
Price Negotiable
</label>

</div>
<div class="mt-2">
<a href="javascript:void(0)" id="togglePricing" class="text-primary">
+ Add more pricing details
</a>
</div>

<div id="pricing_more_section" style="display:none;" class="mt-3">

<h6 class="mb-2">Additional Pricing Details <small class="text-muted">(Optional)</small></h6>

<div class="row gx-3">

    <div class="col-md-6 mb-2">
        <input type="text" class="form-control config-field"
        placeholder="Maintenance"
        data-key="maintenance">
    </div>

    <div class="col-md-6 mb-2">
        <select class="form-control config-field"
        data-key="maintenance_type">
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div class="col-md-12 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="Expected rental"
        data-key="expected_rent">
    </div>

    <div class="col-md-12 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="Booking Amount"
        data-key="booking_amount">
    </div>

    <div class="col-md-12 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="Annual dues payable"
        data-key="annual_dues">
    </div>

</div>

</div>

</div>
</div>


<!-- BROKERAGE -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-3">Do you charge brokerage?</h5>

<div class="d-flex mb-2">

<label class="mr-3">
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="1"> Yes
</label>

<label>
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="0"> No
</label>

</div>

<div id="brokerage_section" style="display:none;">

<div class="d-flex mb-2">

<label class="pill mr-2">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field"
data-key="brokerage_type" value="percentage"> Percentage of Price
</label>

</div>

<input type="number" class="form-control config-field mb-2"
placeholder="Enter brokerage here"
data-key="brokerage_amount">

<label>
<input type="checkbox" class="config-field"
data-key="brokerage_negotiable" value="1">
Brokerage Negotiable
</label>

</div>

</div>
</div>


<!-- PRE-LEASED -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-2">Is it Pre-leased / Pre-Rented?</h5>

<small class="text-muted d-block mb-2">
For properties that are already rented out
</small>

<div class="d-flex mb-2">

<label class="pill mr-2">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="1"> Yes
</label>

<label class="pill">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="0"> No
</label>

</div>

<div id="prelease_section" style="display:none;">

<h6 class="mt-2 mb-2">Pre-leased / Pre-Rented Details</h6>

<small class="text-muted d-block mb-2">
Lease / Rent related details of your property
</small>

<input type="number" class="form-control config-field mt-2"
placeholder="₹ Current rent per month"
data-key="current_rent">

<input type="number" class="form-control config-field mt-2"
placeholder="Lease tenure in years"
data-key="lease_tenure">

<input type="number" class="form-control config-field mt-2"
placeholder="Annual rent increase in % (Optional)"
data-key="annual_rent_increase">

<input type="text" class="form-control config-field mt-2"
placeholder="Leased to - Business Type (Optional)"
data-key="leased_to">

</div>
</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-2">Describe your property</h5>

<p class="text-muted" style="font-size:13px;">
Writing a description helps improve your property's visibility
</p>

<textarea class="form-control config-field"
rows="4"
maxlength="5000"
data-key="description"
placeholder="Write here what makes your property unique"></textarea>

<div class="d-flex justify-content-between mt-1">
<small class="text-muted">Minimum 30 characters required</small>
<small class="text-muted">0/5000</small>
</div>

</div>
</div>

`;
}
else if (purpose == 'sale' && [3,7,8,9,10,11,12,13,14,15].includes(parseInt(subType))) {
    html += `

<!-- PRICE DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-3">Price Details</h5>

<div class="row gx-3">
    <div class="col-md-6 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="₹ Expected Price"
        data-key="expected_price">

    </div>

    <div class="col-md-6 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="₹ Price per sq.ft."
        data-key="price_per_sqft">
    </div>
    <div class="mt-2 text-success font-weight-bold" id="priceInWords"></div
</div>

<div class="mt-3 d-flex flex-wrap gap-3">

<label>
<input type="checkbox" class="config-field"
data-key="tax_excluded" value="1">
Tax and Govt. charges excluded
</label>

<label>
<input type="checkbox" class="config-field"
data-key="price_negotiable" value="1">
Price Negotiable
</label>

</div>

<div class="mt-2">
<a href="javascript:void(0)" id="togglePricing" class="text-primary">
+ Add more pricing details
</a>
</div>

<!-- 🔥 ADDITIONAL PRICING DETAILS -->
<div id="pricing_more_section" style="display:none;" class="mt-3">

<h6 class="mb-2">
Additional Pricing Details <small class="text-muted">(Optional)</small>
</h6>

<div class="row gx-3">

    <div class="col-md-6 mb-2">
        <input type="text" class="form-control config-field"
        placeholder="Maintenance"
        data-key="maintenance">
    </div>

    <div class="col-md-6 mb-2">
        <select class="form-control config-field"
        data-key="maintenance_type">
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    <div class="col-md-12 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="Expected rental"
        data-key="expected_rent">
    </div>

    <div class="col-md-12 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="Booking Amount"
        data-key="booking_amount">
    </div>

    <div class="col-md-12 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="Annual dues payable"
        data-key="annual_dues">
    </div>

</div>

</div>

</div>
</div>


<!-- PRE-LEASED -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-2">Is it Pre-leased / Pre-Rented?</h5>

<small class="text-muted d-block mb-2">
For properties that are already rented out
</small>

<div class="d-flex mb-2">

<label class="pill mr-2">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="1"> Yes
</label>

<label class="pill">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="0"> No
</label>

</div>

<div id="prelease_section" style="display:none;">

<h6 class="mt-2 mb-2">Pre-leased / Pre-Rented Details</h6>

<small class="text-muted d-block mb-2">
Lease / Rent related details of your property
</small>

<input type="number" class="form-control config-field mt-2"
placeholder="₹ Current rent per month"
data-key="current_rent">

<input type="number" class="form-control config-field mt-2"
placeholder="Lease tenure in years"
data-key="lease_tenure">

<input type="number" class="form-control config-field mt-2"
placeholder="Annual rent increase in % (Optional)"
data-key="annual_rent_increase">

<input type="text" class="form-control config-field mt-2"
placeholder="Leased to - Business Type (Optional)"
data-key="leased_to">

</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-2">What makes your property unique</h5>

<p class="text-muted" style="font-size:13px;">
Adding description will increase your listing visibility
</p>

<textarea class="form-control config-field"
rows="4"
maxlength="5000"
data-key="description"
placeholder="Share some details about your property like spacious rooms, well maintained facilities..."></textarea>

<div class="d-flex justify-content-between mt-1">
<small class="text-muted">Minimum 30 characters required</small>
<small class="text-muted"><span id="charCount">0</span>/5000</small>
</div>

</div>
</div>

`;}

else if (purpose == 'sale' && [5,6].includes(parseInt(subType))) {

html += `

<!-- PRICE DETAILS -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-3">Price Details</h5>

<div class="row gx-3">
    <div class="col-md-6 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="₹ Expected Price"
        data-key="expected_price">
       
    </div>

    <div class="col-md-6 mb-2">
        <input type="number" class="form-control config-field"
        placeholder="₹ Price per sq.ft."
        data-key="price_per_sqft">
    </div>
    <div class="mt-2 text-success font-weight-bold" id="priceInWords"></div
</div>

<div class="mt-3 d-flex flex-wrap gap-3">

<label>
<input type="checkbox" class="config-field"
data-key="tax_excluded" value="1">
Tax and Govt. charges excluded
</label>

<label>
<input type="checkbox" class="config-field"
data-key="price_negotiable" value="1">
Price Negotiable
</label>

</div>

<div class="mt-2">
<a href="javascript:void(0)" id="togglePricing56" class="text-primary">
+ Add Maintenance and Booking Amount
</a>
</div>

<div id="pricing_more_56" style="display:none;" class="mt-3">

<div class="row gx-3">

<div class="col-md-6 mb-2">
<input type="text" class="form-control config-field"
placeholder="Maintenance"
data-key="maintenance">
</div>

<div class="col-md-6 mb-2">
<select class="form-control config-field" data-key="maintenance_type">
<option value="monthly">Monthly</option>
<option value="yearly">Yearly</option>
</select>
</div>

<div class="col-md-12 mb-2">
<input type="number" class="form-control config-field"
placeholder="Booking Amount"
data-key="booking_amount">
</div>

</div>

</div>

</div>
</div>


<!-- BROKERAGE -->
<div class="card mt-3">
<div class="card-body">

<h5 class="mb-3">Do you charge brokerage?</h5>

<label class="mr-3">
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="1"> Yes
</label>

<label>
<input type="radio" name="brokerage_required"
class="config-field brokerage-toggle"
data-key="brokerage_required" value="0"> No
</label>

<div id="brokerage_section" style="display:none;" class="mt-2">

<div class="d-flex gap-2 mb-2">
<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field" data-key="brokerage_type" value="fixed"> Fixed
</label>

<label class="pill">
<input type="radio" name="brokerage_type"
class="config-field" data-key="brokerage_type" value="percentage"> Percentage of Price
</label>
</div>

<input type="number" class="form-control config-field mb-2"
placeholder="Enter brokerage here"
data-key="brokerage_amount">

<label>
<input type="checkbox" class="config-field"
data-key="brokerage_negotiable" value="1">
Brokerage Negotiable
</label>

</div>

</div>
</div>


<!-- PRELEASED -->
<div class="card mt-3">
<div class="card-body">

<h5>Is it Pre-leased / Pre-Rented?</h5>

<small class="text-muted d-block mb-2">
For properties that are already rented out
</small>

<label class="pill mr-2">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="1"> Yes
</label>

<label class="pill">
<input type="radio" name="is_preleased"
class="config-field prelease-toggle"
data-key="is_preleased" value="0"> No
</label>

<div id="prelease_section" style="display:none;" class="mt-3">

<input type="number" class="form-control config-field mb-2"
placeholder="₹ Current rent per month"
data-key="current_rent">

<input type="number" class="form-control config-field mb-2"
placeholder="Lease tenure in years"
data-key="lease_tenure">

<input type="number" class="form-control config-field mb-2"
placeholder="Annual rent increase in %"
data-key="annual_rent_increase">

<input type="text" class="form-control config-field mb-2"
placeholder="Leased to - Business Type"
data-key="leased_to">


<!-- INVESTOR SECTION -->
<div class="border rounded p-3 mt-3">

<h6>💡 Investors tend to look for <small>(Optional)</small></h6>

<input type="text" class="form-control config-field mb-2"
placeholder="Assured Returns"
data-key="assured_returns">

<div id="lease_more" style="display:none;">
<input type="number" class="form-control config-field"
placeholder="Lease guarantee in years"
data-key="lease_years">
</div>

<a href="javascript:void(0)" id="toggleLease" class="text-primary">
+ Add Lease Guarantee
</a>

</div>

</div>

</div>
</div>


<!-- DESCRIPTION -->
<div class="card mt-3">
<div class="card-body">

<h5>What makes your property unique</h5>

<textarea class="form-control config-field"
rows="4"
data-key="description"
placeholder="Share details like spacious area, connectivity etc"></textarea>

</div>
</div>

`;
}
 container.html(html);

        // 🔥 IMPORTANT FIXES
        setOldData();
        triggerAllToggles(); // 👈 MOST IMPORTANT
    }

    // =========================
    // 💾 SAVE JSON (FIXED)
    
    
    
    $(document).on('click', '#togglePricing', function () {

    let section = $('#morePricingSection');

    if (section.is(':visible')) {
        section.slideUp();
        $(this).text('+ Add more pricing details');
    } else {
        section.slideDown();
        $(this).text('- Hide pricing details');
    }

});


function collectConfigData() {

    let data = {};

    $('#dynamicStep4Form').find('input, textarea, select').each(function(){

        let key = $(this).data('key');
        if(!key) return;

        let type = $(this).attr('type');

        // ✅ RADIO
        if(type === 'radio'){
            if($(this).is(':checked')){
                data[key] = $(this).val();
            }
        }

        // ✅ CHECKBOX
        else if(type === 'checkbox'){

            // array support
            if(key.includes('[]')){
                let baseKey = key.replace('[]','');

                if(!data[baseKey]) data[baseKey] = [];

                if($(this).is(':checked')){
                    data[baseKey].push($(this).val());
                }
            }else{
                data[key] = $(this).is(':checked') ? 1 : 0;
            }
        }

        // ✅ NORMAL INPUT
        else{
            let val = $(this).val();

            if(val !== '' && val !== null){
                data[key] = val;
            }
        }

    });

    // 🔥 IMPORTANT
    $('#config_json').val(JSON.stringify(data));
}

// 🔥 FORM SUBMIT
$(document).on('change keyup', '#dynamicStep4Form input, #dynamicStep4Form textarea, #dynamicStep4Form select', function(){
    collectConfigData();
});
$(document).on('change', '.prelease-toggle', function() {
    // Agar "Yes" (value 1) select hua hai toh section dikhao, warna hide karo
    if ($(this).val() == '1') {
        $('#prelease_section').slideDown();
    } else {
        $('#prelease_section').slideUp();
    }
});
function populateConfigData(data){

    $('#dynamicStep4Form').find('[data-key]').each(function(){

        let key = $(this).data('key');
        let type = $(this).attr('type');

        if(data[key] === undefined) return;

        // RADIO
        if(type === 'radio'){
            if($(this).val() == data[key]){
                $(this).prop('checked', true);
            }
        }

        // CHECKBOX
        else if(type === 'checkbox'){

            if(key.includes('[]')){
                let baseKey = key.replace('[]','');

                if(data[baseKey] && data[baseKey].includes($(this).val())){
                    $(this).prop('checked', true);
                }
            }else{
                $(this).prop('checked', data[key] == 1);
            }
        }

        // INPUT
        else{
            $(this).val(data[key]);
        }

    });
}
    // =========================
    // 🔁 EDIT LOAD (FIXED)
    // =========================
function setOldData(){

    let json = $('#config_json').val();

    if(!json) return;

    let data = JSON.parse(json);

    $('#dynamicStep4Form .config-field').each(function(){

        let key = $(this).data('key');
        let type = $(this).attr('type');

        if(data[key] !== undefined){

            if(type === 'radio'){
                if($(this).val() == data[key]){
                    $(this).prop('checked', true);
                }
            }
            else if(type === 'checkbox'){
                $(this).prop('checked', data[key] == 1);
            }
            else{
                $(this).val(data[key] ?? '');
            }
        }
    });
}


// ADDITIONAL PRICING TOGGLE
$(document).on('click', '#togglePricing', function(){

    $('#pricing_more_section').slideToggle();

    let text = $(this).text();

    if(text.includes('Add')){
        $(this).text('- Hide pricing details');
    } else {
        $(this).text('+ Add more pricing details');
    }
});
$(document).on('click','#togglePricing56',function(){
    $('#pricing_more_56').slideToggle();
});
$(document).on('click','#toggleLease',function(){
    $('#lease_more').slideToggle();
});
    // =========================
    // 🔥 TOGGLE FIX (AUTO LOAD)
    // =========================
    function triggerAllToggles(){

        // deposit
         let bro = $('#dynamicStep4Form input[name="brokerage_required"]:checked').val();

    if(bro == "1"){
        $('#brokerage_section').show();
    } else {
        $('#brokerage_section').hide();
    }

    // 🔥 DEPOSIT
    let dep = $('#dynamicStep4Form input[name="deposit_type"]:checked').val();

    if(dep && dep != 'none'){
        $('#deposit_input').show();
    } else {
        $('#deposit_input').hide();
    }

        // food
        let food = $('input[name="food_available"]:checked').val();
        if(food == 1){
            $('#food_section').show();
        } else {
            $('#food_section').hide();
        }

        // food charge
        let type = $('input[name="food_charge_type"]:checked').val();
        $('#per_meal_section').hide();
        $('#fixed_food_section').hide();

        if(type == 'per_meal'){
            $('#per_meal_section').show();
        }
        else if(type == 'fixed'){
            $('#fixed_food_section').show();
        }

        // early
        let early = $('input[name="early"]:checked').val();
        $('#early_fixed').hide();
        $('#early_multiple').hide();

        if(early == 'fixed'){
            $('#early_fixed').show();
        }
        else if(early == 'multiple'){
            $('#early_multiple').show();
        }
    }

    // =========================
    // 🎯 EVENTS (NO CHANGE)
    // =========================
    $(document).on('change','.deposit-toggle', triggerAllToggles);
    $(document).on('change','.brokerage-toggle', triggerAllToggles);
    $(document).on('change','.food-toggle', triggerAllToggles);
    $(document).on('change','.food-charge-toggle', triggerAllToggles);
    $(document).on('change','.early-toggle', triggerAllToggles);

    // =========================
    // 🔥 SAVE TRIGGER
    // =========================
    $(document).ready(function(){

    let existing = $('#config_json').val();

    if(existing){
        try{
            let data = JSON.parse(existing);
            populateConfigData(data);
        }catch(e){
            console.log('Invalid JSON');
        }
    }

});
$(document).on("click", ".step-next, #finalSave", function (e) {

    e.preventDefault();

    let data = {};

    $('#dynamicStep4Form .config-field').each(function(){

        let key = $(this).data('key');

        if(!key) return;

        if($(this).attr('type') === 'checkbox'){
            data[key] = $(this).is(':checked') ? 1 : 0;
        } else {
            data[key] = $(this).val();
        }

    });

    console.log("FINAL JSON:", data);

    $('#config_json').val(JSON.stringify(data));

});
    
});


</script>

<script>

// ================= PRICE IN WORDS =================
function numberToWords(num) {

    let a = ['','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten',
    'Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen',
    'Eighteen','Nineteen'];

    let b = ['', '', 'Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety'];

    if ((num = num.toString()).length > 9) return 'Overflow';

    let n = ('000000000' + num).substr(-9).match(/.{1,2}/g);

    let str = '';
    str += (n[0] != 0) ? (a[n[0]] || b[n[0][0]] + " " + a[n[0][1]]) + " Crore " : '';
    str += (n[1] != 0) ? (a[n[1]] || b[n[1][0]] + " " + a[n[1][1]]) + " Lakh " : '';
    str += (n[2] != 0) ? (a[n[2]] || b[n[2][0]] + " " + a[n[2][1]]) + " Thousand " : '';
    str += (n[3] != 0) ? (a[n[3]] || b[n[3][0]] + " " + a[n[3][1]]) + " Hundred " : '';

    return str + "Only";
}

$(document).on('input', '[data-key="expected_price"]', function(){
    let val = $(this).val();
    $('#priceInWords').text(val ? numberToWords(val) : '');
});

$(document).on('input', '[data-key="expected_rent"]', function(){
    let val = $(this).val();
    $('#rentInWords').text(val ? numberToWords(val) : '');
});

// ================= PRICE PER SQFT =================
$(document).on('input', '[data-key="expected_price"], [data-key="builtup_area"]', function(){

    let price = parseFloat($('[data-key="expected_price"]').val());
    let area = parseFloat($('[data-key="builtup_area"]').val());

    if(price && area){
        let perSqft = Math.round(price / area);
        $('[data-key="price_per_sqft"]').val(perSqft);
    }
});


// ================= TOGGLE EXTRA =================
$('#toggleExtra').click(function(){
    $('#extraSection').slideToggle();
});


// ================= BROKERAGE TOGGLE =================
$('input[name="brokerage_required"]').change(function(){
    if($(this).val() == 1){
        $('#brokerage_section').slideDown();
    } else {
        $('#brokerage_section').slideUp();
    }
});


// ================= % VALIDATION =================
$('#brokerage_amount').on('input', function(){

    let type = $('input[name="brokerage_type"]:checked').val();
    let val = parseFloat($(this).val());

    if(type === 'percentage' && val > 100){
        alert('Percentage cannot exceed 100');
        $(this).val('');
    }
});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelector('.step-next[data-next="5"]').addEventListener('click', function(e){

    let thumbnail = document.querySelector('input[name="thumbnail_image"]').files.length;
    let slider = document.querySelector('input[name="slider_images[]"]').files.length;
    let video = document.querySelector('input[name="video_file"]').files.length;

    let existingThumb = document.querySelector('.thumbnail-preview img') ? 1 : 0;
    let existingSlider = document.querySelectorAll('#existing-sliders .thumbnail-preview').length;

    if(thumbnail === 0 && slider === 0 && video === 0 && existingThumb === 0 && existingSlider === 0){

        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'Media Required',
            text: 'Please upload at least one image or video!',
            confirmButtonColor: '#f97316'
        });

        return false;
    }

});



</script>
<script>

// CHARACTER COUNT + PREVIEW
const seoTitle = document.getElementById('seo_title');
const seoDesc = document.getElementById('seo_meta_description');

seoTitle.addEventListener('input', function () {
    document.getElementById('titleCount').innerText = this.value.length;
    document.getElementById('previewTitle').innerText = this.value || 'Sample Title';
});

seoDesc.addEventListener('input', function () {
    document.getElementById('descCount').innerText = this.value.length;
    document.getElementById('previewDesc').innerText = this.value || 'Sample description...';
});


// SAVE STEP 7
function saveStep7() {

    let formData = new FormData();

    formData.append('step', 7);
    formData.append('property_id', window.property_id || '');

    formData.append('seo_title', seoTitle.value);
    formData.append('seo_meta_description', seoDesc.value);

    fetch("{{ route('admin.property.save-step') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {

        if (res.status === 'success') {

            window.property_id = res.property_id;

            alert('✅ SEO Saved Successfully');

            // 👉 Next Step (if exists)
            // goToStep(8);

        } else {
            alert('❌ Error saving data');
        }

    })
    .catch(err => {
        console.log(err);
        alert('❌ Something went wrong');
    });
}


$(document).on('input', '#total_floors', function () {

    let total = parseInt($(this).val());
    let dropdown = $('#property_floor');

    dropdown.html('<option value="">Property on floor</option>');

    if (!total || total <= 0) return;

    dropdown.append('<option value="Basement">Basement</option>');
    dropdown.append('<option value="Ground">Ground</option>');

    for (let i = 1; i <= total; i++) {
        dropdown.append(`<option value="${i}">Floor ${i}</option>`);
    }

});
</script>
<script>
$(document).on('input', '[data-key="total_floors"]', function () {

    let total = parseInt($(this).val());
    let floorSelect = $('[data-key="property_floor"]');

    // reset dropdown
    floorSelect.html('<option value="">Property on floor</option>');

    if (!total || total <= 0) return;

    // Ground
    floorSelect.append('<option value="ground">Ground</option>');

    // Floors
    for (let i = 1; i <= total; i++) {
        floorSelect.append('<option value="'+i+'">'+i+'</option>');
    }

});
$(document).on('change', '.config-field-radio', function () {
    let key = $(this).data('key');
    let value = $(this).val();

    console.log(key, value); // debug
});
</script>
@endsection