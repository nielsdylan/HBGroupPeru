{{--
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div
                style="
                    background: url('{{asset('uploads/slider/slider_1.jfif')}}');background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    height: 550px;"
            ></div>
        </div>
        <div class="carousel-item">
            <div
            style="
                background: url('{{asset('uploads/slider/slider_1.jfif')}}');background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 550px;"
            ></div>
        </div>
        <div class="carousel-item">
            <div
                style="
                    background: url('{{asset('uploads/slider/slider_1.jfif')}}');background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    height: 550px;"
                ></div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
 --}}

<div id="slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="img-fluid d-none d-md-block d-xl-block"  style="
                background: url('{{asset('uploads/slider/slider_1.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 550px;"></div>
            <div class="img-fluid d-none d-sm-block d-md-none"  style="
                background: url('{{asset('uploads/slider/slider_1.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 300px;"></div>
            <div class="img-fluid d-block d-sm-none"  style="
                background: url('{{asset('uploads/slider/slider_1.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 200px;"></div>
        </div>

        <div class="carousel-item ">
            <div class="img-fluid d-none d-md-block d-xl-block"  style="
                background: url('{{asset('uploads/slider/slider_2.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 550px;"></div>
            <div class="img-fluid d-none d-sm-block d-md-none"  style="
                background: url('{{asset('uploads/slider/slider_2.jpg')}}');
                background-size: cover;
                background-position: center;background-repeat: no-repeat;
                height: 300px;"></div>
            <div class="img-fluid d-block d-sm-none"  style="
                background: url('{{asset('uploads/slider/slider_2.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 200px;"></div>
        </div>

        <div class="carousel-item ">
            <div class="img-fluid d-none d-md-block d-xl-block"  style="
                background: url('{{asset('uploads/slider/slider_3.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 550px;"></div>
            <div class="img-fluid d-none d-sm-block d-md-none"  style="
                background: url('{{asset('uploads/slider/slider_3.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 300px;"></div>
            <div class="img-fluid d-block d-sm-none"  style="
                background: url('{{asset('uploads/slider/slider_3.jpg')}}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 200px;"></div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#slider" data-slide="prev">
        <span class="my-carousel-control-prev-icon"><i class="fas fa-chevron-left"></i></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider" data-slide="next">
        <span class="my-carousel-control-next-icon"><i class="fas fa-chevron-right"></i></span>
        <span class="sr-only">Next</span>
    </a>
</div>
