<!doctype html>
<html lang="en"><!-- [Head] start -->

<title>{{config('app.name')}}</title><!-- [Meta] -->

<link rel="icon" href="{{asset('logo.png')}}" type="image/x-icon"><!-- [Font] Family -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Able Pro is trending dashboard template made using Bootstrap 5 design framework. Able Pro is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
          content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="Phoenixcoded"><!-- [Favicon] icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/inter/inter.css')}}" id="main-font-link">
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{asset('assets/fonts/phosphor/duotone/style.css')}}">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/tabler-icons.min.css')}}"><!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather.css')}}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome.css')}}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/material.css')}}"><!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" id="main-style-link">
    <script src="{{asset('assets/js/tech-stack.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/style-preset.css')}}">
</head><!-- [Head] end --><!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
      data-pc-theme_contrast="" data-pc-theme="light"><!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div><!-- [ Pre-loader ] End -->
<div class="auth-main">
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <div class="text-center">
                        <a href="#"><img src="{{asset('logo.png')}}" alt="{{config('app.name')}}" style="width: 270px;"></a>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
{{--                    <h4 class="text-center f-w-500 mb  -3">DIY Portal</h4>--}}
                    <h4 class="text-center f-w-500 mb-3">{{$headerText}}</h4>
                    {{$slot}}

                </div>
            </div>
        </div>
    </div>
</div><!-- [ Main Content ] end --><!-- Required Js -->
<script src="{{asset('assets/js/plugins/popper.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/simplebar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/i18next.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/i18nextHttpBackend.min.js')}}"></script>
<script src="{{asset('assets/js/icon/custom-font.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>
<script src="{{asset('assets/js/multi-lang.js')}}"></script>
<script src="{{asset('assets/js/plugins/feather.min.js')}}"></script>

<script>layout_change('light');</script>
<script>change_box_container('false');</script>
<script>layout_caption_change('true');</script>
<script>layout_rtl_change('false');</script>
<script>preset_change('preset-8');</script>
<script>main_layout_change('vertical');</script>
</html>
