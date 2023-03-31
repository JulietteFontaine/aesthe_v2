<?php defined('ABSPATH') || die; ?>

<div class="glsr-form-wrap-separator">
</div>
<div id="form-open" class="glsr-form-wrap customised-form-wrap">
    <form class="{{ class }} customised-review-form" method="post" enctype="multipart/form-data">
        {{ fields }}
        {{ response }}
        <div class="customised-form-wrap__button">
                {{ submit_button }}
        </div>
    </form>
</div>