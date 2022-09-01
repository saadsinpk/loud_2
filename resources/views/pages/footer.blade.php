	<!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2021©</span>
            <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Loud9ja Limited</a>. All rights reserved.
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Container-->
@php $currentTime = getdate(); @endphp
<script>
    var date = new Date(Date.UTC(@php echo $currentTime['year'] .",".
                                        $currentTime['mon'] .",".
                                        $currentTime['mday'] .",".
                                        $currentTime['hours'] .",".
                                        $currentTime['minutes'] .",".
                                        $currentTime['seconds']; @endphp));
    setInterval(function() {
        date.setSeconds(date.getSeconds() + 1);
        jQuery(".show_clock").text((date.getHours() +':' + date.getMinutes() + ':' + date.getSeconds() ));
    }, 1000);
</script>
