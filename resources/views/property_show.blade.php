<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ html_decode($property->seo_title ?? $property->title) }}</title>
    <meta name="description" content="{{ html_decode($property->seo_meta_description ?? Str::limit($property->description, 160)) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
        *{font-family:'Inter',sans-serif;box-sizing:border-box}
        body{margin:0;padding:0;background:#f5f6f8}
        .no-scrollbar::-webkit-scrollbar{display:none}
        .no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
        .btn-p{background:linear-gradient(135deg,#f97316,#ea580c);transition:all .3s;cursor:pointer;border:none}
        .btn-p:hover{background:linear-gradient(135deg,#ea580c,#c2410c);transform:translateY(-1px);box-shadow:0 4px 15px rgba(249,115,22,.4)}
        .btn-p:disabled{opacity:.6;cursor:not-allowed;transform:none;box-shadow:none}
        .btn-o{border:2px solid #f97316;color:#f97316;transition:all .3s;cursor:pointer;background:#fff}
        .btn-o:hover{background:#f97316;color:#fff}
        .nav-link{position:relative}
        .nav-link::after{content:'';position:absolute;bottom:-2px;left:0;width:0;height:2px;background:#f97316;transition:width .3s}
        .nav-link:hover::after{width:100%}
        .modal-anim{animation:modalIn .3s ease-out}
        @keyframes modalIn{from{transform:scale(.95) translateY(20px);opacity:0}to{transform:scale(1) translateY(0);opacity:1}}
        .toast-anim{animation:slideUp .4s ease-out,fadeOut .4s ease-in 2.6s forwards}
        @keyframes slideUp{from{transform:translateY(100%);opacity:0}to{transform:translateY(0);opacity:1}}
        @keyframes fadeOut{from{opacity:1}to{opacity:0}}
        .gallery-main{width:100%;height:460px;object-fit:cover;cursor:zoom-in;display:block}
        .thumb-strip{display:flex;gap:8px;margin-top:10px;overflow-x:auto;padding-bottom:4px}
        .thumb-strip::-webkit-scrollbar{height:3px}
        .thumb-strip::-webkit-scrollbar-thumb{background:#f97316;border-radius:99px}
        .thumb-strip img{width:84px;height:60px;object-fit:cover;border-radius:8px;cursor:pointer;border:2px solid transparent;opacity:.5;flex-shrink:0;transition:all .3s}
        .thumb-strip img.active,.thumb-strip img:hover{border-color:#f97316;opacity:1;transform:scale(1.06)}
        .ov-card{background:#fff;border:1px solid #eef0f2;border-radius:14px;padding:18px 12px;text-align:center;transition:all .35s}
        .ov-card:hover{border-color:#f97316;box-shadow:0 6px 20px rgba(249,115,22,.1);transform:translateY(-3px)}
        .ov-card .ov-i{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:1rem}
        .ov-card .ov-v{font-size:.9rem;font-weight:700;color:#111}
        .ov-card .ov-l{font-size:.66rem;color:#aaa;text-transform:uppercase;letter-spacing:.4px;margin-top:3px}
        .kf{display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;background:#f9fafb;border:1px solid #f3f4f6;transition:all .3s}
        .kf:hover{border-color:#f97316;background:#fff7ed}
        .kf .kf-i{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0}
        .kf .kf-t{font-size:.8rem;font-weight:600;color:#333}
        .nb{display:flex;align-items:center;gap:12px;padding:11px 0;border-bottom:1px solid #f3f4f6}
        .nb:last-child{border-bottom:none}
        .nb .nb-i{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.82rem;flex-shrink:0}
        .nb .nb-n{flex:1;font-size:.8rem;font-weight:600;color:#333}
        .nb .nb-d{font-size:.76rem;font-weight:700;color:#ea580c}
        .am-tag{display:inline-flex;align-items:center;gap:5px;background:#f0fdf4;color:#16a34a;font-size:.73rem;font-weight:600;padding:6px 13px;border-radius:99px;border:1px solid #bbf7d0}
        .sh-bar{width:4px;height:22px;border-radius:99px;background:linear-gradient(180deg,#f97316,#ea580c)}
        .section-heading{display:flex;align-items:center;gap:10px;margin-bottom:18px}
        .lightbox-overlay{position:fixed;inset:0;z-index:200;background:rgba(0,0,0,.92);display:none;align-items:center;justify-content:center}
        .lightbox-overlay.show{display:flex}
        .lightbox-overlay img{max-width:90vw;max-height:85vh;border-radius:12px;object-fit:contain}
        .review-card{background:#fff;border:1px solid #eef0f2;border-radius:14px;padding:18px;border-left:4px solid #f97316}
        .rate-bar-bg{height:6px;border-radius:99px;background:#e5e7eb;overflow:hidden}
        .rate-bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,#f97316,#f59e0b)}
        .sim-card{background:#fff;border:1px solid #eef0f2;border-radius:14px;overflow:hidden;transition:all .35s;cursor:pointer}
        .sim-card:hover{transform:translateY(-5px);box-shadow:0 12px 30px rgba(0,0,0,.08)}
        .sim-card img{width:100%;height:170px;object-fit:cover}
        .loc-feature{display:flex;align-items:center;gap:12px;padding:12px 16px;background:#fff;border:1px solid #eef0f2;border-radius:12px;transition:all .3s}
        .loc-feature:hover{border-color:#f97316;box-shadow:0 4px 12px rgba(249,115,22,.08)}
        .loc-feature .lf-i{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0}
        .loc-feature .lf-n{font-size:.82rem;font-weight:600;color:#333}
        .loc-feature .lf-v{font-size:.78rem;color:#888;font-weight:500}
        .form-input{width:100%;border:2px solid #e5e7eb;border-radius:12px;padding:10px 14px;font-size:.875rem;outline:none;background:#f9fafb;transition:border-color .3s}
        .form-input:focus{border-color:#f97316;background:#fff}
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
        .ch-property-strip{padding:8px 16px 10px;background:rgba(255,255,255,.06);display:flex;align-items:center;gap:8px;position:relative;z-index:1;border-top:1px solid rgba(255,255,255,.06)}
        .ch-property-strip img{width:36px;height:36px;border-radius:8px;object-fit:cover;flex-shrink:0}
        .ch-property-strip .ch-pp-name{font-size:.72rem;font-weight:600;color:rgba(255,255,255,.85);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px}
        .ch-property-strip .ch-pp-price{font-size:.68rem;font-weight:700;color:#fb923c}
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
        .chat-input-area .chat-send:disabled{opacity:.4;cursor:not-allowed;transform:none;box-shadow:none}
        .chat-powered{padding:5px 14px;text-align:center;background:#fafafa;border-top:1px solid #f3f4f6;flex-shrink:0}
        .chat-powered span{font-size:.58rem;color:#c0c0c0;font-weight:500;letter-spacing:.3px}
        @media(max-width:768px){
            .gallery-main{height:260px}
            .sim-grid{grid-template-columns:1fr !important}
            .chat-panel{right:8px;bottom:90px;width:calc(100vw - 16px);height:calc(100vh - 110px);max-height:none;border-radius:18px 18px 0 0}
            .chat-fab{bottom:18px;right:18px;width:56px;height:56px}
        }
    </style>
</head>
<body class="text-gray-800">

    <!-- TOP BAR -->
    <div class="bg-dark-900 text-white text-xs py-2">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="tel:{{ $setting->phone ?? '' }}" class="flex items-center gap-1.5 hover:text-brand-400 transition"><i class="fas fa-phone text-[10px]"></i>{{ $setting->phone ?? '+91 98765 43210' }}</a>
                <a href="mailto:{{ $setting->email ?? '' }}" class="hidden sm:flex items-center gap-1.5 hover:text-brand-400 transition"><i class="fas fa-envelope text-[10px]"></i>{{ $setting->email ?? 'info@example.com' }}</a>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden sm:inline text-gray-400">Follow us:</span>
                @isset($setting->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-facebook-f text-xs"></i></a>
                @endisset
                @isset($setting->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-instagram text-xs"></i></a>
                @endisset
                @isset($setting->twitter)
                    <a href="{{ $setting->twitter }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-twitter text-xs"></i></a>
                @endisset
                @isset($setting->youtube)
                    <a href="{{ $setting->youtube }}" target="_blank" rel="noopener" class="hover:text-brand-400 transition"><i class="fab fa-youtube text-xs"></i></a>
                @endisset
            </div>
        </div>
    </div>

    <!-- NAV -->
    <nav class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100" id="mainNav">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center"><i class="fas fa-building text-white text-lg"></i></div>
                    <div>
                        <span class="text-lg font-bold text-dark-900">{{ $setting->site_name ?? 'RealEstate' }}</span>
                        <p class="text-[10px] text-gray-400 -mt-1 tracking-wider uppercase">Premium Properties</p>
                    </div>
                </a>
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Home</a>
                    <a href="{{ route('properties') }}" class="nav-link text-sm font-medium text-brand-600">Properties</a>
                    <a href="{{ route('agents') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">Agents</a>
                    @isset($pages)
                        @foreach($pages->take(3) as $page)
                            <a href="{{ route('page', $page->slug) }}" class="nav-link text-sm font-medium text-gray-600 hover:text-gray-900">{{ Str::limit($page->title, 15) }}</a>
                        @endforeach
                    @endisset
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('agents') }}" class="btn-p text-white text-sm font-semibold px-5 py-2.5 rounded-lg hidden sm:inline-flex items-center gap-2">Get Free Consultation</a>
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100" aria-label="Toggle menu"><i class="fas fa-bars text-xl"></i></button>
                </div>
            </div>
        </div>
        <div class="lg:hidden hidden bg-white border-t border-gray-100 pb-4" id="mobileMenu">
            <div class="px-4 pt-3 space-y-1">
                <a href="{{ route('home') }}" class="mobile-link block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Home</a>
                <a href="{{ route('properties') }}" class="mobile-link block py-2.5 px-3 text-sm font-medium text-brand-600 bg-brand-50 rounded-lg">Properties</a>
                <a href="{{ route('agents') }}" class="mobile-link block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Agents</a>
                @isset($pages)
                    @foreach($pages->take(3) as $page)
                        <a href="{{ route('page', $page->slug) }}" class="mobile-link block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">{{ $page->title }}</a>
                    @endforeach
                @endisset
            </div>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <section class="relative overflow-hidden" style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%)">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-brand-500 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-blue-500 rounded-full filter blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 py-7">
            <nav class="flex items-center gap-2 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="text-white/50 hover:text-white transition"><i class="fas fa-home text-xs"></i></a>
                <i class="fas fa-chevron-right text-white/20 text-[10px]"></i>
                <a href="{{ route('properties') }}" class="text-white/50 hover:text-white transition">Properties</a>
                <i class="fas fa-chevron-right text-white/20 text-[10px]"></i>
                <span class="text-brand-400 font-medium">{{ Str::limit($property->title, 45) }}</span>
            </nav>
        </div>
    </section>

    <!-- MAIN -->
    <section class="py-8 md:py-10">
        <div class="max-w-7xl mx-auto px-4">

            <!-- TITLE BAR -->
            <div class="bg-white rounded-2xl border border-gray-100 p-5 md:p-6 mb-6" data-aos="fade-up">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <h1 class="text-xl md:text-2xl font-bold text-dark-900">{{ $property->title }}</h1>
                            @if(!empty($property->rera_number))
                                <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-md">RERA</span>
                            @endif
                            <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2.5 py-1 rounded-md">New Launch</span>
                        </div>
                        <p class="text-sm text-gray-500 flex items-center gap-1.5"><i class="fas fa-map-marker-alt text-brand-400 text-xs"></i>{{ $property->address }}</p>
                        <div class="flex items-center gap-3 mt-3 flex-wrap">
                            @if($property->total_bedroom)
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 bg-brand-50 px-3 py-1.5 rounded-lg"><i class="fas fa-bed text-[10px]"></i>{{ $property->total_bedroom }} Bed</span>
                            @endif
                            @if($property->total_bathroom)
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg"><i class="fas fa-bath text-[10px]"></i>{{ $property->total_bathroom }} Bath</span>
                            @endif
                            @if($property->total_area)
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-600 bg-green-50 px-3 py-1.5 rounded-lg"><i class="fas fa-ruler-combined text-[10px]"></i>{{ $property->total_area }} m²</span>
                            @endif
                            @if($property->total_garage)
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-purple-600 bg-purple-50 px-3 py-1.5 rounded-lg"><i class="fas fa-car text-[10px]"></i>{{ $property->total_garage }} Parking</span>
                            @endif
                            @isset($property->possession_date)
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-yellow-600 bg-yellow-50 px-3 py-1.5 rounded-lg"><i class="fas fa-calendar text-[10px]"></i>{{ date('M Y', strtotime($property->possession_date)) }}</span>
                            @endisset
                        </div>
                    </div>
                    <div class="text-left md:text-right shrink-0 md:pl-6 md:border-l border-gray-100">
                        <p class="text-xs text-gray-400">Starting Price</p>
                        <div class="text-2xl md:text-3xl font-extrabold" style="color:#c2410c">{{ html_decode(num_format($property->price)) }}</div>
                        @if($property->purpose == 'rent' && $property->rent_period)
                            <span class="text-xs text-gray-500">{{ $property->rent_period }}</span>
                        @endif
                        @isset($property->size)
                            <p class="text-xs text-gray-400 mt-1">{{ $property->size }} sq.ft</p>
                        @endisset
                        <div class="flex gap-2 mt-3 justify-start md:justify-end">
                            <button onclick="showEnquiry('{{ Str::limit(addslashes($property->title), 30) }}')" class="btn-p text-white text-sm font-semibold px-5 py-2.5 rounded-xl inline-flex items-center gap-2"><i class="fas fa-phone text-xs"></i> Enquire Now</button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone ?? '919876543210') }}?text={{ urlencode('Hi, I am interested in: ' . $property->title) }}" target="_blank" rel="noopener" class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center text-white hover:bg-green-600 transition" aria-label="WhatsApp"><i class="fab fa-whatsapp text-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GALLERY -->
            @php
                $sliderImages = [];
                foreach($sliders as $s) {
                    $sliderImages[] = $s->image ? asset($s->image) : asset($setting->default_placeholder ?? 'default.jpg');
                }
                $firstImage = count($sliderImages) > 0 ? $sliderImages[0] : asset($setting->default_placeholder ?? 'default.jpg');
            @endphp
            <div class="relative mb-8" data-aos="fade-up" data-aos-delay="50">
                <div class="relative rounded-2xl overflow-hidden bg-gray-200">
                    <img id="mainImg" src="{{ $firstImage }}" alt="{{ $property->title }}" class="gallery-main" onclick="openLightbox(0)">
                    @if(count($sliderImages) > 1)
                        <button onclick="prevSlide()" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center shadow-lg hover:bg-white transition z-10" aria-label="Previous image"><i class="fas fa-chevron-left text-gray-700 text-sm"></i></button>
                        <button onclick="nextSlide()" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center shadow-lg hover:bg-white transition z-10" aria-label="Next image"><i class="fas fa-chevron-right text-gray-700 text-sm"></i></button>
                    @endif
                    <div class="absolute top-3 right-3 bg-dark-900/80 backdrop-blur-sm text-white text-[10px] font-bold px-3 py-1 rounded-lg z-10"><i class="fas fa-camera mr-1"></i>{{ count($sliderImages) }} Photos</div>
                </div>
                @if(count($sliderImages) > 1)
                    <div class="thumb-strip" id="thumbStrip">
                        @foreach($sliderImages as $index => $imgSrc)
                            <img src="{{ $imgSrc }}" class="{{ $index == 0 ? 'active' : '' }}" onclick="setSlide({{ $index }})" alt="Thumbnail {{ $index + 1 }}">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- OVERVIEW CHIPS -->
            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 mb-8" data-aos="fade-up" data-aos-delay="100">
                <div class="ov-card"><div class="ov-i bg-brand-50 text-brand-500"><i class="fas fa-building"></i></div><div class="ov-v">{{ $property->total_unit ?? '-' }}</div><div class="ov-l">Units</div></div>
                <div class="ov-card"><div class="ov-i bg-blue-50 text-blue-500"><i class="fas fa-layer-group"></i></div><div class="ov-v">{{ $property->total_floor ?? '-' }}</div><div class="ov-l">Floors</div></div>
                <div class="ov-card"><div class="ov-i bg-green-50 text-green-500"><i class="fas fa-bed"></i></div><div class="ov-v">{{ $property->total_bedroom ?? '-' }} BHK</div><div class="ov-l">Config</div></div>
                <div class="ov-card"><div class="ov-i bg-purple-50 text-purple-500"><i class="fas fa-door-open"></i></div><div class="ov-v">{{ $property->total_bathroom ?? '-' }}</div><div class="ov-l">Bathroom</div></div>
                <div class="ov-card"><div class="ov-i bg-yellow-50 text-yellow-500"><i class="fas fa-car"></i></div><div class="ov-v">{{ $property->total_garage ?? '-' }}</div><div class="ov-l">Parking</div></div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- LEFT CONTENT -->
                <div class="flex-1 min-w-0 space-y-6">
                    <!-- DESCRIPTION -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                        <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Property Overview</h2></div>
                        <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed text-[.84rem]">{!! html_decode($property->description) !!}</div>
                    </div>

                    <!-- CONFIGURATION -->
                    @php
                        $config = json_decode($property->configuration_json, true);
                        $config = is_array($config) ? $config : [];
                        if (!function_exists('makeLabel')) {
                            function makeLabel($key) { return ucwords(str_replace('_', ' ', $key)); }
                        }
                        $cfgIcons = [
                            'bedrooms'=>'fa-bed','bathrooms'=>'fa-bath','balcony'=>'fa-building','carpet_area'=>'fa-ruler',
                            'furnishing'=>'fa-couch','ac'=>'fa-snowflake','tv'=>'fa-tv','fridge'=>'fa-box','sofa'=>'fa-couch',
                            'parking'=>'fa-car','builtup_area'=>'fa-ruler-combined','super_builtup_area'=>'fa-expand',
                            'bhk_type'=>'fa-home','pooja_room'=>'fa-om','study_room'=>'fa-book','servant_room'=>'fa-person',
                            'store_room'=>'fa-boxes-stacked','covered_parking'=>'fa-warehouse','open_parking'=>'fa-square-parking',
                            'total_floors'=>'fa-layer-group','property_floor'=>'fa-building','availability'=>'fa-clock',
                            'age'=>'fa-calendar','possession_by'=>'fa-key','washing_machine'=>'fa-shirt',
                            'microwave'=>'fa-bolt','chimney'=>'fa-wind','stove'=>'fa-fire-burner'
                        ];
                        $cfgGroups = [
                            ['Area Details',['carpet_area','builtup_area','super_builtup_area']],
                            ['Room Details',['bhk_type','bedrooms','bathrooms','balcony','pooja_room','study_room','servant_room','store_room']],
                            ['Furnishing Details',['furnishing','ac','tv','fridge','sofa','washing_machine','microwave','chimney','stove']],
                            ['Parking Details',['covered_parking','open_parking']],
                            ['Other Details',['total_floors','property_floor','availability','age','possession_by']]
                        ];
                    @endphp
                    @foreach($cfgGroups as $group)
                        @php
                            $groupData = [];
                            foreach($group[1] as $key) {
                                if(array_key_exists($key, $config)) {
                                    $val = $config[$key];
                                    if($val !== null && $val !== '' && $val != 0) { $groupData[$key] = $val; }
                                }
                            }
                        @endphp
                        @if(count($groupData) > 0)
                            <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                                <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">{{ $group[0] }}</h2></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($groupData as $key => $val)
                                        <div class="kf">
                                            <div class="kf-i bg-brand-50 text-brand-500"><i class="fas {{ $cfgIcons[$key] ?? 'fa-circle-info' }}"></i></div>
                                            <div>
                                                <div class="text-[11px] text-gray-400">{{ makeLabel($key) }}</div>
                                                <div class="kf-t">
                                                    @if(isset($config[$key.'_unit']))
                                                        {{ $val }} {{ $config[$key.'_unit'] }}
                                                    @elseif(is_array($val))
                                                        {{ implode(', ', $val) }}
                                                    @else
                                                        {{ $val }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <!-- ADDITIONAL INFO -->
                    @if(isset($additional_informations) && $additional_informations->count() > 0)
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                            <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Additional Information</h2></div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($additional_informations as $info)
                                    <div class="kf">
                                        <div class="kf-i bg-blue-50 text-blue-500"><i class="fas fa-circle-info"></i></div>
                                        <div>
                                            <div class="text-[11px] text-gray-400">{{ html_decode($info->add_key) }}</div>
                                            <div class="kf-t">{{ html_decode($info->add_value) }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- AMENITIES -->
                    @if(isset($aminities) && $aminities->count() > 0)
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                            <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Amenities</h2></div>
                            <div class="flex flex-wrap gap-2.5">
                                @foreach($aminities as $am)
                                    <span class="am-tag"><i class="fas fa-check text-[10px]"></i>{{ $am->aminity->aminity }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- NEARBY -->
                    @if(isset($nearest_locations) && $nearest_locations->count() > 0)
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                            <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Nearby Landmarks</h2></div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                                @foreach($nearest_locations as $near)
                                    <div class="nb">
                                        <div class="nb-i bg-brand-50 text-brand-500"><i class="fas fa-map-pin"></i></div>
                                        <div class="nb-n">{{ $near->location->location ?? '' }}</div>
                                        <div class="nb-d">{{ html_decode($near->distance) }} KM</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- FLOOR PLANS -->
                    @if(isset($property_plans) && $property_plans->count() > 0)
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                            <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Floor Plans</h2></div>
                            <div class="space-y-3">
                                @foreach($property_plans as $pi => $plan)
                                    <div class="border border-gray-100 rounded-xl overflow-hidden">
                                        <button type="button" class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-brand-50 transition text-left" onclick="toggleFloorPlan(this)">
                                            <span class="flex items-center gap-2 font-semibold text-sm text-gray-800"><i class="fas fa-drafting-compass text-brand-500"></i>{{ html_decode($plan->title) }}</span>
                                            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-300 {{ $pi == 0 ? 'rotate-180' : '' }}"></i>
                                        </button>
                                        <div class="p-4 {{ $pi != 0 ? 'hidden' : '' }}">
                                            <img src="{{ $plan->image ?? asset($setting->default_placeholder ?? 'default.jpg') }}" class="w-full rounded-lg border border-gray-100" alt="{{ html_decode($plan->title) }}">
                                            @if($plan->description)
                                                <p class="text-sm text-gray-600 mt-3">{{ html_decode($plan->description) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- VIDEO -->
                    @if($property->video_id)
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                            <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Video Tour</h2></div>
                            @if($property->video_description)
                                <p class="text-sm text-gray-600 mb-4">{{ html_decode($property->video_description) }}</p>
                            @endif
                            <div class="relative rounded-xl overflow-hidden cursor-pointer group" onclick="playVideo('{{ $property->video_id }}')">
                                <img src="{{ $property->video_thumbnail ?? asset($setting->default_placeholder ?? 'default.jpg') }}" class="w-full h-72 md:h-80 object-cover group-hover:scale-105 transition-transform duration-500" alt="Video thumbnail">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/30 transition">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-brand-500 text-xl shadow-2xl group-hover:bg-red-500 group-hover:text-white group-hover:scale-110 transition-all"><i class="fas fa-play ml-1"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- MAP -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                        <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Location Map</h2></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center text-brand-500 text-xs"><i class="fas fa-location-dot"></i></div>
                                    <h5 class="font-semibold text-sm">Address</h5>
                                </div>
                                <p class="text-sm text-gray-600 ml-10">{{ html_decode($property->address) }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 text-xs"><i class="fas fa-info-circle"></i></div>
                                    <h5 class="font-semibold text-sm">About Location</h5>
                                </div>
                                <p class="text-sm text-gray-600 ml-10">{{ html_decode($property->address_description ?? '') }}</p>
                            </div>
                        </div>
                        <div class="rounded-xl overflow-hidden border border-gray-100" style="min-height:350px">
                            @if(isset($setting->live_map) && $setting->live_map == 'yes' && !empty($property->lat) && !empty($property->lon))
                                <div id="map" style="height:400px;width:100%"></div>
                            @else
                                {!! html_decode($property->google_map ?? '') !!}
                            @endif
                        </div>
                    </div>

                    <!-- CHECK LOCATION -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                        <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Check Location</h2></div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div class="loc-feature"><div class="lf-i bg-blue-50 text-blue-500"><i class="fas fa-hospital"></i></div><div><div class="lf-n">Hospital</div><div class="lf-v">Within 2 KM</div></div></div>
                            <div class="loc-feature"><div class="lf-i bg-green-50 text-green-500"><i class="fas fa-graduation-cap"></i></div><div><div class="lf-n">School</div><div class="lf-v">Within 1 KM</div></div></div>
                            <div class="loc-feature"><div class="lf-i bg-purple-50 text-purple-500"><i class="fas fa-shopping-bag"></i></div><div><div class="lf-n">Mall</div><div class="lf-v">Within 3 KM</div></div></div>
                            <div class="loc-feature"><div class="lf-i bg-yellow-50 text-yellow-500"><i class="fas fa-train"></i></div><div><div class="lf-n">Metro</div><div class="lf-v">Within 1.5 KM</div></div></div>
                            <div class="loc-feature"><div class="lf-i bg-red-50 text-red-500"><i class="fas fa-plane"></i></div><div><div class="lf-n">Airport</div><div class="lf-v">Within 15 KM</div></div></div>
                            <div class="loc-feature"><div class="lf-i bg-brand-50 text-brand-500"><i class="fas fa-bus"></i></div><div><div class="lf-n">Bus Stop</div><div class="lf-v">Within 0.5 KM</div></div></div>
                            <div class="loc-feature"><div class="lf-i bg-teal-50 text-teal-500"><i class="fas fa-tree"></i></div><div><div class="lf-n">Park</div><div class="lf-v">Within 1 KM</div></div></div>
                            <div class="loc-feature"><div class="lf-i bg-indigo-50 text-indigo-500"><i class="fas fa-utensils"></i></div><div><div class="lf-n">Restaurant</div><div class="lf-v">Within 1 KM</div></div></div>
                        </div>
                    </div>

                    <!-- REVIEWS -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8" data-aos="fade-up">
                        <div class="section-heading"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Ratings & Reviews</h2></div>
                        @php
                            $avgRating = $reviews->count() ? number_format($reviews->avg('rating'), 1) : '4.1';
                        @endphp
                        <div class="flex flex-col sm:flex-row gap-8 mb-8 p-5 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="text-center sm:text-left sm:pr-6 sm:border-r border-gray-200 shrink-0">
                                <div class="text-5xl font-extrabold text-gray-900 leading-none">{{ $avgRating }}</div>
                                <div class="flex items-center gap-0.5 justify-center sm:justify-start mt-2">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fas fa-star text-sm {{ $avgRating >= $i ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-xs text-gray-400 mt-2">{{ $reviews->count() }} Reviews</p>
                            </div>
                            <div class="flex-1 space-y-2.5">
                                @for($s=5; $s>=1; $s--)
                                    @php
                                        $cnt = $reviews->where('rating', $s)->count();
                                        $pct = $reviews->count() ? ($cnt / $reviews->count() * 100) : 0;
                                    @endphp
                                    <div class="flex items-center gap-3">
                                        <span class="text-xs font-semibold text-gray-600 w-8 text-right shrink-0">{{ $s }} <i class="fas fa-star text-[9px] text-yellow-400"></i></span>
                                        <div class="flex-1 rate-bar-bg"><div class="rate-bar-fill" style="width:{{ $pct }}%"></div></div>
                                        <span class="text-xs text-gray-400 w-10 text-right shrink-0">{{ round($pct) }}%</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        @if($reviews->count() > 0)
                            <div class="space-y-4 mb-6">
                                @foreach($reviews as $review)
                                    <div class="review-card">
                                        <div class="flex items-center gap-3 mb-3">
                                            <img src="{{ $review->user->image ?? asset($default_user_avatar ?? 'default.jpg') }}" class="w-10 h-10 rounded-full object-cover border-2 border-brand-200" alt="{{ $review->user->name ?? 'User' }}">
                                            <div class="flex-1">
                                                <p class="font-semibold text-sm text-dark-900">{{ html_decode($review->user->name ?? 'Anonymous') }}</p>
                                                <p class="text-[11px] text-gray-400">{{ $review->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="flex gap-0.5">
                                                @for($i=1; $i<=5; $i++)
                                                    <i class="fas fa-star text-xs {{ $review->rating >= $i ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">"{{ html_decode($review->review) }}"</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div>{{ $reviews->links('custom_pagination') }}</div>
                        @auth('web')
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <h4 class="font-bold text-sm text-dark-900 mb-3">Write a Review</h4>
                                <form id="reviewForm">
                                    @csrf
                                    <input type="hidden" name="agent_id" value="{{ $property->agent_id ?? '' }}">
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <input type="hidden" id="property_rating" name="rating" value="5">
                                    <div class="flex items-center gap-1 mb-3" id="ratingStars">
                                        @for($i=1; $i<=5; $i++)
                                            <i data-rating="{{ $i }}" class="property_rat fas fa-star text-xl cursor-pointer text-yellow-400"></i>
                                        @endfor
                                    </div>
                                    <textarea name="review" placeholder="Share your experience..." rows="3" required class="form-input resize-none"></textarea>
                                    @if(isset($recaptcha_setting) && $recaptcha_setting->status == 1)
                                        <div class="mt-3"><div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div></div>
                                    @endif
                                    <button type="submit" id="reviewSubmitBtn" class="btn-p text-white text-sm font-semibold px-6 py-2.5 rounded-xl mt-3">Submit Review</button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="w-full lg:w-[280px] shrink-0 space-y-5">
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden" data-aos="fade-left">
                        @php
                            $kycVerified = false;
                            try {
                                $kyc = \Modules\Kyc\Entities\KycInformation::where('user_id', $property_agent->id)->where('status', 1)->first();
                                $kycVerified = !empty($kyc);
                            } catch(\Exception $e) { $kycVerified = false; }
                        @endphp
                        <div class="p-5 text-center" style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%)">
                            <img src="{{ $property_agent->image ?? asset($default_user_avatar ?? 'default.jpg') }}" class="w-16 h-16 rounded-full object-cover border-3 border-brand-500 mx-auto mb-3" alt="{{ $property_agent->name ?? 'Agent' }}">
                            <h4 class="text-white font-bold text-sm">{{ $property_agent->name ?? 'Agent' }}</h4>
                            <p class="text-brand-400 text-xs mt-1">{{ $property_agent->phone ?? '' }}</p>
                            @if($kycVerified)
                                <span class="inline-flex items-center gap-1 bg-green-500/20 text-green-400 text-[10px] font-bold px-2.5 py-1 rounded-full mt-2"><i class="fas fa-shield-check text-[10px]"></i> Verified</span>
                            @endif
                        </div>
                        <div class="p-4 space-y-2">
                            <a href="tel:{{ $property_agent->phone ?? '' }}" class="btn-p w-full text-sm font-semibold py-2.5 rounded-xl flex items-center justify-center gap-2"><i class="fas fa-phone text-xs"></i> Call Agent</a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $property_agent->phone ?? '') }}" target="_blank" rel="noopener" class="w-full bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-2.5 rounded-xl flex items-center justify-center gap-2 transition"><i class="fab fa-whatsapp text-sm"></i> WhatsApp</a>
                            <button onclick="showEnquiry('{{ Str::limit(addslashes($property->title), 30) }}')" class="btn-o w-full text-sm font-semibold py-2.5 rounded-xl flex items-center justify-center gap-2"><i class="fas fa-envelope text-xs"></i> Enquire Now</button>
                        </div>
                    </div>
                    <button type="button" id="bookVisitBtn" class="w-full bg-dark-900 hover:bg-dark-800 text-white text-sm font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition shadow-lg" data-aos="fade-left" data-aos-delay="100"><i class="fas fa-calendar-check"></i> Book a Site Visit</button>
                    <div class="bg-white rounded-2xl border border-gray-100 p-5 text-center" data-aos="fade-left" data-aos-delay="150">
                        <p class="text-xs text-gray-400 mb-1">Starting Price</p>
                        <p class="text-2xl font-extrabold" style="color:#c2410c">{{ html_decode(num_format($property->price)) }}</p>
                        @isset($property->size)
                            <p class="text-xs text-gray-400 mt-1">Onwards · {{ $property->size }} sq.ft</p>
                        @endisset
                        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-center gap-4">
                            <div class="text-center"><p class="text-[10px] text-gray-400">Type</p><p class="text-xs font-bold text-gray-800">{{ $property->property_type->name ?? 'Apartment' }}</p></div>
                            <div class="w-px h-8 bg-gray-200"></div>
                            <div class="text-center"><p class="text-[10px] text-gray-400">Status</p><p class="text-xs font-bold text-green-600">Active</p></div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-5 flex items-center justify-between gap-3" style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%)" data-aos="fade-left" data-aos-delay="200">
                        <div class="text-white"><h4 class="font-bold text-sm">Need Help?</h4><p class="text-white/50 text-xs mt-0.5">Get exclusive pricing</p></div>
                        <button onclick="showEnquiry('{{ Str::limit(addslashes($property->title), 30) }}')" class="btn-p text-white text-sm font-semibold px-5 py-2 rounded-xl inline-flex items-center gap-2 shrink-0"><i class="fas fa-phone text-xs"></i> Callback</button>
                    </div>
                </div>
            </div>

            <!-- SIMILAR PROPERTIES -->
            @php
                $similarProperties = \App\Models\Property::where('id', '!=', $property->id)
                    ->when($property->city_id, function($q) use ($property) { return $q->where('city_id', $property->city_id); })
                    ->when($property->property_type_id, function($q) use ($property) { return $q->where('property_type_id', $property->property_type_id); })
                    ->where('status', 1)->latest()->take(4)->get();
            @endphp
            @if($similarProperties->count() > 0)
                <div class="mt-10" data-aos="fade-up">
                    <div class="flex items-center justify-between mb-6">
                        <div class="section-heading mb-0"><div class="sh-bar"></div><h2 class="text-lg font-bold text-dark-900">Similar Properties</h2></div>
                        <a href="{{ route('properties') }}" class="text-brand-600 text-sm font-semibold flex items-center gap-1 hover:gap-2 transition-all">View All <i class="fas fa-arrow-right text-xs"></i></a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sim-grid">
                        @foreach($similarProperties as $sim)
                            <div class="sim-card">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $sim->thumbnail_image ? asset($sim->thumbnail_image) : asset($setting->default_placeholder ?? 'default.jpg') }}" alt="{{ $sim->title }}" loading="lazy">
                                    @if($sim->total_bedroom)
                                        <span class="absolute bottom-2 left-2 bg-dark-900/80 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded">{{ $sim->total_bedroom }} BHK</span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <span class="text-[10px] font-bold text-brand-500 uppercase tracking-wider">{{ $sim->property_type->name ?? 'Apartment' }}</span>
                                    <h3 class="font-bold text-dark-900 text-sm leading-tight mt-1">
                                        <a href="{{ route('property', $sim->slug) }}" class="hover:text-brand-600 transition">{{ Str::limit($sim->title, 28) }}</a>
                                    </h3>
                                    <p class="flex items-center gap-1 text-gray-500 text-xs mt-1"><i class="fas fa-map-marker-alt text-brand-400 text-[10px]"></i> {{ Str::limit($sim->address, 25) }}</p>
                                    <div class="mt-3 flex items-center justify-between">
                                        <div>
                                            <p class="font-bold text-sm" style="color:#c2410c">{{ $currency_icon ?? '₹' }}{{ num_format($sim->price) }}</p>
                                            @isset($sim->size)
                                                <p class="text-gray-400 text-[10px]">{{ $sim->size }} sq.ft</p>
                                            @endisset
                                        </div>
                                        <button onclick="showEnquiry('{{ Str::limit(addslashes($sim->title), 25) }}')" class="btn-o text-[10px] font-semibold px-3 py-1.5 rounded-lg"><i class="fas fa-phone text-[9px]"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark-900 text-white mt-10">
        <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                <div class="col-span-2 md:col-span-4 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center"><i class="fas fa-building text-white text-sm"></i></div>
                        <span class="text-lg font-bold">{{ $setting->site_name ?? 'RealEstate' }}</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $setting->footer_text ?? "Premium real estate platform." }}</p>
                    <div class="flex gap-3">
                        @isset($setting->facebook)
                            <a href="{{ $setting->facebook }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-facebook-f text-sm"></i></a>
                        @endisset
                        @isset($setting->instagram)
                            <a href="{{ $setting->instagram }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-instagram text-sm"></i></a>
                        @endisset
                        @isset($setting->twitter)
                            <a href="{{ $setting->twitter }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-twitter text-sm"></i></a>
                        @endisset
                        @isset($setting->youtube)
                            <a href="{{ $setting->youtube }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-500 hover:border-brand-500 transition"><i class="fab fa-youtube text-sm"></i></a>
                        @endisset
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold text-sm mb-4">Quick Links</h5>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('home') }}" class="text-gray-400 text-sm hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('properties') }}" class="text-gray-400 text-sm hover:text-white transition">Properties</a></li>
                        <li><a href="{{ route('agents') }}" class="text-gray-400 text-sm hover:text-white transition">Agents</a></li>
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
                        <li class="flex items-start gap-2 text-gray-400 text-sm"><i class="fas fa-phone text-brand-400 text-xs mt-1"></i><span>{{ $setting->phone ?? '+91 98765 43210' }}</span></li>
                        <li class="flex items-start gap-2 text-gray-400 text-sm"><i class="fas fa-envelope text-brand-400 text-xs mt-1"></i><span>{{ $setting->email ?? 'info@example.com' }}</span></li>
                        <li class="flex items-start gap-2 text-gray-400 text-sm"><i class="fas fa-map-marker-alt text-brand-400 text-xs mt-1"></i><span>{{ $setting->address ?? 'Mumbai, India' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 py-5 flex flex-col md:flex-row items-center justify-between gap-3">
                <p class="text-gray-500 text-xs">&copy; {{ date('Y') }} {{ $setting->site_name ?? 'Your Company' }}. All Rights Reserved.</p>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- LIGHTBOX -->
    <div class="lightbox-overlay" id="lightbox" onclick="closeLightbox()">
        <button type="button" class="absolute top-4 right-4 w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition z-10"><i class="fas fa-times"></i></button>
        <button type="button" onclick="event.stopPropagation();lightboxPrev()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition z-10"><i class="fas fa-chevron-left"></i></button>
        <button type="button" onclick="event.stopPropagation();lightboxNext()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition z-10"><i class="fas fa-chevron-right"></i></button>
        <img id="lightboxImg" src="" onclick="event.stopPropagation()" alt="Gallery image">
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-sm font-medium" id="lightboxCounter"></div>
    </div>

    <!-- VIDEO MODAL -->
    <div class="fixed inset-0 z-[100] hidden" id="videoModal">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeVideo()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-black rounded-2xl shadow-2xl max-w-4xl w-full relative modal-anim overflow-hidden">
                <button type="button" onclick="closeVideo()" class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition"><i class="fas fa-times text-white text-sm"></i></button>
                <div class="aspect-video"><iframe id="videoFrame" src="" class="w-full h-full" allowfullscreen allow="autoplay" title="Property video"></iframe></div>
            </div>
        </div>
    </div>

    <!-- ENQUIRY MODAL -->
    <div class="fixed inset-0 z-[100] hidden" id="enquiryModal">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeEnquiry()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 relative modal-anim">
                <button type="button" onclick="closeEnquiry()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition"><i class="fas fa-times text-gray-500 text-sm"></i></button>
                <div class="text-center mb-5">
                    <div class="w-12 h-12 rounded-full bg-brand-50 flex items-center justify-center mx-auto mb-3"><i class="fas fa-building text-brand-500 text-lg"></i></div>
                    <h3 class="text-lg font-bold text-dark-900" id="enquiryTitle">Enquire Now</h3>
                    <p class="text-gray-500 text-sm mt-1">Get exclusive pricing & floor plans</p>
                </div>
                <form id="enquiryForm" class="space-y-3">
                    @csrf
                    <input type="hidden" name="property_name" id="enquiryPropertyName">
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <input type="text" name="name" placeholder="Full Name *" required class="form-input">
                    <div class="flex gap-3">
                        <input type="tel" name="phone" placeholder="Phone *" required class="form-input flex-1">
                        <input type="email" name="email" placeholder="Email" class="form-input flex-1">
                    </div>
                    <textarea name="message" placeholder="Any specific requirement?" rows="2" class="form-input resize-none"></textarea>
                    @if(isset($recaptcha_setting) && $recaptcha_setting->status == 1)
                        <div><div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div></div>
                    @endif
                    <button type="submit" id="enquirySubmitBtn" class="w-full btn-p text-white text-sm font-semibold py-3 rounded-xl flex items-center justify-center gap-2"><span>Get Free Consultation</span></button>
                    <p class="text-[10px] text-gray-400 text-center">By submitting, you agree to our Privacy Policy</p>
                </form>
            </div>
        </div>
    </div>

    <!-- BOOKING MODAL -->
    <div class="fixed inset-0 z-[100] hidden" id="bookingModal">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeBooking()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto relative modal-anim">
                <button type="button" onclick="closeBooking()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition z-10"><i class="fas fa-times text-gray-500 text-sm"></i></button>
                <div class="p-6 md:p-8">
                    <div class="text-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-brand-50 flex items-center justify-center mx-auto mb-3"><i class="fas fa-calendar-check text-brand-500 text-lg"></i></div>
                        <h3 class="text-lg font-bold text-dark-900">Book a Site Visit</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ Str::limit($property->title, 30) }}</p>
                    </div>
                    <form id="bookingForm" class="space-y-4">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="agent_id" value="{{ $property->agent_id ?? '' }}">
                        <div class="grid grid-cols-2 gap-3">
                            <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Date *</label><input type="text" name="booking_date" id="bookingDate" placeholder="Select date" required class="form-input" readonly></div>
                            <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Time *</label><input type="time" name="booking_time" required class="form-input"></div>
                        </div>
                        <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Guests *</label><input type="number" name="guests" placeholder="2" min="1" required class="form-input"></div>
                        <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Name *</label><input type="text" name="name" placeholder="John Doe" required class="form-input"></div>
                        <div class="grid grid-cols-2 gap-3">
                            <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Country *</label>
                                <select name="country" required class="form-input" id="countrySelect"><option value="">Select</option>
                                    @isset($countries)
                                        @foreach($countries as $c)
                                            <option value="{{ $c->name }}" data-id="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div id="cityWrapper"><label class="text-[11px] font-semibold text-gray-500 mb-1 block">City *</label>
                                <select name="city" class="form-input" id="citySelect"><option value="">Select country first</option></select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Zip *</label><input type="text" name="zip_code" placeholder="400001" required class="form-input"></div>
                            <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Phone *</label><input type="tel" name="phone" placeholder="+91..." required class="form-input"></div>
                        </div>
                        <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Email *</label><input type="email" name="email" placeholder="john@email.com" required class="form-input"></div>
                        <div><label class="text-[11px] font-semibold text-gray-500 mb-1 block">Comments</label><textarea name="comment" rows="3" placeholder="Any requirements..." class="form-input resize-none"></textarea></div>
                        <button type="submit" id="bookingSubmitBtn" class="w-full btn-p text-white text-sm font-semibold py-3 rounded-xl flex items-center justify-center gap-2"><i class="fas fa-check-circle text-xs"></i> Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST -->
    <div class="fixed bottom-6 right-6 z-[110] space-y-2" id="toastContainer"></div>

    <!-- FLOATING WHATSAPP -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone ?? '919876543210') }}" target="_blank" rel="noopener" class="fixed bottom-6 left-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition hover:scale-110"><i class="fab fa-whatsapp text-white text-2xl"></i></a>

    <!-- CHATBOT WIDGET -->
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
            <div class="ch-property-strip">
                <img src="{{ $property->thumbnail_image ? asset($property->thumbnail_image) : asset($setting->default_placeholder ?? 'default.jpg') }}" alt="">
                <div style="min-width:0;flex:1"><div class="ch-pp-name">{{ Str::limit($property->title, 32) }}</div><div class="ch-pp-price">{{ html_decode(num_format($property->price)) }}</div></div>
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

    <!-- PREPARE CHATBOT DATA -->
    @php
        $chatAmenities = [];
        if(isset($aminities) && $aminities->count() > 0) {
            foreach($aminities as $amItem) { $chatAmenities[] = e($amItem->aminity->aminity); }
        } else { $chatAmenities = ["Gym", "Pool", "Clubhouse"]; }
        $chatNearby = [];
        if(isset($nearest_locations) && $nearest_locations->count() > 0) {
            foreach($nearest_locations as $nearItem) { $chatNearby[] = ['name' => e($nearItem->location->location ?? ''), 'dist' => e(html_decode($nearItem->distance))]; }
        } else { $chatNearby = [['name' => 'School', 'dist' => '1']]; }
        $chatFloorPlans = [];
        if(isset($property_plans) && $property_plans->count() > 0) {
            foreach($property_plans as $planItem) { $chatFloorPlans[] = e(html_decode($planItem->title)); }
        } else { $chatFloorPlans = ["1 BHK Plan"]; }
        $chatAgentPhoneClean = preg_replace('/[^0-9]/', '', $property_agent->phone ?? '');
    @endphp

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
    (function() {
        'use strict';
        var WOMAN_AV = '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="18" r="11" fill="white"/><path d="M13 55c0-10.493 8.507-19 19-19s19 8.507 19 19" fill="white"/><path d="M25 15.5c0-2 1.8-4.5 7-4.5s7 2.5 7 4.5" stroke="#ea580c" stroke-width="2.2" stroke-linecap="round" fill="none"/><circle cx="28" cy="18" r="1.3" fill="#ea580c"/><circle cx="36" cy="18" r="1.3" fill="#ea580c"/><path d="M29.5 22.5s1.3 2 2.5 2 2.5-2 2.5-2" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg>';
        var USER_AV = '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="20" r="11" fill="white"/><path d="M14 56c0-9.941 8.059-18 18-18s18 8.059 18 18" fill="white"/></svg>';
        var propertyData = {
            name:@json($property->title), price:@json(html_decode(num_format($property->price))),
            address:@json($property->address), addressDesc:@json($property->address_description ?? ''),
            bedroom:@json($property->total_bedroom ?? '-'), bathroom:@json($property->total_bathroom ?? '-'),
            area:@json($property->total_area ?? '-'), size:@json($property->size ?? '-'),
            floor:@json($property->total_floor ?? '-'), unit:@json($property->total_unit ?? '-'),
            garage:@json($property->total_garage ?? '-'), type:@json($property->property_type->name ?? 'Apartment'),
            possession:@json(isset($property->possession_date) ? date('M Y', strtotime($property->possession_date)) : 'TBD'),
            rera:@json($property->rera_number ?? 'N/A'), agentName:@json($property_agent->name ?? ''),
            agentPhone:@json($property_agent->phone ?? ''), agentPhoneClean:@json($chatAgentPhoneClean),
            amenities:@json($chatAmenities), nearby:@json($chatNearby), floorPlans:@json($chatFloorPlans),
            enquiryTitle:@json(Str::limit(addslashes($property->title), 30))
        };
        AOS.init({duration:800,once:true,offset:50});
        var mainNav=document.getElementById('mainNav');
        window.addEventListener('scroll',function(){mainNav.classList.toggle('shadow-md',window.pageYOffset>50);mainNav.classList.toggle('shadow-sm',window.pageYOffset<=50);});
        window.toggleMobileMenu=function(){document.getElementById('mobileMenu').classList.toggle('hidden');};
        document.querySelectorAll('.mobile-link').forEach(function(l){l.addEventListener('click',function(){document.getElementById('mobileMenu').classList.add('hidden');});});
        var allSlides=@json($sliderImages),totalSlides=allSlides.length,currentSlide=0,lightboxIndex=0;
        window.setSlide=function(i){if(!totalSlides)return;currentSlide=((i%totalSlides)+totalSlides)%totalSlides;document.getElementById('mainImg').src=allSlides[currentSlide];var thumbs=document.querySelectorAll('#thumbStrip img');thumbs.forEach(function(t,idx){t.classList.toggle('active',idx===currentSlide);});if(thumbs[currentSlide])thumbs[currentSlide].scrollIntoView({behavior:'smooth',block:'nearest',inline:'center'});};
        window.nextSlide=function(){setSlide(currentSlide+1);};
        window.prevSlide=function(){setSlide(currentSlide-1);};
        var galleryWrap=document.querySelector('.thumb-strip')?document.querySelector('.thumb-strip').parentElement:null,autoSlide=null;
        function startAuto(){if(totalSlides>1)autoSlide=setInterval(nextSlide,5000);}
        function stopAuto(){if(autoSlide){clearInterval(autoSlide);autoSlide=null;}}
        if(galleryWrap){galleryWrap.addEventListener('mouseenter',stopAuto);galleryWrap.addEventListener('mouseleave',startAuto);}
        startAuto();
        function updateLB(){if(!totalSlides)return;lightboxIndex=((lightboxIndex%totalSlides)+totalSlides)%totalSlides;document.getElementById('lightboxImg').src=allSlides[lightboxIndex];document.getElementById('lightboxCounter').textContent=(lightboxIndex+1)+' / '+totalSlides;}
        window.openLightbox=function(i){if(!totalSlides)return;lightboxIndex=i||0;updateLB();document.getElementById('lightbox').classList.add('show');document.body.style.overflow='hidden';stopAuto();};
        window.closeLightbox=function(){document.getElementById('lightbox').classList.remove('show');document.body.style.overflow='';startAuto();};
        window.lightboxNext=function(){lightboxIndex++;updateLB();};
        window.lightboxPrev=function(){lightboxIndex--;updateLB();};
        window.playVideo=function(id){if(!id)return;document.getElementById('videoFrame').src='https://www.youtube.com/embed/'+id+'?autoplay=1&rel=0';document.getElementById('videoModal').classList.remove('hidden');document.body.style.overflow='hidden';};
        window.closeVideo=function(){document.getElementById('videoFrame').src='';document.getElementById('videoModal').classList.add('hidden');document.body.style.overflow='';};
        window.showEnquiry=function(n){document.getElementById('enquiryTitle').textContent=n?'Enquire: '+n:'Enquire Now';document.getElementById('enquiryPropertyName').value=n||'';document.getElementById('enquiryModal').classList.remove('hidden');document.body.style.overflow='hidden';};
        window.closeEnquiry=function(){document.getElementById('enquiryModal').classList.add('hidden');document.body.style.overflow='';};
        window.closeBooking=function(){document.getElementById('bookingModal').classList.add('hidden');document.body.style.overflow='';};
        document.getElementById('bookVisitBtn').addEventListener('click',function(){document.getElementById('bookingModal').classList.remove('hidden');document.body.style.overflow='hidden';if(!$('#bookingDate').data('datepicker')){$('#bookingDate').datepicker({format:'yyyy-mm-dd',startDate:'0d',autoclose:true,orientation:'bottom auto'});}});
        window.toggleFloorPlan=function(btn){var c=btn.nextElementSibling;var i=btn.querySelector('.fa-chevron-down');c.classList.toggle('hidden');if(i)i.classList.toggle('rotate-180');};
        document.addEventListener('keydown',function(e){if(e.key==='Escape'){closeEnquiry();closeVideo();closeBooking();closeLightbox();closeChat();}if(document.getElementById('lightbox').classList.contains('show')){if(e.key==='ArrowRight'){lightboxNext();e.preventDefault();}if(e.key==='ArrowLeft'){lightboxPrev();e.preventDefault();}}});
        document.querySelectorAll('.property_rat').forEach(function(s){s.addEventListener('click',function(){var r=parseInt(this.dataset.rating);document.getElementById('property_rating').value=r;document.querySelectorAll('.property_rat').forEach(function(x){x.classList.toggle('text-yellow-400',parseInt(x.dataset.rating)<=r);x.classList.toggle('text-gray-200',parseInt(x.dataset.rating)>r);});});s.addEventListener('mouseenter',function(){var hr=parseInt(this.dataset.rating);document.querySelectorAll('.property_rat').forEach(function(x){x.style.color=parseInt(x.dataset.rating)<=hr?'#facc15':'#e5e7eb';});});s.addEventListener('mouseleave',function(){var sr=parseInt(document.getElementById('property_rating').value);document.querySelectorAll('.property_rat').forEach(function(x){x.style.color='';x.classList.toggle('text-yellow-400',parseInt(x.dataset.rating)<=sr);x.classList.toggle('text-gray-200',parseInt(x.dataset.rating)>sr);});});});
        window.showToast=function(msg,type){type=type||'info';var c={success:'bg-green-500',error:'bg-red-500',info:'bg-gray-800'};var ic={success:'check-circle',error:'exclamation-circle',info:'info-circle'};var t=document.createElement('div');t.className='toast-anim flex items-center gap-3 '+(c[type]||c.info)+' text-white px-5 py-3 rounded-xl shadow-lg max-w-sm';t.innerHTML='<i class="fas fa-'+(ic[type]||ic.info)+' text-base shrink-0"></i><span class="text-sm">'+msg+'</span>';document.getElementById('toastContainer').appendChild(t);setTimeout(function(){if(t.parentNode)t.remove();},3200);};
        $('#reviewForm').on('submit',function(e){e.preventDefault();var btn=$('#reviewSubmitBtn'),ot=btn.html();btn.prop('disabled',true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');$.ajax({url:'{{ route("store-property-review") }}',method:'POST',data:$(this).serialize(),success:function(r){if(r.status==1){showToast(r.message||'Review submitted!','success');$('#reviewForm')[0].reset();document.getElementById('property_rating').value=5;document.querySelectorAll('.property_rat').forEach(function(s){s.classList.add('text-yellow-400');s.classList.remove('text-gray-200');});}else{showToast(r.message||'Failed.','error');}},error:function(x){var m='Failed.';if(x.responseJSON){if(x.responseJSON.message)m=x.responseJSON.message;if(x.responseJSON.errors)m=Object.values(x.responseJSON.errors).flat().join(', ');}showToast(m,'error');},complete:function(){btn.prop('disabled',false).html(ot);}});});
        $('#bookingForm').on('submit',function(e){e.preventDefault();var btn=$('#bookingSubmitBtn'),ot=btn.html();btn.prop('disabled',true).html('<i class="fas fa-spinner fa-spin"></i> Booking...');$.ajax({url:'{{ route("booking.store") }}',method:'POST',data:$(this).serialize(),success:function(r){closeBooking();showToast(r.message||'Booking confirmed!','success');$('#bookingForm')[0].reset();try{$('#bookingDate').datepicker('destroy');}catch(ex){}},error:function(x){var m='Booking failed.';if(x.responseJSON){if(x.responseJSON.message)m=x.responseJSON.message;if(x.responseJSON.errors)m=Object.values(x.responseJSON.errors).flat().join(', ');}showToast(m,'error');},complete:function(){btn.prop('disabled',false).html(ot);}});});
        $('#countrySelect').on('change',function(){var cid=$(this).find(':selected').data('id'),$cs=$('#citySelect');$cs.html('<option value="">Loading...</option>');if(!cid){$cs.html('<option value="">Select country first</option>');return;}$.get('{{ url("/property/city/list/") }}/'+cid,function(r){$cs.html(r.template||'<option value="">No cities</option>');}).fail(function(){$cs.html('<option value="">Select country first</option>');});});
        @if(isset($setting->live_map) && $setting->live_map == 'yes' && !empty($property->lat) && !empty($property->lon))
        (function(){var lat=parseFloat("{{ $property->lat }}"),lon=parseFloat("{{ $property->lon }}");if(isNaN(lat)||isNaN(lon))return;var map=L.map('map').setView([lat,lon],13);L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution:'&copy; OpenStreetMap'}).addTo(map);var popup='<div style="width:220px;text-align:center;font-family:Inter,sans-serif"><a href="{{ url("/property/".$property->slug) }}" style="text-decoration:none;color:inherit"><img src="{{ asset($property->thumbnail_image ?? $setting->default_placeholder ?? 'default.jpg') }}" height="80" width="100%" style="object-fit:cover;border-radius:8px"/><p style="font-weight:bold;margin:6px 0 0;font-size:13px;color:#111">{{ $property->title }}</p><p style="font-size:11px;color:#888;margin:2px 0 0">{{ Str::limit($property->address,30) }}</p></a></div>';L.marker([lat,lon]).addTo(map).bindPopup(popup).openPopup();})();
        @endif
        var tsx=0,tex=0,mi=document.getElementById('mainImg');
        if(mi){mi.addEventListener('touchstart',function(e){tsx=e.changedTouches[0].screenX;},{passive:true});mi.addEventListener('touchend',function(e){tex=e.changedTouches[0].screenX;var d=tsx-tex;if(Math.abs(d)>50){d>0?nextSlide():prevSlide();}},{passive:true});}

        /* ===== CHATBOT ENGINE ===== */
        var chatOpen=false,chatFirstOpen=true;
        var chatFab=document.getElementById('chatFab'),chatPanel=document.getElementById('chatPanel'),chatMessages=document.getElementById('chatMessages'),chatInput=document.getElementById('chatInput'),chatQuick=document.getElementById('chatQuick'),chatBadge=document.getElementById('chatBadge'),chatFabIconOpen=document.getElementById('chatFabIconOpen'),chatFabIconClose=document.getElementById('chatFabIconClose'),chatStatusText=document.getElementById('chatStatusText');
        function getTime(){var d=new Date(),h=d.getHours(),m=d.getMinutes(),ap=h>=12?'PM':'AM';h=h%12||12;return h+':'+(m<10?'0':'')+m+' '+ap;}
        function addMsg(text,type,quickAfter){var div=document.createElement('div');div.className='chat-msg '+type;if(type==='bot'){div.innerHTML='<div class="msg-row"><div class="msg-avatar-sm">'+WOMAN_AV+'</div><div><div class="msg-bubble">'+text+'</div><div class="msg-time">'+getTime()+'</div></div></div>';}else{div.innerHTML='<div class="msg-row"><div><div class="msg-bubble">'+text+'</div><div class="msg-time">'+getTime()+' <i class="fas fa-check-double msg-check"></i></div></div><div class="msg-avatar-sm user-av">'+USER_AV+'</div></div>';}chatMessages.appendChild(div);chatMessages.scrollTop=chatMessages.scrollHeight;if(quickAfter)showQuickReplies(quickAfter);}
        function showTyping(){chatStatusText.innerHTML='<span class="typing-live">typing...</span>';var div=document.createElement('div');div.className='chat-msg bot';div.id='typingIndicator';div.innerHTML='<div class="msg-row"><div class="msg-avatar-sm">'+WOMAN_AV+'</div><div class="chat-typing"><span></span><span></span><span></span></div></div>';chatMessages.appendChild(div);chatMessages.scrollTop=chatMessages.scrollHeight;}
        function removeTyping(){var t=document.getElementById('typingIndicator');if(t)t.remove();chatStatusText.innerHTML='Online now';}
        function botReply(text,delay,quickAfter){showTyping();setTimeout(function(){removeTyping();addMsg(text,'bot',quickAfter);},delay||900);}
        function showQuickReplies(set){chatQuick.innerHTML='';var replies=set||[{label:'💰 Price',key:'price'},{label:'🏠 Configuration',key:'config'},{label:'🏊 Amenities',key:'amenities'},{label:'📍 Location',key:'location'},{label:'📐 Floor Plans',key:'floorplan'},{label:'📅 Book Visit',key:'visit'},{label:'📞 Contact Agent',key:'contact'}];replies.forEach(function(r){var btn=document.createElement('button');btn.textContent=r.label;btn.onclick=function(){chatQuickReply(r.key);};chatQuick.appendChild(btn);});}
        function hideQuick(){chatQuick.innerHTML='';}
        function addDateSep(){var div=document.createElement('div');div.className='chat-date-sep';var d=new Date(),opts={month:'short',day:'numeric',year:'numeric'};div.innerHTML='<span>Today, '+d.toLocaleDateString('en-US',opts)+'</span>';chatMessages.appendChild(div);}
        function initChat(){chatMessages.innerHTML='';addDateSep();addMsg('👋 Hi there! I\'m <strong>Priya</strong>, your personal property advisor for <strong>'+propertyData.name+'</strong>.','bot');setTimeout(function(){addMsg('I can help you with pricing, floor plans, amenities, location details, or booking a site visit. What would you like to know?','bot','default');},600);}
        window.chatResetChat=function(){initChat();};
        window.chatQuickReply=function(key){hideQuick();var userText='',botText='',nextQ=null;
        switch(key){
            case 'price':userText='What is the price?';botText='💰 Starting price of <strong>'+propertyData.name+'</strong> is <strong style="color:#ea580c;font-size:.95em">'+propertyData.price+'</strong>'+(propertyData.size&&propertyData.size!=='-'?'<br><span style="color:#888;font-size:.75em">Size from '+propertyData.size+' sq.ft</span>':'')+'<br><br><em style="color:#aaa;font-size:.72em">*Price may vary based on configuration & floor</em>';nextQ=[{label:'🏠 Config',key:'config'},{label:'🏊 Amenities',key:'amenities'},{label:'📞 Talk to Agent',key:'contact'}];break;
            case 'config':userText='Tell me the configuration';var cp=[];if(propertyData.bedroom&&propertyData.bedroom!=='-')cp.push('<strong>'+propertyData.bedroom+' BHK</strong>');if(propertyData.bathroom&&propertyData.bathroom!=='-')cp.push(propertyData.bathroom+' Bathrooms');if(propertyData.area&&propertyData.area!=='-')cp.push(propertyData.area+' m² Area');if(propertyData.floor&&propertyData.floor!=='-')cp.push(propertyData.floor+' Floors');if(propertyData.unit&&propertyData.unit!=='-')cp.push(propertyData.unit+' Units');if(propertyData.garage&&propertyData.garage!=='-')cp.push(propertyData.garage+' Parking');if(propertyData.possession)cp.push('Possession: <strong>'+propertyData.possession+'</strong>');botText='🏠 <strong>Configuration:</strong><br><br><div style="display:grid;grid-template-columns:1fr 1fr;gap:4px 12px;font-size:.78em">'+(propertyData.bedroom&&propertyData.bedroom!=='-'?'<div><span style="color:#888">Bedrooms</span></div><div><strong>'+propertyData.bedroom+'</strong></div>':'')+(propertyData.bathroom&&propertyData.bathroom!=='-'?'<div><span style="color:#888">Bathrooms</span></div><div><strong>'+propertyData.bathroom+'</strong></div>':'')+(propertyData.area&&propertyData.area!=='-'?'<div><span style="color:#888">Area</span></div><div><strong>'+propertyData.area+' m²</strong></div>':'')+(propertyData.floor&&propertyData.floor!=='-'?'<div><span style="color:#888">Floors</span></div><div><strong>'+propertyData.floor+'</strong></div>':'')+(propertyData.unit&&propertyData.unit!=='-'?'<div><span style="color:#888">Units</span></div><div><strong>'+propertyData.unit+'</strong></div>':'')+(propertyData.garage&&propertyData.garage!=='-'?'<div><span style="color:#888">Parking</span></div><div><strong>'+propertyData.garage+'</strong></div>':'')+'</div><br>Type: <strong>'+propertyData.type+'</strong>';if(propertyData.rera&&propertyData.rera!=='N/A')botText+='<br>RERA: <strong>'+propertyData.rera+'</strong>';nextQ=[{label:'📐 Floor Plans',key:'floorplan'},{label:'💰 Price',key:'price'},{label:'📅 Book Visit',key:'visit'}];break;
            case 'amenities':userText='What amenities are available?';var amGrid='<div style="display:grid;grid-template-columns:1fr 1fr;gap:3px 10px;font-size:.78em">';propertyData.amenities.slice(0,12).forEach(function(a){amGrid+='<div>✅ '+a+'</div>';});amGrid+='</div>';if(propertyData.amenities.length>12)amGrid+='<br><em style="color:#aaa;font-size:.7em">+ '+(propertyData.amenities.length-12)+' more amenities available</em>';botText='🏊 <strong>Amenities at '+propertyData.name+':</strong><br><br>'+amGrid;nextQ=[{label:'📍 Location',key:'location'},{label:'🏠 Config',key:'config'},{label:'📞 Talk to Agent',key:'contact'}];break;
            case 'location':userText='Tell me about the location';var nlList='';propertyData.nearby.slice(0,6).forEach(function(n){nlList+='<div style="display:flex;justify-content:space-between;padding:4px 0;border-bottom:1px solid #f3f4f6;font-size:.78em"><span>📌 '+n.name+'</span><span style="color:#ea580c;font-weight:600">'+n.dist+' KM</span></div>';});botText='📍 <strong>Location Details:</strong><br><br><div style="background:#f9fafb;border-radius:10px;padding:8px 10px;margin-bottom:8px"><div style="font-size:.75em;color:#888">Address</div><div style="font-size:.8em;font-weight:600">'+propertyData.address+'</div>'+(propertyData.addressDesc?'<div style="font-size:.75em;color:#666;margin-top:3px">'+propertyData.addressDesc+'</div>':'')+'</div><strong style="font-size:.78em">Nearby Landmarks:</strong><br>'+nlList;nextQ=[{label:'💰 Price',key:'price'},{label:'🏊 Amenities',key:'amenities'},{label:'📅 Book Visit',key:'visit'}];break;
            case 'floorplan':userText='Show me floor plans';var fpList='';propertyData.floorPlans.forEach(function(f,i){fpList+='<div style="display:flex;align-items:center;gap:8px;padding:6px 0;border-bottom:1px solid #f3f4f6;font-size:.8em"><span style="width:22px;height:22px;border-radius:6px;background:#fff7ed;color:#f97316;display:flex;align-items:center;justify-content:center;font-size:.7em;font-weight:700;flex-shrink:0">'+(i+1)+'</span>'+f+'</div>';});botText='📐 <strong>Available Floor Plans:</strong><br><br>'+fpList+'<br><br><em style="color:#aaa;font-size:.7em">💡 Scroll down on the page to view detailed floor plan images</em>';nextQ=[{label:'🏠 Config',key:'config'},{label:'💰 Price',key:'price'},{label:'📅 Book Visit',key:'visit'}];break;
            case 'visit':userText='I want to book a site visit';botText='📅 Great choice! I\'d love to help you schedule a visit to <strong>'+propertyData.name+'</strong>.<br><br><button onclick="closeChat();document.getElementById(\'bookVisitBtn\').click();" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">🗓️ Book Site Visit Now</button><br><br><span style="font-size:.72em;color:#aaa">Free visit · No obligation · Get exclusive pricing on visit</span>';nextQ=[{label:'📞 Contact Agent',key:'contact'},{label:'💰 Price',key:'price'}];break;
            case 'contact':userText='Connect me with the agent';botText='📞 Let me connect you with <strong>'+propertyData.agentName+'</strong>'+(propertyData.agentPhone?' — '+propertyData.agentPhone:'')+'<br><br><div class="inline-btns">'+(propertyData.agentPhone?'<a href="tel:'+propertyData.agentPhone+'" style="background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 2px 8px rgba(249,115,22,.3)"><i class="fas fa-phone" style="font-size:10px"></i> Call Now</a>':'')+(propertyData.agentPhoneClean?'<a href="https://wa.me/'+propertyData.agentPhoneClean+'" target="_blank" style="background:#22c55e;box-shadow:0 2px 8px rgba(34,197,94,.3)"><i class="fab fa-whatsapp" style="font-size:12px"></i> WhatsApp</a>':'')+'</div><br><span style="font-size:.72em;color:#aaa">Available 9 AM – 9 PM, 7 days a week</span>';nextQ=[{label:'💰 Price',key:'price'},{label:'📅 Book Visit',key:'visit'}];break;
            default:userText='Help';botText='I can help with pricing, configuration, amenities, location, floor plans, booking a visit, or connecting with the agent.';nextQ='default';}
        addMsg(userText,'user');botReply(botText,700,nextQ);};

        window.chatSend=function(){var text=chatInput.value.trim();if(!text)return;chatInput.value='';hideQuick();addMsg(text,'user');
        var lower=text.toLowerCase(),reply='',nextQ=null;
        if(lower.match(/price|cost|rate|amount|budget|pricing|how much|kitna/i)){nextQ=[{label:'🏠 Config',key:'config'},{label:'📞 Agent',key:'contact'}];reply='💰 Starting price: <strong style="color:#ea580c">'+propertyData.price+'</strong>'+(propertyData.size&&propertyData.size!=='-'?'<br><span style="color:#888;font-size:.75em">'+propertyData.size+' sq.ft onwards</span>':'')+'<br><br><em style="color:#aaa;font-size:.7em">Contact agent for best negotiated price</em>';}
        else if(lower.match(/bhk|bed|bedroom|config|room|type/i)){nextQ=[{label:'📐 Floor Plan',key:'floorplan'},{label:'💰 Price',key:'price'}];reply='🏠 <strong>'+propertyData.bedroom+' BHK</strong>'+(propertyData.bathroom&&propertyData.bathroom!=='-'?', '+propertyData.bathroom+' baths':'')+', <strong>'+(propertyData.unit||'-')+'</strong> units across <strong>'+(propertyData.floor||'-')+'</strong> floors.<br>Type: <strong>'+propertyData.type+'</strong>';}
        else if(lower.match(/amenit|facility|pool|gym|club|park|play/i)){nextQ=[{label:'📍 Location',key:'location'},{label:'🏠 Config',key:'config'}];reply='🏊 <strong>Key Amenities:</strong><br><br><div style="display:grid;grid-template-columns:1fr 1fr;gap:3px 10px;font-size:.78em">'+propertyData.amenities.slice(0,8).map(function(a){return '<div>✅ '+a+'</div>';}).join('')+'</div>'+(propertyData.amenities.length>8?'<br><em style="color:#aaa;font-size:.7em">...and '+(propertyData.amenities.length-8)+' more</em>':'');}
        else if(lower.match(/locat|address|area|where|nearby|landmark|school|hospital|metro/i)){nextQ=[{label:'💰 Price',key:'price'},{label:'📅 Visit',key:'visit'}];var nl=propertyData.nearby.slice(0,5).map(function(n){return '<div style="display:flex;justify-content:space-between;padding:3px 0;font-size:.78em"><span>📌 '+n.name+'</span><span style="color:#ea580c;font-weight:600">'+n.dist+' KM</span></div>';}).join('');reply='📍 <strong>'+propertyData.address+'</strong><br><br><strong style="font-size:.8em">Nearby:</strong><br>'+nl;}
        else if(lower.match(/floor.?plan|layout|plan/i)){nextQ=[{label:'🏠 Config',key:'config'},{label:'📅 Visit',key:'visit'}];reply='📐 <strong>Floor Plans:</strong><br><br>'+propertyData.floorPlans.map(function(f,i){return '<div style="padding:4px 0;font-size:.8em"><span style="color:#f97316;font-weight:700">'+(i+1)+'.</span> '+f+'</div>';}).join('')+'<br><em style="color:#aaa;font-size:.7em">💡 Scroll to Floor Plans section for images</em>';}
        else if(lower.match(/visit|book|site|tour|come/i)){nextQ=[{label:'📞 Agent',key:'contact'}];reply='📅 Click below to book your free site visit:<br><br><button onclick="closeChat();document.getElementById(\'bookVisitBtn\').click();" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">🗓️ Book Site Visit</button>';}
        else if(lower.match(/agent|contact|call|phone|talk|connect/i)){nextQ=[{label:'💰 Price',key:'price'},{label:'📅 Visit',key:'visit'}];reply='📞 <strong>'+propertyData.agentName+'</strong>'+(propertyData.agentPhone?'<br>📱 '+propertyData.agentPhone:'')+'<br><br><div class="inline-btns">'+(propertyData.agentPhone?'<a href="tel:'+propertyData.agentPhone+'" style="background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 2px 8px rgba(249,115,22,.3)"><i class="fas fa-phone" style="font-size:10px"></i> Call</a>':'')+(propertyData.agentPhoneClean?'<a href="https://wa.me/'+propertyData.agentPhoneClean+'" target="_blank" style="background:#22c55e;box-shadow:0 2px 8px rgba(34,197,94,.3)"><i class="fab fa-whatsapp" style="font-size:12px"></i> WhatsApp</a>':'')+'</div>';}
        else if(lower.match(/rera|registration|legal/i)){nextQ=[{label:'🏠 Config',key:'config'},{label:'📞 Agent',key:'contact'}];reply=propertyData.rera&&propertyData.rera!=='N/A'?'📋 RERA: <strong>'+propertyData.rera+'</strong><br><br>✅ This project is RERA registered, ensuring legal compliance & transparency.':'📋 RERA details not available. Please contact the agent for more info.';}
        else if(lower.match(/possession|delivery|when|ready|move/i)){nextQ=[{label:'💰 Price',key:'price'},{label:'📅 Visit',key:'visit'}];reply='📅 Expected possession: <strong>'+propertyData.possession+'</strong><br><br><em style="color:#aaa;font-size:.7em">Subject to construction timeline</em>';}
        else if(lower.match(/loan|emi|bank|finance/i)){nextQ=[{label:'💰 Price',key:'price'},{label:'📞 Agent',key:'contact'}];reply='🏦 Home loan available for <strong style="color:#ea580c">'+propertyData.price+'</strong>. We work with top banks for best rates.<br><br><button onclick="closeChat();showEnquiry(propertyData.enquiryTitle);" style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">💬 Get Loan Assistance</button>';}
        else if(lower.match(/hi|hello|hey|good|start|help/i)){nextQ='default';reply='👋 Hello! I\'m <strong>Priya</strong>, your property advisor for <strong>'+propertyData.name+'</strong>. I can help with price, config, amenities, location, floor plans, site visits, or connecting you with the agent. Just ask!';}
        else if(lower.match(/thank|thanks|bye|goodbye/i)){nextQ='default';reply='😊 You\'re welcome! Feel free to come back anytime if you have questions about <strong>'+propertyData.name+'</strong>. Wishing you a great day! 🙏';}
        else{nextQ='default';reply='🤔 I\'m not sure about that, but I can definitely help with:<br><br><div style="display:grid;grid-template-columns:1fr 1fr;gap:4px;font-size:.78em"><div>💰 Price</div><div>🏠 Configuration</div><div>🏊 Amenities</div><div>📍 Location</div><div>📐 Floor Plans</div><div>📅 Site Visit</div><div>📞 Agent</div><div>🏦 Loan/EMI</div></div>';}
        botReply(reply,800,nextQ);};

        chatInput.addEventListener('keydown',function(e){if(e.key==='Enter'){e.preventDefault();chatSend();}});
        chatFab.addEventListener('click',function(){chatOpen=!chatOpen;chatPanel.classList.toggle('open',chatOpen);chatFab.classList.toggle('active',chatOpen);chatFabIconOpen.style.display=chatOpen?'none':'block';chatFabIconClose.style.display=chatOpen?'block':'none';if(chatOpen&&chatFirstOpen){chatFirstOpen=false;chatBadge.style.display='none';var ring=chatFab.querySelector('.fab-ring');if(ring)ring.style.display='none';initChat();setTimeout(function(){chatInput.focus();},450);}else if(chatOpen){setTimeout(function(){chatInput.focus();},350);}});
        window.closeChat=function(){chatOpen=false;chatPanel.classList.remove('open');chatFab.classList.remove('active');chatFabIconOpen.style.display='block';chatFabIconClose.style.display='none';};
        setTimeout(function(){if(!chatOpen&&chatFirstOpen){chatFab.style.transform='scale(1.15)';setTimeout(function(){chatFab.style.transform='';},400);setTimeout(function(){chatFab.style.transform='scale(1.15)';setTimeout(function(){chatFab.style.transform='';},400);},1200);}},6000);
    })();
    </script>
</body>
</html>