@extends('layout/main')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        @livewire('generate-report-food-recall')

    </div> <!-- container -->
    </div>
    </div>
@endsection
@section('plugins')
    <!-- Datatables js -->
    <script src="{{ url('/') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js">
    </script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="{{ url('/') }}/assets/js/pages/demo.datatable-init.js"></script>
@endsection

</body>

</html>
