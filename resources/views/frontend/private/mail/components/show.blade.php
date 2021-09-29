@extends('frontend.private.mail.index_mail')
@section('title','HB Group Perú')
@section('mail_content')
    <div class="email-head">
        <h3>
            <i class="fa fa-star favorite"></i>
            <input type="hidden" name="mail_id" value="{{$email}}">
            <label name="subject"></label>
            {{-- {{$response->subject}} --}}
        </h3>
        <div class="controls">
            <a href="#"><i class="fa fa-reply"></i></a>
            <a href="#"><i class="fa fa-print"></i></a>
            <a href="#"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <div class="email-sender">
        <div class="avatar">
            <img src="../assets/img/profile2.jpg" alt="Avatar">
        </div>
        <div class="sender">
            <a href="#" class="from">Joko Subianto</a> to <a href="#" class="to">me</a>
            <div class="action ml-1">
                <a data-toggle="dropdown" class="dropdown-toggle"></a>
                <div role="menu" class="dropdown-menu"><a href="#" class="dropdown-item">Mark as read</a><a href="#" class="dropdown-item">Mark as unread</a><a href="#" class="dropdown-item">Spam</a>
                    <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Delete</a>
                </div>
            </div>
        </div>
        <div class="date">June 21, 20:03</div>
    </div>
    <div class="email-body">
        {{-- <p>Hello,</p>

        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>

        <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didnâ€™t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>

        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.</p>

        <p>Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its</p>

        <p>Regards,<br/>Joko Subianto</p> --}}
    </div>
    <div class="email-attachments">
        <div class="title">Attachments <span>(3 files 17,27Kb)</span></div>
        <ul>
            <li><a href="#"><i class="fa fa-paperclip"></i> proposal.docs <span>(5.12 KB)</span></a></li>
            <li><a href="#"><i class="fa fa-paperclip"></i> example.psd <span>(5.12 KB)</span></a></li>
            <li><a href="#"><i class="fa fa-paperclip"></i> resume.pdf <span>(5.12 KB)</span></a></li>
        </ul>
    </div>
    <script>
        $(document).ready(function () {
            viewContentEmail($('[name="mail_id"]').val());
        });
        function viewContentEmail(mail_id) {
            var route = '{{ route('inbox.mail.content') }}';
                // route = route.replace('body', body);

            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: {mail_id:mail_id},
                beforeSend: function()
                {
                    $('.email-body').addClass('is-loading is-loading-lg');
                },
            }).done(function (response) {
                $('.email-body').removeClass('is-loading is-loading-lg');
                $('.email-body').html(response);
            }).fail(function () {
                alert("Error");
            });
        }
    </script>
@endsection
