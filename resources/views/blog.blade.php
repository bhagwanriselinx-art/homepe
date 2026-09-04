<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seo_setting->seo_title ?? 'Blog — Premium Real Estate' }}</title>
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
        .tag-badge{background:linear-gradient(135deg,#f97316,#ea580c)}
        .tag-green{background:linear-gradient(135deg,#22c55e,#16a34a)}
        .tag-blue{background:linear-gradient(135deg,#3b82f6,#2563eb)}
        .tag-yellow{background:linear-gradient(135deg,#f59e0b,#d97706)}
        .tag-purple{background:linear-gradient(135deg,#8b5cf6,#7c3aed)}
        .tag-teal{background:linear-gradient(135deg,#14b8a6,#0d9488)}
        .tag-rose{background:linear-gradient(135deg,#f43f5e,#e11d48)}
        .tag-indigo{background:linear-gradient(135deg,#6366f1,#4f46e5)}
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
        .skeleton-pulse{animation:pulse 1.5s ease-in-out infinite}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}

        /* ===== BLOG CARD SYSTEM — UNIFORM SIZE ===== */
        .blog-card{
            background:#fff;
            border-radius:20px;
            overflow:hidden;
            border:1px solid #f3f4f6;
            transition:all .45s cubic-bezier(.2,.8,.2,1);
            display:flex;
            flex-direction:column;
            height:100%;
            position:relative;
        }
        .blog-card::before{
            content:'';position:absolute;inset:0;border-radius:20px;
            padding:1.5px;
            background:linear-gradient(135deg,transparent,transparent);
            -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
            mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
            -webkit-mask-composite:xor;mask-composite:exclude;
            transition:background .5s ease;pointer-events:none;z-index:3;
        }
        .blog-card:hover::before{
            background:linear-gradient(135deg,rgba(249,115,22,.5),rgba(234,88,12,.2));
        }
        .blog-card:hover{
            transform:translateY(-10px);
            box-shadow:0 30px 60px -15px rgba(249,115,22,.12),0 0 0 1px rgba(249,115,22,.08);
        }
        .blog-card .card-img-wrap{
            position:relative;
            height:210px;
            overflow:hidden;
            flex-shrink:0;
        }
        .blog-card .card-img-wrap img{
            width:100%;height:100%;object-fit:cover;
            transition:transform .7s cubic-bezier(.2,.8,.2,1);
        }
        .blog-card:hover .card-img-wrap img{transform:scale(1.1)}
        .blog-card .card-img-overlay{
            position:absolute;inset:0;
            background:linear-gradient(to top,rgba(0,0,0,.5) 0%,transparent 50%);
            pointer-events:none;z-index:1;
        }
        .blog-card .card-body{
            flex:1;
            display:flex;
            flex-direction:column;
            padding:20px;
            min-height:0;
        }
        .blog-card .card-title{
            font-size:.95rem;font-weight:700;color:#111827;
            line-height:1.45;
            display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
            overflow:hidden;
            flex-shrink:0;
            margin-top:10px;
            transition:color .3s;
        }
        .blog-card:hover .card-title{color:#ea580c}
        .blog-card .card-excerpt{
            font-size:.82rem;color:#9ca3af;line-height:1.55;
            display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
            overflow:hidden;
            flex:1;
            margin-top:8px;
            min-height:42px;
        }
        .blog-card .card-footer{
            display:flex;align-items:center;justify-content:space-between;
            padding-top:14px;margin-top:auto;
            border-top:1px solid #f3f4f6;
            flex-shrink:0;
        }
        .blog-card .read-link{
            display:inline-flex;align-items:center;gap:6px;
            color:#f97316;font-size:.78rem;font-weight:600;
            transition:all .3s;
        }
        .blog-card .read-link:hover{gap:10px;color:#c2410c}
        .blog-card .read-link i{transition:transform .3s;font-size:.65rem}
        .blog-card:hover .read-link i{transform:translateX(3px)}

        /* Featured card */
        .blog-featured{
            position:relative;border-radius:24px;overflow:hidden;
            cursor:pointer;transition:all .5s cubic-bezier(.2,.8,.2,1);
        }
        .blog-featured:hover{transform:translateY(-6px);box-shadow:0 35px 70px -20px rgba(0,0,0,.3)}
        .blog-featured .feat-img{transition:transform .8s cubic-bezier(.2,.8,.2,1)}
        .blog-featured:hover .feat-img{transform:scale(1.06)}
        .blog-featured::after{
            content:'';position:absolute;bottom:0;left:0;right:0;height:75%;
            background:linear-gradient(to top,rgba(0,0,0,.88) 0%,rgba(0,0,0,.45) 45%,transparent 100%);
            pointer-events:none;z-index:1;
        }

        /* Category tabs */
        .cat-tab{transition:all .25s ease;white-space:nowrap}
        .cat-tab.active{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;box-shadow:0 4px 15px rgba(249,115,22,.3);border-color:transparent}
        .cat-tab:not(.active):hover{background:#fff7ed;color:#ea580c;border-color:#fed7aa}

        /* Author ring */
        .author-ring{padding:2px;background:linear-gradient(135deg,#f97316,#ea580c);border-radius:50%;flex-shrink:0}
        .author-ring img{display:block;border-radius:50%;border:2px solid #fff}

        /* Bookmark */
        .bookmark-btn{
            width:34px;height:34px;border-radius:10px;
            background:rgba(255,255,255,.9);backdrop-filter:blur(8px);
            border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;
            color:#9ca3af;transition:all .3s;opacity:0;transform:translateY(-6px);
            box-shadow:0 2px 8px rgba(0,0,0,.08);
        }
        .blog-card:hover .bookmark-btn{opacity:1;transform:translateY(0)}
        .bookmark-btn:hover,.bookmark-btn.saved{color:#f97316}
        .bookmark-btn.saved i{font-weight:900}

        /* Pagination */
        .pg-btn{
            min-width:42px;height:42px;display:inline-flex;align-items:center;justify-content:center;
            border-radius:12px;border:1.5px solid #e5e7eb;
            color:#6b7280;font-size:.85rem;font-weight:600;
            transition:all .25s;cursor:pointer;background:#fff;
        }
        .pg-btn:hover{border-color:#f97316;color:#f97316;background:#fff7ed}
        .pg-btn.active{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border-color:transparent;box-shadow:0 4px 12px rgba(249,115,22,.3)}

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
                    <a href="{{ route('blogs') }}" class="nav-link text-sm font-medium text-brand-600">Blog</a>
                    @isset($pages)
                        @foreach($pages->take(2) as $page)
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
                <a href="{{ route('home') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Home</a>
                <a href="{{ route('properties') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Properties</a>
                <a href="{{ route('agents') }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">Agents</a>
                <a href="{{ route('blogs') }}" class="block py-2.5 px-3 text-sm font-medium text-brand-600 bg-brand-50 rounded-lg">Blog</a>
                @isset($pages)
                    @foreach($pages->take(2) as $page)
                        <a href="{{ route('page', $page->slug) }}" class="block py-2.5 px-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">{{ $page->title }}</a>
                    @endforeach
                @endisset
                <a href="{{ route('agents') }}" class="block btn-primary-c text-white text-sm font-semibold px-5 py-2.5 rounded-lg mt-2 text-center">Get Free Consultation</a>
            </div>
        </div>
    </nav>

    <!-- ========== BLOG HERO ========== -->
    <section class="relative overflow-hidden hero-gradient py-16 md:py-24">
        <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 2px 2px,rgba(255,255,255,.15) 1px,transparent 0);background-size:40px 40px;"></div>
        <div class="absolute top-10 right-10 w-72 h-72 bg-brand-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/4 w-60 h-60 bg-blue-500/10 rounded-full blur-[80px] pointer-events-none"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <nav class="flex items-center gap-2 text-sm text-white/50 mb-6" data-aos="fade-right">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white font-medium">Blog</span>
            </nav>
            <div class="max-w-3xl" data-aos="fade-up">
                <span class="inline-flex items-center gap-1.5 bg-white/10 text-brand-400 text-xs font-semibold uppercase tracking-wider px-4 py-1.5 rounded-full mb-5"><i class="fas fa-newspaper text-[11px]"></i> Insights & Updates</span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight">Our <span class="text-brand-400">Blog</span></h1>
                <p class="text-white/60 mt-4 text-base md:text-lg max-w-xl leading-relaxed">Stay informed with the latest real estate trends, property guides, investment tips, and market insights.</p>
            </div>
            <div class="flex flex-wrap gap-6 sm:gap-8 mt-10" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center"><i class="fas fa-file-alt text-brand-400 text-lg"></i></div>
                    <div><p class="text-white font-bold text-xl">{{ $blogs->total() ?? '50' }}+</p><p class="text-white/40 text-xs">Articles</p></div>
                </div>
               
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center"><i class="fas fa-eye text-brand-400 text-lg"></i></div>
                    <div><p class="text-white font-bold text-xl">15K+</p><p class="text-white/40 text-xs">Monthly Readers</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CATEGORY FILTERS ========== -->
    <section class="bg-white border-b border-gray-100 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar py-4" id="catFilters">
                <button class="cat-tab active shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold border border-transparent" data-cat="all">All Posts</button>
                @if(isset($blog_categories) && $blog_categories->count())
                    @foreach($blog_categories->take(8) as $cat)
                        <button class="cat-tab shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-200 text-gray-500 bg-white" data-cat="{{ $cat->slug ?? $cat->id }}">{{ $cat->name }}</button>
                    @endforeach
                @else
                    <button class="cat-tab shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-200 text-gray-500 bg-white" data-cat="guides">Guides</button>
                    <button class="cat-tab shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-200 text-gray-500 bg-white" data-cat="investment">Investment</button>
                    <button class="cat-tab shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-200 text-gray-500 bg-white" data-cat="news">News</button>
                    <button class="cat-tab shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-200 text-gray-500 bg-white" data-cat="tips">Tips</button>
                    <button class="cat-tab shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold border border-gray-200 text-gray-500 bg-white" data-cat="lifestyle">Lifestyle</button>
                @endif
            </div>
        </div>
    </section>

    <!-- ========== BLOG CONTENT ========== -->
    <section class="py-10 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">

            @if($blogs->count() > 0)

                @php
                    $featured = $blogs->first();
                    $tagColors = ['tag-purple','tag-teal','tag-blue','tag-rose','tag-yellow','tag-green','tag-indigo'];
                @endphp

                <!-- ===== FEATURED POST ===== -->
                <a href="{{ route('blog', $featured->slug) }}" class="blog-featured block mb-10" data-aos="fade-up">
                    <div class="relative h-[280px] sm:h-[380px] md:h-[460px] overflow-hidden">
                        <img src="{{ $featured->image ? asset($featured->image) : asset($setting->default_placeholder ?? 'https://picsum.photos/seed/blogfeat/1200/600.jpg') }}" alt="{{ $featured->title }}" class="w-full h-full object-cover feat-img">
                        <div class="absolute top-5 left-5 z-10 flex items-center gap-2">
                            <span class="tag-badge text-white text-[10px] font-bold px-3 py-1.5 rounded-lg uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-star text-[8px]"></i> Featured</span>
                            <span class="{{ ($tagColors[0]) }} text-white text-[10px] font-bold px-3 py-1.5 rounded-lg uppercase tracking-wider">{{ $featured->category->name ?? 'Guide' }}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 z-10 p-6 md:p-10">
                            <div class="flex items-center gap-3 text-white/50 text-xs mb-3">
                                <span class="flex items-center gap-1.5"><i class="far fa-calendar"></i> {{ $featured->created_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span class="flex items-center gap-1.5"><i class="far fa-clock"></i> {{ $featured->created_at->diffForHumans() }}</span>
                                <span>•</span>
                                <span class="flex items-center gap-1.5"><i class="far fa-eye"></i> {{ rand(200,1500) }} views</span>
                            </div>
                            <h2 class="text-xl sm:text-2xl md:text-4xl font-extrabold text-white leading-tight mb-3">{{ Str::limit($featured->title, 80) }}</h2>
                            <p class="text-white/55 text-sm leading-relaxed hidden sm:block max-w-2xl">{{ Str::limit(strip_tags($featured->description ?? $featured->body ?? ''), 180) }}</p>
                            <div class="flex items-center gap-3 mt-5">
                                @if($featured->admin)
                                <div class="author-ring"><img src="{{ $featured->admin->image ? asset($featured->admin->image) : 'https://ui-avatars.com/api/?name='.urlencode($featured->admin->name).'&background=f97316&color=fff&size=64' }}" alt="{{ $featured->admin->name }}" class="w-10 h-10 rounded-full object-cover"></div>
                                <div><p class="text-white text-sm font-semibold">{{ $featured->admin->name }}</p><p class="text-white/40 text-xs">{{ $featured->admin->designation ?? 'Author' }}</p></div>
                                @endif
                                <div class="ml-auto hidden sm:flex items-center gap-2 text-brand-400 text-sm font-semibold bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/10">
                                    Read Article <i class="fas fa-arrow-right text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- ===== SECTION HEADING ===== -->
                <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-dark-900">Latest Articles</h2>
                        <p class="text-gray-400 text-sm mt-1">Explore our most recent insights</p>
                    </div>
                    <div class="hidden sm:flex items-center gap-2 text-gray-400 text-xs">
                        <button onclick="setView('grid')" id="viewGrid" class="w-9 h-9 rounded-lg bg-brand-500 text-white flex items-center justify-center transition"><i class="fas fa-th-large text-xs"></i></button>
                        <button onclick="setView('list')" id="viewList" class="w-9 h-9 rounded-lg bg-white border border-gray-200 text-gray-400 flex items-center justify-center hover:border-brand-500 hover:text-brand-500 transition"><i class="fas fa-list text-xs"></i></button>
                    </div>
                </div>

                <!-- ===== GRID VIEW (DEFAULT) ===== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7" id="blogGrid" data-view="grid">
                    @foreach($blogs->skip(1) as $index => $blog)
                        @php
                            $colorKey = ($index + 1) % count($tagColors);
                            $catColor = $tagColors[$colorKey];
                        @endphp
                        <div class="blog-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 80 }}" data-category="{{ $blog->category->slug ?? '' }}">
                            <a href="{{ route('blog', $blog->slug) }}" class="block">
                                <div class="card-img-wrap">
                                    <img loading="lazy" src="{{ $blog->image ? asset($blog->image) : asset($setting->default_placeholder ?? 'https://picsum.photos/seed/blog-'.$blog->id.'/600/420.jpg') }}" alt="{{ $blog->title }}">
                                    <div class="card-img-overlay"></div>
                                    <!-- Category -->
                                    <div class="absolute top-3.5 left-3.5 z-[2]">
                                        <span class="{{ $catColor }} text-white text-[9px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider">{{ $blog->category->name ?? 'Article' }}</span>
                                    </div>
                                    <!-- Bookmark -->
                                    <div class="absolute top-3.5 right-3.5 z-[2]">
                                        <button class="bookmark-btn" onclick="event.preventDefault();event.stopPropagation();toggleBookmark(this)" title="Bookmark">
                                            <i class="far fa-bookmark text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body">
                                <!-- Meta row -->
                                <div class="flex items-center gap-2.5 text-[11px] text-gray-400">
                                    <span class="flex items-center gap-1"><i class="far fa-calendar text-[9px] text-brand-400"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                    <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                                    <span class="flex items-center gap-1"><i class="far fa-clock text-[9px] text-brand-400"></i> {{ $blog->created_at->diffForHumans() }}</span>
                                </div>
                                <!-- Title — fixed 2 lines -->
                                <a href="{{ route('blog', $blog->slug) }}">
                                    <h3 class="card-title">{{ Str::limit($blog->title, 65) }}</h3>
                                </a>
                                <!-- Excerpt — fixed 2 lines -->
                                <p class="card-excerpt">{{ Str::limit(strip_tags($blog->description ?? $blog->body ?? ''), 110) }}</p>
                                <!-- Footer -->
                                <div class="card-footer">
                                    <div class="flex items-center gap-2">
                                        @if($blog->admin)
                                        <div class="author-ring"><img src="{{ $blog->admin->image ? asset($blog->admin->image) : 'https://ui-avatars.com/api/?name='.urlencode($blog->admin->name).'&background=f97316&color=fff&size=40' }}" alt="{{ $blog->admin->name }}" class="w-6 h-6 rounded-full object-cover"></div>
                                        <span class="text-[11px] text-gray-500 font-medium truncate max-w-[100px]">{{ Str::limit($blog->admin->name, 12) }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('blog', $blog->slug) }}" class="read-link">
                                        Read <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ===== PAGINATION ===== -->
                <div class="flex items-center justify-center gap-2 mt-14" data-aos="fade-up">
                    {{ $blogs->appends(request()->query())->links('pagination::tailwind') }}
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-24" data-aos="fade-up">
                    <div class="w-24 h-24 rounded-3xl bg-gray-100 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-gray-300 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark-900 mb-2">No Articles Found</h3>
                    <p class="text-gray-500 text-sm mb-8 max-w-sm mx-auto">We're working on new content. Check back soon for the latest real estate insights!</p>
                    <a href="{{ route('home') }}" class="btn-primary-c text-white text-sm font-semibold px-8 py-3 rounded-xl inline-flex items-center gap-2"><i class="fas fa-home text-xs"></i> Back to Home</a>
                </div>
            @endif

        </div>
    </section>

    <!-- ========== NEWSLETTER CTA ========== -->
    <section class="relative overflow-hidden bg-white py-14 md:py-20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-500/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-500/5 rounded-full blur-[80px] pointer-events-none"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4 text-center" data-aos="fade-up">
            <div class="w-16 h-16 rounded-2xl bg-brand-50 border border-brand-100 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-envelope-open-text text-brand-500 text-2xl"></i>
            </div>
            <h2 class="text-2xl md:text-4xl font-bold text-dark-900 mb-3">Never Miss an <span class="text-brand-500">Update</span></h2>
            <p class="text-gray-500 text-sm md:text-base max-w-lg mx-auto leading-relaxed">Subscribe to our newsletter and get the latest real estate insights, market updates, and exclusive offers delivered to your inbox.</p>
            <form onsubmit="handleSubscribe(event)" class="flex flex-col sm:flex-row gap-3 mt-8 max-w-lg mx-auto">
                <div class="flex-1 relative">
                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 text-sm"></i>
                    <input type="email" placeholder="Enter your email address" required class="w-full pl-11 pr-5 py-3.5 rounded-xl border border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none text-sm bg-gray-50 focus:bg-white transition" id="subEmail">
                </div>
                <button type="submit" class="btn-primary-c text-white text-sm font-semibold px-7 py-3.5 rounded-xl flex items-center justify-center gap-2 whitespace-nowrap"><i class="fas fa-paper-plane text-xs"></i> Subscribe</button>
            </form>
            <p class="text-gray-400 text-[11px] mt-4"><i class="fas fa-lock text-[9px] mr-1"></i> We respect your privacy. Unsubscribe anytime.</p>
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

    <!-- ========== CHATBOT WIDGET ========== -->
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

    <!-- View Toggle -->
    <script>
    function setView(type) {
        var grid = document.getElementById('blogGrid');
        var btnGrid = document.getElementById('viewGrid');
        var btnList = document.getElementById('viewList');
        if (type === 'grid') {
            grid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7';
            btnGrid.className = 'w-9 h-9 rounded-lg bg-brand-500 text-white flex items-center justify-center transition';
            btnList.className = 'w-9 h-9 rounded-lg bg-white border border-gray-200 text-gray-400 flex items-center justify-center hover:border-brand-500 hover:text-brand-500 transition';
            document.querySelectorAll('.blog-card .card-img-wrap').forEach(function(el) { el.style.height = '210px'; });
            grid.dataset.view = 'grid';
        } else {
            grid.className = 'grid grid-cols-1 gap-5';
            btnList.className = 'w-9 h-9 rounded-lg bg-brand-500 text-white flex items-center justify-center transition';
            btnGrid.className = 'w-9 h-9 rounded-lg bg-white border border-gray-200 text-gray-400 flex items-center justify-center hover:border-brand-500 hover:text-brand-500 transition';
            document.querySelectorAll('.blog-card .card-img-wrap').forEach(function(el) { el.style.height = '200px'; });
            grid.dataset.view = 'list';
            // Make list cards horizontal
            document.querySelectorAll('.blog-card').forEach(function(card) {
                card.style.flexDirection = 'row';
                var imgWrap = card.querySelector('.card-img-wrap');
                var body = card.querySelector('.card-body');
                if (imgWrap) { imgWrap.style.width = '280px'; imgWrap.style.flexShrink = '0'; imgWrap.style.height = '100%'; imgWrap.style.minHeight = '220px'; }
                if (body) { body.style.padding = '20px 24px'; body.style.justifyContent = 'center'; }
            });
        }
        if (type === 'grid') {
            document.querySelectorAll('.blog-card').forEach(function(card) {
                card.style.flexDirection = 'column';
                var imgWrap = card.querySelector('.card-img-wrap');
                var body = card.querySelector('.card-body');
                if (imgWrap) { imgWrap.style.width = ''; imgWrap.style.flexShrink = ''; imgWrap.style.minHeight = ''; }
                if (body) { body.style.padding = '20px'; body.style.justifyContent = ''; }
            });
        }
    }
    </script>

    <!-- Category Filter -->
    <script>
    (function() {
        var tabs = document.querySelectorAll('.cat-tab');
        var cards = document.querySelectorAll('.blog-card');
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabs.forEach(function(t) { t.classList.remove('active'); t.classList.add('border', 'border-gray-200', 'text-gray-500', 'bg-white'); });
                this.classList.add('active'); this.classList.remove('border-gray-200', 'text-gray-500', 'bg-white');
                var cat = this.dataset.cat, visible = 0;
                cards.forEach(function(card) {
                    if (cat === 'all' || card.dataset.category === cat) {
                        card.style.display = ''; card.style.opacity = '0'; card.style.transform = 'translateY(15px)';
                        setTimeout(function() { card.style.transition = 'opacity .4s ease, transform .4s ease'; card.style.opacity = '1'; card.style.transform = 'translateY(0)'; }, visible * 60);
                        visible++;
                    } else { card.style.display = 'none'; }
                });
            });
        });
    })();
    </script>

    <!-- Utility -->
    <script>
    function toggleMobileMenu() { document.getElementById('mobileMenu').classList.toggle('hidden'); }
    function showEnquiry(name) { document.getElementById('enquiryTitle').textContent = name ? ('Enquire: ' + name) : 'Enquire Now'; document.getElementById('enquiryPropertyName').value = name || ''; document.getElementById('enquiryModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
    function closeEnquiry() { document.getElementById('enquiryModal').classList.add('hidden'); document.body.style.overflow = ''; }
    function toggleBookmark(btn) { btn.classList.toggle('saved'); var i = btn.querySelector('i'); i.classList.toggle('far'); i.classList.toggle('fas'); if (btn.classList.contains('saved')) showToast('Article bookmarked!', 'success'); else showToast('Bookmark removed', 'info'); }
    function handleSubscribe(e) { e.preventDefault(); var em = document.getElementById('subEmail').value; if (em) { showToast('Subscribed with ' + em + '!', 'success'); document.getElementById('subEmail').value = ''; } }
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