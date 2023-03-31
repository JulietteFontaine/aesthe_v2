<?php

namespace GeminiLabs\SiteReviews\Addon\Forms\Tags;

use GeminiLabs\SiteReviews\Modules\Html\Builder;
use GeminiLabs\SiteReviews\Modules\Html\Tags\Tag;

class CustomEmailTag extends Tag
{
    /**
     * {@inheritdoc}
     */
    protected function handle($value = null)
    {
        $value = antispambot($value);
        if ('link' === $this->with->get('format', 'link')) {
            $value = glsr(Builder::class)->a([
                'href' => sprintf('mailto:%s', esc_url($value)),
                'text' => esc_url($value),
            ]);
        }
        return $this->wrap($value);
    }
}
