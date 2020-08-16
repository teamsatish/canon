<!-- will be used to show any messages -->

@if (session('message'))
    <script>
      toastr.info("{{ session('message') }}");
    </script>
@endif

@if (session('error'))
    <script>
      toastr.error("{{ session('error') }}");
    </script>
    <!-- <div class="alert alert-danger">{{ session('error') }}</div> -->
@endif
