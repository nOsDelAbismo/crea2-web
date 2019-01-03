<section v-cloak v-if="showBanner" class="imagebg image--dark cover cover-blocks bg--secondary" id="slide-home">
    <div class="row-close" v-on:click="showBanner = false">
        <a href="#"><i class="fas fa-times"></i></a>
    </div>
    <div class="background-image-holder">
        <img alt="background" src="/img/crea-web/slide_casmiclab_logo.jpg"/>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6 offset-1">
                <h1>{{ lang.BANNER.TITLE }}</h1>
                <h3>{{ lang.BANNER.SUBTITLE }}</h3>
                <a href="/welcome" class="btn btn--sm type--uppercase">
                    <span class="btn__text">
                            {{ lang.BUTTON.SIGN_UP }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>