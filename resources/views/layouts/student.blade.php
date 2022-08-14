
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>@yield('title') | Online Quran Tutor</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="{{ asset('theme/assets/images/favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('theme/vendors/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/jquery-nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/OwlCarousel2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/magnific-popup/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.23/r-2.2.7/datatables.min.css"/>
    <!-- Select 2 Plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.css" integrity="sha512-2sFkW9HTkUJVIu0jTS8AUEsTk8gFAFrPmtAxyzIhbeXHRH8NXhBFnLAMLQpuhHF/dL5+sYoNHWYYX2Hlk+BVHQ==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/assets/plugins/css/bootstrap-multiselect.min.css">
    @yield('css')
    <style>
        .rating-stars {
            border: none;
            float: left;
        }

        .rating-stars > input {
            display: none;
        }
        .rating-stars > label:before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating-stars > .half:before {
            content: "\f089";
            position: absolute;
        }

        .rating-stars > label {
            color: #ddd;
            float: right;
        }

        .rating-stars > input:checked ~ label, /* show gold star when clicked */
        .rating-stars:not(:checked) > label:hover, /* hover current star */
        .rating-stars:not(:checked) > label:hover ~ label {
            color: #FFD700;
        } /* hover previous stars in list */

        .rating-stars > input:checked + label:hover, /* hover current star when changing rating */
        .rating-stars > input:checked ~ label:hover,
        .rating-stars > label:hover ~ input:checked ~ label, /* lighten current selection */
        .rating-stars > input:checked ~ label:hover ~ label {
            color: #FFED85;
        }
    </style>
</head>

<body id="top" class="body">
<header class="bg-blue shadow main-header" >

    <div class="container-lg " >
        <nav class="navbar p-2 justify-content-center navbar-expand-xl navbar-dark px-0">
            <a class="navbar-brand p-0" href="{{route('index')}}" style="height: 49px;">
                <img src="{{asset('images/inner_logo.png')}}" alt="" style="width:200px;">
            </a>
            <button class="navbar-toggler ml-auto" type="button">
                <span class="fas fa-bars"></span>
            </button>
        </nav>

    </div>
</header>


<main class="dashboard">
    <div class="container-fluid ">

        <div class="row main-menu" >
            <div class="col-lg-3 col-md-5 col-sm-6 col-6  p-0  ">
                <nav class="navbar navbar-expand-xl navbar-light px-0 py-0 py-xl-3 ">
                    @include('student.components.header')
                </nav>
            </div>
            <div class="col-lg-9 pt-4 pb-4 col-sm-12 height-screen h-100" >

                @yield('content')

            </div>
        </div>

    </div>

</main>
{{--@include('student.components.footer')--}}

<script src="{{ asset('theme/vendors/jQuery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="{{ asset('theme/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/vendors/jquery-nice-select/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('theme/vendors/OwlCarousel2/owl.carousel.min.js') }}"></script>
<script src="{{ asset('theme/vendors/counterup/waypoints.min.js') }}"></script>
<script src="{{ asset('theme/vendors/counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('theme/vendors/magnific-popup/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- DataTable Plugin Js -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
{{--
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
--}}


<script type="text/javascript" src="{{ asset('theme') }}/assets/plugins/js/bootstrap-multiselect.min.js"></script>
<!-- END: Page JS-->
<script>
    $("select").niceSelect("destroy");
    
    @if(session('message'))
    toastr.success("{{ session('message') }}");
    @elseif(session('error'))
    toastr.error("{{ session('error') }}");
    @endif

    $(document).ready(function() {
        $('.multiselect').multiselect({
            buttonWidth: '100%'
        });
    });
    $(".select2").select2();
    // $(".multiselect").multiselect('destroy');

</script>
<script>
    (function(){
        $('.navbar-toggler').on('click', function(){
            $(this).toggleClass('is-active');
            $('.side-nav').toggleClass('side-nav--show');
        });
    }());
    $(window).resize(function(){
        if ($(window).width() > 991) {
            $('.side-nav').removeClass('side-nav--show');
        }
    });

    // Mapping old values
    function mapDataToFields(data)
    {
        $.map(data, function(value, index){
            var input = $('[name="'+index+'"]');
            if($(input).length && $(input).attr('type') !== 'file')
            {
              if(($(input).attr('type') == 'radio' || $(input).attr('type') == 'checkbox') && value == $(input).val())
                $(input).prop('checked', true);
              else
                  $(input).val(value).change();
            }
        });
    }
    var data = <?php echo json_encode(session()->getOldInput()) ?>;
    mapDataToFields(data);
</script>
@yield('js')
</body>
</html>


