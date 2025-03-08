<section class="testimonial-sec testimonial-sec-v-2 div-padding testimonial-area testimonial-area-v-2">
        <div class="container">
            <div class="testimonial-slider dots-hide">
                <div class="row">

                    <div class="d-flex justify-content-center align-items-center">
                        <a class="btn btn-lg btn-default" href="{{ route('testimonial.create') }}">Add Testimony</a>
                    </div>

                    <div class="col-md-12 testimo-slider testimonial-carousel owl-carousel" id="testimonial-test">

                        @forelse ( $testimonials as $testimonial )
                            <div class="testimonial-slide-v-2 testimonial-slide">
                                <p>
                                    {{ $testimonial->content }}
                                </p>
                                <div class="thmb-row">
                                    <div class="thmb-img">
                                        <!-- <img src="assets/assets/images/client-1.webp" alt> -->
                                    </div>
                                    <div class="thmb-info">
                                        <h3>{{ $testimonial->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Ooops.. Nothing yet. Please come back later</p>
                        @endforelse
                        
                    </div>
                </div>
            </div>

        </div>
    </section>