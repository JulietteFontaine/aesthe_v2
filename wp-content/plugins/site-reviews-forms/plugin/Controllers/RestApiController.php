<?php

namespace GeminiLabs\SiteReviews\Addon\Forms\Controllers;

class RestApiController
{
    /**
     * @return array
     * @filter site-reviews/rest-api/reviews/parameters
     */
    public function filterReviewsParameters(array $parameters)
    {
        $parameters['form'] = [
            'description' => _x('Render the review with a specific custom form (ID) review template; only works with the rendered parameter.', 'admin-text', 'site-reviews-forms'),
            'sanitize_callback' => 'absint',
            'type' => 'integer',
        ];
        return $parameters;
    }

    /**
     * @return array
     * @filter site-reviews/rest-api/summary/parameters
     */
    public function filterSummaryParameters(array $parameters)
    {
        $parameters['rating_field'] = [
            'description' => _x('Use rating values of a custom rating field; use the custom rating Field Name as the value. ', 'admin-text', 'site-reviews-forms'),
            'type' => 'string',
        ];
        return $parameters;
    }
}
