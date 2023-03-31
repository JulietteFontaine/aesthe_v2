<?php

namespace GeminiLabs\SiteReviews\Addon\Forms;

use GeminiLabs\SiteReviews\Addons\Addon;

final class Application extends Addon
{
    public const ID = 'site-reviews-forms';
    public const LICENSED = true;
    public const NAME = 'Review Forms';
    public const POST_TYPE = 'site-review-form';
    public const SLUG = 'forms';
    public const UPDATE_URL = 'https://niftyplugins.com';

    /**
     * @param string $placeholder
     * @return array
     */
    public function forms($placeholder = '')
    {
        $forms = get_posts([
            'no_found_rows' => true, // skip counting the total rows found
            'post_type' => static::POST_TYPE,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'suppress_filters' => true,
        ]);
        $forms = wp_list_pluck($forms, 'post_title', 'ID');
        foreach ($forms as $id => &$title) {
            if (empty($title)) {
                $title = sprintf('%s', _x('No title', 'admin-text', 'site-reviews-forms'));
            }
        }
        natcasesort($forms);
        if ($placeholder) {
            return ['' => $placeholder] + $forms;
        }
        return $forms;
    }
}
