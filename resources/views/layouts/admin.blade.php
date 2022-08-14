<!--
=========================================================
Material Dashboard PRO - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard-pro
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin_theme') }}/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{--{{ asset(setting('favicon')) }}--}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | Online Quran Tutor</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- start JQUERY DATEPICKER CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('admin_theme') }}/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('admin_theme') }}/assets/css/custom.css" rel="stylesheet" />
    <style>
        .h1,
        .h2,
        .h3,
        .h4,
        body,
        p,
        a,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: Quicksand;
            font-weight: 400;
        }
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
        .select2-hidden-accessible{
            display: none;
        }
        .select2-container,
        .select2-container--default .select2-selection--single,
        .select2-container .select2-selection--single,
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: calc(2.4375rem + 1px) !important;
            border-radius: 0px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height: calc(2.4375rem + 1px) !important;
        }
        #ui-datepicker-div {
            z-index: 10 !important;
        }
    </style>
    @yield('css')
</head>

<body class="">
    <div class="wrapper ">
        @include('admin.components.sidebar')
        <div class="main-panel">
            <!-- Navbar -->
            @include('admin.components.navbar')
            <!-- End Navbar -->
            <div class="content">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
<!--  -->
<!--   Core JS Files   -->
<script src="{{ asset('admin_theme') }}/assets/js/core/jquery.min.js"></script>
<script src="{{ asset('admin_theme') }}/assets/js/core/popper.min.js"></script>
<script src="{{ asset('admin_theme') }}/assets/js/core/bootstrap-material-design.min.js"></script>
<script src="{{ asset('admin_theme') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/jasny-bootstrap.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/arrive.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('admin_theme') }}/assets/js/plugins/bootstrap-notify.js"></script>
<!--  Select2 Plugin    -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!--  CKEditor Plugin    -->
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('admin_theme') }}/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
<!-- // START Jquery DATE PICKER -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- JQUERY clockPicker LINK -->
<script src="https://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js" integrity="sha512-/9uQgrROuVyGVQMh4f61rF2MTLjDVN+tFGn20kq66J+kTZu/q83X8oJ6i4I9MCl3psbB5ByQfIwtZcHDHc2ngQ==" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{ asset('admin_theme') }}/assets/js/plugins/chartist.min.js"></script>

{{-- Alert Messages --}}
@if(session('success'))
    <script>
        md.showNotification('success', "{{ session('success') }}");
    </script>
@elseif(session('error'))
    <script>
        md.showNotification('danger', "{{ session('error') }}");
    </script>
@endif
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd-mm-yy' ,
        });
    });
    $(function() {
        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            default: 'now',
            donetext: "Select",
        });
    });
    $(document).ready(function () {
        $('.bmd-form-group').each(function(){
            $(this).find('label').removeClass('bmd-label-floating');
            $(this).removeClass('bmd-form-group');
        });
        // Validator Initialized
        $(".validate-form").validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
            },
            errorPlacement: function(error, element) {
                $(element).closest('.form-group').append(error);
            },
        });

        // Datatable Initalized
        $('.datatables').DataTable({
            "sort": false,
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });
        var table = $('.datatable').DataTable();

        // Select2 Initialized
        $('.select2').select2({
            width: '100%'
        });
    });

    // General Delete Function
    function deleteAlert(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                location.href = url;
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
</script>
@yield('js')
</body>

</html>

