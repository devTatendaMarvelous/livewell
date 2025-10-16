
    <!doctype html>
<html lang="en"><!-- [Head] start -->

<head>
    <title>{{config('app.name')}}</title><!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Coverlink"><!-- [Favicon] icon -->
    <link rel="icon" href="{{asset('logo.svg')}}" type="image/x-icon"><!-- [Font] Family -->
    <link rel="stylesheet" href="{{asset('assets/fonts/inter/inter.css')}}" id="main-font-link">
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{asset('assets/fonts/phosphor/duotone/style.css')}}">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/tabler-icons.min.css')}}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather.css')}}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome.css')}}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/material.css')}}"><!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" id="main-style-link">
    <script src="{{asset('assets/js/tech-stack.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/style-preset.css')}}">
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spinkit/1.2.5/spinkit.min.css">

</head><!-- [Head] end --><!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
      data-pc-theme_contrast="" data-pc-theme="light"><!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<x-navbar/>
<x-sidebar/>
<!-- [ Header ] end -->
<!-- [ Main Content ] start -->
@include('sweetalert::alert')
{{$slot}}
<!-- [ Main Content ] end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- [Page Specific JS] start -->
<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/widgets/all-earnings-graph.js')}}"></script>
<script src="{{asset('assets/js/widgets/page-views-graph.js')}}"></script>
<script src="{{asset('assets/js/widgets/total-task-graph.js')}}"></script>
<script src="{{asset('assets/js/widgets/download-graph.js')}}"></script>
<script src="{{asset('assets/js/widgets/customer-rate-graph.js')}}"></script>
<script src="{{asset('assets/js/widgets/tasks-graph.js')}}"></script>
<script src="{{asset('assets/js/widgets/total-income-graph.js')}}"></script><!-- [Page Specific JS] end -->
<!-- Required Js -->
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


<script>
    $(document).ready(function() {
        $('#signs').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        $('#symptoms').select2({
            placeholder: "Select an option",
            allowClear: true
        });
    });
</script>
</body><!-- [Body] end -->
</html>
