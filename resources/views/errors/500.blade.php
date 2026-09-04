@php
    $error_404=App\Models\ErrorPage::find(1);
@endphp

@extends('layout')
@section('title')
    <title>{{ $error_404->page_name }}</title>
@endsection
@section('meta')
<meta name="title" content="{{ $error_404->page_name }}">
<meta name="description" content="{{ $error_404->page_name }}">
<meta name="robots" content="noindex, nofollow">
@endsection

@section('frontend-content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: { 50:'#fff7ed',100:'#ffedd5',200:'#fed7aa',300:'#fdba74',400:'#fb923c',500:'#f97316',600:'#ea580c',700:'#c2410c' },
                        dark: { 800:'#1a1a1a',900:'#0f0f0f',950:'#050505' }
                    }
                }
            }
        }
    </script>

    <style>
        *{font-family:'Inter',sans-serif}
        .tag-badge{background:linear-gradient(135deg,#f97316,#ea580c)}
        .hero-gradient{background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%)}
        .section-divider{height:1px;background:linear-gradient(to right,transparent,#e5e7eb,transparent)}
        .nav-link{position:relative}
        .nav-link::after{content:'';position:absolute;bottom:-2px;left:0;width:0;height:2px;background:#f97316;transition:width .3s}
        .nav-link:hover::after{width:100%}
        .btn-primary-c{background:linear-gradient(135deg,#f97316,#ea580c);transition:all .3s}
        .btn-primary-c:hover{background:linear-gradient(135deg,#ea580c,#c2410c);transform:translateY(-1px);box-shadow:0 4px 15px rgba(249,115,22,.4)}
        .btn-outline-c{border:2px solid #f97316;color:#f97316;transition:all .3s}
        .btn-outline-c:hover{background:#f97316;color:#fff}
        .toast-anim{animation:slideUp .4s ease-out,fadeOut .4s ease-in 2.6s forwards}
        @keyframes slideUp{from{transform:translateY(100%);opacity:0}to{transform:translateY(0);opacity:1}}
        @keyframes fadeOut{from{opacity:1}to{opacity:0}}
        .modal-anim{animation:modalIn .3s ease-out}
        @keyframes modalIn{from{transform:scale(.95) translateY(20px);opacity:0}to{transform:scale(1) translateY(0);opacity:1}}

        /* 500 Number */
        .error-number{
            font-size:clamp(8rem,20vw,16rem);
            font-weight:900;
            line-height:1;
            background:linear-gradient(135deg,#ef4444 0%,#dc2626 30%,#b91c1c 60%,#991b1b 100%);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            background-clip:text;
            filter:drop-shadow(0 20px 40px rgba(239,68,68,.3));
            user-select:none;
            position:relative;
        }
        .error-number::before{
            content:'500';
            position:absolute;
            inset:0;
            background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            background-clip:text;
            filter:blur(30px);
            opacity:.4;
            z-index:-1;
        }

        /* Floating elements */
        .float-element{
            position:absolute;
            border-radius:50%;
            opacity:.08;
            animation:floatAnim 6s ease-in-out infinite;
        }
        .float-element:nth-child(2){animation-delay:-1s;animation-duration:8s}
        .float-element:nth-child(3){animation-delay:-2s;animation-duration:7s}
        .float-element:nth-child(4){animation-delay:-3s;animation-duration:9s}
        .float-element:nth-child(5){animation-delay:-4s;animation-duration:6.5s}
        @keyframes floatAnim{
            0%,100%{transform:translateY(0) rotate(0deg)}
            33%{transform:translateY(-15px) rotate(5deg)}
            66%{transform:translateY(10px) rotate(-3deg)}
        }

        /* Glitch on hover */
        .error-glitch:hover .error-number{animation:glitch .3s ease-in-out}
        @keyframes glitch{
            0%{transform:translate(0)}
            20%{transform:translate(-3px,2px)}
            40%{transform:translate(3px,-2px)}
            60%{transform:translate(-2px,-1px)}
            80%{transform:translate(2px,1px)}
            100%{transform:translate(0)}
        }

        /* Error image */
        .error-img-wrap{
            position:relative;
            max-width:420px;
            margin:0 auto;
        }
        .error-img-wrap img{
            width:100%;
            border-radius:24px;
            box-shadow:0 25px 60px -15px rgba(0,0,0,.2);
            display:block;
        }
        .error-img-wrap::after{
            content:'';
            position:absolute;
            inset:-4px;
            border-radius:28px;
            background:linear-gradient(135deg,rgba(239,68,68,.3),rgba(220,38,38,.1));
            z-index:-1;
            animation:imgPulse 3s ease-in-out infinite;
        }
        @keyframes imgPulse{
            0%,100%{opacity:.6;transform:scale(1)}
            50%{opacity:1;transform:scale(1.02)}
        }

        /* Quick link cards */
        .quick-link-card{
            background:#fff;
            border:1px solid #f3f4f6;
            border-radius:16px;
            padding:20px;
            display:flex;
            align-items:center;
            gap:14px;
            transition:all .35s cubic-bezier(.2,.8,.2,1);
            text-decoration:none;
        }
        .quick-link-card:hover{
            border-color:#fed7aa;
            box-shadow:0 15px 30px -8px rgba(249,115,22,.12);
            transform:translateY(-4px);
        }
        .quick-link-card:hover .ql-icon{
            background:linear-gradient(135deg,#f97316,#ea580c);
            box-shadow:0 6px 16px rgba(249,115,22,.3);
        }
        .quick-link-card:hover .ql-icon i{color:#fff}
        .ql-icon{
            width:44px;height:44px;border-radius:12px;
            background:#fff7ed;display:flex;align-items:center;justify-content:center;
            flex-shrink:0;transition:all .35s;
        }
        .ql-icon i{color:#f97316;font-size:.9rem;transition:color .35s}
        .ql-text h4{font-size:.85rem;font-weight:700;color:#111827;margin:0 0 2px}
        .ql-text p{font-size:.75rem;color:#9ca3af;font-weight:500;margin:0}

        /* Warning pulse */
        .warning-ring{
            width:120px;height:120px;border-radius:50%;
            border:2px solid rgba(239,68,68,.2);
            display:flex;align-items:center;justify-content:center;
            margin:0 auto 32px;
            animation:warnPulse 2s ease-in-out infinite;
            position:relative;
        }
        .warning-ring::before{
            content:'';position:absolute;inset:-8px;border-radius:50%;
            border:1.5px solid rgba(239,68,68,.1);
            animation:warnPulse 2s ease-in-out infinite .3s;
        }
        @keyframes warnPulse{
            0%,100%{opacity:1;transform:scale(1)}
            50%{opacity:.5;transform:scale(1.05)}
        }

        /* Chatbot */
        .chat-fab{position:fixed;bottom:24px;right:24px;z-index:90;width:62px;height:62px;border-radius:50%;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 24px rgba(249,115,22,.5);transition:all .3s cubic-bezier(.34,1.56,.64,1)}
        .chat-fab:hover{transform:scale(1.12);box-shadow:0 6px 32px rgba(249,115,22,.6)}
        .chat-fab.active{transform:scale(0.92);box-shadow:0 2px 12px rgba(249,115,22,.3)}
        .chat-fab .fab-badge{position:absolute;top:-4px;right:-4px;min-width:20px;height:20px;border-radius:99px;background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center;border:2.5px solid #fff;animation:badgeBounce 2s ease-in-out infinite;padding:0 4px}
        @keyframes badgeBounce{0%,100%{transform:scale(1)}50%{transform:scale(1.2) translateY(-2px)}}
        .chat-fab .fab-ring{position:absolute;inset:-6px;border-radius:50%;border:2px solid rgba(249,115,22,.25);animation:ringPulse 3s ease-out infinite;pointer-events:none}
        @keyframes ringPulse{0%{transform:scale(1);opacity:1}100%{transform:scale(1.5);opacity:0}}
        .chat-panel{position:fixed;bottom:100px;right:24px;z-index:89;width:390px;max-width:calc(100vw - 32px);height:540px;max-height:calc(100vh - 140px);background:#fff;border-radius:22px;box-shadow:0 20px 60px rgba(0,0,0,.18),0 0 0 1px rgba(0,0,0,.04);display:flex;flex-direction:column;overflow:hidden;transform:scale(0) translateY(30px);transform-origin:bottom right;opacity:0;transition:all .4s cubic-bezier(.34,1.56,.64,1);pointer-events:none}
        .chat-panel.open{transform:scale(1) translateY(0);opacity:1;pointer-events:auto}
        .chat-header{background:linear-gradient(135deg,#1a1a2e 0%,#16213e 40%,#0f3460 100%);color:#fff;flex-shrink:0;position:relative;overflow:hidden}
        .chat-header::before{content:'';position:absolute;top:-30px;right:-30px;width:120px;height:120px;border-radius:50%;background:rgba(249,115,22,.12)}
        .chat-header::after{content:'';position:absolute;bottom:-20px;left:-20px;width:80px;height:80px;border-radius:50%;background:rgba(249,115,22,.08)}
        .chat-header-inner{padding:14px 16px;display:flex;align-items:center;gap:12px;position:relative;z-index:1}
        .ch-avatar-wrap{position:relative;flex-shrink:0}
        .ch-avatar{width:44px;height:44px;border-radius:14px;background:linear-gradient(135deg,#f97316,#fb923c);display:flex;align-items:center;justify-content:center;box-shadow:0 2px 10px rgba(249,115,22,.4)}
        .ch-avatar svg{width:28px;height:28px}
        .ch-avatar-status{position:absolute;bottom:-2px;right:-2px;width:14px;height:14px;border-radius:50%;background:#22c55e;border:2.5px solid #1a1a2e}
        .ch-info{flex:1;min-width:0}
        .ch-info h4{font-size:.88rem;font-weight:700;margin:0}
        .ch-info p{font-size:.68rem;color:rgba(255,255,255,.45);margin:2px 0 0;display:flex;align-items:center;gap:4px}
        .ch-info p .typing-live{color:#22c55e;font-weight:600}
        .ch-header-actions{display:flex;align-items:center;gap:4px}
        .ch-header-btn{width:32px;height:32px;border-radius:10px;background:rgba(255,255,255,.08);border:none;color:rgba(255,255,255,.6);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.8rem;transition:all .2s}
        .ch-header-btn:hover{background:rgba(255,255,255,.15);color:#fff}
        .ch-site-strip{padding:8px 16px 10px;background:rgba(255,255,255,.06);display:flex;align-items:center;gap:8px;position:relative;z-index:1;border-top:1px solid rgba(255,255,255,.06)}
        .ch-site-strip .ch-ss-icon{width:28px;height:28px;border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center}
        .ch-site-strip .ch-ss-name{font-size:.72rem;font-weight:600;color:rgba(255,255,255,.85)}
        .ch-site-strip .ch-ss-tag{font-size:.6rem;font-weight:700;color:#fb923c;background:rgba(249,115,22,.15);padding:2px 8px;border-radius:99px}
        .chat-messages{flex:1;overflow-y:auto;padding:16px 14px;display:flex;flex-direction:column;gap:6px;scroll-behavior:smooth;background:linear-gradient(180deg,#f8f9fb 0%,#fff 100%)}
        .chat-messages::-webkit-scrollbar{width:4px}
        .chat-messages::-webkit-scrollbar-thumb{background:#ddd;border-radius:99px}
        .chat-msg{max-width:85%;animation:msgSlideIn .35s cubic-bezier(.34,1.56,.64,1)}
        @keyframes msgSlideIn{from{transform:translateY(12px) scale(.96);opacity:0}to{transform:translateY(0) scale(1);opacity:1}}
        .chat-msg.bot{align-self:flex-start}
        .chat-msg.user{align-self:flex-end}
        .chat-msg .msg-row{display:flex;align-items:flex-end;gap:8px}
        .chat-msg.user .msg-row{flex-direction:row-reverse}
        .msg-avatar-sm{width:26px;height:26px;border-radius:8px;flex-shrink:0;background:linear-gradient(135deg,#f97316,#fb923c);display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(249,115,22,.25)}
        .msg-avatar-sm svg{width:16px;height:16px}
        .msg-avatar-sm.user-av{background:linear-gradient(135deg,#3b82f6,#6366f1)}
        .chat-msg .msg-bubble{padding:10px 14px;border-radius:16px;font-size:.8rem;line-height:1.55;word-wrap:break-word}
        .chat-msg.bot .msg-bubble{background:#fff;color:#333;border-bottom-left-radius:4px;box-shadow:0 1px 4px rgba(0,0,0,.06),0 0 0 1px rgba(0,0,0,.03)}
        .chat-msg.user .msg-bubble{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border-bottom-right-radius:4px;box-shadow:0 2px 8px rgba(249,115,22,.3)}
        .chat-msg .msg-bubble strong{font-weight:700}
        .chat-msg .msg-bubble a{color:#fff;text-decoration:underline}
        .chat-msg .msg-bubble button{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:8px 18px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;margin-top:6px;display:inline-flex;align-items:center;gap:4px;transition:all .2s}
        .chat-msg .msg-bubble button:hover{transform:scale(1.03);box-shadow:0 2px 8px rgba(249,115,22,.4)}
        .chat-msg .msg-bubble .inline-btns{display:flex;gap:8px;flex-wrap:wrap;margin-top:6px}
        .chat-msg .msg-bubble .inline-btns a{display:inline-flex;align-items:center;gap:4px;padding:7px 14px;border-radius:10px;font-size:11px;font-weight:600;color:#fff;text-decoration:none;transition:all .2s}
        .chat-msg .msg-bubble .inline-btns a:hover{transform:scale(1.03);filter:brightness(1.1)}
        .chat-msg .msg-time{font-size:.58rem;color:#b0b0b0;margin-top:3px;padding:0 2px;display:flex;align-items:center;gap:3px}
        .chat-msg.user .msg-time{justify-content:flex-end}
        .chat-msg .msg-time .msg-check{color:#f97316;font-size:.55rem}
        .chat-date-sep{display:flex;align-items:center;gap:10px;padding:8px 0}
        .chat-date-sep::before,.chat-date-sep::after{content:'';flex:1;height:1px;background:#e5e7eb}
        .chat-date-sep span{font-size:.65rem;font-weight:600;color:#aaa;background:linear-gradient(180deg,#f8f9fb,#fff);padding:2px 10px;border-radius:99px}
        .chat-quick{display:flex;flex-wrap:wrap;gap:6px;padding:4px 14px 10px;background:linear-gradient(180deg,#fff,#f8f9fb)}
        .chat-quick button{border:1.5px solid #e5e7eb;color:#444;background:#fff;font-size:.7rem;font-weight:600;padding:7px 13px;border-radius:99px;cursor:pointer;transition:all .25s;white-space:nowrap;box-shadow:0 1px 3px rgba(0,0,0,.04)}
        .chat-quick button:hover{border-color:#f97316;color:#f97316;background:#fff7ed;transform:translateY(-1px);box-shadow:0 3px 10px rgba(249,115,22,.12)}
        .chat-typing{display:flex;align-items:center;gap:5px;padding:12px 16px;background:#fff;border-radius:16px;border-bottom-left-radius:4px;width:fit-content;align-self:flex-start;box-shadow:0 1px 4px rgba(0,0,0,.06),0 0 0 1px rgba(0,0,0,.03)}
        .chat-typing span{width:7px;height:7px;border-radius:50%;background:#d1d5db;animation:typingBounce 1.4s ease-in-out infinite}
        .chat-typing span:nth-child(2){animation-delay:.15s}
        .chat-typing span:nth-child(3){animation-delay:.3s}
        @keyframes typingBounce{0%,60%,100%{transform:translateY(0);opacity:.4}30%{transform:translateY(-6px);opacity:1}}
        .chat-input-area{padding:10px 12px;border-top:1px solid #f0f0f0;display:flex;align-items:center;gap:8px;flex-shrink:0;background:#fff}
        .chat-input-wrap{flex:1;position:relative}
        .chat-input-wrap input{width:100%;border:2px solid #e5e7eb;border-radius:14px;padding:10px 40px 10px 14px;font-size:.8rem;outline:none;background:#f9fafb;transition:all .3s}
        .chat-input-wrap input:focus{border-color:#f97316;background:#fff;box-shadow:0 0 0 3px rgba(249,115,22,.08)}
        .chat-input-wrap .input-emoji{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:#ccc;font-size:1rem;cursor:pointer;transition:color .2s;padding:2px}
        .chat-input-wrap .input-emoji:hover{color:#f97316}
        .chat-input-area .chat-send{width:40px;height:40px;border-radius:14px;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .25s;flex-shrink:0;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;box-shadow:0 2px 8px rgba(249,115,22,.3)}
        .chat-input-area .chat-send:hover{transform:scale(1.08);box-shadow:0 4px 14px rgba(249,115,22,.4)}
        .chat-powered{padding:5px 14px;text-align:center;background:#fafafa;border-top:1px solid #f3f4f6;flex-shrink:0}
        .chat-powered span{font-size:.58rem;color:#c0c0c0;font-weight:500;letter-spacing:.3px}
        @media(max-width:768px){
            .chat-panel{right:8px;bottom:90px;width:calc(100vw - 16px);height:calc(100vh - 110px);max-height:none;border-radius:18px 18px 0 0}
            .chat-fab{bottom:18px;right:18px;width:56px;height:56px}
            .error-img-wrap{max-width:300px}
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- ========== TOP BAR ========== -->
    <div class="bg-dark-900 text-white text-xs py-2">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="tel:{{ $setting->phone ?? '' }}" class="flex items-center gap-1.5 hover:text-brand-400 transition"><i class="fas fa-phone text-[10px]"></i><span>{{ $setting->phone ?? '+91 98765 43210' }}</span></a>
                <a href="mailto:{{ $setting->email ?? '' }}" class="hidden sm:flex items-center gap-1.5 hover:text-brand-400 transition"><i class="fas fa-envelope text-[10px]"></i><span>{{ $setting->email ?? 'info@example.com' }}</span></a>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden sm:inline text-gray-400">Follow us:</span>
                @isset($setting->facebook)<a href="{{ $setting->facebook }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-facebook-f text-xs"></i></a>@endisset
                @isset($setting->instagram)<a href="{{ $setting->instagram }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-instagram text-xs"></i></a>@endisset
                @isset($setting->twitter)<a href="{{ $setting->twitter }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-twitter text-xs"></i></a>@endisset
                @isset($setting->youtube)<a href="{{ $setting->youtube }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-youtube text-xs"></i></a>@endisset
            </div>
        </div>
    </div>

    <!-- ========== MAIN NAVIGATION ========== -->
    <nav class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100" id="mainNav">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-lg tag-badge flex items-center justify-center"><i class="fas fa-building text-white text-lg"></i></div>
                    <div>
                        <span class="text-lg font-bold text-dark-900">{{ $setting->site_name ?? 'RealEstate' }}</span>
                        <p class="text-[10px] text-gray-400 -mt-1 tracking-wider uppercase">Premium Properties</p>
                    </div>
                </a>
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Home</a>
                    <a href="{{ route('properties') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Properties</a>
                    <a href="{{ route('agents') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Agents</a>
                    <a href="{{ route('blogs') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Blog</a>
                    @isset($pages)
                        @foreach($pages->take(2) as $page)
                            <a href="{{ route('page', $page->slug) }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">{{ Str::limit($page->title, 15) }}</a>
                        @endforeach
                    @endisset
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('contact-us') }}" class="btn-primary-c text-white text-sm font-semibold px-5 py-2.5 rounded-lg hidden sm:block">Contact Us</a>
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100"><i class="fas fa-bars text-xl"></i></button>
                </div>
            </div>
        </div>
        <div class="lg:hidden hidden bg-white border-t border-gray-100 pb-4" id="mobileMenu">
            <div class="px-4 pt-3 space-y-1">
                <a href="{{ route('home') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Home</a>
                <a href="{{ route('properties') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Properties</a>
                <a href="{{ route('agents') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Agents</a>
                <a href="{{ route('blogs') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Blog</a>
                @isset($pages)
                    @foreach($pages->take(2) as $page)
                        <a href="{{ route('page', $page->slug) }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">{{ $page->title }}</a>
                    @endforeach
                @endisset
                <a href="{{ route('contact-us') }}" class="block btn-primary-c text-white text-sm font-semibold px-5 py-2.5 rounded-lg mt-2 text-center">Contact Us</a>
            </div>
        </div>
    </nav>

    <!-- ========== 500 HERO ========== -->
    <section class="relative overflow-hidden hero-gradient py-16 md:py-28 min-h-[75vh] flex items-center">
        <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 2px 2px,rgba(255,255,255,.15) 1px,transparent 0);background-size:40px 40px;"></div>
        <div class="absolute top-10 right-10 w-72 h-72 bg-red-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/4 w-60 h-60 bg-orange-500/8 rounded-full blur-[80px] pointer-events-none"></div>

        <!-- Floating circles -->
        <div class="float-element w-20 h-20 bg-red-500 top-[15%] left-[8%]"></div>
        <div class="float-element w-14 h-14 bg-orange-400 top-[25%] right-[12%]"></div>
        <div class="float-element w-10 h-10 bg-red-300 bottom-[20%] left-[20%]"></div>
        <div class="float-element w-16 h-16 bg-yellow-400 bottom-[30%] right-[20%]"></div>
        <div class="float-element w-8 h-8 bg-red-200 top-[60%] left-[45%]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 w-full">
            <nav class="flex items-center gap-2 text-sm text-white/50 mb-10" data-aos="fade-right">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-red-400 font-medium">{{ $error_404->page_name }}</span>
            </nav>

            <div class="error-glitch text-center max-w-3xl mx-auto" data-aos="fade-up">
                <div class="error-number">500</div>
            </div>

            <div class="max-w-2xl mx-auto mt-8" data-aos="fade-up" data-aos-delay="200">
                <!-- Warning ring -->
                <div class="warning-ring" data-aos="zoom-in" data-aos-delay="150">
                    <i class="fas fa-exclamation-triangle text-red-400 text-3xl"></i>
                </div>

                <h2 class="text-2xl md:text-4xl font-extrabold text-white leading-tight mb-4 text-center">{{ $error_404->header }}</h2>
                <p class="text-white/55 text-base md:text-lg leading-relaxed mb-10 text-center max-w-lg mx-auto">Something went wrong on our end. Our team has been notified and is working to fix the issue. Please try again in a few minutes.</p>

                <!-- Error Image -->
                @if($error_404->image)
                <div class="error-img-wrap mb-10" data-aos="fade-up" data-aos-delay="250">
                    <img src="{{ asset($error_404->image) }}" alt="Error Illustration">
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4 justify-center" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('home') }}" class="btn-primary-c text-white text-sm font-semibold px-8 py-3.5 rounded-xl inline-flex items-center gap-2">
                        <i class="fas fa-home text-xs"></i> {{ $error_404->button_text }}
                    </a>
                    <button onclick="location.reload()" class="text-sm font-semibold px-8 py-3.5 rounded-xl inline-flex items-center gap-2 border-2 border-white/20 text-white hover:bg-white/10 transition">
                        <i class="fas fa-rotate-right text-xs"></i> Try Again
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== QUICK LINKS ========== -->
    <section class="py-14 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10" data-aos="fade-up">
                <span class="inline-flex items-center gap-1.5 bg-brand-50 text-brand-600 text-xs font-bold uppercase tracking-wider px-4 py-1.5 rounded-full mb-4 border border-brand-100"><i class="fas fa-compass text-[11px]"></i> While You Wait</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-dark-900">Helpful <span class="text-brand-500">Resources</span></h2>
                <p class="text-gray-400 text-sm mt-3">Explore our platform while we fix the issue</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('properties') }}" class="quick-link-card">
                    <div class="ql-icon"><i class="fas fa-building"></i></div>
                    <div class="ql-text"><h4>Browse Properties</h4><p>Explore apartments, villas, plots & more</p></div>
                </a>
                <a href="{{ route('agents') }}" class="quick-link-card">
                    <div class="ql-icon"><i class="fas fa-user-tie"></i></div>
                    <div class="ql-text"><h4>Find an Agent</h4><p>Connect with verified property experts</p></div>
                </a>
                <a href="{{ route('blogs') }}" class="quick-link-card">
                    <div class="ql-icon"><i class="fas fa-newspaper"></i></div>
                    <div class="ql-text"><h4>Read Our Blog</h4><p>Tips, guides & market insights</p></div>
                </a>
                <a href="{{ route('faq') }}" class="quick-link-card">
                    <div class="ql-icon"><i class="fas fa-circle-question"></i></div>
                    <div class="ql-text"><h4>Help & FAQ</h4><p>Answers to common questions</p></div>
                </a>
                <a href="{{ route('about-us') }}" class="quick-link-card">
                    <div class="ql-icon"><i class="fas fa-info-circle"></i></div>
                    <div class="ql-text"><h4>About Us</h4><p>Our story, mission & team</p></div>
                </a>
                <a href="{{ route('contact-us') }}" class="quick-link-card">
                    <div class="ql-icon"><i class="fas fa-envelope"></i></div>
                    <div class="ql-text"><h4>Contact Us</h4><p>Get in touch with our team</p></div>
                </a>
                <a href="{{ route('terms-and-conditions') }}" class="quick-link-card">
                    <div class="ql-icon"><i class="fas fa-file-contract"></i></div>
                    <div class="ql-text"><h4>Terms & Conditions</h4><p>Our terms of service</p></div>
                </a>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- ========== FOOTER ========== -->
    <footer class="bg-dark-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                <div class="col-span-2 md:col-span-4 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 rounded-lg tag-badge flex items-center justify-center"><i class="fas fa-building text-white text-sm"></i></div><span class="text-lg font-bold">{{ $setting->site_name ?? 'RealEstate' }}</span></div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $setting->footer_text ?? "Premium real estate platform offering the best properties in your city." }}</p>
                    <div class="flex gap-3">
                        @isset($setting->facebook)<a href="{{ $setting->facebook }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-facebook-f text-sm"></i></a>@endisset
                        @isset($setting->instagram)<a href="{{ $setting->instagram }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-instagram text-sm"></i></a>@endisset
                        @isset($setting->twitter)<a href="{{ $setting->twitter }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-twitter text-sm"></i></a>@endisset
                        @isset($setting->youtube)<a href="{{ $setting->youtube }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-youtube text-sm"></i></a>@endisset
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold text-sm mb-4">Quick Links</h5>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('home') }}" class="text-gray-400 text-sm hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('properties') }}" class="text-gray-400 text-sm hover:text-white transition">Properties</a></li>
                        <li><a href="{{ route('agents') }}" class="text-gray-400 text-sm hover:text-white transition">Agents</a></li>
                        <li><a href="{{ route('blogs') }}" class="text-gray-400 text-sm hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold text-sm mb-4">Property Types</h5>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('properties', ['type' => 'apartment']) }}" class="text-gray-400 text-sm hover:text-white transition">Apartments</a></li>
                        <li><a href="{{ route('properties', ['type' => 'villa']) }}" class="text-gray-400 text-sm hover:text-white transition">Villas</a></li>
                        <li><a href="{{ route('properties', ['type' => 'plot']) }}" class="text-gray-400 text-sm hover:text-white transition">Plots</a></li>
                        <li><a href="{{ route('properties', ['type' => 'commercial']) }}" class="text-gray-400 text-sm hover:text-white transition">Commercial</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold text-sm mb-4">Legal</h5>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('terms-and-conditions') }}" class="text-gray-400 text-sm hover:text-white transition">Terms & Conditions</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="text-gray-400 text-sm hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Disclaimer</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Refund Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold text-sm mb-4">Contact</h5>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2 text-gray-400 text-sm"><i class="fas fa-phone text-brand-400 text-xs mt-1"></i>{{ $setting->phone ?? '+91 98765 43210' }}</li>
                        <li class="flex items-start gap-2 text-gray-400 text-sm"><i class="fas fa-envelope text-brand-400 text-xs mt-1"></i>{{ $setting->email ?? 'info@example.com' }}</li>
                        <li class="flex items-start gap-2 text-gray-400 text-sm"><i class="fas fa-map-marker-alt text-brand-400 text-xs mt-1"></i>{{ $setting->address ?? 'Mumbai, India' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 py-5 flex flex-col md:flex-row items-center justify-between gap-3">
                <p class="text-gray-500 text-xs">&copy; {{ date('Y') }} {{ $setting->site_name ?? 'Your Company' }}. All Rights Reserved.</p>
                <div class="flex items-center gap-4 text-xs text-gray-500"><a href="#" class="hover:text-white transition">Privacy Policy</a><a href="#" class="hover:text-white transition">Terms of Service</a><a href="#" class="hover:text-white transition">Disclaimer</a></div>
            </div>
        </div>
    </footer>

    <!-- ========== ENQUIRY MODAL ========== -->
    <div class="fixed inset-0 z-[100] hidden" id="enquiryModal">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeEnquiry()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 relative modal-anim">
                <button onclick="closeEnquiry()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition"><i class="fas fa-times text-gray-500 text-sm"></i></button>
                <div class="text-center mb-5"><div class="w-12 h-12 rounded-full bg-brand-50 flex items-center justify-center mx-auto mb-3"><i class="fas fa-building text-brand-500 text-lg"></i></div><h3 class="text-lg font-bold text-dark-900" id="enquiryTitle">Enquire Now</h3><p class="text-gray-500 text-sm mt-1">Get exclusive pricing & floor plans</p></div>
                <form id="enquiryForm" class="space-y-3">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="property_name" id="enquiryPropertyName">
                    <input type="text" name="name" placeholder="Full Name *" required class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    <div class="flex gap-3"><input type="tel" name="phone" placeholder="Phone *" required class="flex-1 px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition"><input type="email" name="email" placeholder="Email" class="flex-1 px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition"></div>
                    <textarea name="message" placeholder="Any specific requirement?" rows="2" class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
                    <button type="submit" id="enquirySubmitBtn" class="w-full btn-primary-c text-white text-sm font-semibold py-3 rounded-xl flex items-center justify-center gap-2"><span>Get Free Consultation</span></button>
                    <p class="text-[10px] text-gray-400 text-center">By submitting, you agree to our Privacy Policy & Terms</p>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="fixed bottom-6 right-6 z-[110] space-y-2" id="toastContainer"></div>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone ?? '919876543210') }}" target="_blank" rel="noopener" class="fixed bottom-6 left-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition hover:scale-110"><i class="fab fa-whatsapp text-white text-2xl"></i></a>

    <!-- ========== CHATBOT ========== -->
    <button type="button" class="chat-fab" id="chatFab" aria-label="Open chat">
        <span class="fab-ring"></span>
        <span class="fab-badge" id="chatBadge">1</span>
        <svg id="chatFabIconOpen" width="26" height="26" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="20" r="12" fill="white"/><path d="M12 56c0-11.046 8.954-20 20-20s20 8.954 20 20" fill="white"/><path d="M26 17c0-2 1.5-4 6-4s6 2 6 4" stroke="#f97316" stroke-width="2" stroke-linecap="round" fill="none"/><circle cx="28" cy="19" r="1.2" fill="#f97316"/><circle cx="36" cy="19" r="1.2" fill="#f97316"/><path d="M29 23c0 0 1.5 2 3 2s3-2 3-2" stroke="#f97316" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg>
        <svg id="chatFabIconClose" width="24" height="24" viewBox="0 0 24 24" fill="none" style="display:none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6l12 12" stroke="white" stroke-width="2.5" stroke-linecap="round"/></svg>
    </button>

    <div class="chat-panel" id="chatPanel">
        <div class="chat-header">
            <div class="chat-header-inner">
                <div class="ch-avatar-wrap"><div class="ch-avatar"><svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="18" r="11" fill="white" opacity="0.95"/><path d="M13 55c0-10.493 8.507-19 19-19s19 8.507 19 19" fill="white" opacity="0.95"/><path d="M25 15.5c0-2 1.8-4.5 7-4.5s7 2.5 7 4.5" stroke="#ea580c" stroke-width="2.2" stroke-linecap="round" fill="none"/><circle cx="28" cy="18" r="1.3" fill="#ea580c"/><circle cx="36" cy="18" r="1.3" fill="#ea580c"/><path d="M29.5 22.5c0 0 1.3 2 2.5 2s2.5-2 2.5-2" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" fill="none"/><path d="M22 11c0 0 2-3 10-3s10 3 10 3" stroke="white" stroke-width="2.5" stroke-linecap="round" fill="none" opacity="0.7"/></svg></div><div class="ch-avatar-status"></div></div>
                <div class="ch-info"><h4>Priya — Property Advisor</h4><p id="chatStatusText">Online now</p></div>
                <div class="ch-header-actions"><button class="ch-header-btn" onclick="chatResetChat()" title="New chat"><i class="fas fa-rotate-right"></i></button><button class="ch-header-btn" onclick="closeChat()" title="Close"><i class="fas fa-xmark"></i></button></div>
            </div>
            <div class="ch-site-strip"><div class="ch-ss-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);border-radius:8px"><i class="fas fa-building text-white" style="font-size:12px"></i></div><div style="min-width:0;flex:1"><div class="ch-ss-name">{{ $setting->site_name ?? 'RealEstate' }}</div></div><div class="ch-ss-tag">Trusted</div></div>
        </div>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="chat-quick" id="chatQuick"></div>
        <div class="chat-input-area"><div class="chat-input-wrap"><input type="text" id="chatInput" placeholder="Type your question..." autocomplete="off"><button class="input-emoji" title="Emoji"><i class="far fa-smile"></i></button></div><button class="chat-send" id="chatSendBtn" onclick="chatSend()" aria-label="Send"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 2L11 13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button></div>
        <div class="chat-powered"><span>Powered by {{ $setting->site_name ?? 'RealEstate' }} AI</span></div>
    </div>

    <!-- ========== SCRIPTS ========== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        const BASE_URL = "{{ asset('/') }}";
        const DEFAULT_IMAGE = "{{ asset($setting->default_placeholder ?? 'default.jpg') }}";
        const SITE_NAME = "{{ $setting->site_name ?? 'RealEstate' }}";
        const SITE_PHONE = "{{ $setting->phone ?? '+91 98765 43210' }}";
        const SITE_PHONE_CLEAN = "{{ preg_replace('/[^0-9]/', '', $setting->phone ?? '919876543210') }}";
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof AOS !== 'undefined') AOS.init({ duration: 800, once: true, offset: 50 });

        if (typeof $ !== 'undefined') {
            $('#enquiryForm').on('submit', function (e) {
                e.preventDefault();
                var form = $(this), btn = $('#enquirySubmitBtn'), html = btn.html();
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');
                $.ajax({
                    url: '{{ route("enquiry.store") }}', method: 'POST', data: form.serialize(),
                    success: function (r) { closeEnquiry(); showToast(r.message || 'Enquiry submitted!', 'success'); form[0].reset(); },
                    error: function (x) { showToast((x.responseJSON && x.responseJSON.message) || 'Error', 'error'); },
                    complete: function () { btn.prop('disabled', false).html(html); }
                });
            });
        }

        window.addEventListener('scroll', function () {
            var n = document.getElementById('mainNav');
            if (window.pageYOffset > 50) { n.classList.add('shadow-md'); n.classList.remove('shadow-sm'); }
            else { n.classList.remove('shadow-md'); n.classList.add('shadow-sm'); }
        });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closeEnquiry(); closeChat(); } });
    });
    </script>

    <!-- Utility -->
    <script>
    function toggleMobileMenu() { document.getElementById('mobileMenu').classList.toggle('hidden'); }
    function showEnquiry(name) { document.getElementById('enquiryTitle').textContent = name ? ('Enquire: ' + name) : 'Enquire Now'; document.getElementById('enquiryPropertyName').value = name || ''; document.getElementById('enquiryModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
    function closeEnquiry() { document.getElementById('enquiryModal').classList.add('hidden'); document.body.style.overflow = ''; }
    function showToast(msg, type) {
        type = type || 'info'; var c = document.getElementById('toastContainer');
        var cls = { success:'bg-green-500', error:'bg-red-500', info:'bg-gray-800' };
        var ico = { success:'check-circle', error:'exclamation-circle', info:'info-circle' };
        var t = document.createElement('div');
        t.className = 'toast-anim flex items-center gap-3 ' + (cls[type]||cls.info) + ' text-white px-5 py-3 rounded-xl shadow-lg max-w-sm';
        t.innerHTML = '<i class="fas fa-' + (ico[type]||ico.info) + ' text-base shrink-0"></i><span class="text-sm">' + msg + '</span>';
        c.appendChild(t); setTimeout(function() { if (t.parentNode) t.remove(); }, 3200);
    }
    </script>

    <!-- Chatbot -->
    <script>
    (function() {
        'use strict';
        var WA='<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="18" r="11" fill="white"/><path d="M13 55c0-10.493 8.507-19 19-19s19 8.507 19 19" fill="white"/><path d="M25 15.5c0-2 1.8-4.5 7-4.5s7 2.5 7 4.5" stroke="#ea580c" stroke-width="2.2" stroke-linecap="round" fill="none"/><circle cx="28" cy="18" r="1.3" fill="#ea580c"/><circle cx="36" cy="18" r="1.3" fill="#ea580c"/><path d="M29.5 22.5s1.3 2 2.5 2 2.5-2 2.5-2" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg>';
        var UA='<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="20" r="11" fill="white"/><path d="M14 56c0-9.941 8.059-18 18-18s18 8.059 18 18" fill="white"/></svg>';
        var co=false,fo=true,cf=document.getElementById('chatFab'),cp=document.getElementById('chatPanel'),cm=document.getElementById('chatMessages'),ci=document.getElementById('chatInput'),cq=document.getElementById('chatQuick'),cb=document.getElementById('chatBadge'),cs=document.getElementById('chatStatusText');
        function gt(){var d=new Date(),h=d.getHours(),m=d.getMinutes(),a=h>=12?'PM':'AM';h=h%12||12;return h+':'+(m<10?'0':'')+m+' '+a}
        function am(t,tp,qa){var d=document.createElement('div');d.className='chat-msg '+tp;if(tp==='bot')d.innerHTML='<div class="msg-row"><div class="msg-avatar-sm">'+WA+'</div><div><div class="msg-bubble">'+t+'</div><div class="msg-time">'+gt()+'</div></div></div>';else d.innerHTML='<div class="msg-row"><div><div class="msg-bubble">'+t+'</div><div class="msg-time">'+gt()+' <i class="fas fa-check-double msg-check"></i></div></div><div class="msg-avatar-sm user-av">'+UA+'</div></div>';cm.appendChild(d);cm.scrollTop=cm.scrollHeight;if(qa)sqr(qa)}
        function st(){cs.innerHTML='<span class="typing-live">typing...</span>';var d=document.createElement('div');d.className='chat-msg bot';d.id='ti';d.innerHTML='<div class="msg-row"><div class="msg-avatar-sm">'+WA+'</div><div class="chat-typing"><span></span><span></span><span></span></div></div>';cm.appendChild(d);cm.scrollTop=cm.scrollHeight}
        function rt(){var t=document.getElementById('ti');if(t)t.remove();cs.innerHTML='Online now'}
        function br(t,dl,qa){st();setTimeout(function(){rt();am(t,'bot',qa)},dl||900)}
        function sqr(s){cq.innerHTML='';var r=s||[{label:'🏠 Browse Properties',key:'browse'},{label:'💰 Pricing Help',key:'pricing'},{label:'📍 Locations',key:'locations'},{label:'📞 Contact Agent',key:'contact'},{label:'💬 Enquire Now',key:'enquire'},{label:'🏦 Loan/EMI',key:'loan'}];r.forEach(function(x){var b=document.createElement('button');b.textContent=x.label;b.onclick=function(){cqr(x.key)};cq.appendChild(b)})}
        function hq(){cq.innerHTML=''}
        function ads(){var d=document.createElement('div');d.className='chat-date-sep';d.innerHTML='<span>Today, '+new Date().toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'})+'</span>';cm.appendChild(d)}
        function ic(){cm.innerHTML='';ads();am('👋 Hi! I\'m <strong>Priya</strong>, your property advisor at <strong>'+SITE_NAME+'</strong>.','bot');setTimeout(function(){am('How can I help? Ask about properties, pricing, locations, or loans!','bot','default')},600)}
        window.chatResetChat=function(){ic()};
        window.chatQuickReply=function(k){hq();var ut='',bt='',nq=null;
        switch(k){case'browse':ut='Browse properties';bt='🏠 <div style="display:flex;flex-direction:column;gap:6px;font-size:.78em"><a href="{{route('properties')}}" style="color:#f97316;text-decoration:none;font-weight:600">🏢 All Properties</a><a href="{{route('properties',['type'=>'apartment'])}}" style="color:#f97316;text-decoration:none;font-weight:600">🏠 Apartments</a><a href="{{route('properties',['type'=>'villa'])}}" style="color:#f97316;text-decoration:none;font-weight:600">🏡 Villas</a><a href="{{route('properties',['type'=>'plot'])}}" style="color:#f97316;text-decoration:none;font-weight:600">🏗️ Plots</a></div>';nq=[{label:'💰 Pricing',key:'pricing'},{label:'📍 Locations',key:'locations'}];break;case'pricing':ut='Pricing info';bt='💰 ₹15L to ₹3Cr+.<br>• Budget: ₹15-30L<br>• Mid: ₹30-80L<br>• Premium: ₹80L-3Cr+';nq=[{label:'🏠 Browse',key:'browse'},{label:'🏦 Loan',key:'loan'}];break;case'locations':ut='Cities';bt='📍 Mumbai, Pune, Bangalore, Delhi NCR, Hyderabad, Chennai & more!';nq=[{label:'🏠 Browse',key:'browse'},{label:'📞 Contact',key:'contact'}];break;case'contact':ut='Contact agent';bt='📞 <div class="inline-btns"><a href="tel:'+SITE_PHONE+'" style="background:linear-gradient(135deg,#f97316,#ea580c)"><i class="fas fa-phone" style="font-size:10px"></i> '+SITE_PHONE+'</a>'+(SITE_PHONE_CLEAN?'<a href="https://wa.me/'+SITE_PHONE_CLEAN+'" target="_blank" style="background:#22c55e"><i class="fab fa-whatsapp" style="font-size:12px"></i> WhatsApp</a>':'')+'</div>';nq=[{label:'💬 Enquire',key:'enquire'}];break;case'enquire':ut='Enquire';bt='💬 <button onclick="closeChat();showEnquiry(\'General\');" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer">✉️ Enquire Now</button>';nq=[{label:'📞 Contact',key:'contact'}];break;case'loan':ut='Loan info';bt='🏦 SBI, HDFC, ICICI at 8.5%+ rates.<br><button onclick="closeChat();showEnquiry(\'Loan\');" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;margin-top:4px">💬 Get Loan Help</button>';nq=[{label:'💰 Pricing',key:'pricing'}];break;default:ut='Help';bt='Ask about properties, pricing, cities, or loans!';nq='default'}
        am(ut,'user');br(bt,700,nq)};
        window.chatSend=function(){var t=ci.value.trim();if(!t)return;ci.value='';hq();am(t,'user');var l=t.toLowerCase(),r='',n=null;
        if(l.match(/price|cost|budget|cheap/i)){r='💰 ₹15L to ₹3Cr+. Search to filter!';n=[{label:'🏠 Browse',key:'browse'}]}
        else if(l.match(/apartment|flat|bhk|villa|plot/i)){r='🏠 All types available! Browse listings.';n=[{label:'🏠 Browse',key:'browse'}]}
        else if(l.match(/loan|emi|bank/i)){r='🏦 8.5%+ rates. <button onclick="closeChat();showEnquiry(\'Loan\');" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:8px 16px;border-radius:10px;font-size:11px;font-weight:600;cursor:pointer;margin-top:4px">Get Help</button>';n=[{label:'📞 Contact',key:'contact'}]}
        else if(l.match(/hi|hello|hey|help/i)){r='👋 Welcome! Ask about properties, pricing, cities!';n='default'}
        else if(l.match(/thank|bye/i)){r='😊 Come back anytime!';n='default'}
        else{r='🤔 Try: properties, pricing, cities, loans!';n='default'}
        br(r,800,n)};
        ci.addEventListener('keydown',function(e){if(e.key==='Enter'){e.preventDefault();chatSend()}});
        cf.addEventListener('click',function(){co=!co;cp.classList.toggle('open',co);cf.classList.toggle('active',co);document.getElementById('chatFabIconOpen').style.display=co?'none':'block';document.getElementById('chatFabIconClose').style.display=co?'block':'none';if(co&&fo){fo=false;cb.style.display='none';var rn=cf.querySelector('.fab-ring');if(rn)rn.style.display='none';ic();setTimeout(function(){ci.focus()},450)}else if(co)setTimeout(function(){ci.focus()},350)});
        window.closeChat=function(){co=false;cp.classList.remove('open');cf.classList.remove('active');document.getElementById('chatFabIconOpen').style.display='block';document.getElementById('chatFabIconClose').style.display='none'};
        setTimeout(function(){if(!co&&fo){cf.style.transform='scale(1.15)';setTimeout(function(){cf.style.transform=''},400)}},6000);
    })();
    </script>

</body>
</html>
@endsection