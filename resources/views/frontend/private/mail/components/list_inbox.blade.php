<div class="mail-option">
    <div class="email-filters-left">
        <div class="chk-all">
            <div class="btn-group">
                <div class="form-check">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <button data-toggle="dropdown" type="button" class="btn btn-option dropdown-toggle"> With selected </button>
            <div role="menu" class="dropdown-menu"><a href="#" class="dropdown-item">Mark as read</a><a href="#" class="dropdown-item">Mark as unread</a><a href="#" class="dropdown-item">Spam</a>
                <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Delete</a>
            </div>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-option">Archive</button>
            <button type="button" class="btn btn-option">Span</button>
            <button type="button" class="btn btn-option" data-action="refresh">Delete</button>
        </div>
        <div class="btn-group">
            <button data-toggle="dropdown" type="button" class="btn btn-option dropdown-toggle" aria-expanded="false">Order by </button>
            <div role="menu" class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Date</a><a href="#" class="dropdown-item">From</a><a href="#" class="dropdown-item">Subject</a>
                <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Size</a>
            </div>
        </div>
    </div>

    <div class="email-filters-right ml-auto"><span class="email-pagination-indicator">1-50 of 213</span>
        <div class="btn-group ml-3">
            <button type="button" class="btn btn-option"><i class="fa fa-angle-left"></i></button>
            <button type="button" class="btn btn-option"><i class="fa fa-angle-right"></i></button>
        </div>
    </div>
</div>
<div class="email-list inbox-outlook">
    @foreach ($results->value as $key=>$value)
        <div class="email-list-item" data-id="{{$value->id}}">
            <div class="email-list-actions">
                <div class="d-flex">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="{{$value->id}}"><span class="custom-control-label"></span>
                    </label>
                    <span class="rating rating-sm mr-3">
                        <input type="checkbox" id="star{{$value->id}}" value="{{$value->id}}">
                        <label for="star{{$value->id}}">
                            <span class="fa fa-star"></span>
                        </label>
                    </span>
                </div>
            </div>
            <div class="email-list-detail" data-click="select-mail">
                <span class="date float-right"><i class="fa fa-paperclip paperclip"></i> 28 Jul</span><span class="from">{{$value->sender->emailAddress->name}}</span>
                <p class="msg">{{$value->subject}}</p>
            </div>
        </div>
    @endforeach
</div>

