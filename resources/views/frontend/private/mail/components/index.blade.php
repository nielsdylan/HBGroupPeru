@extends('frontend.private.mail.index_mail')
@section('title','HB Group Perú')
@section('mail_content')
    <div class="inbox-head">
        <h3>Inbox</h3>
        <form action="#" class="ml-auto">
            <div class="input-group">
                <input type="text" placeholder="Search Email" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-search search-icon"></i>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="inbox-body">
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
                    <button type="button" class="btn btn-option">Delete</button>
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

        <div class="email-list">
            <div class="email-list-item unread">
                <div class="email-list-actions">
                    <div class="d-flex">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label>
                        <span class="rating rating-sm mr-3">
                            <input type="checkbox" id="star1" value="1">
                            <label for="star1">
                                <span class="fa fa-star"></span>
                            </label>
                        </span>
                    </div>
                </div>
                <div class="email-list-detail">
                    <span class="date float-right"><i class="fa fa-paperclip paperclip"></i> 28 Jul</span><span class="from">Google Webmaster</span>
                    <p class="msg">Improve the search presence of WebSite</p>
                </div>
            </div>
            <div class="email-list-item unread">
                <div class="email-list-actions">
                    <div class="d-flex">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label>
                        <span class="rating rating-sm mr-3">
                            <input type="checkbox" id="star2" value="1" checked>
                            <label for="star2">
                                <span class="fa fa-star"></span>
                            </label>
                        </span>
                    </div>
                </div>
                <div class="email-list-detail"><span class="date float-right"></span><span class="date float-right"><i class="fa fa-paperclip paperclip"></i> 13 Jul</span><span class="from">	PHPClass</span>
                    <p class="msg">Learn Laravel Videos Tutorial</p>
                </div>
            </div>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <div class="d-flex">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label>
                        <span class="rating rating-sm mr-3">
                            <input type="checkbox" id="star6" value="1">
                            <label for="star6">
                                <span class="fa fa-star"></span>
                            </label>
                        </span>
                    </div>
                </div>
                <div class="email-list-detail"><span class="date float-right">23 Jun</span><span class="from">Language Course</span>
                    <p class="msg">Learn new language, Hizrian !</p>
                </div>
            </div>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <div class="d-flex">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label>
                        <span class="rating rating-sm mr-3">
                            <input type="checkbox" id="star5" value="1">
                            <label for="star5">
                                <span class="fa fa-star"></span>
                            </label>
                        </span>
                    </div>
                </div>
                <div class="email-list-detail"><span class="date float-right">17 May</span><span class="from">Farrah Septya</span>
                    <p class="msg">Urgent - You forgot your keys in the class room, please come imediatly!</p>
                </div>
            </div>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <div class="d-flex">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label>
                        <span class="rating rating-sm mr-3">
                            <input type="checkbox" id="star3" value="1">
                            <label for="star3">
                                <span class="fa fa-star"></span>
                            </label>
                        </span>
                    </div>
                </div>
                <div class="email-list-detail"><span class="date float-right">16 May</span><span class="from">Facebook</span>
                    <p class="msg">Somebody requested a new password</p>
                </div>
            </div>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <div class="d-flex">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label>
                        <span class="rating rating-sm mr-3">
                            <input type="checkbox" id="star4" value="1">
                            <label for="star4">
                                <span class="fa fa-star"></span>
                            </label>
                        </span>
                    </div>
                </div>
                <div class="email-list-detail"><span class="date float-right">12 May</span><span class="from">Kristopher Donny</span>
                    <p class="msg">Hello Friend, How are you?</p>
                </div>
            </div>
        </div>
    </div>
@endsection
