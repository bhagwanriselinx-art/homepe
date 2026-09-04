<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seo_setting->seo_title ?? 'Premium Real Estate Properties' }}</title>
    <meta name="description" content="{{ $seo_setting->seo_description ?? '' }}">
    @isset($seo_setting->seo_keywords)
    <meta name="keywords" content="{{ $seo_setting->seo_keywords }}">
    @endisset
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
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
        .no-scrollbar::-webkit-scrollbar{display:none}
        .no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
        .card-hover{transition:all .4s cubic-bezier(.2,.8,.2,1)}
        .card-hover:hover{transform:translateY(-8px);box-shadow:0 25px 50px rgba(0,0,0,.12)}
        .tag-badge{background:linear-gradient(135deg,#f97316,#ea580c)}
        .tag-green{background:linear-gradient(135deg,#22c55e,#16a34a)}
        .tag-blue{background:linear-gradient(135deg,#3b82f6,#2563eb)}
        .tag-yellow{background:linear-gradient(135deg,#f59e0b,#d97706)}
        .hero-gradient{background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%)}
        .search-glow{box-shadow:0 4px 40px rgba(249,115,22,.15)}
        .section-divider{height:1px;background:linear-gradient(to right,transparent,#e5e7eb,transparent)}
        .rating-star{color:#f59e0b}
        .price-highlight{color:#c2410c;font-weight:700}
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
        .video-section-dark{background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%)}
        .skeleton-pulse{animation:pulse 1.5s ease-in-out infinite}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}
        .select2-container{width:100%!important}
        .select2-container--default .select2-selection--single{border:2px solid #e5e7eb!important;border-radius:12px!important;height:48px!important;display:flex!important;align-items:center;background:#f9fafb;transition:all .3s;padding:0!important}
        .select2-container--default.select2-container--focus .select2-selection--single{border-color:#f97316!important;box-shadow:0 0 0 3px rgba(249,115,22,.1)!important}
        .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:44px!important;padding-left:16px!important;font-size:14px!important;font-weight:500!important;color:#374151!important}
        .select2-container--default .select2-selection--single .select2-selection__arrow{height:44px!important;right:14px!important;width:20px!important}
        .select2-container--default .select2-selection--single .select2-selection__arrow b{border-color:#9ca3af transparent transparent transparent!important;border-width:6px 5px 0 5px!important;margin-left:-4px!important}
        .select2-dropdown{border:2px solid #e5e7eb!important;border-radius:12px!important;margin-top:4px!important;overflow:hidden!important;box-shadow:0 10px 30px rgba(0,0,0,.1)!important}
        .select2-container--default .select2-results__option{padding:10px 16px!important;font-size:14px!important;color:#374151!important}
        .select2-container--default .select2-results__option--highlighted[aria-selected]{background:#f97316!important;color:#fff!important}
        .select2-container--default .select2-results__option[aria-selected=true]{background:#fff7ed!important;color:#ea580c!important}
        .select2-search--dropdown .select2-search__field{border:2px solid #e5e7eb!important;border-radius:8px!important;padding:8px 12px!important;font-size:14px!important}
        .swiper-pagination-bullet{background:#fff!important;opacity:.5!important;width:10px!important;height:10px!important}
        .swiper-pagination-bullet-active{opacity:1!important;background:#f97316!important}
        .search-result-card{transition:all .3s ease}
        .search-result-card:hover{transform:translateY(-4px);box-shadow:0 12px 30px rgba(0,0,0,.1)}
        .tag-pill{display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#fff7ed,#ffedd5);color:#ea580c;font-size:12px;font-weight:600;padding:4px 12px 4px 8px;border-radius:9999px;border:1px solid #fed7aa}
        .tag-pill button{background:none;border:none;cursor:pointer;color:#ef4444;font-size:14px;line-height:1;padding:0;display:flex;align-items:center;justify-content:center;width:16px;height:16px;border-radius:50%;transition:background .2s}
        .tag-pill button:hover{background:#fee2e2}
        .input-error{border-color:#ef4444!important;box-shadow:0 0 0 3px rgba(239,68,68,.1)!important}
        .field-error{color:#ef4444;font-size:11px;margin-top:2px;display:none}
        .field-error.show{display:block}

        /* ===== CHATBOT STYLES ===== */
        .chat-fab{position:fixed;bottom:24px;right:24px;z-index:90;width:62px;height:62px;border-radius:50%;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 24px rgba(249,115,22,.5);transition:all .3s cubic-bezier(.34,1.56,.64,1)}
        .chat-fab:hover{transform:scale(1.12);box-shadow:0 6px 32px rgba(249,115,22,.6)}
        .chat-fab.active{transform:scale(0.92);box-shadow:0 2px 12px rgba(249,115,22,.3)}
        .chat-fab .fab-badge{position:absolute;top:-4px;right:-4px;min-width:20px;height:20px;border-radius:99px;background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center;border:2.5px solid #fff;animation:badgeBounce 2s ease-in-out infinite;padding:0 4px}
        @keyframes badgeBounce{0%,100%{transform:scale(1)}50%{transform:scale(1.2) translateY(-2px)}}
        .chat-fab .fab-ring{position:absolute;inset:-6px;border-radius:50%;border:2px solid rgba(249,115,22,.25);animation:ringPulse 3s ease-out infinite;pointer-events:none}
        @keyframes ringPulse{0%{transform:scale(1);opacity:1}100%{transform:scale(1.5);opacity:0}}
        .chat-panel{position:fixed;bottom:100px;right:24px;z-index:89;width:390px;max-width:calc(100vw - 32px);height:540px;max-height:calc(100vh - 140px);background:#fff;border-radius:22px;box-shadow:0 20px 60px rgba(0,0,0,.18),0 0 0 1px rgba(0,0,0,.04);display:flex;flex-direction:column;overflow:hidden;transform:scale(0) translateY(30px);transform-origin:bottom right;opacity:0;transition:all .4s cubic-bezier(.34,1.56,.64,1);pointer-events:none}
        .chat-panel.open{transform:scale(1) translateY(0);opacity:1;pointer-events:auto}
        .chat-header{background:linear-gradient(135deg,#1a1a2e 0%,#16213e 40%,#0f3460 100%);color:#fff;padding:0;flex-shrink:0;position:relative;overflow:hidden}
        .chat-header::before{content:'';position:absolute;top:-30px;right:-30px;width:120px;height:120px;border-radius:50%;background:rgba(249,115,22,.12)}
        .chat-header::after{content:'';position:absolute;bottom:-20px;left:-20px;width:80px;height:80px;border-radius:50%;background:rgba(249,115,22,.08)}
        .chat-header-inner{padding:14px 16px;display:flex;align-items:center;gap:12px;position:relative;z-index:1}
        .ch-avatar-wrap{position:relative;flex-shrink:0}
        .ch-avatar{width:44px;height:44px;border-radius:14px;background:linear-gradient(135deg,#f97316,#fb923c);display:flex;align-items:center;justify-content:center;box-shadow:0 2px 10px rgba(249,115,22,.4)}
        .ch-avatar svg{width:28px;height:28px}
        .ch-avatar-status{position:absolute;bottom:-2px;right:-2px;width:14px;height:14px;border-radius:50%;background:#22c55e;border:2.5px solid #1a1a2e;box-shadow:0 0 0 2px rgba(34,197,94,.3)}
        .ch-info{flex:1;min-width:0}
        .ch-info h4{font-size:.88rem;font-weight:700;margin:0;letter-spacing:-.01em}
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
        .chat-messages::-webkit-scrollbar-track{background:transparent}
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
        .chat-quick button:active{transform:scale(.96)}
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
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- TOP BAR -->
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

    <!-- MAIN NAVIGATION -->
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
                    <a href="{{ route('home') }}" class="nav-link text-sm font-medium text-brand-600">Home</a>
                    <a href="{{ route('properties') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Properties</a>
                    <a href="{{ route('agents') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Agents</a>
                    <a href="{{ route('blogs') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Blog</a>
                    <a href="{{ route('contact-us') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Contact</a>
                    @isset($pages)
                        @foreach($pages->take(3) as $page)
                            <a href="{{ route('page', $page->slug) }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">{{ Str::limit($page->title, 15) }}</a>
                        @endforeach
                    @endisset
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('agents') }}" class="btn-primary-c text-white text-sm font-semibold px-5 py-2.5 rounded-lg hidden sm:block">Get Free Consultation</a>
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100"><i class="fas fa-bars text-xl"></i></button>
                </div>
            </div>
        </div>
        <div class="lg:hidden hidden bg-white border-t border-gray-100 pb-4" id="mobileMenu">
            <div class="px-4 pt-3 space-y-1">
                <a href="{{ route('home') }}" class="block py-2.5 px-3 text-sm font-medium text-brand-600 bg-brand-50 rounded-lg">Home</a>
                <a href="{{ route('properties') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Properties</a>
                <a href="{{ route('agents') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Agents</a>
                <a href="{{ route('blogs') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Blog</a>
                <a href="{{ route('contact-us') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Contact</a>
                @isset($pages)
                    @foreach($pages->take(3) as $page)
                        <a href="{{ route('page', $page->slug) }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">{{ $page->title }}</a>
                    @endforeach
                @endisset
                <a href="{{ route('agents') }}" class="block btn-primary-c text-white text-sm font-semibold px-5 py-2.5 rounded-lg mt-2 text-center">Get Free Consultation</a>
            </div>
        </div>
    </nav>

    <!-- HERO + SEARCH -->
    <section class="relative overflow-hidden min-h-[600px] flex items-center">
        @php
            $video = $videos->first() ?? null;
        @endphp
        @if($video && !empty($video->video_file))
            <div class="absolute inset-0 z-0">
                <video autoplay muted loop playsinline class="w-full h-full object-cover"><source src="{{ asset($video->video_file) }}" type="video/mp4"></video>
                <div class="absolute inset-0 bg-black/60"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-100 via-white to-gray-200"></div>
        @endif
        <div class="relative z-10 max-w-7xl mx-auto px-4 py-16 w-full">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">{!! $hero->title ?? 'Premium Real Estate Properties' !!}</h1>
                <p class="text-white/70 mt-4 text-base md:text-lg">Discover the finest properties from top builders across India.</p>
            </div>
            <div class="max-w-4xl mx-auto mt-10 bg-white/90 backdrop-blur-xl rounded-3xl p-6 shadow-2xl border border-white/20">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5">
                    <div onclick="addFilter('Residential')" class="group cursor-pointer bg-white rounded-xl p-3 flex items-center gap-3 border hover:shadow-lg hover:-translate-y-1 transition-all duration-200"><img src="https://cdn-icons-png.flaticon.com/512/69/69524.png" class="w-9 h-9 group-hover:scale-110 transition"><div class="text-xs md:text-sm font-semibold text-gray-700 leading-tight">Residential<br> Properties</div></div>
                    <div onclick="addFilter('Commercial')" class="group cursor-pointer bg-white rounded-xl p-3 flex items-center gap-3 border hover:shadow-lg hover:-translate-y-1 transition-all duration-200"><img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" class="w-9 h-9 group-hover:scale-110 transition"><div class="text-xs md:text-sm font-semibold text-gray-700 leading-tight">Commercial<br> Properties</div></div>
                    <div onclick="addFilter('Under Construction')" class="group cursor-pointer bg-white rounded-xl p-3 flex items-center gap-3 border hover:shadow-lg hover:-translate-y-1 transition-all duration-200"><img src="https://cdn-icons-png.flaticon.com/512/1048/1048317.png" class="w-9 h-9 group-hover:scale-110 transition"><div class="text-xs md:text-sm font-semibold text-gray-700 leading-tight">Under Construction<br> Properties</div></div>
                    <div onclick="addFilter('Ready to Move')" class="group cursor-pointer bg-white rounded-xl p-3 flex items-center gap-3 border hover:shadow-lg hover:-translate-y-1 transition-all duration-200"><img src="https://cdn-icons-png.flaticon.com/512/1534/1534938.png" class="w-9 h-9 group-hover:scale-110 transition"><div class="text-xs md:text-sm font-semibold text-gray-700 leading-tight">Ready to Move<br> Properties</div></div>
                </div>
                <div class="flex flex-col md:flex-row gap-3 items-stretch">
                    <div class="flex-1 relative">
                        <div id="selectedTags" class="flex flex-wrap gap-2 mb-2"></div>
                        <div class="relative">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" id="searchInput" placeholder="Search city, property, price..." class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none text-sm bg-gray-50 focus:bg-white transition" autocomplete="off">
                        </div>
                        <div id="suggestionsBox" class="absolute left-0 right-0 bg-white shadow-xl rounded-xl mt-2 hidden max-h-72 overflow-y-auto border border-gray-100 z-[9999]"></div>
                    </div>
                    <button type="button" onclick="fetchResults()" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold text-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition whitespace-nowrap"><i class="fas fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH RESULTS -->
    <section id="searchResultsSection" class="max-w-7xl mx-auto px-4 py-8 hidden">
        <div class="flex items-center justify-between mb-6">
            <div><h2 class="text-xl font-bold text-dark-900">Search Results</h2><p class="text-sm text-gray-500" id="resultCount">Showing 0 properties</p></div>
            <button onclick="clearAllFilters()" class="text-sm text-brand-600 hover:text-brand-700 font-semibold flex items-center gap-1.5 transition"><i class="fas fa-times-circle text-xs"></i> Clear Filters</button>
        </div>
        <div id="propertyResults" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5"></div>
    </section>

    <!-- UPCOMING NEW LAUNCHES -->
    @isset($featured_property)
    @if($featured_property->visibility)
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-3">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-brand-600 text-xs font-semibold uppercase tracking-wider mb-2"><i class="fas fa-rocket text-[11px]"></i> New Launches</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-dark-900">{{ $featured_property->title ?? 'Upcoming New Launches' }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Be the first to explore pre-launch exclusive pricing</p>
                </div>
                <a href="{{ route('properties') }}" class="hidden md:flex items-center gap-1 text-brand-600 text-sm font-semibold hover:gap-2 transition-all">View All <i class="fas fa-arrow-right text-xs"></i></a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach(($featured_property->properties ?? collect())->take(4) as $item)
                <div class="card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden group" data-aos="fade-up">
                    <div class="relative h-48 overflow-hidden">
                        <img loading="lazy" src="{{ $item->thumbnail_image ? asset($item->thumbnail_image) : asset($setting->default_placeholder ?? 'default.jpg') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 left-3"><span class="tag-badge text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">New Launch</span></div>
                        @if($item->total_bedroom)<div class="absolute bottom-3 left-3 flex gap-1.5"><span class="bg-dark-900/80 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded">{{ $item->total_bedroom }} BHK</span></div>@endif
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2"><span class="text-[11px] font-bold text-brand-500 uppercase tracking-wider">{{ $item->property_type->name ?? 'Apartment' }}</span>@if(!empty($item->rera_number))<span class="bg-blue-50 text-blue-600 text-[9px] font-bold px-1.5 py-0.5 rounded">RERA</span>@endif</div>
                        <h3 class="font-bold text-dark-900 text-base leading-tight mt-1"><a href="{{ route('property', $item->slug) }}" class="hover:text-brand-600 transition">{{ Str::limit($item->title, 28) }}</a></h3>
                        <p class="flex items-center gap-1 text-gray-500 text-xs mt-1"><i class="fas fa-map-marker-alt text-brand-400 text-[10px]"></i> {{ Str::limit($item->address, 30) }}</p>
                        <div class="mt-3 flex items-center justify-between"><div><p class="price-highlight text-lg">@php
    $config = json_decode($item->config_json, true);

    $finalPrice = '';

    if (!empty($config['expected_price'])) {

        $finalPrice = $config['expected_price'];

    } elseif (!empty($config['expected_rent'])) {

        $finalPrice = $config['expected_rent'];

    }
@endphp

@if($finalPrice)
    ₹{{ number_format((int)$finalPrice) }}
@else
    Price On Request
@endif </p>@isset($item->size)<p class="text-gray-400 text-[10px]">{{ $item->size }} sq.ft</p>@endisset</div>@isset($item->possession_date)<div class="text-right"><p class="text-xs text-gray-500">Possession</p><p class="text-xs font-semibold text-dark-900">{{ date('M Y', strtotime($item->possession_date)) }}</p></div>@endisset</div>
                        <button onclick="showEnquiry('{{ Str::limit(addslashes($item->title), 25) }}')" class="w-full mt-3 btn-outline-c text-xs font-semibold py-2 rounded-lg">Enquire Now</button>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="md:hidden text-center mt-6"><a href="{{ route('properties') }}" class="inline-flex items-center gap-1 text-brand-600 text-sm font-semibold">View All <i class="fas fa-arrow-right text-xs"></i></a></div>
        </div>
    </section>
    @endif
    @endisset

    <div class="section-divider"></div>

    <!-- RECENTLY LAUNCHED -->
    @isset($urgent_property)
    @if($urgent_property->visibility)
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-3">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-green-600 text-xs font-semibold uppercase tracking-wider mb-2"><i class="fas fa-check-circle text-[11px]"></i> Recently Launched</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-dark-900">{{ $urgent_property->title ?? 'Recently Launched Projects' }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Fresh listings with early-bird offers</p>
                </div>
                <a href="{{ route('properties') }}" class="hidden md:flex items-center gap-1 text-brand-600 text-sm font-semibold hover:gap-2 transition-all">View All <i class="fas fa-arrow-right text-xs"></i></a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach(($urgent_property->properties ?? collect())->take(4) as $item)
                <div class="card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-48 overflow-hidden">
                        <img loading="lazy" src="{{ $item->thumbnail_image ? asset($item->thumbnail_image) : asset($setting->default_placeholder ?? 'default.jpg') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 left-3"><span class="tag-green text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">Launched</span></div>
                        @if($item->total_bedroom)<div class="absolute bottom-3 left-3 flex gap-1.5"><span class="bg-dark-900/80 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded">{{ $item->total_bedroom }} BHK</span></div>@endif
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2"><span class="text-[11px] font-bold text-green-600 uppercase tracking-wider">{{ $item->property_type->name ?? 'Apartment' }}</span>@if(!empty($item->rera_number))<span class="bg-blue-50 text-blue-600 text-[9px] font-bold px-1.5 py-0.5 rounded">RERA</span>@endif</div>
                        <h3 class="font-bold text-dark-900 text-base leading-tight mt-1"><a href="{{ route('property', $item->slug) }}" class="hover:text-brand-600 transition">{{ Str::limit($item->title, 28) }}</a></h3>
                        <p class="flex items-center gap-1 text-gray-500 text-xs mt-1"><i class="fas fa-map-marker-alt text-green-500 text-[10px]"></i> {{ Str::limit($item->address, 30) }}</p>
                        <div class="mt-3 flex items-center justify-between"><div><p class="price-highlight text-lg">{{ $currency_icon ?? '₹' }}@php
    $config = json_decode($item->config_json, true);

    $finalPrice = '';

    if (!empty($config['expected_price'])) {

        $finalPrice = $config['expected_price'];

    } elseif (!empty($config['expected_rent'])) {

        $finalPrice = $config['expected_rent'];

    }
@endphp

@if($finalPrice)
    ₹{{ number_format((int)$finalPrice) }}
@else
    Price On Request
@endif </p>@isset($item->size)<p class="text-gray-400 text-[10px]">{{ $item->size }} sq.ft</p>@endisset</div>@isset($item->possession_date)<div class="text-right"><p class="text-xs text-gray-500">Possession</p><p class="text-xs font-semibold text-dark-900">{{ date('M Y', strtotime($item->possession_date)) }}</p></div>@endisset</div>
                        <button onclick="showEnquiry('{{ Str::limit(addslashes($item->title), 25) }}')" class="w-full mt-3 btn-outline-c text-xs font-semibold py-2 rounded-lg">Enquire Now</button>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="md:hidden text-center mt-6"><a href="{{ route('properties') }}" class="inline-flex items-center gap-1 text-brand-600 text-sm font-semibold">View All <i class="fas fa-arrow-right text-xs"></i></a></div>
        </div>
    </section>
    @endif
    @endisset

    <div class="section-divider"></div>

    <!-- TOP SELLING -->
    @isset($top_selling)
    @if($top_selling->visibility)
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-3">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-yellow-600 text-xs font-semibold uppercase tracking-wider mb-2"><i class="fas fa-trophy text-[11px]"></i> Top Selling</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-dark-900">{{ $top_selling->title ?? 'Top Selling Recommended Projects' }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Most popular projects chosen by home buyers</p>
                </div>
                <a href="{{ route('properties') }}" class="hidden md:flex items-center gap-1 text-brand-600 text-sm font-semibold hover:gap-2 transition-all">View All <i class="fas fa-arrow-right text-xs"></i></a>
            </div>
            <div class="space-y-4">
                @foreach(($top_selling->properties ?? collect())->take(3) as $index => $item)
                <div class="card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden flex flex-col md:flex-row" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative w-full md:w-72 h-52 md:h-auto shrink-0 overflow-hidden">
                        <img loading="lazy" src="{{ $item->thumbnail_image ? asset($item->thumbnail_image) : asset($setting->default_placeholder ?? 'default.jpg') }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        <div class="absolute top-3 left-3"><span class="tag-yellow text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider flex items-center gap-1"><i class="fas fa-trophy text-[9px]"></i> #{{ $index + 1 }} Best Seller</span></div>
                    </div>
                    <div class="flex-1 p-5 md:p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between flex-wrap gap-2">
                                <div>
                                    <div class="flex items-center gap-2"><h3 class="font-bold text-dark-900 text-lg">{{ Str::limit($item->title, 30) }}</h3>@if(!empty($item->rera_number))<span class="bg-blue-50 text-blue-600 text-[9px] font-bold px-1.5 py-0.5 rounded">RERA</span>@endif</div>
                                    <p class="flex items-center gap-1 text-gray-500 text-sm mt-1"><i class="fas fa-map-marker-alt text-brand-400 text-xs"></i> {{ Str::limit($item->address, 35) }}</p>
                                </div>
                                <div class="text-right"><p class="price-highlight text-xl">{{ $currency_icon ?? '₹' }}@php
    $config = json_decode($item->config_json, true);

    $finalPrice = '';

    if (!empty($config['expected_price'])) {

        $finalPrice = $config['expected_price'];

    } elseif (!empty($config['expected_rent'])) {

        $finalPrice = $config['expected_rent'];

    }
@endphp

@if($finalPrice)
    ₹{{ number_format((int)$finalPrice) }}
@else
    Price On Request
@endif</p>@isset($item->size)<p class="text-gray-400 text-xs">{{ $item->size }} sq.ft</p>@endisset</div>
                            </div>
                            <div class="flex flex-wrap gap-3 mt-4">
                                @if($item->total_bedroom)<div class="flex items-center gap-1.5 text-xs text-gray-600"><i class="fas fa-home text-brand-400 text-[11px]"></i><span>{{ $item->total_bedroom }} BHK</span></div>@endif
                                @isset($item->possession_date)<div class="flex items-center gap-1.5 text-xs text-gray-600"><i class="fas fa-calendar text-brand-400 text-[11px]"></i><span>{{ date('M Y', strtotime($item->possession_date)) }}</span></div>@endisset
                                @isset($item->total_floor)<div class="flex items-center gap-1.5 text-xs text-gray-600"><i class="fas fa-layer-group text-brand-400 text-[11px]"></i><span>{{ $item->total_floor }} Floors</span></div>@endisset
                                @isset($item->land_area)<div class="flex items-center gap-1.5 text-xs text-gray-600"><i class="fas fa-tree text-brand-400 text-[11px]"></i><span>{{ $item->land_area }} Acres</span></div>@endisset
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2 text-xs text-gray-500"><i class="fas fa-bed text-brand-400 text-[11px]"></i>{{ $item->total_bedroom ?? '-' }} Beds<span class="mx-1 text-gray-300">|</span><i class="fas fa-bath text-brand-400 text-[11px]"></i>{{ $item->total_bathroom ?? '-' }} Baths</div>
                            <button onclick="showEnquiry('{{ Str::limit(addslashes($item->title), 25) }}')" class="btn-primary-c text-white text-xs font-semibold px-5 py-2.5 rounded-lg">Enquire Now</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @endisset

    <!-- VIDEO SECTION -->
    @isset($video_section)
    @if($video_section->visibility)
    <section class="video-section-dark py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-1.5 bg-white/10 text-red-400 text-xs font-semibold uppercase tracking-wider px-4 py-1.5 rounded-full mb-4"><i class="fas fa-play-circle text-[11px]"></i> Video Tour</span>
                <h2 class="text-2xl md:text-3xl font-bold text-white">{{ $video_section->title ?? 'Property Videos' }}</h2>
            </div>
            <div class="swiper mySwiperVideos">
                <div class="swiper-wrapper">
                    @foreach(($video_section->videos ?? []) as $video)
                    <div class="swiper-slide">
                        <div class="rounded-2xl overflow-hidden relative shadow-2xl cursor-pointer group" onclick="playVideo('{{ $video->url }}')">
                            <img loading="lazy" src="{{ asset($video->thumbnail) }}" class="w-full h-72 md:h-80 object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $video->title }}">
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center group-hover:bg-black/30 transition"><div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-brand-500 text-xl shadow-lg group-hover:bg-red-500 group-hover:text-white group-hover:scale-110 transition-all"><i class="fas fa-play ml-1"></i></div></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 bg-gradient-to-t from-black/90 to-transparent"><h4 class="text-white font-semibold text-base">{{ $video->title }}</h4></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-8"></div>
            </div>
        </div>
    </section>
    @endif
    @endisset

    <!-- PARTNERS -->
    @isset($partner)
    @if($partner->visibility)
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-1.5 text-brand-600 text-xs font-semibold uppercase tracking-wider mb-2"><i class="fas fa-handshake text-[11px]"></i> Our Partners</span>
                <h2 class="text-2xl md:text-3xl font-bold text-dark-900">{{ $partner->title ?? 'Top Builders & Partners' }}</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach(($partner->partners ?? []) as $builder)
                <div class="border border-gray-200 rounded-2xl p-6 flex items-center justify-center bg-white hover:border-brand-500 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 h-28" data-aos="zoom-in">
                    <a href="{{ $builder->link ?? '#' }}" target="_blank" rel="noopener"><img loading="lazy" src="{{ asset($builder->logo) }}" alt="{{ $builder->name }}" class="max-h-10 max-w-[100px] object-contain grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300"></a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @endisset

    <div class="section-divider"></div>

    <!-- TESTIMONIALS -->
    @isset($testimonial)
    @if($testimonial->visibility)
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-1.5 text-brand-600 text-xs font-semibold uppercase tracking-wider mb-2"><i class="fas fa-quote-left text-[11px]"></i> Testimonials</span>
                <h2 class="text-2xl md:text-3xl font-bold text-dark-900">{{ $testimonial->title ?? 'What Our Customers Say' }}</h2>
                <p class="text-gray-500 text-sm mt-1">Real experiences from verified home buyers</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach(($testimonial->testimonials ?? collect())->take(3) as $testi)
                <div class="card-hover bg-white rounded-2xl p-6 border border-gray-100 border-l-4 border-l-brand-500 relative" data-aos="fade-up">
                    <i class="fas fa-quote-right absolute top-5 right-5 text-3xl text-brand-100"></i>
                    <div class="flex items-center gap-0.5 rating-star mb-3"><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i></div>
                    <p class="text-gray-600 text-sm leading-relaxed italic mb-4">"{{ $testi->comment }}"</p>
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <img loading="lazy" src="{{ $testi->image ? asset($testi->image) : asset($setting->default_placeholder ?? 'default.jpg') }}" class="w-11 h-11 rounded-full object-cover border-2 border-brand-200" alt="{{ $testi->name }}">
                        <div><p class="font-semibold text-sm text-dark-900">{{ $testi->name }}</p><p class="text-xs text-gray-400">{{ $testi->designation ?? 'Home Buyer' }}</p></div>
                        <span class="ml-auto bg-green-50 text-green-600 text-[9px] font-bold px-2 py-0.5 rounded">Verified</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @endisset

    <!-- ARTICLES -->
    @isset($articles)
    @if(count($articles))
    <div class="section-divider"></div>
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-3">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-purple-600 text-xs font-semibold uppercase tracking-wider mb-2"><i class="fas fa-newspaper text-[11px]"></i> Insights</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-dark-900">Latest Articles & Guides</h2>
                </div>
                <a href="{{ route('articles') }}" class="hidden md:flex items-center gap-1 text-brand-600 text-sm font-semibold hover:gap-2 transition-all">All Articles <i class="fas fa-arrow-right text-xs"></i></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($articles->take(3) as $article)
                <div class="card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden group" data-aos="fade-up">
                    <div class="relative h-48 overflow-hidden">
                        <img loading="lazy" src="{{ $article->image ? asset($article->image) : 'https://picsum.photos/seed/article' . $article->id . '/500/250.jpg' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $article->title }}">
                        <div class="absolute top-3 left-3"><span class="bg-purple-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-md">{{ $article->category ?? 'Guide' }}</span></div>
                    </div>
                    <div class="p-5">
                        <p class="text-xs text-gray-400 mb-2">{{ date('M d, Y', strtotime($article->created_at)) }} &bull; {{ Str::limit($article->excerpt ?? '', 60) }}</p>
                        <h3 class="font-bold text-dark-900 text-base leading-snug group-hover:text-brand-600 transition">{{ Str::limit($article->title, 50) }}</h3>
                        <a href="{{ route('article', $article->slug) }}" class="inline-flex items-center gap-1 text-brand-600 text-xs font-semibold mt-3 hover:gap-2 transition-all">Read More <i class="fas fa-arrow-right text-[10px]"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @endisset

    <!-- CTA SECTION -->
    <section class="hero-gradient py-16 md:py-20">
        <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
            <h2 class="text-2xl md:text-4xl font-bold text-white leading-tight">Ready to Find Your <span class="text-brand-400">Dream Home?</span></h2>
            <p class="text-white/60 mt-4 text-base md:text-lg max-w-2xl mx-auto">Get personalized property recommendations from our expert advisors. Free consultation, no obligations.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
                <button onclick="showEnquiry('General Consultation')" class="btn-primary-c text-white text-sm font-semibold px-8 py-3.5 rounded-xl flex items-center gap-2"><i class="fas fa-phone"></i> Get Free Consultation</button>
                <a href="tel:{{ $setting->phone ?? '' }}" class="flex items-center gap-2 text-white/80 hover:text-white text-sm font-medium transition"><i class="fas fa-phone-volume"></i> {{ $setting->phone ?? '+91 98765 43210' }}</a>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-6 mt-8 text-white/40 text-xs">
                <span class="flex items-center gap-1.5"><i class="fas fa-shield-alt"></i> 100% Verified Listings</span>
                <span class="flex items-center gap-1.5"><i class="fas fa-lock"></i> Data Privacy Assured</span>
                <span class="flex items-center gap-1.5"><i class="fas fa-headset"></i> Dedicated Support</span>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
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
                        <li><a href="{{ route('home') }}" class="text-gray-400 text-sm hover:text-white transition">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('properties') }}" class="text-gray-400 text-sm hover:text-white transition">{{ __('Properties') }}</a></li>
                        <li><a href="{{ route('agents') }}" class="text-gray-400 text-sm hover:text-white transition">{{ __('Agents') }}</a></li>
                        @isset($pages)
                            @foreach($pages->take(3) as $page)
                                <li><a href="{{ route('page', $page->slug) }}" class="text-gray-400 text-sm hover:text-white transition">{{ Str::limit($page->title, 18) }}</a></li>
                            @endforeach
                        @endisset
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
                    <h5 class="font-semibold text-sm mb-4">Popular Cities</h5>
                    <ul class="space-y-2.5">
                        @isset($popular_cities)
                            @foreach($popular_cities->take(4) as $city)
                                <li><a href="{{ route('properties', ['location' => $city->slug]) }}" class="text-gray-400 text-sm hover:text-white transition">{{ $city->name }}</a></li>
                            @endforeach
                        @else
                            <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Mumbai</a></li>
                            <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Pune</a></li>
                            <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Bangalore</a></li>
                            <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Delhi</a></li>
                        @endisset
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

    <!-- ===== ENQUIRY MODAL ===== -->
    <div class="fixed inset-0 z-[100] hidden" id="enquiryModal">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeEnquiry()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 relative modal-anim">
                <button onclick="closeEnquiry()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition"><i class="fas fa-times text-gray-500 text-sm"></i></button>
                <div class="text-center mb-5">
                    <div class="w-12 h-12 rounded-full bg-brand-50 flex items-center justify-center mx-auto mb-3"><i class="fas fa-building text-brand-500 text-lg"></i></div>
                    <h3 class="text-lg font-bold text-dark-900" id="enquiryTitle">Enquire Now</h3>
                    <p class="text-gray-500 text-sm mt-1">Get exclusive pricing & floor plans</p>
                </div>
                <form id="enquiryForm" class="space-y-3" novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="property_name" id="enquiryPropertyName">
                    <div>
                        <input type="text" name="name" id="enqName" placeholder="Full Name *" required class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        <p class="field-error" id="errName">Please enter your full name</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-1">
                            <input type="tel" name="phone" id="enqPhone" placeholder="Phone *" required class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                            <p class="field-error" id="errPhone">Please enter a valid phone number</p>
                        </div>
                        <div class="flex-1">
                            <input type="email" name="email" id="enqEmail" placeholder="Email" class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                            <p class="field-error" id="errEmail">Please enter a valid email</p>
                        </div>
                    </div>
                    <div>
                        <textarea name="message" id="enqMessage" placeholder="Any specific requirement?" rows="2" class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
                    </div>
                    <button type="submit" id="enquirySubmitBtn" class="w-full btn-primary-c text-white text-sm font-semibold py-3 rounded-xl flex items-center justify-center gap-2">
                        <span id="enqBtnText">Get Free Consultation</span>
                        <i class="fas fa-spinner fa-spin hidden" id="enqBtnSpinner"></i>
                    </button>
                    <p class="text-[10px] text-gray-400 text-center">By submitting, you agree to our Privacy Policy & Terms</p>
                </form>
            </div>
        </div>
    </div>

    <!-- VIDEO MODAL -->
    <div class="fixed inset-0 z-[100] hidden" id="videoModal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeVideoModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-black rounded-2xl shadow-2xl max-w-4xl w-full relative modal-anim overflow-hidden">
                <button onclick="closeVideoModal()" class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center hover:bg-white/40 transition"><i class="fas fa-times text-white text-sm"></i></button>
                <div class="aspect-video"><iframe id="videoFrame" src="" class="w-full h-full" title="Video" allowfullscreen allow="autoplay"></iframe></div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="fixed bottom-6 right-6 z-[110] space-y-2" id="toastContainer"></div>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone ?? '919876543210') }}" target="_blank" rel="noopener" class="fixed bottom-6 left-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition hover:scale-110"><i class="fab fa-whatsapp text-white text-2xl"></i></a>

    <!-- ===== CHATBOT WIDGET ===== -->
    <button type="button" class="chat-fab" id="chatFab" aria-label="Open chat">
        <span class="fab-ring"></span>
        <span class="fab-badge" id="chatBadge">1</span>
        <svg id="chatFabIconOpen" width="26" height="26" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="20" r="12" fill="white"/><path d="M12 56c0-11.046 8.954-20 20-20s20 8.954 20 20" fill="white"/><path d="M26 17c0-2 1.5-4 6-4s6 2 6 4" stroke="#f97316" stroke-width="2" stroke-linecap="round" fill="none"/><circle cx="28" cy="19" r="1.2" fill="#f97316"/><circle cx="36" cy="19" r="1.2" fill="#f97316"/><path d="M29 23c0 0 1.5 2 3 2s3-2 3-2" stroke="#f97316" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg>
        <svg id="chatFabIconClose" width="24" height="24" viewBox="0 0 24 24" fill="none" style="display:none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6l12 12" stroke="white" stroke-width="2.5" stroke-linecap="round"/></svg>
    </button>

    <div class="chat-panel" id="chatPanel">
        <div class="chat-header">
            <div class="chat-header-inner">
                <div class="ch-avatar-wrap">
                    <div class="ch-avatar"><svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="18" r="11" fill="white" opacity="0.95"/><path d="M13 55c0-10.493 8.507-19 19-19s19 8.507 19 19" fill="white" opacity="0.95"/><path d="M25 15.5c0-2 1.8-4.5 7-4.5s7 2.5 7 4.5" stroke="#ea580c" stroke-width="2.2" stroke-linecap="round" fill="none"/><circle cx="28" cy="18" r="1.3" fill="#ea580c"/><circle cx="36" cy="18" r="1.3" fill="#ea580c"/><path d="M29.5 22.5c0 0 1.3 2 2.5 2s2.5-2 2.5-2" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" fill="none"/><path d="M22 11c0 0 2-3 10-3s10 3 10 3" stroke="white" stroke-width="2.5" stroke-linecap="round" fill="none" opacity="0.7"/></svg></div>
                    <div class="ch-avatar-status"></div>
                </div>
                <div class="ch-info"><h4>Priya — Property Advisor</h4><p id="chatStatusText">Online now</p></div>
                <div class="ch-header-actions">
                    <button class="ch-header-btn" onclick="chatResetChat()" title="New chat"><i class="fas fa-rotate-right"></i></button>
                    <button class="ch-header-btn" onclick="closeChat()" title="Close"><i class="fas fa-xmark"></i></button>
                </div>
            </div>
            <div class="ch-site-strip">
                <div class="ch-ss-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);border-radius:8px"><i class="fas fa-building text-white" style="font-size:12px"></i></div>
                <div style="min-width:0;flex:1"><div class="ch-ss-name">{{ $setting->site_name ?? 'RealEstate' }}</div></div>
                <div class="ch-ss-tag">Trusted</div>
            </div>
        </div>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="chat-quick" id="chatQuick"></div>
        <div class="chat-input-area">
            <div class="chat-input-wrap">
                <input type="text" id="chatInput" placeholder="Type your question..." autocomplete="off">
                <button class="input-emoji" title="Emoji"><i class="far fa-smile"></i></button>
            </div>
            <button class="chat-send" id="chatSendBtn" onclick="chatSend()" aria-label="Send"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 2L11 13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        </div>
        <div class="chat-powered"><span>Powered by {{ $setting->site_name ?? 'RealEstate' }} AI</span></div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- ===== GLOBAL CONFIG — ALL URLS DEFINED HERE ===== -->
    <script>
        var BASE_URL = "{{ asset('/') }}";
        var DEFAULT_IMAGE = "{{ asset($setting->default_placeholder ?? 'default.jpg') }}";
        var SEARCH_SUGGEST_URL = "{{ route('search.suggestions') }}";
        var SEARCH_RESULTS_URL = "{{ route('search.results') }}";
        var ENQUIRY_URL = "{{ route('enquiry.store') }}";
        var SITE_NAME = "{{ $setting->site_name ?? 'RealEstate' }}";
        var SITE_PHONE = "{{ $setting->phone ?? '+91 98765 43210' }}";
        var SITE_PHONE_CLEAN = "{{ preg_replace('/[^0-9]/', '', $setting->phone ?? '919876543210') }}";
    </script>

    <!-- ===== TOAST UTILITY ===== -->
    <script>
    function showToast(message, type) {
        type = type || 'info';
        var container = document.getElementById('toastContainer');
        if (!container) return;
        var colors = { success: 'bg-green-500', error: 'bg-red-500', info: 'bg-gray-800', warning: 'bg-yellow-500' };
        var icons = { success: 'check-circle', error: 'exclamation-circle', info: 'info-circle', warning: 'exclamation-triangle' };
        var toast = document.createElement('div');
        toast.className = 'toast-anim flex items-center gap-3 ' + (colors[type] || colors.info) + ' text-white px-5 py-3 rounded-xl shadow-lg max-w-sm';
        toast.innerHTML = '<i class="fas fa-' + (icons[type] || icons.info) + ' text-base shrink-0"></i><span class="text-sm font-medium">' + message + '</span>';
        container.appendChild(toast);
        setTimeout(function() { if (toast.parentNode) toast.remove(); }, 3200);
    }
    </script>

    <!-- ===== ENQUIRY MODAL — FULLY WORKING ===== -->
    <script>
    (function() {
        'use strict';

        var modal = document.getElementById('enquiryModal');
        var form = document.getElementById('enquiryForm');
        var submitBtn = document.getElementById('enquirySubmitBtn');
        var btnText = document.getElementById('enqBtnText');
        var btnSpinner = document.getElementById('enqBtnSpinner');
        var isSubmitting = false;

        window.showEnquiry = function(name) {
            var titleEl = document.getElementById('enquiryTitle');
            var propNameEl = document.getElementById('enquiryPropertyName');
            if (titleEl) titleEl.textContent = name ? ('Enquire: ' + name) : 'Enquire Now';
            if (propNameEl) propNameEl.value = name || '';
            clearEnquiryErrors();
            form.reset();
            if (propNameEl) propNameEl.value = name || '';
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(function() {
                var nameField = document.getElementById('enqName');
                if (nameField) nameField.focus();
            }, 350);
        };

        window.closeEnquiry = function() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            if (isSubmitting) return;
            clearEnquiryErrors();
        };

        function clearEnquiryErrors() {
            var fields = ['enqName', 'enqPhone', 'enqEmail'];
            var errors = ['errName', 'errPhone', 'errEmail'];
            fields.forEach(function(id) {
                var el = document.getElementById(id);
                if (el) el.classList.remove('input-error');
            });
            errors.forEach(function(id) {
                var el = document.getElementById(id);
                if (el) el.classList.remove('show');
            });
        }

        function showFieldError(fieldId, errorId) {
            var field = document.getElementById(fieldId);
            var error = document.getElementById(errorId);
            if (field) field.classList.add('input-error');
            if (error) error.classList.add('show');
        }

        function clearFieldError(fieldId, errorId) {
            var field = document.getElementById(fieldId);
            var error = document.getElementById(errorId);
            if (field) field.classList.remove('input-error');
            if (error) error.classList.remove('show');
        }

        function validateEnquiryForm() {
            var valid = true;
            clearEnquiryErrors();

            var name = document.getElementById('enqName').value.trim();
            var phone = document.getElementById('enqPhone').value.trim();
            var email = document.getElementById('enqEmail').value.trim();

            if (!name || name.length < 2) {
                showFieldError('enqName', 'errName');
                valid = false;
            }

            var phoneRegex = /^[0-9+\-\s()]{7,15}$/;
            if (!phone || !phoneRegex.test(phone)) {
                showFieldError('enqPhone', 'errPhone');
                valid = false;
            }

            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showFieldError('enqEmail', 'errEmail');
                valid = false;
            }

            return valid;
        }

        /* Real-time error clearing on input */
        document.getElementById('enqName').addEventListener('input', function() { clearFieldError('enqName', 'errName'); });
        document.getElementById('enqPhone').addEventListener('input', function() { clearFieldError('enqPhone', 'errPhone'); });
        document.getElementById('enqEmail').addEventListener('input', function() { clearFieldError('enqEmail', 'errEmail'); });

        /* Form submit via fetch (no jQuery dependency) */
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (isSubmitting) return;
            if (!validateEnquiryForm()) return;

            isSubmitting = true;
            submitBtn.disabled = true;
            btnText.textContent = 'Submitting...';
            btnSpinner.classList.remove('hidden');

            var formData = new FormData(form);

            fetch(ENQUIRY_URL, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(response) {
                if (!response.ok) return response.json().then(function(err) { throw err; });
                return response.json();
            })
            .then(function(data) {
                closeEnquiry();
                showToast(data.message || 'Enquiry submitted successfully! We will contact you soon.', 'success');
                form.reset();
            })
            .catch(function(err) {
                console.error('Enquiry error:', err);
                var msg = 'Something went wrong. Please try again.';

                if (err && typeof err === 'object') {
                    if (err.message) {
                        msg = err.message;
                    }
                    if (err.errors) {
                        var firstError = Object.values(err.errors)[0];
                        if (Array.isArray(firstError) && firstError.length > 0) {
                            msg = firstError[0];
                        } else if (typeof firstError === 'string') {
                            msg = firstError;
                        }
                    }
                } else if (typeof err === 'string') {
                    msg = err;
                }

                showToast(msg, 'error');

                /* Show specific field errors from Laravel validation */
                if (err && err.errors) {
                    if (err.errors.name) showFieldError('enqName', 'errName');
                    if (err.errors.phone) showFieldError('enqPhone', 'errPhone');
                    if (err.errors.email) showFieldError('enqEmail', 'errEmail');
                }
            })
            .finally(function() {
                isSubmitting = false;
                submitBtn.disabled = false;
                btnText.textContent = 'Get Free Consultation';
                btnSpinner.classList.add('hidden');
            });
        });

        /* Escape key closes modal */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeEnquiry();
            }
        });
    })();
    </script>

    <!-- ===== CORE INIT ===== -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof AOS !== 'undefined') { AOS.init({ duration: 800, once: true, offset: 50 }); }

        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select2-init').each(function () {
                var el = $(this);
                el.select2({ placeholder: el.data('placeholder') || 'Select...', allowClear: true, width: '100%', minimumResultsForSearch: 8 });
            });
        }

        if (typeof Swiper !== 'undefined' && document.querySelector('.mySwiperVideos')) {
            new Swiper('.mySwiperVideos', {
                slidesPerView: 1, spaceBetween: 24, loop: true,
                pagination: { el: '.swiper-pagination', clickable: true },
                breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }
            });
        }

        /* Nav shadow on scroll */
        window.addEventListener('scroll', function () {
            var nav = document.getElementById('mainNav');
            if (window.pageYOffset > 50) { nav.classList.add('shadow-md'); nav.classList.remove('shadow-sm'); }
            else { nav.classList.remove('shadow-md'); nav.classList.add('shadow-sm'); }
        });

        /* Global escape handler */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { closeVideoModal(); if (typeof closeChat === 'function') closeChat(); }
        });
    });
    </script>

    <!-- ===== SEARCH ENGINE ===== -->
    <script>
    (function() {
        'use strict';
        var searchInput = document.getElementById('searchInput'), suggestionsBox = document.getElementById('suggestionsBox'), selectedTagsEl = document.getElementById('selectedTags'), resultsSection = document.getElementById('searchResultsSection'), resultsGrid = document.getElementById('propertyResults'), resultCountEl = document.getElementById('resultCount');
        var filters = [], debounceTimer = null;
        searchInput.addEventListener('input', function() { clearTimeout(debounceTimer); var q = this.value.trim(); if (q.length < 2) { suggestionsBox.classList.add('hidden'); return; } debounceTimer = setTimeout(function() { loadSuggestions(q); }, 300); });
        searchInput.addEventListener('keypress', function(e) { if (e.key === 'Enter') { e.preventDefault(); addFilter(this.value.trim()); this.value = ''; suggestionsBox.classList.add('hidden'); } });
        document.addEventListener('click', function(e) { if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) suggestionsBox.classList.add('hidden'); });
        function loadSuggestions(query) {
            fetch(SEARCH_SUGGEST_URL + '?term=' + encodeURIComponent(query)).then(function(r) { return r.json(); }).then(function(data) {
                suggestionsBox.innerHTML = '';
                var items = data.cities || [];
                if (items.length > 0) { items.forEach(function(city) { var d = document.createElement('div'); d.className = 'p-3 px-4 cursor-pointer hover:bg-brand-50 flex items-center gap-3 transition'; d.dataset.value = city.name; d.innerHTML = '<div class="w-8 h-8 rounded-lg bg-brand-100 flex items-center justify-center shrink-0"><i class="fas fa-map-marker-alt text-brand-500 text-xs"></i></div><div><div class="font-medium text-sm text-gray-800">' + city.name + '</div><div class="text-[11px] text-gray-400">City</div></div>'; d.addEventListener('click', function() { addFilter(this.dataset.value); searchInput.value = ''; suggestionsBox.classList.add('hidden'); }); suggestionsBox.appendChild(d); }); }
                else { suggestionsBox.innerHTML = '<div class="p-5 text-center text-gray-400 text-sm"><i class="fas fa-search text-2xl mb-2 block text-gray-300"></i>No results found</div>'; }
                suggestionsBox.classList.remove('hidden');
            }).catch(function() { suggestionsBox.innerHTML = '<div class="p-5 text-center text-red-400 text-sm">Something went wrong</div>'; suggestionsBox.classList.remove('hidden'); });
        }
        window.addFilter = function(v) { if (!v || filters.includes(v)) return; filters.push(v); renderTags(); fetchResults(); };
        window.removeFilter = function(v) { filters = filters.filter(function(f) { return f !== v; }); renderTags(); fetchResults(); };
        window.clearAllFilters = function() { filters = []; renderTags(); resultsSection.classList.add('hidden'); };
        function renderTags() { selectedTagsEl.innerHTML = ''; filters.forEach(function(t) { var p = document.createElement('span'); p.className = 'tag-pill'; p.innerHTML = t + '<button onclick="removeFilter(\'' + t.replace(/'/g, "\\'") + '\')" title="Remove">&times;</button>'; selectedTagsEl.appendChild(p); }); }
        window.fetchResults = function() {
            if (filters.length === 0) { resultsSection.classList.add('hidden'); return; }
            resultsSection.classList.remove('hidden');
            resultsGrid.innerHTML = '';
            for (var i = 0; i < 4; i++) { resultsGrid.innerHTML += '<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden"><div class="h-48 skeleton-pulse bg-gray-200"></div><div class="p-4 space-y-3"><div class="h-3 w-16 skeleton-pulse bg-gray-200 rounded"></div><div class="h-5 w-3/4 skeleton-pulse bg-gray-200 rounded"></div><div class="h-3 w-1/2 skeleton-pulse bg-gray-200 rounded"></div><div class="flex justify-between mt-2"><div class="h-6 w-24 skeleton-pulse bg-gray-200 rounded"></div><div class="h-3 w-16 skeleton-pulse bg-gray-200 rounded"></div></div><div class="h-9 skeleton-pulse bg-gray-200 rounded-lg mt-3"></div></div></div>'; }
            fetch(SEARCH_RESULTS_URL + '?filters=' + encodeURIComponent(JSON.stringify(filters))).then(function(r) { return r.json(); }).then(function(data) {
                resultsGrid.innerHTML = '';
                if (!data || data.length === 0) { resultCountEl.textContent = 'No properties found'; resultsGrid.innerHTML = '<div class="col-span-full text-center py-16"><div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4"><i class="fas fa-building text-gray-300 text-3xl"></i></div><p class="text-gray-500 font-medium">No properties match your filters</p><button onclick="clearAllFilters()" class="mt-4 text-brand-600 text-sm font-semibold hover:underline">Clear All Filters</button></div>'; return; }
                resultCountEl.textContent = 'Showing ' + data.length + ' propert' + (data.length === 1 ? 'y' : 'ies');
                data.forEach(function(item, i) {
                    var c = document.createElement('div'); c.className = 'search-result-card bg-white rounded-2xl border border-gray-100 overflow-hidden group'; c.style.animation = 'modalIn 0.4s ease-out both'; c.style.animationDelay = (i * 60) + 'ms';
                    var img = item.image ? (BASE_URL + item.image) : DEFAULT_IMAGE, price = item.price ? ('\u20b9' + Number(item.price).toLocaleString('en-IN')) : 'Price on Request', slug = item.slug || '#', bhk = item.bedroom ? (item.bedroom + ' BHK') : '', bath = item.bathroom ? (item.bathroom + ' Bath') : '', size = item.size ? (item.size + ' sq.ft') : '', type = item.property_type || 'Property', addr = item.address || '', rera = item.rera_number ? '<span class="bg-blue-50 text-blue-600 text-[9px] font-bold px-1.5 py-0.5 rounded">RERA</span>' : '', poss = item.possession_date ? '<p class="text-[10px] text-gray-400">Possession: ' + item.possession_date + '</p>' : '';
                    resultsGrid.appendChild(c);
                });
            }).catch(function() { resultsGrid.innerHTML = '<div class="col-span-full text-center py-16 text-red-400"><i class="fas fa-exclamation-triangle text-3xl mb-3 block"></i>Failed to load results.</div>'; });
        };
    })();
    </script>

    <!-- ===== OTHER UTILITY FUNCTIONS ===== -->
    <script>
    function toggleMobileMenu() { document.getElementById('mobileMenu').classList.toggle('hidden'); }
    function playVideo(url) { var id = ''; if (url.indexOf('youtube.com') !== -1) { id = (url.split('v=')[1] || ''); var a = id.indexOf('&'); if (a !== -1) id = id.substring(0, a); } else if (url.indexOf('youtu.be') !== -1) { id = url.split('/').pop(); } if (!id) return; document.getElementById('videoFrame').src = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0'; document.getElementById('videoModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
    function closeVideoModal() { document.getElementById('videoFrame').src = ''; document.getElementById('videoModal').classList.add('hidden'); document.body.style.overflow = ''; }
    </script>

    <!-- ===== CHATBOT ENGINE ===== -->
    <script>
    (function() {
        'use strict';

        var WOMAN_AV = '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="18" r="11" fill="white"/><path d="M13 55c0-10.493 8.507-19 19-19s19 8.507 19 19" fill="white"/><path d="M25 15.5c0-2 1.8-4.5 7-4.5s7 2.5 7 4.5" stroke="#ea580c" stroke-width="2.2" stroke-linecap="round" fill="none"/><circle cx="28" cy="18" r="1.3" fill="#ea580c"/><circle cx="36" cy="18" r="1.3" fill="#ea580c"/><path d="M29.5 22.5s1.3 2 2.5 2 2.5-2 2.5-2" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg>';
        var USER_AV = '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="20" r="11" fill="white"/><path d="M14 56c0-9.941 8.059-18 18-18s18 8.059 18 18" fill="white"/></svg>';

        var chatOpen = false, chatFirstOpen = true;
        var chatFab = document.getElementById('chatFab'), chatPanel = document.getElementById('chatPanel');
        var chatMessages = document.getElementById('chatMessages'), chatInput = document.getElementById('chatInput');
        var chatQuick = document.getElementById('chatQuick'), chatBadge = document.getElementById('chatBadge');
        var chatFabIconOpen = document.getElementById('chatFabIconOpen'), chatFabIconClose = document.getElementById('chatFabIconClose');
        var chatStatusText = document.getElementById('chatStatusText');

        function getTime() { var d=new Date(),h=d.getHours(),m=d.getMinutes(),ap=h>=12?'PM':'AM'; h=h%12||12; return h+':'+(m<10?'0':'')+m+' '+ap; }

        function addMsg(text, type, quickAfter) {
            var div = document.createElement('div');
            div.className = 'chat-msg ' + type;
            if (type === 'bot') {
                div.innerHTML = '<div class="msg-row"><div class="msg-avatar-sm">' + WOMAN_AV + '</div><div><div class="msg-bubble">' + text + '</div><div class="msg-time">' + getTime() + '</div></div></div>';
            } else {
                div.innerHTML = '<div class="msg-row"><div><div class="msg-bubble">' + text + '</div><div class="msg-time">' + getTime() + ' <i class="fas fa-check-double msg-check"></i></div></div><div class="msg-avatar-sm user-av">' + USER_AV + '</div></div>';
            }
            chatMessages.appendChild(div);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            if (quickAfter) showQuickReplies(quickAfter);
        }

        function showTyping() {
            chatStatusText.innerHTML = '<span class="typing-live">typing...</span>';
            var div = document.createElement('div');
            div.className = 'chat-msg bot'; div.id = 'typingIndicator';
            div.innerHTML = '<div class="msg-row"><div class="msg-avatar-sm">' + WOMAN_AV + '</div><div class="chat-typing"><span></span><span></span><span></span></div></div>';
            chatMessages.appendChild(div);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
        function removeTyping() { var t = document.getElementById('typingIndicator'); if(t) t.remove(); chatStatusText.innerHTML = 'Online now'; }

        function botReply(text, delay, quickAfter) { showTyping(); setTimeout(function() { removeTyping(); addMsg(text, 'bot', quickAfter); }, delay || 900); }

        function showQuickReplies(set) {
            chatQuick.innerHTML = '';
            var replies = set || [
                {label:'\uD83C\uDFE0 Browse Properties',key:'browse'},{label:'\uD83D\uDCB0 Pricing Help',key:'pricing'},
                {label:'\uD83D\uDCCD Locations',key:'locations'},{label:'\uD83D\uDCDE Contact Agent',key:'contact'},
                {label:'\uD83D\uDCAC Enquire Now',key:'enquire'},{label:'\uD83C\uDFE6 Loan/EMI',key:'loan'}
            ];
            replies.forEach(function(r) {
                var btn = document.createElement('button');
                btn.textContent = r.label;
                btn.onclick = function() { chatQuickReply(r.key); };
                chatQuick.appendChild(btn);
            });
        }
        function hideQuick() { chatQuick.innerHTML = ''; }

        function addDateSep() {
            var div = document.createElement('div');
            div.className = 'chat-date-sep';
            var d = new Date(), opts = {month:'short',day:'numeric',year:'numeric'};
            div.innerHTML = '<span>Today, ' + d.toLocaleDateString('en-US',opts) + '</span>';
            chatMessages.appendChild(div);
        }

        function initChat() {
            chatMessages.innerHTML = '';
            addDateSep();
            addMsg('\uD83D\uDC4B Hi there! I\'m <strong>Priya</strong>, your personal property advisor at <strong>' + SITE_NAME + '</strong>.', 'bot');
            setTimeout(function() {
                addMsg('I can help you find the perfect home \u2014 apartments, villas, plots, or commercial spaces. What are you looking for?', 'bot', 'default');
            }, 600);
        }

        window.chatResetChat = function() { initChat(); };

        window.chatQuickReply = function(key) {
            hideQuick();
            var userText = '', botText = '', nextQ = null;

            switch(key) {
                case 'browse':
                    userText = 'I want to browse properties';
                    botText = '\uD83C\uDFE0 Great! You can browse our full property listing by clicking the search bar at the top, or use these quick links:<br><br>'
                        + '<div style="display:flex;flex-direction:column;gap:6px;font-size:.78em">'
                        + '<a href="{{ route('properties') }}" style="color:#f97316;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:6px"><i class="fas fa-building" style="width:20px;text-align:center"></i> All Properties</a>'
                        + '<a href="{{ route('properties', ['type' => 'apartment']) }}" style="color:#f97316;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:6px"><i class="fas fa-home" style="width:20px;text-align:center"></i> Apartments</a>'
                        + '<a href="{{ route('properties', ['type' => 'villa']) }}" style="color:#f97316;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:6px"><i class="fas fa-house-chimney" style="width:20px;text-align:center"></i> Villas</a>'
                        + '<a href="{{ route('properties', ['type' => 'plot']) }}" style="color:#f97316;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:6px"><i class="fas fa-map" style="width:20px;text-align:center"></i> Plots</a>'
                        + '<a href="{{ route('properties', ['type' => 'commercial']) }}" style="color:#f97316;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:6px"><i class="fas fa-city" style="width:20px;text-align:center"></i> Commercial</a>'
                        + '</div>';
                    nextQ = [{label:'\uD83D\uDCB0 Pricing',key:'pricing'},{label:'\uD83D\uDCCD Locations',key:'locations'},{label:'\uD83D\uDCDE Contact',key:'contact'}];
                    break;

                case 'pricing':
                    userText = 'Tell me about pricing';
                    botText = '\uD83D\uDCB0 Our properties range from <strong style="color:#ea580c">affordable homes</strong> to <strong style="color:#ea580c">luxury apartments</strong>.<br><br>'
                        + '\u2022 Budget homes starting from \u20B915-30 Lakhs<br>'
                        + '\u2022 Mid-range: \u20B930-80 Lakhs<br>'
                        + '\u2022 Premium: \u20B980 Lakhs - 3 Cr+<br><br>'
                        + '<em style="color:#aaa;font-size:.72em">Prices vary by city, builder & configuration. Contact us for exact quotes.</em>';
                    nextQ = [{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83C\uDFE6 Loan',key:'loan'},{label:'\uD83D\uDCDE Contact',key:'contact'}];
                    break;

                case 'locations':
                    userText = 'Which cities do you cover?';
                    botText = '\uD83D\uDCCD We have properties across <strong>major Indian cities</strong> including:<br><br>'
                        + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:4px 12px;font-size:.78em">'
                        + '<div>\uD83C\uDFD9\uFE0F Mumbai</div><div>\uD83C\uDFD9\uFE0F Pune</div>'
                        + '<div>\uD83C\uDFD9\uFE0F Bangalore</div><div>\uD83C\uDFD9\uFE0F Delhi NCR</div>'
                        + '<div>\uD83C\uDFD9\uFE0F Hyderabad</div><div>\uD83C\uDFD9\uFE0F Chennai</div>'
                        + '<div>\uD83C\uDFD9\uFE0F Kolkata</div><div>\uD83C\uDFD9\uFE0F Ahmedabad</div>'
                        + '</div><br>'
                        + '<em style="color:#aaa;font-size:.72em">Use the search bar above to filter by city!</em>';
                    nextQ = [{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83D\uDCB0 Pricing',key:'pricing'},{label:'\uD83D\uDCDE Contact',key:'contact'}];
                    break;

                case 'contact':
                    userText = 'I want to contact an agent';
                    botText = '\uD83D\uDCDE You can reach our team directly:<br><br>'
                        + '<div class="inline-btns">'
                        + '<a href="tel:' + SITE_PHONE + '" style="background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 2px 8px rgba(249,115,22,.3)"><i class="fas fa-phone" style="font-size:10px"></i> ' + SITE_PHONE + '</a>'
                        + (SITE_PHONE_CLEAN ? '<a href="https://wa.me/' + SITE_PHONE_CLEAN + '" target="_blank" style="background:#22c55e;box-shadow:0 2px 8px rgba(34,197,94,.3)"><i class="fab fa-whatsapp" style="font-size:12px"></i> WhatsApp</a>' : '')
                        + '</div>'
                        + '<br><span style="font-size:.72em;color:#aaa">Available 9 AM \u2013 9 PM, 7 days a week</span>';
                    nextQ = [{label:'\uD83D\uDCAC Enquire',key:'enquire'},{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83D\uDCB0 Pricing',key:'pricing'}];
                    break;

                case 'enquire':
                    userText = 'I want to enquire';
                    botText = '\uD83D\uDCAC I\'d love to help! Click below to submit your enquiry and our team will get back to you within 30 minutes:<br><br>'
                        + '<button onclick="closeChat();showEnquiry(\'General Consultation\');" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">\u2709\uFE0F Enquire Now</button>'
                        + '<br><br><span style="font-size:.72em;color:#aaa">Free consultation \u00B7 No obligation \u00B7 Expert advice</span>';
                    nextQ = [{label:'\uD83D\uDCDE Contact',key:'contact'},{label:'\uD83C\uDFE0 Browse',key:'browse'}];
                    break;

                case 'loan':
                    userText = 'Tell me about home loans';
                    botText = '\uD83C\uDFE6 We help with home loan assistance through top banks:<br><br>'
                        + '\u2022 SBI, HDFC, ICICI, Axis & more<br>'
                        + '\u2022 Interest rates from 8.5% onwards<br>'
                        + '\u2022 Quick approval & documentation help<br>'
                        + '\u2022 Compare offers from multiple banks<br><br>'
                        + '<button onclick="closeChat();showEnquiry(\'Loan Assistance\');" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">\uD83D\uDCAC Get Loan Assistance</button>';
                    nextQ = [{label:'\uD83D\uDCB0 Pricing',key:'pricing'},{label:'\uD83D\uDCDE Contact',key:'contact'},{label:'\uD83C\uDFE0 Browse',key:'browse'}];
                    break;

                default:
                    userText = 'Help';
                    botText = 'I can help you with:<br><br>'
                        + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:4px;font-size:.78em">'
                        + '<div>\uD83C\uDFE0 Browse Properties</div><div>\uD83D\uDCB0 Pricing Info</div>'
                        + '<div>\uD83D\uDCCD City Coverage</div><div>\uD83D\uDCDE Contact Agent</div>'
                        + '<div>\uD83D\uDCAC Submit Enquiry</div><div>\uD83C\uDFE6 Loan/EMI Help</div>'
                        + '</div>';
                    nextQ = 'default';
            }

            addMsg(userText, 'user');
            botReply(botText, 700, nextQ);
        };

        window.chatSend = function() {
            var text = chatInput.value.trim();
            if (!text) return;
            chatInput.value = '';
            hideQuick();
            addMsg(text, 'user');

            var lower = text.toLowerCase(), reply = '', nextQ = null;

            if (lower.match(/price|cost|rate|budget|afford|cheap|kitna|expensive/i)) {
                nextQ = [{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83D\uDCDE Contact',key:'contact'}];
                reply = '\uD83D\uDCB0 Our properties range from \u20B915 Lakhs for budget apartments to \u20B93 Cr+ for premium homes. Use the search bar to filter by price range!';
            } else if (lower.match(/apartment|flat|bhk|1rk|2bhk|3bhk|4bhk|config/i)) {
                nextQ = [{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83D\uDCB0 Pricing',key:'pricing'}];
                reply = '\uD83C\uDFE0 We have 1 RK to 5+ BHK configurations available. Use the search bar or browse all properties to find your perfect match. Want me to help you search?';
            } else if (lower.match(/villa|independent|house|bungalow/i)) {
                nextQ = [{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83D\uDCB0 Pricing',key:'pricing'}];
                reply = '\uD83C\uDFE1 We have premium villas and independent houses available across multiple cities. Check our listings for details!';
            } else if (lower.match(/plot|land|acre/i)) {
                nextQ = [{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83D\uDCDE Contact',key:'contact'}];
                reply = '\uD83C\uDFD7\uFE0F Residential and commercial plots are available. Use the search bar and select "Plots" to see all available land options.';
            } else if (lower.match(/commercial|office|shop|warehouse/i)) {
                nextQ = [{label:'\uD83C\uDFE0 Browse',key:'browse'},{label:'\uD83D\uDCDE Contact',key:'contact'}];
                reply = '\uD83C\uDFE2 We offer offices, shops, showrooms, warehouses and more. Browse our commercial section for details!';
            } else if (lower.match(/city|location|area|where|mumbai|pune|bangalore|delhi|hyderabad/i)) {
                nextQ = [{label:'\uD83D\uDCCD Locations',key:'locations'},{label:'\uD83C\uDFE0 Browse',key:'browse'}];
                reply = '\uD83D\uDCCD We cover major cities \u2014 Mumbai, Pune, Bangalore, Delhi NCR, Hyderabad, Chennai, Kolkata, Ahmedabad and more. Use the search bar to find properties in your preferred city!';
            } else if (lower.match(/loan|emi|bank|finance|interest|home loan/i)) {
                nextQ = [{label:'\uD83D\uDCDE Contact',key:'contact'},{label:'\uD83D\uDCAC Enquire',key:'enquire'}];
                reply = '\uD83C\uDFE6 We assist with home loans from SBI, HDFC, ICICI and other top banks at competitive rates starting 8.5%.<br><br><button onclick="closeChat();showEnquiry(\'Loan Assistance\');" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">\uD83D\uDCAC Get Loan Help</button>';
            } else if (lower.match(/agent|contact|call|phone|talk|connect|person/i)) {
                nextQ = [{label:'\uD83D\uDCAC Enquire',key:'enquire'},{label:'\uD83C\uDFE0 Browse',key:'browse'}];
                reply = '\uD83D\uDCDE Reach us at <strong>' + SITE_PHONE + '</strong><br><br><div class="inline-btns"><a href="tel:' + SITE_PHONE + '" style="background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 2px 8px rgba(249,115,22,.3)"><i class="fas fa-phone" style="font-size:10px"></i> Call Now</a>' + (SITE_PHONE_CLEAN ? '<a href="https://wa.me/' + SITE_PHONE_CLEAN + '" target="_blank" style="background:#22c55e;box-shadow:0 2px 8px rgba(34,197,94,.3)"><i class="fab fa-whatsapp" style="font-size:12px"></i> WhatsApp</a>' : '') + '</div>';
            } else if (lower.match(/enquir|submit|form|register|interest/i)) {
                nextQ = [{label:'\uD83D\uDCDE Contact',key:'contact'},{label:'\uD83C\uDFE0 Browse',key:'browse'}];
                reply = '\uD83D\uDCAC <button onclick="closeChat();showEnquiry(\'General Consultation\');" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">\u2709\uFE0F Click to Enquire Now</button><br><br><span style="font-size:.72em;color:#aaa">We\'ll respond within 30 minutes!</span>';
            } else if (lower.match(/hi|hello|hey|good|start|help/i)) {
                nextQ = 'default';
                reply = '\uD83D\uDC4B Hello! Welcome to <strong>' + SITE_NAME + '</strong>! I\'m here to help you find the perfect property. Ask me about locations, pricing, property types, loans, or anything else!';
            } else if (lower.match(/thank|thanks|bye|goodbye/i)) {
                nextQ = 'default';
                reply = '\uD83D\uDE0A You\'re welcome! Feel free to come back anytime. Wishing you the best in finding your dream home! \uD83D\uDE4F';
            } else {
                nextQ = 'default';
                reply = '\uD83E\uDD14 I\'m not sure about that. Try asking about:<br><br>'
                    + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:4px;font-size:.78em">'
                    + '<div>\uD83C\uDFE0 Property Types</div><div>\uD83D\uDCB0 Pricing</div>'
                    + '<div>\uD83D\uDCCD Cities</div><div>\uD83D\uDCDE Contact Agent</div>'
                    + '<div>\uD83D\uDCAC Enquire</div><div>\uD83C\uDFE6 Loan/EMI</div>'
                    + '</div>';
            }
            botReply(reply, 800, nextQ);
        };

        chatInput.addEventListener('keydown', function(e) { if(e.key==='Enter'){e.preventDefault();chatSend();} });

        chatFab.addEventListener('click', function() {
            chatOpen = !chatOpen;
            chatPanel.classList.toggle('open', chatOpen);
            chatFab.classList.toggle('active', chatOpen);
            chatFabIconOpen.style.display = chatOpen ? 'none' : 'block';
            chatFabIconClose.style.display = chatOpen ? 'block' : 'none';
            if (chatOpen && chatFirstOpen) {
                chatFirstOpen = false;
                chatBadge.style.display = 'none';
                var ring = chatFab.querySelector('.fab-ring');
                if (ring) ring.style.display = 'none';
                initChat();
                setTimeout(function() { chatInput.focus(); }, 450);
            } else if (chatOpen) {
                setTimeout(function() { chatInput.focus(); }, 350);
            }
        });

        window.closeChat = function() {
            chatOpen = false;
            chatPanel.classList.remove('open');
            chatFab.classList.remove('active');
            chatFabIconOpen.style.display = 'block';
            chatFabIconClose.style.display = 'none';
        };

        /* Attention pulse after 6s */
        setTimeout(function() {
            if (!chatOpen && chatFirstOpen) {
                chatFab.style.transform = 'scale(1.15)';
                setTimeout(function() { chatFab.style.transform = ''; }, 400);
                setTimeout(function() {
                    chatFab.style.transform = 'scale(1.15)';
                    setTimeout(function() { chatFab.style.transform = ''; }, 400);
                }, 1200);
            }
        }, 6000);

    })();
    </script>

</body>
</html>