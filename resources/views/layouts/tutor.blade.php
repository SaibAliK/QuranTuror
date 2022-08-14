
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.23/r-2.2.7/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <style>
        .table thead th {
            border-top-width: 1px !important;
            color: #000 !important;
            font-weight: bold !important;
            font-size: 14px !important;
        }
        .table>tbody>tr>td {
            font-weight: 500;
        }
        .card-title,
        .error {
            font-weight: bold;
        }
        .form-control {
            border: 1px solid #e7e7e7;
            border-radius: 0px;
            padding: 4px 10px;
        }
        input.form-control,
        textarea.form-control,
        select.form-control{
            background-image: none !important;
        }
        input.form-control,
        select.form-control {
            height: calc(2.4375rem + 1px) !important;
        }
        label,
        .bmd-label-static{
            font-weight: bold;
            text-transform: capitalize;
            margin-bottom: 3px;
            color: #000;
        }
        .toast-info {
            background-color: green;
        }
        #toast-container > .toast-success {
            opacity: 1 !important;
        }
        #toast-container > .toast-error {
            opacity: 1 !important;
        }
        .web{
            padding: 12.6px 16px;
        }
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
    @yield('css')

</head>

<body id="top" class="body">
    <header class="bg-blue shadow main-header" >

        <div class="container-lg" >
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

            <div class="row main-menu">
                <div class="col-lg-3 col-md-5 col-sm-6 col-6  p-0  ">
                    <nav class="navbar navbar-expand-xl navbar-light px-0 py-0 py-xl-3 ">
                        @include('tutor.components.header')
                    </nav>
                </div>
                <div class="col-lg-9 pt-4 pb-4 col-sm-12 height-screen h-100" >

                    @yield('content')

                </div>
            </div>

        </div>

    </main>
    <!-- start modal -->
    <div class="modal fade rounded" id="deleteModel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-secondary font-weight-600">Start Session</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                        <div class="form-group col-12 mt-3">
                            <a href="" class="btn btn-primary w-100 rounded-sm start_session_btn" type="submit">Start Session</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    {{--@include('tutor.components.footer')--}}

    <script src="{{ asset('theme/vendors/jQuery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/jquery-nice-select/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/OwlCarousel2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/counterup/waypoints.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/magnific-popup/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- sweet alert -->
    <script src="{{ asset('admin_theme') }}/assets/js/plugins/sweetalert2.js"></script>
    <!-- Data Tables JS -->
    <script src="{{ asset('admin_theme') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>


    <!-- END: Page JS-->

    <script>
        @if(session('message'))
        toastr.success("{{ session('message') }}");
        @elseif(session('error'))
        toastr.error("{{ session('error') }}");
        @endif

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
      

        function deleteAlert(url) {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                location.href=url;
              }
            });
        }


    // General alert
    function alertMessage(url, msg) {
        Swal.fire({
            title: 'Are you sure?',
            text: msg,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        });
    }

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

    $(document).ready(function () {
        $('table.display').dataTable({
            "responsive":true,
            "scrollX": true
        });
    });
</script>
@yield('js')
</body>
</html>

