<div name="frame_html">
    {{-- <iframe width="760" height="800" name="frame_html" > --}}
        {{-- {{$content}} --}}
    {{-- </iframe> --}}
</div>
<script>
    $(document).ready(function () {
        $('[name="frame_html"]').html({!! json_encode($content) !!});
        var json = JSON.parse('{!! json_encode($img_array) !!}');

        $.each(json, function (index, element) {
            $('img[src="cid:'+element.content_id+'"]').attr('src',element.img);
        });
        $('[name="subject"]').text(JSON.parse('{!! json_encode($subject) !!}'))
    });

</script>
