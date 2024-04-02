@php
    $current_route = Request::route()->getName();
    // echo $current_route;
@endphp
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{\Carbon\Carbon::now()->format('Y')}} {{Config('app.name')}}</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->



<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
{{-- Comment the below script if using any vue component in the page using @if(!in_array($current_route, ['routeNameHere'])) --}}
{{-- @if(!in_array($current_route,[])) --}}
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- @endif --}}

<!-- Core plugin JavaScript -->
<script src="{{ asset('assets/plugins/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Main scripts for all pages -->
<script src="{{ asset('assets/js/admin-panel-min.js') }}"></script>
<!-- Main scripts for all pages Ends -->


<!-- Custom Scripts for Admin Panel -->
<script src="{{ asset('assets/js/admin-panel-custom.js') }}"></script>
<!-- Custom Scripts for Admin Panel Ends -->


<!-- Sweet Alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweet Alert 2 Ends -->

<!--  Toastr JS  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!--  Toastr JS Ends -->

@yield('scripts')
