@extends('layout')
@section('title')
    <title>{{ __('user.Payment') }}</title>
@endsection
@section('meta')
    <meta name="title" content="{{ __('user.Payment') }}">
    <meta name="description" content="{{ __('user.Payment') }}">
@endsection

@section('frontend-content')

<!-- Minimal styles for popup visibility -->
<style>
    .payment-popup__top { position: relative; }
    .payment-popup__top .payment-popup { display: none; position: absolute; right: 0; top: 48px; z-index: 999; width: 100%; max-width: 420px; background: #fff; border: 1px solid #eee; box-shadow: 0 6px 24px rgba(0,0,0,0.12); padding: 18px; border-radius: 8px; }
    .payment-popup__top.active .payment-popup { display: block; }
    .payment-popup__header { margin-bottom: 12px; }
    .error.d-none { display: none; color: #a94442; margin-top: 8px; }
    .error { color: #a94442; }
    .input-error { border-color: #e74c3c !important; }
</style>

    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{ __('user.Home') }}</a></li>
                            <li class="active"><a href="javascript:;">{{ __('user.Payment') }}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{ __('user.Payment') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <section class="pd-top-80 pd-btm-80 payment-package-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <h3 class="homec-package-detail__heading">{{ __('user.PACKAGE DETAILS') }}</h3>
                    <div class="homec-package-detail">
                        <table class="homec-package-detail__table">
                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Package') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ $pricing_plan->plan_name }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Price') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ num_format($pricing_plan->plan_price) }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Expired') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ date('d M Y', strtotime($plan_expired_date)) }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Agency Profile') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->max_agent_add > 0)
                                        {{ __('user.Available') }}
                                    @else
                                        {{ __('user.Unavailable') }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Agent') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ $pricing_plan->max_agent_add }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Property') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->number_of_property == -1)
                                        {{ __('user.Unlimited') }}
                                    @else
                                        {{ $pricing_plan->number_of_property }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Featured Property') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->featured_property == 'enable')
                                        {{ __('user.Available') }}
                                    @else
                                        {{ __('user.Unavailable') }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Featured Property') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->featured_property_qty == -1)
                                        {{ __('user.Unlimited') }}
                                    @else
                                        {{ $pricing_plan->featured_property_qty }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Top Property') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->top_property == 'enable')
                                        {{ __('user.Available') }}
                                    @else
                                        {{ __('user.Unavailable') }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Top Property') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->top_property_qty == -1)
                                        {{ __('user.Unlimited') }}
                                    @else
                                        {{ $pricing_plan->top_property_qty }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Urgent Property') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->urgent_property == 'enable')
                                        {{ __('user.Available') }}
                                    @else
                                        {{ __('user.Unavailable') }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Urgent Property') }}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->urgent_property_qty == -1)
                                        {{ __('user.Unlimited') }}
                                    @else
                                        {{ $pricing_plan->urgent_property_qty }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Aminities') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ __('user.Unlimited') }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Image Gallery') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ __('user.Unlimited') }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Nearest Location') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ __('user.Unlimited') }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Property Plan') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ __('user.Unlimited') }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{ __('user.Additional Information') }}</h4></td>
                                <td><span class="homec-package-detail__value">{{ __('user.Unlimited') }}</span></td>
                            </tr>

                        </table>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="homec-payment-method">
                        <!-- Digital (Stripe) popup wrapper -->
                        <div class="payment-popup__top payment-popup__top--digital" id="digitalPopupWrapper">
                            <div class="payment-popup">
                                <h4 class="payment-popup__title">{{ __('user.Stripe Payment') }}</h4>
                                <div class="payment-popup__inner">
                                    <div class="payment-popup__header">
                                        <h4 class="payment-popup__heading">{{ __('user.Total') }} <b>{{ num_format($pricing_plan->plan_price) }}</b></h4>
                                    </div>

                                    <form role="form" action="{{ route('pay-with-stripe', $pricing_plan->plan_slug) }}" method="POST"
                                          class="require-validation ecom-wc__form-main p-0" data-cc-on-file="false"
                                          data-stripe-publishable-key="{{ $stripe->stripe_key }}" id="payment-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group homec-form-input">
                                                    <input class="ecom-wc__form-input card-number required-field" type="text" name="card_number" placeholder="{{ __('user.Card Number') }}" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group homec-form-input">
                                                    <input class="ecom-wc__form-input card-expiry-month required-field" type="text" name="month" placeholder="{{ __('user.Month') }}" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group homec-form-input">
                                                    <input class="ecom-wc__form-input card-expiry-year required-field" type="text" name="year" placeholder="{{ __('user.Year') }}" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group homec-form-input">
                                                    <input class="ecom-wc__form-input card-cvc required-field" type="text" name="cvc" placeholder="{{ __('user.CVV') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 mg-top-20">
                                                <button type="submit" class="homec-btn homec-btn__second homec-btn--payment"><span>{{ __('user.Payment Now') }}</span></button>
                                            </div>

                                            <div class="col-12 error d-none" id="cardError">
                                                <div class="payment-popup__error">{{ __('user.Please provide your valid card information') }}</div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- End Digital popup -->

                        <!-- Bank popup wrapper -->
                        <div class="payment-popup__top payment-popup__top--bank" id="bankPopupWrapper">
                            <div class="payment-popup">
                                <h4 class="payment-popup__title">{{ __('user.Bank Payment') }}</h4>
                                <div class="payment-popup__inner">
                                    <div class="payment-popup__header">
                                        <h4 class="payment-popup__heading">{{ __('user.Total') }} <b>{{ num_format($pricing_plan->plan_price) }}</b></h4>
                                    </div>
                                    <ul class="payment-popup__bank-list">
                                        <p>{!! clean(nl2br($bankPayment->account_info)) !!}</p>
                                    </ul>
                                    <form class="ecom-wc__form-main p-0" method="post" action="{{ route('bank-payment', $pricing_plan->plan_slug) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group homec-form-input">
                                                    <textarea class="ecom-wc__form-input" name="tnx_info" placeholder="{{ __('user.Transaction information') }}" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 mg-top-20">
                                                <button type="submit" class="homec-btn homec-btn__second homec-btn--payment"><span>{{ __('user.Payment Now') }}</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Bank popup -->

                        <ul class="homec-payment-method__list">

                            @if ($stripe->status == 1)
                            <li>
                                <a href="javascript:;" class="stripe-method-toggle">
                                    <input class="form-check-input payment-stripe-button" type="radio" value="" id="payment-7" name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-7"><img src="{{ asset($stripe->image) }}" alt="stripe"></label>
                                </a>
                            </li>
                            @endif

                            @if ($paypal->status == 1)
                            <li>
                                <a href="{{ route('pay-with-paypal', $pricing_plan->plan_slug) }}">
                                    <label class="form-check-label homec-payment-method__label" for="payment-1"><img src="{{ asset($paypal->image) }}" alt="paypal"></label>
                                </a>
                            </li>
                            @endif

                            @if ($razorpay->status == 1)
                            <li>
                                <a href="javascript:;" id="razorpayBtn">
                                    <input class="form-check-input" type="radio" value="" id="payment-2"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-2"><img src="{{ asset($razorpay->image) }}" alt="razorpay"></label>
                                </a>
                            </li>

                            <form action="{{ route('pay-with-razorpay', $pricing_plan->plan_slug) }}" method="POST" class="d-none">
                                @csrf
                                @php
                                    $payable_amount = $pricing_plan->plan_price * $razorpay->currency_rate;
                                    $payable_amount = round($payable_amount, 2);
                                @endphp
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="{{ $razorpay->key }}"
                                        data-currency="{{ $razorpay->currency_code }}"
                                        data-amount= "{{ $payable_amount * 100 }}"
                                        data-buttontext="{{ __('user.Pay') }} {{ $payable_amount }} {{ $razorpay->currency_code }}"
                                        data-name="{{ $razorpay->name }}"
                                        data-description="{{ $razorpay->description }}"
                                        data-image="{{ asset($razorpay->image) }}"
                                        data-prefill.name=""
                                        data-prefill.email=""
                                        data-theme.color="{{ $razorpay->color }}">
                                </script>
                            </form>
                            @endif

                            @if ($flutterwave->status == 1)
                            <li>
                                <a onclick="flutterwavePayment()" href="javascript:;">
                                    <input class="form-check-input" type="radio" value="" id="payment-3"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-3"><img src="{{ asset($flutterwave->logo) }}" alt="flutterwave"></label>
                                </a>
                            </li>
                            @endif

                            @if ($mollie->mollie_status ==1)
                            <li>
                                <a href="{{ route('pay-with-mollie',$pricing_plan->plan_slug) }}">
                                    <label class="form-check-label homec-payment-method__label" for="payment-4"><img src="{{ ($mollie->mollie_image)? asset($mollie->mollie_image) : asset($setting->default_placeholder)}}" alt="mollie"></label>
                                </a>
                            </li>
                            @endif

                            @if ($paystack->paystack_status == 1)
                            <li>
                                <a onclick="payWithPaystack()" href="javascript:;">
                                    <input class="form-check-input" type="radio" value="" id="payment-5"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-5"><img src="{{ ($paystack->paystack_image)? asset($paystack->paystack_image) : asset($setting->default_placeholder)}}" alt="paystack"></label>
                                </a>
                            </li>
                            @endif

                            @if ($instamojoPayment->status == 1)
                            <li>
                                <a href="{{ route('pay-with-instamojo', $pricing_plan->plan_slug) }}">
                                    <label class="form-check-label homec-payment-method__label" for="payment-51"><img src="{{ ($instamojoPayment->image)? asset($instamojoPayment->image) : asset($setting->default_placeholder)}}" alt="instamojo"></label>
                                </a>
                            </li>
                            @endif

                            @if ($bankPayment->status == 1)
                            <li>
                                <a href="javascript:;" class="bank-method-toggle">
                                    <input class="form-check-input payment-bank-button" type="radio" value="" id="payment-6"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-6"><img src="{{ ($bankPayment->image)? asset($bankPayment->image) : asset($setting->default_placeholder)}}" alt="bank"></label>
                                </a>
                            </li>
                            @endif

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download App -->
    <section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15" style="background-image:url({{ asset($mobile_app->app_bg) }})">
        <div class="homec-shape">
            <div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
            <div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
            <div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="download-app__middle">
                        <div class="download-app__content">
                            <div class="homec-section__head section-white mg-btm-30" data-aos="fade-up" data-aos-delay="400">
                                <h2 class="homec-section__title">{{ $mobile_app->full_title }}</h2>
                                <p class="sec-head__text">{{ $mobile_app->description }}</p>
                            </div>
                            <!-- App Download Button -->
                            <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                                <a href="{{ $mobile_app->app_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-apple"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->apple_btn_text1 }}</span><p>{{ $mobile_app->apple_btn_text2 }}</p></div>
                                    </div>
                                </a>
                                <a href="{{ $mobile_app->play_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-google-play"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->google_btn_text1 }}</span><p>{{ $mobile_app->google_btn_text2 }}</p></div>
                                    </div>
                                </a>
                            </div>
                            <!-- End App Download Button -->
                        </div>
                        <!-- Download Image -->
                        <div class="download-app__img" data-aos="fade-up" data-aos-delay="700">
                            <img src="{{ ($mobile_app->image)? asset($mobile_app->image) : asset($setting->default_placeholder)}}" alt="mobile_app">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Download App -->

    {{-- scripts: jQuery, Toastr, Stripe, Flutterwave, Paystack --}}
    <!-- jQuery (if your layout already includes it, remove this) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>

    <!-- Toastr (if used in project; remove if already included) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- start stripe payment --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        $(function() {
            var $body = $('body');
            var $digitalWrapper = $('#digitalPopupWrapper');
            var $bankWrapper = $('#bankPopupWrapper');
            var $stripeForm = $('#payment-form');

            // Helper validation function
            function validateCardInputs() {
                var valid = true;
                var fields = ['.card-number', '.card-expiry-month', '.card-expiry-year', '.card-cvc'];
                fields.forEach(function(sel){
                    var $el = $stripeForm.find(sel);
                    if (!$el.length || !$el.val() || $el.val().trim() === '') {
                        valid = false;
                        $el.addClass('input-error');
                    } else {
                        $el.removeClass('input-error');
                    }
                });
                return valid;
            }

            // Stripe form submit
            $stripeForm.on('submit', function(e) {
                var isDemo = "{{ env('APP_MODE') }}";
                if(isDemo == 'DEMO'){
                    e.preventDefault();
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                // client side check
                if (!validateCardInputs()) {
                    e.preventDefault();
                    $('#cardError').removeClass('d-none');
                    return;
                } else {
                    $('#cardError').addClass('d-none');
                }

                if (!$stripeForm.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($stripeForm.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $stripeForm.find('.card-number').val(),
                        cvc: $stripeForm.find('.card-cvc').val(),
                        exp_month: $stripeForm.find('.card-expiry-month').val(),
                        exp_year: $stripeForm.find('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('#cardError').removeClass('d-none').find('.payment-popup__error').text(response.error.message || '{{ __("user.Invalid card details") }}');
                } else {
                    var token = response['id'];
                    // remove sensitive data
                    $stripeForm.find('input.card-number, input.card-cvc, input.card-expiry-month, input.card-expiry-year').val('');
                    $stripeForm.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $stripeForm.get(0).submit();
                }
            }

            // Toggle popup: stripe
            $body.on('click', '.stripe-method-toggle, .payment-stripe-button', function(e){
                e.preventDefault();
                e.stopPropagation();
                $digitalWrapper.toggleClass('active');
                $bankWrapper.removeClass('active');
            });

            // Toggle popup: bank
            $body.on('click', '.bank-method-toggle, .payment-bank-button', function(e){
                e.preventDefault();
                e.stopPropagation();
                $bankWrapper.toggleClass('active');
                $digitalWrapper.removeClass('active');
            });

            // Close on outside click (single handler)
            $body.on('click.paymentPopups', function(e){
                var $target = $(e.target);
                if (!$target.closest('#digitalPopupWrapper').length && !$target.closest('.stripe-method-toggle').length) {
                    $digitalWrapper.removeClass('active');
                }
                if (!$target.closest('#bankPopupWrapper').length && !$target.closest('.bank-method-toggle').length) {
                    $bankWrapper.removeClass('active');
                }
            });

            // stop propagation inside popups
            $digitalWrapper.on('click', function(e){ e.stopPropagation(); });
            $bankWrapper.on('click', function(e){ e.stopPropagation(); });

            // Razorpay trigger: click the generated razorpay button (if present)
            $("#razorpayBtn").on("click", function(e){
                e.preventDefault();
                var $rpBtn = $('.razorpay-payment-button');
                if ($rpBtn.length) {
                    $rpBtn.first().click();
                } else {
                    // fallback
                    toastr.error('{{ __("user.Razorpay button not available") }}');
                }
            });

        });
    </script>
    {{-- end stripe payment --}}

    {{-- start flutterwave payment --}}
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    @php
        $payable_amount = $pricing_plan->plan_price * $flutterwave->currency_rate;
        $payable_amount = round($payable_amount, 2);
    @endphp
    <script>
        function flutterwavePayment() {
            var isDemo = "{{ env('APP_MODE') }}"
            if(isDemo == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }

            FlutterwaveCheckout({
                public_key: "{{ $flutterwave->public_key }}",
                tx_ref: "{{ substr(rand(0,time()),0,10) }}",
                amount: {{ $payable_amount }},
                currency: "{{ $flutterwave->currency_code }}",
                country: "{{ $flutterwave->country_code }}",
                payment_options: " ",
                customer: {
                    email: "{{ $user->email }}",
                    phone_number: "{{ $user->phone }}",
                    name: "{{ $user->name }}",
                },
                callback: function (data) {
                    var tnx_id = data.transaction_id;
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'post',
                        data : {tnx_id,_token},
                        url: "{{ url('pay-with-flutterwave') }}" + "/" + "{{ $pricing_plan->plan_slug }}",
                        success: function (response) {
                            if(response.status == 'success'){
                                toastr.success(response.message);
                                window.location.href = "{{ route('user.dashboard') }}";
                            }else{
                                toastr.error(response.message);
                                window.location.reload();
                            }
                        },
                        error: function(err) {
                            toastr.error('Server Error');
                        }
                    });
                },
                customizations: {
                    title: "{{ $flutterwave->title }}",
                    logo: "{{ asset($flutterwave->logo) }}",
                },
            });
        }
    </script>
    {{-- end flutterwave payment --}}

    {{-- paystack start --}}
    <script src="https://js.paystack.co/v1/inline.js"></script>
    @php
        $public_key = $paystack->paystack_public_key;
        $currency = $paystack->paystack_currency_code;
        $currency = strtoupper($currency);

        $ngn_amount = $pricing_plan->plan_price * $paystack->paystack_currency_rate;
        $ngn_amount = $ngn_amount * 100;
        $ngn_amount = round($ngn_amount);
    @endphp
    <script>
        function payWithPaystack(){
            var isDemo = "{{ env('APP_MODE') }}"
            if(isDemo == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }

            var handler = PaystackPop.setup({
                key: '{{ $public_key }}',
                email: '{{ $user->email }}',
                amount: '{{ $ngn_amount }}',
                currency: "{{ $currency }}",
                callback: function(response){
                    let reference = response.reference;
                    let tnx_id = response.transaction;
                    let _token = "{{ csrf_token() }}";
                    $.ajax({
                        type: "get",
                        data: {reference, tnx_id, _token},
                        url: "{{ url('pay-with-paystack') }}" + "/" + "{{ $pricing_plan->plan_slug }}",
                        success: function(response) {
                            if(response.status == 'success'){
                                toastr.success(response.message);
                                window.location.href = "{{ route('user.dashboard') }}";
                            }else{
                                toastr.error(response.message);
                                window.location.reload();
                            }
                        },
                        error: function(response){
                            toastr.error('Server Error');
                            window.location.reload();
                        }
                    });
                },
                onClose: function(){
                    // optional: notify user
                }
            });
            handler.openIframe();
        }
    </script>
    {{-- end paystack --}}

@endsection
