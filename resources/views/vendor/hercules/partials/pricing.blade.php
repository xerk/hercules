<!-- Start Pricing Area -->
<section class="pricing-area pt-100 pb-70" id="pricing">
    <div class="container">
        <div class="section-title">
            <span>{{ __('Pricing') }}</span>
            <h3>{{ __('Individuals Memberships') }}</h3>
        </div>

        <div class="row">
            @foreach ($prices as $item)
            <div class="col-lg-4 col-md-6">
                <div class="single-pricing-box">
                    <div class="pricing-header">
                        <h3>{{ $item->name }}</h3>
                        <p>{{ $item->desc }}</p>
                    </div>
                    <div class="price">
                        {{ $item->currency }}{{ $item->price }}<span>/{{ $item->per_month }}</span>
                    </div>
                    <ul class="pricing-features">
                        @foreach ($item->priceLists as $list)
                        <li>
                            @if ($list->active)
                            <i class="fas fa-check"></i>
                            @else
                            <i class="fas fa-times text-danger"></i>
                            @endif
                            {{ $list->name }}
                        </li>
                        @endforeach
                    </ul>
                    <div class="price-btn">
                        <a href="{{$item->link}}" class="price-btn-one">{{$item->button_text}}</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<section class="subscribe-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="subscribe-content">
                    <h2>{{ __('Are you asking for companies packages?') }}</h2>
                    <span class="sub-title">{{ __('We offer multi-serial users and bulk points for companies') }}</span>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="newsletter-form">
                    <button onclick="window.open('http://m.me/SoftwaresProjects/');" class="disabled"
                        style="pointer-events: all; cursor: pointer;"><i class="fab fa-facebook-messenger"></i>
                        {{__('Contact Us')}}</button>
                    <div id="validator-newsletter" class="form-result"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Pricing Area -->
