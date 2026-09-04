<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties - RealEstate</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        /* ── Nav ── */
        .nav-link { position: relative; }
        .nav-link::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background:#f97316; transition:width .3s; }
        .nav-link:hover::after { width:100%; }

        /* ── Buttons ── */
        .btn-primary-c {
            background: linear-gradient(135deg,#f97316,#ea580c);
            transition: all .3s; color:#fff; border-radius:9999px;
            padding:.75rem 1.5rem; font-weight:600; display:inline-flex;
            align-items:center; justify-content:center; border:none;
            cursor:pointer; font-size:.875rem;
        }
        .btn-primary-c:hover {
            background: linear-gradient(135deg,#ea580c,#c2410c);
            transform: translateY(-1px); box-shadow: 0 4px 15px rgba(249,115,22,.4);
        }
        .btn-outline-c {
            border:2px solid #f97316; color:#f97316; transition:all .3s;
            border-radius:9999px; padding:.5rem 1.25rem; font-weight:600;
            display:inline-flex; align-items:center; justify-content:center;
            background:transparent; cursor:pointer; font-size:.85rem;
        }
        .btn-outline-c:hover { background:#f97316; color:#fff; }

        /* ── Breadcrumb ── */
        .breadcrumbs__content {
            background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1920&q=80');
            background-size: cover; background-position: center;
            padding: 100px 0 80px; position: relative;
        }
        .breadcrumbs__content::before {
            content:''; position:absolute; inset:0;
            background: linear-gradient(135deg,rgba(15,15,15,.78),rgba(26,26,46,.6));
        }
        .breadcrumb-content { position:relative; z-index:10; color:#fff; }
        .breadcrumb__menu {
            display:flex; gap:10px; margin-bottom:15px;
            list-style:none; padding:0; justify-content:center;
        }
        .breadcrumb__menu a { color:rgba(255,255,255,.6); text-decoration:none; font-size:.875rem; transition:.3s; }
        .breadcrumb__menu a:hover { color:#fff; }
        .breadcrumb__menu li.active a { color:#fff; font-weight:600; }
        .breadcrumb__menu li i { font-size:10px; color:rgba(255,255,255,.4); margin-top:4px; }

        /* ── jQuery UI Slider ── */
        .ui-slider .ui-slider-handle {
            width:22px; height:22px; background:#fff; border:3px solid #ea580c;
            border-radius:50%; cursor:pointer; top:-9px; outline:none;
            box-shadow: 0 2px 8px rgba(0,0,0,.15); transition:.2s;
        }
        .ui-slider .ui-slider-handle:hover,
        .ui-slider .ui-slider-handle:focus {
            box-shadow: 0 0 0 5px rgba(249,115,22,.15);
            border-color:#c2410c; transform:scale(1.1);
        }
        .ui-slider .ui-slider-range { background:linear-gradient(135deg,#f97316,#ea580c); border-radius:4px; }
        .ui-slider-horizontal { height:6px; border:none; background:#e5e7eb; border-radius:4px; }

        /* ── Select2 ── */
        .select2-container--default .select2-selection--single {
            border:2px solid #e5e7eb!important; border-radius:.75rem!important;
            height:48px!important; display:flex!important; align-items:center;
            background:#fff!important; transition:.2s;
        }
        .select2-container--default .select2-selection--single:hover { border-color:#f97316!important; }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color:#f97316!important; box-shadow:0 0 0 3px rgba(249,115,22,.1)!important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height:44px!important; padding-left:16px!important; font-size:14px!important; color:#374151!important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height:44px!important; width:40px!important; }
        .select2-container--default .select2-selection--single .select2-selection__arrow b { border-color:#6b7280 transparent transparent!important; }
        .select2-dropdown {
            border:2px solid #e5e7eb!important; border-radius:.75rem!important;
            overflow:hidden!important; box-shadow:0 10px 40px rgba(0,0,0,.12)!important; margin-top:6px!important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] { background:linear-gradient(135deg,#f97316,#ea580c)!important; }
        .select2-container--default .select2-results__option { padding:10px 16px!important; font-size:14px; }

        /* ── Property Card ── */
        .homec-property {
            position:relative; transition:all .4s cubic-bezier(.4,0,.2,1);
            background:#fff; border:1px solid #e5e7eb; border-radius:16px;
            overflow:hidden; animation: cardFadeIn .6s ease-out both;
        }
        @keyframes cardFadeIn {
            from { opacity:0; transform:translateY(30px) scale(.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }
        .homec-property:hover {
            transform:translateY(-8px); box-shadow:0 20px 40px rgba(0,0,0,.1); border-color:transparent;
        }
        .homec-property__head { position:relative; height:240px; overflow:hidden; }
        .homec-property__head img {
            width:100%; height:100%; object-fit:cover;
            transition:transform .7s cubic-bezier(.4,0,.2,1);
        }
        .homec-property:hover .homec-property__head img { transform:scale(1.08); }
        .homec-property__head::after {
            content:''; position:absolute; bottom:0; left:0; right:0;
            height:60px; background:linear-gradient(transparent,rgba(0,0,0,.15)); pointer-events:none;
        }
        .homec-property__hsticky {
            position:absolute; top:14px; left:14px; right:14px;
            display:flex; justify-content:space-between; align-items:flex-start; z-index:10;
        }
        .homec-heart {
            display:flex; align-items:center; justify-content:center;
            width:38px; height:38px; background:rgba(255,255,255,.95);
            border-radius:50%; color:#333; transition:.3s;
            box-shadow:0 4px 12px rgba(0,0,0,.1); text-decoration:none;
            cursor:pointer; backdrop-filter:blur(4px);
        }
        .homec-heart:hover { color:#ef4444; transform:scale(1.15); box-shadow:0 6px 20px rgba(239,68,68,.25); }
        .homec-heart svg { width:18px; height:18px; stroke:#555; stroke-width:2; fill:none; transition:.3s; }
        .homec-heart:hover svg { stroke:#ef4444; }
        .homec-heart.wishlisted { background:#fef2f2; }
        .homec-heart.wishlisted svg { stroke:#ef4444; fill:#ef4444; }
        .homec-property__salebadge {
            background:linear-gradient(135deg,#f97316,#ea580c); color:#fff;
            padding:5px 14px; border-radius:20px; font-size:11px;
            font-weight:700; text-transform:uppercase; letter-spacing:.5px;
            box-shadow:0 4px 12px rgba(249,115,22,.35);
        }
        .homec-property__body { padding:20px; }
        .homec-property__price { color:#c2410c; font-size:22px; font-weight:800; margin-bottom:6px; letter-spacing:-.3px; }
        .homec-property__price span { color:#9ca3af; font-size:13px; font-weight:400; }
        .homec-property__title a {
            font-weight:700; color:#1a1a1a; font-size:16px; line-height:1.45;
            transition:.3s; text-decoration:none; display:block;
            display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
        }
        .homec-property__title a:hover { color:#ea580c; }
        .homec-property__text { display:flex; align-items:flex-start; gap:6px; font-size:13px; color:#6b7280; margin-bottom:4px; }
        .homec-property__text i { color:#f97316; margin-top:3px; font-size:12px; }
        .homec-property__list {
            display:flex; justify-content:space-between; border-top:1px solid #f3f4f6;
            padding-top:14px; margin-top:14px; font-size:13px; color:#6b7280;
            list-style:none; padding-left:0; margin-bottom:0;
        }
        .homec-property__list li { display:flex; align-items:center; gap:5px; }
        .homec-property__list li i { color:#f97316; font-size:13px; }
        .homec-property__enquire { padding-top:14px; }

        /* ── View Tabs ── */
        .list-group-item {
            border:1px solid #e5e7eb; background:#fff; color:#6b7280;
            padding:10px 14px; cursor:pointer; transition:.3s;
            display:flex; align-items:center; justify-content:center;
        }
        .list-group-item.active, .list-group-item:hover { background:#f97316; color:#fff; border-color:#f97316; }
        .list-group-item svg { fill:currentColor; }

        /* ── Map ── */
        #map { height:520px; width:100%; border-radius:16px; z-index:1; border:2px solid #e5e7eb; }
        .leaflet-popup-content-wrapper { border-radius:12px; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,.15); }
        .leaflet-popup-content { margin:0; width:240px!important; }
        .leaflet-popup-content img { width:100%; height:140px; object-fit:cover; }
        .leaflet-popup-close-button {
            top:8px!important; right:8px!important; color:#fff!important;
            background:rgba(0,0,0,.4); width:24px; height:24px; border-radius:50%;
            display:flex; align-items:center; justify-content:center; font-size:14px!important;
        }

        /* ── Active Filter Tags ── */
        .active-filters { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:20px; }
        .active-filter-tag {
            display:inline-flex; align-items:center; gap:7px;
            background:linear-gradient(135deg,#fff7ed,#ffedd5); color:#ea580c;
            font-size:12px; font-weight:600; padding:6px 14px; border-radius:99px;
            border:1px solid #fed7aa; transition:.2s;
        }
        .active-filter-tag:hover { border-color:#fdba74; background:#fff7ed; }
        .active-filter-tag button {
            background:none; border:none; cursor:pointer; color:#ef4444;
            font-size:12px; line-height:1; padding:0; width:18px; height:18px;
            border-radius:50%; display:flex; align-items:center; justify-content:center; transition:.2s;
        }
        .active-filter-tag button:hover { background:#fee2e2; transform:scale(1.1); }

        /* ── No Results ── */
        .no-results-box { text-align:center; padding:80px 20px; }
        .no-results-box .icon-wrap {
            width:80px; height:80px; border-radius:50%; background:#fef2f2;
            display:flex; align-items:center; justify-content:center; margin:0 auto 20px;
        }
        .no-results-box .icon-wrap i { font-size:32px; color:#fca5a5; }
        .no-results-box h4 { color:#374151; font-size:20px; font-weight:700; margin-bottom:8px; }
        .no-results-box p { color:#9ca3af; font-size:14px; max-width:300px; margin:0 auto; }

        /* ── List Card ── */
        .homec-property.list-card { display:flex; flex-direction:row; }
        .homec-property.list-card .homec-property__head { width:340px; min-width:340px; height:auto; min-height:260px; }
        @media(max-width:768px) {
            .homec-property.list-card { flex-direction:column; }
            .homec-property.list-card .homec-property__head { width:100%!important; min-width:100%; height:220px!important; min-height:auto; }
            .skeleton-list-card { flex-direction:column; }
            .skeleton-list-img { width:100%!important; min-width:100%; height:180px; }
        }

        /* ── Skeleton ── */
        .loading-skeleton { position:relative; overflow:hidden; background:#e5e7eb; border-radius:12px; }
        .loading-skeleton::after {
            content:''; position:absolute; inset:0;
            background:linear-gradient(90deg,transparent,rgba(255,255,255,.6),transparent);
            animation:skeletonShimmer 1.5s ease-in-out infinite;
        }
        @keyframes skeletonShimmer { 0%{transform:translateX(-100%)} 100%{transform:translateX(100%)} }
        .skeleton-card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; overflow:hidden; }
        .skeleton-img { height:240px; background:#e5e7eb; }
        .skeleton-line { height:12px; background:#e5e7eb; border-radius:6px; margin:10px 20px; }
        .skeleton-line.w60 { width:60%; }
        .skeleton-line.w40 { width:40%; }
        .skeleton-line.w80 { width:80%; }
        .skeleton-line.h6 { height:18px; }
        .skeleton-line.price { height:22px; width:130px; background:#fecaca; }
        .skeleton-btn { height:42px; margin:14px 20px 20px; border-radius:999px; background:#e5e7eb; }
        .skeleton-list-card { display:flex; gap:0; }
        .skeleton-list-img { width:340px; min-width:340px; height:260px; background:#e5e7eb; }

        /* ── Modal ── */
        .modal-anim { animation:modalIn .35s cubic-bezier(.4,0,.2,1); }
        @keyframes modalIn { from{transform:scale(.9) translateY(30px);opacity:0} to{transform:scale(1) translateY(0);opacity:1} }

        /* ── Form Errors ── */
        .input-error { border-color:#ef4444!important; box-shadow:0 0 0 3px rgba(239,68,68,.1)!important; }
        .field-error { color:#ef4444; font-size:11px; margin-top:4px; display:none; font-weight:500; }
        .field-error.show { display:block; }

        /* ── Filter Sidebar ── */
        .filter-section { margin-bottom:20px; }
        .filter-label {
            font-size:13px; font-weight:700; color:#374151;
            margin-bottom:8px; display:flex; align-items:center; gap:6px;
        }
        .filter-label i { color:#f97316; font-size:12px; }
        .checkbox-pill {
            display:inline-flex; align-items:center; gap:6px;
            padding:6px 14px; border:2px solid #e5e7eb; border-radius:99px;
            cursor:pointer; transition:.2s; font-size:13px; color:#6b7280;
            font-weight:500; user-select:none;
        }
        .checkbox-pill:hover { border-color:#fdba74; color:#ea580c; background:#fff7ed; }
        .checkbox-pill input { display:none; }
        .checkbox-pill.checked {
            border-color:#f97316; background:linear-gradient(135deg,#fff7ed,#ffedd5);
            color:#ea580c; font-weight:600;
        }

        /* ── Back to Top ── */
        .back-to-top {
            position:fixed; bottom:30px; right:30px; width:48px; height:48px;
            border-radius:50%; background:linear-gradient(135deg,#f97316,#ea580c);
            color:#fff; display:none; align-items:center; justify-content:center;
            cursor:pointer; z-index:90; box-shadow:0 4px 15px rgba(249,115,22,.4);
            transition:.3s; border:none; font-size:18px;
        }
        .back-to-top:hover { transform:translateY(-3px); box-shadow:0 8px 25px rgba(249,115,22,.5); }
        .back-to-top.show { display:flex; }

        /* ── Agent Sidebar Card ── */
        .agent-sidebar-card {
            background: linear-gradient(135deg,#0f172a 0%,#1e293b 50%,#334155 100%);
            border-radius:16px; padding:24px; color:#fff; position:relative; overflow:hidden;
        }
        .agent-sidebar-card::before {
            content:''; position:absolute; top:-50%; right:-50%;
            width:100%; height:100%;
            background:radial-gradient(circle,rgba(249,115,22,.08),transparent 70%);
            pointer-events:none;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- ═══════════ TOP BAR ═══════════ -->
    <div class="bg-dark-900 text-white text-xs py-2.5 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-5">
                <a href="#" class="hover:text-brand-400 transition flex items-center gap-1.5">
                    <i class="fas fa-phone text-brand-400"></i> +91 98765 43210
                </a>
                <a href="#" class="hidden sm:flex hover:text-brand-400 transition items-center gap-1.5">
                    <i class="fas fa-envelope text-brand-400"></i> info@example.com
                </a>
                <span class="hidden md:flex items-center gap-1.5 text-gray-400">
                    <i class="fas fa-clock text-brand-400"></i> Mon - Sat: 9:00 AM - 7:00 PM
                </span>
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-brand-400 transition w-7 h-7 rounded-full bg-white/5 flex items-center justify-center"><i class="fab fa-facebook-f text-[11px]"></i></a>
                <a href="#" class="hover:text-brand-400 transition w-7 h-7 rounded-full bg-white/5 flex items-center justify-center"><i class="fab fa-instagram text-[11px]"></i></a>
                <a href="#" class="hover:text-brand-400 transition w-7 h-7 rounded-full bg-white/5 flex items-center justify-center"><i class="fab fa-twitter text-[11px]"></i></a>
                <a href="#" class="hover:text-brand-400 transition w-7 h-7 rounded-full bg-white/5 flex items-center justify-center"><i class="fab fa-youtube text-[11px]"></i></a>
            </div>
        </div>
    </div>

    <!-- ═══════════ NAVBAR ═══════════ -->
    <nav class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-[68px]">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-white shadow-lg shadow-brand-500/20">
                        <i class="fas fa-building text-lg"></i>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold text-dark-900 tracking-tight">Real<span class="text-brand-600">Estate</span></span>
                        <p class="text-[10px] text-gray-400 -mt-0.5 tracking-widest uppercase font-medium">Premium Properties</p>
                    </div>
                </a>
                <div class="hidden lg:flex items-center gap-9">
                    <a href="{{ url('/') }}" class="nav-link text-sm font-semibold text-gray-500 hover:text-gray-900 transition">Home</a>
                    <a href="{{ route('properties') }}" class="nav-link text-sm font-semibold text-brand-600">Properties</a>
                    <a href="#" class="nav-link text-sm font-semibold text-gray-500 hover:text-gray-900 transition">Agents</a>
                    <a href="#" class="nav-link text-sm font-semibold text-gray-500 hover:text-gray-900 transition">Blog</a>
                    <a href="#" class="nav-link text-sm font-semibold text-gray-500 hover:text-gray-900 transition">Contact</a>
                </div>
                <div class="flex items-center gap-3">
                    <a href="#" class="btn-primary-c text-sm hidden md:flex"><i class="fas fa-headset mr-2"></i>Get Free Consultation</a>
                    <button class="lg:hidden text-gray-600 w-10 h-10 rounded-lg bg-gray-50 flex items-center justify-center hover:bg-gray-100 transition" id="mobileMenuBtn">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- ═══════════ BREADCRUMBS ═══════════ -->
    <section class="breadcrumbs__content">
        <div class="container max-w-7xl mx-auto px-4">
            <div class="breadcrumb-content text-center">
                <ul class="breadcrumb__menu">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
                    <li><i class="fas fa-chevron-right"></i></li>
                    <li class="active">Properties</li>
                </ul>
                <h1 class="text-3xl md:text-5xl font-extrabold m-0 tracking-tight">All Properties</h1>
                <p class="text-white/60 text-sm mt-3 max-w-lg mx-auto">Find your dream property from our curated collection of premium listings</p>
            </div>
        </div>
    </section>

    <!-- ═══════════ MAIN SECTION ═══════════ -->
    <section class="py-10 md:py-14">
        <div class="container max-w-7xl mx-auto px-4">

            <!-- ── SEARCH BAR ── -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between bg-white p-4 md:p-5 rounded-2xl shadow-sm border border-gray-100 mb-8 gap-4">
                <div class="w-full md:w-1/2">
                    <div class="flex items-center gap-2">
                        <div class="relative flex-1">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" id="searchInput" placeholder="Search by title, location..."
                                class="w-full border-2 border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition">
                        </div>
                        <button type="button" id="searchPropertyBtn" class="btn-primary-c !py-3 !px-6 !rounded-xl whitespace-nowrap">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-full md:w-auto justify-center md:justify-end">
                    <span class="text-xs text-gray-400 hidden sm:block">View:</span>
                    <div id="homec-tabs" class="list-group flex rounded-xl overflow-hidden border border-gray-200">
                        <a class="list-group-item active px-3.5 py-2.5 grid_view" onclick="switchView('grid')" title="Grid View">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><path d="M7.31756.518H3.14916C1.88457.518.855469 1.547.855469 2.811V6.979C.855469 8.244 1.88457 9.273 3.14916 9.273H7.31705C8.58164 9.273 9.61075 8.244 9.61075 6.979V2.811C9.61126 1.547 8.58215.518 7.31756.518ZM8.08213 6.98C8.08213 7.401 7.73909 7.744 7.31756 7.744H3.14916C2.72763 7.744 2.3846 7.401 2.3846 6.98V2.812C2.3846 2.39 2.72763 2.047 3.14916 2.047H7.31705C7.73858 2.047 8.08162 2.39 8.08162 2.812L8.08213 6.98ZM17.63.518H13.4616C12.197.518 11.1679 1.547 11.1679 2.811V6.979C11.1679 8.244 12.197 9.273 13.4616 9.273H17.63C18.8946 9.273 19.9237 8.244 19.9237 6.979V2.811C19.9237 1.547 18.8951.518 17.63.518ZM18.3946 6.98C18.3946 7.401 18.0515 7.744 17.63 7.744H13.4616C13.0401 7.744 12.697 7.401 12.697 6.98V2.812C12.697 2.39 13.0401 2.047 13.4616 2.047H17.63C18.0515 2.047 18.3946 2.39 18.3946 2.812V6.98ZM7.31756 10.339H3.14916C1.88457 10.339.855469 11.368.855469 12.633V16.801C.855469 18.065 1.88457 19.094 3.14916 19.094H7.31705C8.58164 19.094 9.61075 18.065 9.61075 16.801V12.633C9.61126 11.368 8.58215 10.339 7.31756 10.339ZM8.08213 16.801C8.08213 17.222 7.73909 17.565 7.31756 17.565H3.14916C2.72763 17.565 2.3846 17.222 2.3846 16.801V12.633C2.3846 12.211 2.72763 11.868 3.14916 11.868H7.31705C7.73858 11.868 8.08162 12.211 8.08162 12.633L8.08213 16.801ZM17.63 10.339H13.4616C12.197 10.339 11.1679 11.368 11.1679 12.633V16.801C11.1679 18.065 12.197 19.094 13.4616 19.094H16.5759C16.998 19.094 17.3405 18.752 17.3405 18.33C17.3405 17.908 16.998 17.565 16.5759 17.565H13.4616C13.0401 17.565 12.697 17.222 12.697 16.801V12.633C12.697 12.211 13.0401 11.868 13.4616 11.868H17.63C18.0515 11.868 18.3946 12.211 18.3946 12.633V16.126C18.3946 16.548 18.7371 16.891 19.1591 16.891C19.5812 16.891 19.9237 16.548 19.9237 16.126V12.633C19.9237 11.368 18.8951 10.339 17.63 10.339Z"/></svg>
                        </a>
                        <a class="list-group-item px-3.5 py-2.5 list_view" onclick="switchView('list')" title="List View">
                            <svg width="20" height="15" viewBox="0 0 27 19" fill="none"><path d="M23.3596.518H6.84306C5.93088.518 5.19141 1.257 5.19141 2.169C5.19141 3.081 5.93088 3.821 6.84306 3.821H23.3596C24.2717 3.821 25.0112 3.081 25.0112 2.169C25.0112 1.257 24.2717.518 23.3596.518Z"/><path d="M25.0112 7.949H6.84306C5.93088 7.949 5.19141 8.689 5.19141 9.601C5.19141 10.513 5.93088 11.253 6.84306 11.253H25.0112C25.9234 11.253 26.6629 10.513 26.6629 9.601C26.6629 8.689 25.9234 7.949 25.0112 7.949Z"/><path d="M17.5788 15.383H6.84306C5.93088 15.383 5.19141 16.122 5.19141 17.035C5.19141 17.947 5.93088 18.686 6.84306 18.686H17.5788C18.491 18.686 19.2304 17.947 19.2304 17.035C19.2304 16.122 18.491 15.383 17.5788 15.383Z"/></svg>
                        </a>
                        <a class="list-group-item px-3.5 py-2.5 map_view" onclick="switchView('map')" title="Map View">
                            <svg width="18" height="18" viewBox="0 0 23 23" fill="none"><g clip-path="url(#clip0_301_121147)"><path d="M22.2799 10.062C21.8831 10.062 21.5612 10.384 21.5612 10.781V18.919L15.8115 21.219V13.655C15.8115 13.259 15.4895 12.937 15.0928 12.937C14.6961 12.937 14.3741 13.259 14.3741 13.655V21.218L8.62446 18.918V7.531L11.9549 8.863C12.3186 9.01 12.7412 8.831 12.8893 8.462C13.0373 8.094 12.8576 7.676 12.4882 7.528L8.18605 5.806C8.18605 5.806 8.18605 5.806 8.18461 5.806L8.17311 5.801C8.00206 5.732 7.81089 5.732 7.63983 5.801L7.6269 5.806.451347 8.676C.179676 8.785 0 9.048 0 9.343V22.28C0 22.519.119305 22.741.31623 22.875C.436973 22.957.576402 22.999.718705 22.999C.809262 22.999.899819 22.981.986063 22.947L7.90576 20.18L14.8125 22.943C14.8125 22.943 14.8125 22.943 14.814 22.943L14.8269 22.948C14.9979 23.017 15.1891 23.017 15.3602 22.948L15.3731 22.943C15.3731 22.943 15.3731 22.943 15.3745 22.943L22.5487 20.073C22.8189 19.963 22.9986 19.7 22.9986 19.405V10.781C22.9986 10.384 22.6766 10.062 22.2799 10.062ZM7.18705 18.918L1.43741 21.218V9.829L7.18705 7.529V18.918Z"/><path d="M17.9684 0C15.1942 0 12.9375 2.257 12.9375 5.031C12.9375 7.613 16.9737 12.185 17.4337 12.698C17.5703 12.849 17.7643 12.937 17.9684 12.937C18.1725 12.937 18.3666 12.849 18.5032 12.698C18.9631 12.185 22.9994 7.613 22.9994 5.031C22.9994 2.257 20.7426 0 17.9684 0ZM17.9684 11.121C16.3988 9.26 14.3749 6.402 14.3749 5.031C14.3749 3.05 15.9877 1.437 17.9684 1.437C19.9492 1.437 21.562 3.05 21.562 5.031C21.562 6.401 19.5381 9.26 17.9684 11.121Z"/></g><defs><clipPath id="clip0_301_121147"><rect width="23" height="23"/></clipPath></defs></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ── FILTER FORM ── -->
            <form id="propertySearchForm" onsubmit="return false;">
                <div class="flex flex-col lg:flex-row gap-8">

                    <!-- ═══════ SIDEBAR ═══════ -->
                    <div class="w-full lg:w-[300px] xl:w-[320px] space-y-6 flex-shrink-0">

                        <!-- FILTER CARD -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-[90px]">
                            <div class="flex items-center justify-between mb-5 border-b border-gray-100 pb-3">
                                <h4 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-sliders-h text-brand-500"></i> Filters
                                </h4>
                                <button type="button" id="clearAllFilters" class="text-xs text-brand-600 hover:text-brand-700 font-semibold transition" style="display:none">
                                    <i class="fas fa-rotate-left mr-1"></i>Clear All
                                </button>
                            </div>

                            <!-- PURPOSE -->
                            <div class="filter-section">
                                <label class="filter-label"><i class="fas fa-exchange-alt"></i> Purpose</label>
                                <select class="w-full filter-select" name="purpose">
                                    <option value="rent">For Rent</option>
                                    <option value="sale">For Sale</option>
                                    <option value="pg">For PG</option>
                                </select>
                            </div>

                            <!-- CITY -->
                           <!-- ========================= -->
<!-- STATE FILTER -->
<!-- ========================= -->

<div class="filter-section">

<label class="filter-label">
    <i class="fas fa-map"></i>
    State
</label>

<select
    class="w-full filter-select"
    name="state"
    id="state_selector"
>

    <option value="">
        All States
    </option>

    @php

        $states = \App\Models\State::orderBy('name','ASC')->get();

    @endphp

    @foreach($states as $state)

        <option value="{{ $state->id }}">

            {{ $state->name }}

        </option>

    @endforeach

</select>

</div>

<!-- ========================= -->
<!-- CITY FILTER -->
<!-- ========================= -->

<div class="filter-section">

<label class="filter-label">
    <i class="fas fa-city"></i>
    City
</label>

<select
    class="w-full filter-select"
    name="city"
    id="city_selector"
>

    <option value="">
        All Cities
    </option>

</select>

</div>

                            <!-- PROPERTY TYPE -->
                            <div class="filter-section">

<label class="filter-label">
    <i class="fas fa-building"></i>
    Property Type
</label>

<select
    class="w-full filter-select"
    name="type"
    id="property_type_selector"
>

    <option value="">
        All Types
    </option>

    <!-- ========================= -->
    <!-- RESIDENTIAL -->
    <!-- ========================= -->

    <optgroup label="Residential">

        @php

            $residentialTypes =
                \App\Models\Category::where(
                    'category_type',
                    'residential'
                )
                ->where('status',1)
                ->orderBy('name','ASC')
                ->get();

        @endphp

        @foreach($residentialTypes as $type)

            <option value="{{ $type->slug }}">

                {{ $type->name }}

            </option>

        @endforeach

    </optgroup>

    <!-- ========================= -->
    <!-- COMMERCIAL -->
    <!-- ========================= -->

    <optgroup label="Commercial">

        @php

            $commercialTypes =
                \App\Models\Category::where(
                    'category_type',
                    'commercial'
                )
                ->where('status',1)
                ->orderBy('name','ASC')
                ->get();

        @endphp

        @foreach($commercialTypes as $type)

            <option value="{{ $type->slug }}">

                {{ $type->name }}

            </option>

        @endforeach

    </optgroup>

</select>

</div>

                            <!-- BEDROOM -->
                            <div class="filter-section">

    <label class="filter-label">
        <i class="fas fa-bed"></i>
        Bedroom
    </label>

    <div class="flex flex-wrap gap-2">

        <label
            class="checkbox-pill"
            onclick="this.classList.toggle('checked')"
        >

            <input
                type="checkbox"
                name="bedroom[]"
                value="1"
                class="bedroom-filter"
            >

            1 BHK

        </label>

        <label
            class="checkbox-pill"
            onclick="this.classList.toggle('checked')"
        >

            <input
                type="checkbox"
                name="bedroom[]"
                value="2"
                class="bedroom-filter"
            >

            2 BHK

        </label>

        <label
            class="checkbox-pill"
            onclick="this.classList.toggle('checked')"
        >

            <input
                type="checkbox"
                name="bedroom[]"
                value="3"
                class="bedroom-filter"
            >

            3 BHK

        </label>

        <label
            class="checkbox-pill"
            onclick="this.classList.toggle('checked')"
        >

            <input
                type="checkbox"
                name="bedroom[]"
                value="4"
                class="bedroom-filter"
            >

            4+ BHK

        </label>

    </div>

</div>
                            <!-- PRICE -->
                            <div class="filter-section">
                                <label class="filter-label"><i class="fas fa-rupee-sign"></i> Price</label>
                                <div id="slider-range-price" class="mb-3"></div>
                                <div class="flex justify-between text-xs font-bold text-brand-600 bg-brand-50 rounded-lg px-3 py-2">
                                    <span id="price-min-val">₹0</span>
                                    <span id="price-max-val">₹5 Cr</span>
                                                                </div>
                                <input type="hidden" name="min_price" id="min_price" value="0">
                                <input type="hidden" name="max_price" id="max_price" value="50000000">
                                                                                    </div>

                            <!-- SORT -->
                            <div class="filter-section">
                                <label class="filter-label"><i class="fas fa-sort"></i> Sort By</label>
                                <select class="w-full filter-select" name="sort">
                                    <option value="default">Default</option>
                                    <option value="price_low">Price: Low to High</option>
                                    <option value="price_high">Price: High to Low</option>
                                    <option value="newest">Newest First</option>
                                </select>
                            </div>

                            <button type="button" id="applyFiltersBtn" class="w-full btn-primary-c !rounded-xl !py-3.5 text-sm !shadow-lg !shadow-brand-500/20">
                                <i class="fas fa-search mr-2"></i>Apply Filters
                            </button>
                        </div>

                        <!-- AGENT SIDEBAR CARD -->
                    </div>

                    <!-- ═══════ MAIN CONTENT ═══════ -->
                    <div class="w-full lg:w-3/4 min-w-0">
                        <!-- Active Filter Tags -->
                        <div id="activeFiltersTags" class="active-filters" style="display:none"></div>

                        <!-- Result Count -->
                        <div class="flex items-center justify-between mb-5">
                            <p class="text-sm text-gray-500" id="resultCount">
                                <i class="fas fa-circle-notch fa-spin mr-2 text-brand-500"></i>Loading properties...
                            </p>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active grid_body" id="homec-grid" role="tabpanel">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="grid-container"></div>
                            </div>
                            <div class="tab-pane fade list_body" id="homec-list" role="tabpanel" style="display:none">
                                <div class="flex flex-col gap-5" id="list-container"></div>
                            </div>
                            <div class="tab-pane fade map_body" id="map-grid" role="tabpanel" style="display:none">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- ═══════════ ENQUIRY MODAL ═══════════ -->
    <div class="fixed inset-0 z-[100] hidden" id="enquiryModal">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeEnquiry()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-7 relative modal-anim">
                <button onclick="closeEnquiry()" class="absolute top-4 right-4 w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition text-gray-500">
                    <i class="fas fa-times text-sm"></i>
                </button>
                <div class="text-center mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-50 to-brand-100 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-paper-plane text-brand-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark-900" id="enquiryTitle">Enquire Now</h3>
                    <p class="text-gray-500 text-sm mt-1">Get exclusive pricing & floor plans</p>
                </div>
                <form id="enquiryForm" class="space-y-4" novalidate>
                    @csrf
                    <input type="hidden" name="property_name" id="enquiryPropertyName">
                    <div>
                        <input type="text" name="name" id="enqName" placeholder="Full Name *" required
                            class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border-2 border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        <p class="field-error" id="errName">Please enter your full name</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-1">
                            <input type="tel" name="phone" id="enqPhone" placeholder="Phone *" required
                                class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border-2 border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                            <p class="field-error" id="errPhone">Enter a valid phone number</p>
                        </div>
                        <div class="flex-1">
                            <input type="email" name="email" id="enqEmail" placeholder="Email"
                                class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border-2 border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                            <p class="field-error" id="errEmail">Enter a valid email</p>
                        </div>
                    </div>
                    <div>
                        <textarea name="message" rows="3" placeholder="Any specific requirement?"
                            class="w-full px-4 py-3 bg-gray-50 rounded-xl text-sm outline-none border-2 border-gray-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
                    </div>
                    <button type="submit" id="enquirySubmitBtn" class="w-full btn-primary-c !rounded-xl !py-3.5 text-sm">
                        <span id="enqBtnText"><i class="fas fa-paper-plane mr-2"></i>Get Free Consultation</span>
                        <i class="fas fa-spinner fa-spin" id="enqBtnSpinner" style="display:none"></i>
                    </button>
                    <p class="text-[10px] text-gray-400 text-center">By submitting, you agree to our Privacy Policy & Terms</p>
                </form>
            </div>
        </div>
    </div>

    <!-- ═══════════ BACK TO TOP ═══════════ -->
    <button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- ═══════════ FOOTER ═══════════ -->
    <footer class="bg-dark-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
                <div class="col-span-2 md:col-span-4 lg:col-span-1">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-lg shadow-brand-500/20">
                            <i class="fas fa-building text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-extrabold">Real<span class="text-brand-500">Estate</span></span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">Premium real estate platform offering the best properties across India.</p>
                    <div class="flex gap-2">
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center hover:bg-brand-600 transition text-gray-400 hover:text-white"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center hover:bg-brand-600 transition text-gray-400 hover:text-white"><i class="fab fa-instagram text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center hover:bg-brand-600 transition text-gray-400 hover:text-white"><i class="fab fa-twitter text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center hover:bg-brand-600 transition text-gray-400 hover:text-white"><i class="fab fa-youtube text-sm"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="font-bold text-sm mb-5 text-white">Quick Links</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/') }}" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Home</a></li>
                        <li><a href="{{ route('properties') }}" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Properties</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Agents</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-sm mb-5 text-white">Property Types</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Apartments</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Villas</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Plots</a></li>
                        <li><a href="#" class="text-gray-400 text-sm hover:text-brand-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-brand-600"></i>Commercial</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-sm mb-5 text-white">Contact Us</h5>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-400 text-sm"><i class="fas fa-phone text-brand-500 text-xs mt-1"></i><span>+91 98765 43210</span></li>
                        <li class="flex items-start gap-3 text-gray-400 text-sm"><i class="fas fa-envelope text-brand-500 text-xs mt-1"></i><span>info@example.com</span></li>
                        <li class="flex items-start gap-3 text-gray-400 text-sm"><i class="fas fa-map-marker-alt text-brand-500 text-xs mt-1"></i><span>Mumbai, Maharashtra, India</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-xs">&copy; {{ date('Y') }} RealEstate. All Rights Reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-500 text-xs hover:text-brand-400 transition">Privacy Policy</a>
                    <a href="#" class="text-gray-500 text-xs hover:text-brand-400 transition">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Swiper JS (must load after DOM) -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
 $(document).ready(function() {

    /* ══════════════════════════════════════
       CONFIGURATION
    ══════════════════════════════════════ */
    var AJAX_URL   = "{{ route('properties-with-ajax') }}";
    var BASE_URL   = "{{ url('/') }}";
    var CSRF_TOKEN = "{{ csrf_token() }}";

    var propertiesData   = [];
    var allPropertiesRaw = [];
    var wishlist = JSON.parse(localStorage.getItem('property_wishlist') || '[]');
    var map = null;
    var markersCluster = null;
    var isLoading  = false;
    var currentView = 'grid';
    var searchTimer = null;

    /* ══════════════════════════════════════
       TOAST CONFIG
    ══════════════════════════════════════ */
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        showDuration: 200,
        hideDuration: 800,
        timeOut: 4000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'
    };

    /* ══════════════════════════════════════
       SELECT2 INIT
    ══════════════════════════════════════ */
    $('.filter-select').select2({
        allowClear: true,
        minimumResultsForSearch: 6,
        dropdownAutoWidth: true
    });

    /* ══════════════════════════════════════
       LOAD CITIES (AJAX → fallback static)
    ══════════════════════════════════════ */
    function loadCities() {
        $.get(BASE_URL + '/get-cities', function(res) {
            var $sel = $('#city_selector');
            $sel.find('option:not(:first)').remove();
            if (Array.isArray(res)) {
                res.forEach(function(c) {
                    $sel.append('<option value="' + c.id + '">' + c.name + '</option>');
                });
            }
            $sel.trigger('change');
        }).fail(function() {
            var fallback = ['Mumbai','Pune','Delhi','Bangalore','Hyderabad','Chennai','Kolkata','Ahmedabad'];
            var $sel = $('#city_selector');
            fallback.forEach(function(name) {
                $sel.append('<option value="' + name.toLowerCase() + '">' + name + '</option>');
            });
            $sel.trigger('change');
        });
    }

    /* ══════════════════════════════════════
       LOAD PROPERTY TYPES (AJAX → fallback)
    ══════════════════════════════════════ */
    function loadPropertyTypes() {
        $.get(BASE_URL + '/get-property-types', function(res) {
            var $sel = $('select[name="type"]');
            $sel.find('option:not(:first)').remove();
            if (Array.isArray(res)) {
                res.forEach(function(t) {
                    $sel.append('<option value="' + t.slug + '">' + t.name + '</option>');
                });
            }
            $sel.trigger('change');
        }).fail(function() {
            var fallback = [
                {slug:'apartment',name:'Apartment'},
                {slug:'villa',name:'Villa'},
                {slug:'commercial',name:'Commercial'},
                {slug:'plot',name:'Plot'},
                {slug:'penthouse',name:'Penthouse'}
            ];
            var $sel = $('select[name="type"]');
            fallback.forEach(function(t) {
                $sel.append('<option value="' + t.slug + '">' + t.name + '</option>');
            });
            $sel.trigger('change');
        });
    }

    /* ══════════════════════════════════════
       LOAD AGENTS FOR SIDEBAR
    ══════════════════════════════════════ */
    function loadAgents() {
        $.get(BASE_URL + '/get-agents-sidebar', function(res) {
            var html = '';
            if (Array.isArray(res) && res.length > 0) {
                res.forEach(function(a) {
                    html += '<div class="swiper-slide text-center">';
                    html += '<img src="' + (a.image || 'https://picsum.photos/seed/agent'+a.id+'/80/80') + '" class="w-14 h-14 rounded-full mx-auto mb-2 border-2 border-white/30 object-cover">';
                    html += '<h5 class="text-white text-xs font-semibold">' + a.name + '</h5>';
                    if (a.designation) html += '<p class="text-gray-400 text-[10px]">' + a.designation + '</p>';
                    html += '</div>';
                });
            } else {
                for (var i = 1; i <= 4; i++) {
                    html += '<div class="swiper-slide text-center">';
                    html += '<img src="https://picsum.photos/seed/agent'+i+'/80/80" class="w-14 h-14 rounded-full mx-auto mb-2 border-2 border-white/30 object-cover">';
                    html += '<h5 class="text-white text-xs font-semibold">Agent '+i+'</h5>';
                    html += '</div>';
                }
            }
            $('#agentSwiperWrapper').html(html);
            new Swiper('.agentSwiper', {
                slidesPerView: 2,
                spaceBetween: 12,
                pagination: { el: '.agentSwiper .swiper-pagination', clickable: true }
            });
        }).fail(function() {
            var html = '';
            for (var i = 1; i <= 4; i++) {
                html += '<div class="swiper-slide text-center">';
                html += '<img src="https://picsum.photos/seed/agent'+i+'/80/80" class="w-14 h-14 rounded-full mx-auto mb-2 border-2 border-white/30 object-cover">';
                html += '<h5 class="text-white text-xs font-semibold">Agent '+i+'</h5>';
                html += '</div>';
            }
            $('#agentSwiperWrapper').html(html);
            new Swiper('.agentSwiper', {
                slidesPerView: 2,
                spaceBetween: 12,
                pagination: { el: '.agentSwiper .swiper-pagination', clickable: true }
            });
        });
    }

    /* ══════════════════════════════════════
       PRICE SLIDER (only price, no area)
    ══════════════════════════════════════ */
    $('#slider-range-price').slider({

range: true,

min: 0,

max: 50000000,
step: 1000,

values: [0, 50000000],
slide: function(event, ui) {

    $('#price-min-val').text(
        formatPriceShort(ui.values[0])
    );

    $('#price-max-val').text(
        formatPriceShort(ui.values[1])
    );

    $('#min_price').val(ui.values[0]);

    $('#max_price').val(ui.values[1]);

}

});
    /* ══════════════════════════════════════
       PRICE FORMAT HELPERS
    ══════════════════════════════════════ */
    function formatPriceShort(num)
{

    if (!num || num == 0) {

        return '₹0';

    }

    num = parseInt(num);

    return '₹' + num.toLocaleString('en-IN');

}

function formatPriceFull(num)
{

    if (!num || num == 0) {

        return 'Price on Request';

    }

    num = parseInt(num);

    return '₹' + num.toLocaleString('en-IN');

}

    /* ══════════════════════════════════════
       HEART SVG ICON
    ══════════════════════════════════════ */
    function heartSvg() {
        return '<svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>';
    }

    /* ══════════════════════════════════════
       FETCH PROPERTIES (MAIN AJAX CALL)
       Uses serialize() on the form
    ══════════════════════════════════════ */
    function fetchProperties() {
        if (isLoading) return;
        isLoading = true;
        showLoadingSkeletons();

        $.ajax({
            url: AJAX_URL,
            type: 'GET',
            data: $('#propertySearchForm').serialize(),
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            success: function(res) {
                if (!Array.isArray(res)) {
                    console.error('Invalid response:', res);
                    isLoading = false;
                    showNoResults();
                    return;
                }

                allPropertiesRaw = res;

                // Client-side sort (after server returns data)
                var sortVal = $('select[name="sort"]').val();
                var sorted = sortProperties(res, sortVal);
                propertiesData = sorted;

                renderGrid(sorted);
                renderList(sorted);
                renderMap(sorted);
                updateResultCount(sorted.length);
                updateActiveFilterTags();

                isLoading = false;
            },
            error: function(xhr) {
                isLoading = false;
                toastr.error('Failed to load properties. Please try again.');
                showNoResults();
            }
        });
    }

    /* ══════════════════════════════════════
       CLIENT-SIDE SORT
    ══════════════════════════════════════ */
    function sortProperties(data, sort) {
        var s = data.slice();
        switch(sort) {
            case 'price_low':
                s.sort(function(a,b){

return (parseFloat(a.expected_price || a.expected_rent) || 0)

- (parseFloat(b.expected_price || b.expected_rent) || 0);

});
                break;
            case 'price_high':
                s.sort(function(a,b){ return (parseFloat(b.expected_price || b.expected_rent)||0) - (parseFloat(a.expected_price || a.expected_rent)||0); });
                break;
            case 'newest':
            default:
                s.sort(function(a,b){ return b.id - a.id; });
                break;
        }
        return s;
    }

    /* ══════════════════════════════════════
       LOADING SKELETON
    ══════════════════════════════════════ */
    function showLoadingSkeletons() {
        var g = '';
        for (var i = 0; i < 6; i++) {
            g += '<div class="skeleton-card">'
               + '<div class="loading-skeleton skeleton-img"></div>'
               + '<div class="skeleton-line price" style="margin-top:18px"></div>'
               + '<div class="skeleton-line h6 w80"></div>'
               + '<div class="skeleton-line w60"></div>'
               + '<div class="skeleton-line w40"></div>'
               + '<div class="skeleton-btn"></div>'
               + '</div>';
        }
        $('#grid-container').html(g);

        var l = '';
        for (var j = 0; j < 3; j++) {
            l += '<div class="skeleton-card skeleton-list-card">'
               + '<div class="loading-skeleton skeleton-list-img"></div>'
               + '<div class="flex-1 p-5">'
               + '<div class="loading-skeleton skeleton-line price" style="margin:10px 0"></div>'
               + '<div class="loading-skeleton skeleton-line h6 w80" style="margin:10px 0"></div>'
               + '<div class="loading-skeleton skeleton-line w60" style="margin:10px 0"></div>'
               + '<div class="loading-skeleton skeleton-line w40" style="margin:10px 0"></div>'
               + '<div class="loading-skeleton" style="height:42px;border-radius:999px;margin:16px 0;width:200px"></div>'
               + '</div></div>';
        }
        $('#list-container').html(l);
    }

    function showNoResults() {
        var h = '<div class="no-results-box col-span-full">'
              + '<div class="icon-wrap"><i class="fas fa-building-circle-xmark"></i></div>'
              + '<h4>No Properties Found</h4>'
              + '<p>Try adjusting your filters or search terms to find what you\'re looking for</p>'
              + '<button onclick="clearAllFiltersFn()" class="btn-primary-c mt-6 !py-2.5 !px-6 text-sm">'
              + '<i class="fas fa-rotate-left mr-2"></i>Reset Filters</button></div>';
        $('#grid-container').html(h);
        $('#list-container').html(h);
        updateResultCount(0);
    }

    /* ══════════════════════════════════════
       RENDER GRID VIEW
    ══════════════════════════════════════ */
    function renderGrid(data) {
        if (data.length === 0) { showNoResults(); return; }

        var html = '';
        data.forEach(function(item, idx) {
            var isWish   = wishlist.indexOf(item.id) > -1;
            var badge = '';

if (item.purpose === 'rent') {

    badge = '<span class="homec-property__salebadge">For Rent</span>';

}
else if (item.purpose === 'sale') {

    badge = '<span class="homec-property__salebadge">For Sale</span>';

}
else if (item.purpose === 'pg') {

    badge = '<span class="homec-property__salebadge">PG</span>';

}
else {

    badge = '<span class="homec-property__salebadge">Property</span>';

}




var priceStr = 'Price On Request';

if (
    item.expected_price &&
    Number(item.expected_price) > 0
) {

    priceStr = '₹' + Number(item.expected_price)
        .toLocaleString('en-IN');

}
else if (
    item.expected_rent &&
    Number(item.expected_rent) > 0
) {

    priceStr = '₹' + Number(item.expected_rent)
        .toLocaleString('en-IN');

}

          
            var addr     = item.address || 'Location not available';
            var slug     = item.slug || '';
            var img      = item.thumbnail_image || 'https://picsum.photos/seed/prop'+item.id+'/600/400';
            var title    = item.title || 'Untitled Property';
            var delay    = (idx * 0.06) + 's';

            html += '<div class="homec-property" style="animation-delay:' + delay + '">';
            html += '  <div class="homec-property__head">';
            html += '    <img src="' + img + '" alt="' + title + '" loading="lazy" onerror="this.src=\'https://picsum.photos/seed/fallback'+item.id+'/600/400\'">';
            html += '    <div class="homec-property__hsticky">';
            html += '      <div>' + badge + '</div>';
            html += '      <a class="homec-heart ' + (isWish ? 'wishlisted' : '') + '" onclick="toggleWishlist(' + item.id + ', this)" title="Add to Wishlist">' + heartSvg() + '</a>';
            html += '    </div>';
            html += '  </div>';
            html += '  <div class="homec-property__body">';
            html += '    <div class="homec-property__price">' + priceStr + '</div>';
                        html += '    <div class="homec-property__title mb-1"><a href="' + BASE_URL + '/' + slug + '">' + title + '</a></div>';
            html += '    <div class="homec-property__text mb-3"><i class="fas fa-map-marker-alt"></i> <span>' + addr + '</span></div>';
            html += '    <ul class="homec-property__list">';
          
            html += '    </ul>';
            html += '    <div class="homec-property__enquire">';
            html += '      <button class="btn-outline-c w-full !py-2.5" onclick="openEnquiry(\'' + title.replace(/'/g, "\\'") + '\')"><i class="fas fa-envelope mr-2"></i>Enquire Now</button>';
            html += '    </div>';
            html += '  </div>';
            html += '</div>';
        });

        $('#grid-container').html(html);
    }

    /* ══════════════════════════════════════
       RENDER LIST VIEW
    ══════════════════════════════════════ */
    function renderList(data) {

if (data.length === 0) {

    showNoResults();

    return;
}

var html = '';

data.forEach(function(item, idx) {

    // =====================================
    // BADGE
    // =====================================

    var badge = '';

    if (item.purpose === 'rent') {

        badge = '<span class="homec-property__salebadge">For Rent</span>';

    }
    else if (item.purpose === 'sale') {

        badge = '<span class="homec-property__salebadge">For Sale</span>';

    }
    else if (item.purpose === 'pg') {

        badge = '<span class="homec-property__salebadge">PG</span>';

    }
    else {

        badge = '<span class="homec-property__salebadge">Property</span>';

    }

    // =====================================
    // PRICE
    // =====================================

    var priceStr = 'Price On Request';

if (
    item.expected_price &&
    Number(item.expected_price) > 0
) {

    priceStr = '₹' + Number(item.expected_price)
        .toLocaleString('en-IN');

}
else if (
    item.expected_rent &&
    Number(item.expected_rent) > 0
) {

    priceStr = '₹' + Number(item.expected_rent)
        .toLocaleString('en-IN');

}
    // =====================================
    // OTHER DATA
    // =====================================

    var addr = item.address || 'Location not available';

    var slug = item.slug || '';

    var img = item.thumbnail_image
        || 'https://picsum.photos/seed/prop' + item.id + '/600/400';

    var title = item.title || 'Untitled Property';

    var delay = (idx * 0.06) + 's';

    // =====================================
    // HTML
    // =====================================

    html += '<div class="homec-property list-card" style="animation-delay:' + delay + '">';

    // IMAGE
    html += '  <div class="homec-property__head">';

    html += '    <img src="' + img + '" ';
    html += '         alt="' + title + '" ';
    html += '         loading="lazy" ';
    html += '         onerror="this.src=\'https://picsum.photos/seed/fallback'+item.id+'/600/400\'">';

    html += '    <div class="homec-property__hsticky">';
    html += '      <div>' + badge + '</div>';
    html += '    </div>';

    html += '  </div>';

    // BODY
    html += '  <div class="homec-property__body flex-1 flex flex-col justify-between">';

    html += '    <div>';

    // PRICE
    html += '      <div class="homec-property__price">';
    html +=              priceStr;
    html += '      </div>';

    // TITLE
    html += '      <div class="homec-property__title mb-1">';
    html += '          <a href="' + BASE_URL + '/' + slug + '">';
    html +=                title;
    html += '          </a>';
    html += '      </div>';

    // ADDRESS
    html += '      <div class="homec-property__text mb-3">';

    html += '          <i class="fas fa-map-marker-alt"></i> ';

    html += '          <span>';
    html +=                addr;
    html += '          </span>';

    html += '      </div>';

    // FEATURES
    html += '      <ul class="homec-property__list">';

    // BEDROOM
    html += '          <li>';

    html += '              <i class="fas fa-bed"></i> ';

    html +=                (item.total_bedroom || 0) + ' Bed';

    html += '          </li>';

    // BATHROOM
    html += '          <li>';

    html += '              <i class="fas fa-bath"></i> ';

    html +=                (item.total_bathroom || 0) + ' Bath';

    html += '          </li>';

    html += '      </ul>';

    html += '    </div>';

    // BUTTONS
    html += '    <div class="flex gap-2 mt-3">';

    // VIEW DETAILS
    html += '      <a href="' + BASE_URL + '/' + slug + '" ';
    html += '         class="btn-outline-c flex-1 !py-2.5 !text-xs">';

    html += '          <i class="fas fa-eye mr-1.5"></i>';

    html += '          View Details';

    html += '      </a>';

    // ENQUIRE
    html += '      <button ';
    html += '          class="btn-primary-c flex-1 !py-2.5 !text-xs !rounded-full" ';
    html += '          onclick="openEnquiry(\'' + title.replace(/'/g, "\\'") + '\')">';

    html += '          <i class="fas fa-envelope mr-1.5"></i>';

    html += '          Enquire';

    html += '      </button>';

    html += '    </div>';

    html += '  </div>';

    html += '</div>';

});

$('#list-container').html(html);
}
    /* ══════════════════════════════════════
       RENDER MAP VIEW
    ══════════════════════════════════════ */
    function renderMap(data) {
        if (!map) {
            map = L.map('map').setView([19.0760, 72.8777], 5);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
        }

        if (markersCluster) {
            map.removeLayer(markersCluster);
        }

        markersCluster = L.markerClusterGroup({
            iconCreateFunction: function(cluster) {
                var count = cluster.getChildCount();
                return L.divIcon({
                    html: '<div style="background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;font-weight:700;font-size:13px;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(249,115,22,.4);border:3px solid #fff">' + count + '</div>',
                    className: '',
                    iconSize: [40, 40]
                });
            }
        });

        var hasMarker = false;
        data.forEach(function(item) {
            if (item.lat && item.lon && parseFloat(item.lat) !== 0 && parseFloat(item.lon) !== 0) {
                hasMarker = true;
                var priceStr = 'Price On Request';

if (
    item.expected_price &&
    Number(item.expected_price) > 0
) {

    priceStr = '₹' + Number(item.expected_price)
        .toLocaleString('en-IN');

}
else if (
    item.expected_rent &&
    Number(item.expected_rent) > 0
) {

    priceStr = '₹' + Number(item.expected_rent)
        .toLocaleString('en-IN');

}

                var icon = L.divIcon({
                    html: '<div style="background:#f97316;color:#fff;font-size:10px;font-weight:700;padding:3px 8px;border-radius:6px;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,0,.2);border:2px solid #fff">' + priceStr + '</div>',
                    className: '',
                    iconAnchor: [40, 40]
                });

                var marker = L.marker([item.lat, item.lon], { icon: icon });
                marker.bindPopup(
                    '<div style="font-family:Inter,sans-serif">'
                    + '<img src="' + (item.thumbnail_image || '') + '" style="width:100%;height:140px;object-fit:cover" onerror="this.style.display=\'none\'">'
                    + '<div style="padding:12px">'
                    + '<div style="font-size:14px;font-weight:700;color:#1a1a1a;margin-bottom:4px">' + (item.title || '') + '</div>'
                    + '<div style="color:#c2410c;font-weight:800;font-size:15px;margin-bottom:6px">' + priceStr + '</div>'
                    + '<div style="font-size:12px;color:#6b7280;margin-bottom:8px"><i class="fas fa-map-marker-alt" style="color:#f97316;margin-right:4px"></i>' + (item.address || '') + '</div>'
                    + '<a href="' + BASE_URL + '/property/' + (item.slug || '') + '" style="display:inline-block;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:600;text-decoration:none">View Details &rarr;</a>'
                    + '</div></div>',
                    { maxWidth: 260 }
                );
                markersCluster.addLayer(marker);
            }
        });

        map.addLayer(markersCluster);

        if (hasMarker) {
            setTimeout(function() {
                map.fitBounds(markersCluster.getBounds().pad(0.15));
            }, 200);
        }

        setTimeout(function() { map.invalidateSize(); }, 400);
    }

    /* ══════════════════════════════════════
       UPDATE RESULT COUNT
    ══════════════════════════════════════ */
    function updateResultCount(count) {
        var el = $('#resultCount');
        if (count === 0) {
            el.html('<i class="fas fa-exclamation-circle text-amber-500 mr-2"></i>No properties found');
        } else {
            el.html('<i class="fas fa-check-circle text-green-500 mr-2"></i>Showing <strong class="text-gray-800">' + count + '</strong> properties');
        }
    }

    /* ══════════════════════════════════════
       ACTIVE FILTER TAGS (supports bedroom[])
    ══════════════════════════════════════ */
    function updateActiveFilterTags() {
        var tags = [];
        var $f = $('#propertySearchForm');

        // Search
        if ($('#searchInput').val().trim()) {
            tags.push({ label: 'Search: "' + $('#searchInput').val().trim() + '"', field: 'search' });
        }

       // Purpose
var purpose = $f.find('select[name="purpose"]').val();

if (purpose && purpose !== 'any') {

    let purposeLabel = 'For Sale';

    if (purpose === 'rent') {

        purposeLabel = 'For Rent';

    }
    else if (purpose === 'pg') {

        purposeLabel = 'For PG';

    }
    else if (purpose === 'sale') {

        purposeLabel = 'For Sale';

    }

    tags.push({
        label: purposeLabel,
        field: 'purpose'
    });
}

        // City
        var cityVal = $f.find('select[name="city"]').val();
        if (cityVal) {
            var cityText = $f.find('select[name="city"] option:selected').text();
            tags.push({ label: 'City: ' + cityText, field: 'city' });
        }

        // Type
        var typeVal = $f.find('select[name="type"]').val();
        if (typeVal) {
            var typeText = $f.find('select[name="type"] option:selected').text();
            tags.push({ label: 'Type: ' + typeText, field: 'type' });
        }

        // Bedroom [] — iterate checked checkboxes with class "bedroom-filter"
        $f.find('input.bedroom-filter:checked').each(function() {
            tags.push({ label: $(this).val() + ' BHK', field: 'bedroom', value: $(this).val() });
        });

        // Price
        var minP = parseInt($('#min_price').val());
        var maxP = parseInt($('#max_price').val());
        if (minP > 0 || maxP < 50000000) {
            tags.push({
                label: 'Price: ' + formatPriceShort(minP) + ' - ' + (maxP >= 50000000 ? '₹5 Cr+' : formatPriceShort(maxP)),
                field: 'price'
            });
        }

        if (tags.length === 0) {
            $('#activeFiltersTags').hide();
            $('#clearAllFilters').hide();
            return;
        }

        $('#activeFiltersTags').show();
        $('#clearAllFilters').show();

        var html = '';
        tags.forEach(function(t) {
            html += '<span class="active-filter-tag">' + t.label;
            html += '<button type="button" data-field="' + t.field + '" data-value="' + (t.value || '') + '" onclick="removeFilter(this)"><i class="fas fa-times"></i></button>';
            html += '</span>';
        });
        $('#activeFiltersTags').html(html);
    }

    /* ══════════════════════════════════════
       REMOVE SINGLE FILTER (supports bedroom[])
    ══════════════════════════════════════ */
    window.removeFilter = function(btn) {
        var field = $(btn).data('field');
        var value = $(btn).data('value');

        switch(field) {
            case 'search':
                $('#searchInput').val('');
                break;
            case 'purpose':
                $('select[name="purpose"]').val('any').trigger('change');
                break;
            case 'city':
                $('select[name="city"]').val('').trigger('change');
                break;
            case 'type':
                $('select[name="type"]').val('').trigger('change');
                break;
            case 'bedroom':
                // Uncheck the specific bedroom checkbox by value
                $('input.bedroom-filter[value="' + value + '"]').prop('checked', false);
                $('input.bedroom-filter[value="' + value + '"]').closest('.checkbox-pill').removeClass('checked');
                break;
            case 'price':
                $('#slider-range-price').slider('values', [0, 50000000]);
                                $('#min_price').val(0);
                $('#max_price').val(50000000);
                $('#price-min-val').text('₹0');
                $('#price-max-val').text('₹5 Cr');
                break;
        }
        fetchProperties();
    };

    /* ══════════════════════════════════════
       CLEAR ALL FILTERS
    ══════════════════════════════════════ */
    window.clearAllFiltersFn = function() {
        $('#searchInput').val('');
        $('select[name="purpose"]').val('any').trigger('change');
        $('select[name="city"]').val('').trigger('change');
        $('select[name="type"]').val('').trigger('change');
        $('select[name="sort"]').val('default').trigger('change');

        // Clear all bedroom checkboxes
        $('input.bedroom-filter').prop('checked', false);
        $('.checkbox-pill').removeClass('checked');

        // Reset price slider
        $('#slider-range-price').slider('values', [0, 50000000]);
                $('#min_price').val(0);
        $('#max_price').val(50000000);
        $('#price-min-val').text('₹0');
        $('#price-max-val').text('₹5 Cr');

        fetchProperties();
    };

    $('#clearAllFilters').on('click', clearAllFiltersFn);

    /* ══════════════════════════════════════
       VIEW SWITCHING (Grid / List / Map)
    ══════════════════════════════════════ */
    window.switchView = function(view) {
        currentView = view;
        $('.list-group-item').removeClass('active');

        if (view === 'grid') {
            $('.grid_view').addClass('active');
            $('#homec-grid').show();
            $('#homec-list').hide();
            $('#map-grid').hide();
        } else if (view === 'list') {
            $('.list_view').addClass('active');
            $('#homec-grid').hide();
            $('#homec-list').show();
            $('#map-grid').hide();
        } else if (view === 'map') {
            $('.map_view').addClass('active');
            $('#homec-grid').hide();
            $('#homec-list').hide();
            $('#map-grid').show();
            if (map) {
                setTimeout(function() { map.invalidateSize(); }, 200);
            }
        }
    };

    /* ══════════════════════════════════════
       WISHLIST TOGGLE (localStorage)
    ══════════════════════════════════════ */
    window.toggleWishlist = function(id, el) {
        var idx = wishlist.indexOf(id);
        if (idx > -1) {
            wishlist.splice(idx, 1);
            $(el).removeClass('wishlisted');
            toastr.info('Removed from wishlist');
        } else {
            wishlist.push(id);
            $(el).addClass('wishlisted');
            toastr.success('Added to wishlist!');
        }
        localStorage.setItem('property_wishlist', JSON.stringify(wishlist));
    };

    /* ══════════════════════════════════════
       ENQUIRY MODAL
    ══════════════════════════════════════ */
    window.openEnquiry = function(title) {
        $('#enquiryPropertyName').val(title);
        $('#enquiryTitle').text(title ? 'Enquire: ' + title : 'Enquire Now');
        $('#enquiryModal').removeClass('hidden');
        $('body').css('overflow', 'hidden');
    };

    window.closeEnquiry = function() {
        $('#enquiryModal').addClass('hidden');
        $('body').css('overflow', '');
        resetEnquiryForm();
    };

    function resetEnquiryForm() {
        $('#enquiryForm')[0].reset();
        $('#enquiryForm input, #enquiryForm textarea').removeClass('input-error');
        $('.field-error').removeClass('show');
        $('#enqBtnText').show();
        $('#enqBtnSpinner').hide();
    }

    // Enquiry form submit
    $('#enquiryForm').on('submit', function(e) {
        e.preventDefault();

        var valid = true;
        var name  = $.trim($('#enqName').val());
        var phone = $.trim($('#enqPhone').val());
        var email = $.trim($('#enqEmail').val());

        $(this).find('input,textarea').removeClass('input-error');
        $('.field-error').removeClass('show');

        if (!name) {
            $('#enqName').addClass('input-error');
            $('#errName').addClass('show');
            valid = false;
        }
        if (!phone || phone.length < 10) {
            $('#enqPhone').addClass('input-error');
            $('#errPhone').addClass('show');
            valid = false;
        }
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#enqEmail').addClass('input-error');
            $('#errEmail').addClass('show');
            valid = false;
        }

        if (!valid) return;

        $('#enqBtnText').hide();
        $('#enqBtnSpinner').show();

        // AJAX submit
        $.ajax({
            url: '{{ route("enquiry.store") }}',
            type: 'POST',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            success: function(res) {
                $('#enqBtnText').show();
                $('#enqBtnSpinner').hide();
                toastr.success('Enquiry submitted successfully! We will contact you soon.');
                closeEnquiry();
            },
            error: function(xhr) {
                $('#enqBtnText').show();
                $('#enqBtnSpinner').hide();
                toastr.error('Something went wrong. Please try again.');
            }
        });
    });

    // Remove error on input
    $('#enqName, #enqPhone, #enqEmail').on('input', function() {
        $(this).removeClass('input-error');
        $(this).next('.field-error').removeClass('show');
    });

    /* ══════════════════════════════════════
       EVENT BINDINGS
    ══════════════════════════════════════ */

    // Search button click
    $('#searchPropertyBtn').on('click', fetchProperties);

    // Apply filters button
    $('#applyFiltersBtn').on('click', fetchProperties);

    // Debounced search on keyup
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(fetchProperties, 400);
    });

    // Select2 change triggers fetch
    $('.filter-select').on('change', fetchProperties);

    // Bedroom checkbox change → toggle pill style + fetch
    $('input.bedroom-filter').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).closest('.checkbox-pill').addClass('checked');
        } else {
            $(this).closest('.checkbox-pill').removeClass('checked');
        }
        fetchProperties();
    });

    // Sort change → client-side re-sort only (no AJAX)
    $('select[name="sort"]').on('change', function() {
        var sorted = sortProperties(propertiesData, $(this).val());
        propertiesData = sorted;
        renderGrid(sorted);
        renderList(sorted);
    });

    /* ══════════════════════════════════════
       BACK TO TOP
    ══════════════════════════════════════ */
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 400) {
            $('#backToTop').addClass('show');
        } else {
            $('#backToTop').removeClass('show');
        }
    });

    /* ══════════════════════════════════════
       MOBILE MENU (simple toggle)
    ══════════════════════════════════════ */
    $('#mobileMenuBtn').on('click', function() {
        // Toggle a simple mobile menu (extend as needed)
        toastr.info('Mobile menu - customize as needed');
    });

    /* ══════════════════════════════════════
       INITIALIZE
    ══════════════════════════════════════ */
    loadCities();
    loadPropertyTypes();
    loadAgents();
    fetchProperties();

});
</script>
<script>

$('#state_selector').on('change', function () {

    let stateId = $(this).val();

    $('#city_selector').html(
        '<option value="">Loading...</option>'
    );

    $.ajax({

        url: "{{ route('get.cities.by.state') }}",

        type: "GET",

        data: {
            state_id: stateId
        },

        success: function (res) {

            let html =
                '<option value="">All Cities</option>';

            $.each(res, function (key, city) {

                html += `
                    <option value="${city.id}">
                        ${city.name}
                    </option>
                `;

            });

            $('#city_selector').html(html);

        }

    });

});

</script>
</body>
</html>