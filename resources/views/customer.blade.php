@extends('layout')
@section('Employee')
<!DOCTYPE html>
<html>
    <body>
        <div class="admin-info mx-auto">
            {{ Auth::user()->name }}
        </div>
     
    </body>
    <!-- jQuery + DataTables + Toastr JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>\
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
</script>