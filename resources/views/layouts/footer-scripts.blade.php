<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>


<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

<script>
    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            var grade_id = $(this).val();

            if (grade_id) {
                $.ajax({
                    url: '{{ URL::to("get_classroom") }}/' + grade_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('select[name="classroom_id"]').empty();
                        $('select[name="classroom_id"]').append('<option selected disabled>{{ trans("parent-translation.choose") }}...</option>');

                        $.each(data, function (key, value) {
                            $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                console.log('Ajax load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select[name="classroom_id"]').on('change', function () {
            var classroom_id = $(this).val();

            if (classroom_id) {
                $.ajax({
                    url: '{{ URL::to("get_section") }}/' + classroom_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {

                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append('<option selected disabled>{{ trans("parent-translation.choose") }}...</option>');
                        console.log(data);
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                console.log('Ajax load did not work');
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('select[name="new_grade_id"]').on('change', function () {
            var grade_id = $(this).val();

            if (grade_id) {
                $.ajax({
                    url: '{{ URL::to("get_classroom") }}/' + grade_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {

                        $('select[name="new_classroom_id"]').empty();
                        $('select[name="new_classroom_id"]').append('<option selected disabled>{{ trans("parent-translation.choose") }}...</option>');

                        $.each(data, function (key, value) {
                            $('select[name="new_classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                console.log('Ajax load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select[name="new_classroom_id"]').on('change', function () {
            var classroom_id = $(this).val();

            if (classroom_id) {
                $.ajax({
                    url: '{{ URL::to("get_section") }}/' + classroom_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {

                        $('select[name="new_section_id"]').empty();
                        $('select[name="new_section_id"]').append('<option selected disabled>{{ trans("parent-translation.choose") }}...</option>');

                        $.each(data, function (key, value) {
                            $('select[name="new_section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                console.log('Ajax load did not work');
            }
        });
    });
</script>
