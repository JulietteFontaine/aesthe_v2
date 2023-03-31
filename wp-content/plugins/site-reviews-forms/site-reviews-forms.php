<?php
/**
 * ╔═╗╔═╗╔╦╗╦╔╗╔╦  ╦  ╔═╗╔╗ ╔═╗
 * ║ ╦║╣ ║║║║║║║║  ║  ╠═╣╠╩╗╚═╗
 * ╚═╝╚═╝╩ ╩╩╝╚╝╩  ╩═╝╩ ╩╚═╝╚═╝.
 *
 * Plugin Name:       Site Reviews: Review Forms
 * Plugin URI:        https://niftyplugins.com/plugins/site-reviews-forms
 * Description:       Create review forms with custom fields and review templates.
 * Version:           1.12.0
 * Author:            Paul Ryley
 * Author URI:        https://niftyplugins.com
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Text Domain:       site-reviews-forms
 * Domain Path:       languages
 */
defined('WPINC') || die;

if (!class_exists('GL_Plugin_Check_v6')) {
    require_once __DIR__.'/activate.php';
}
if (!(new GL_Plugin_Check_v6(__FILE__))->canProceed()) {
    return;
}
require_once __DIR__.'/autoload.php';
require_once __DIR__.'/compatibility.php';
$gatekeeper = new GeminiLabs\SiteReviews\Addon\Forms\Gatekeeper(__FILE__, [
    'site-reviews/site-reviews.php' => 'Site Reviews|6.5|https://wordpress.org/plugins/site-reviews|7.0',
]);
if ($gatekeeper->allows()) {
    add_action('site-reviews/addon/register', function ($app) {
        $app->singleton(GeminiLabs\SiteReviews\Addon\Forms\Controllers\Controller::class);
        $app->singleton(GeminiLabs\SiteReviews\Addon\Forms\Controllers\FieldController::class);
        $app->singleton(GeminiLabs\SiteReviews\Addon\Forms\Controllers\RestApiController::class);
        $app->singleton(GeminiLabs\SiteReviews\Addon\Forms\Controllers\TemplateController::class);
        $app->register(GeminiLabs\SiteReviews\Addon\Forms\Application::class);
        register_deactivation_hook(__FILE__, function () {
            delete_option('glsr_activated_site-reviews-forms');
        });
    });
}
add_action('site-reviews/addon/update', function ($app) {
    $app->update(GeminiLabs\SiteReviews\Addon\Forms\Application::class, __FILE__);
});
