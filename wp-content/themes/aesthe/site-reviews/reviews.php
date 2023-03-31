<?php defined('ABSPATH') || die; ?>

<h2 class="title-uppercase" id="moreReviews">Vos avis</h2>
<a href="#form-open"><button class="give-review">Donner mon avis</button></a>

<div class="customised-reviews-wrap">

    <div class="glsr-reviews customised-reviews">
        {{ reviews }}
    </div>
    {{ pagination }}
</div>