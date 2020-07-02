<?php
/**
 * The header for our Member site
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>  >
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <?php wp_head(); ?>
        <link rel="stylesheet" href="<?php echo get_theme_file_uri() . '/style-membership.css'; ?>">
        <link rel="stylesheet" href="<?php echo get_theme_file_uri() . '/style-course.css'; ?>">
        <link rel="stylesheet" href="<?php echo 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'; ?>">
        <script type="text/javascript" src="<?php get_theme_file_uri() . '/js/membership-navigation.js'; ?>"></script>
        <style>
            .menu-item-6853:before {
                content: url("data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAfCAYAAACCox+xAAABiklEQVRYhe2YvUsEMRDFf3dcJcJdJaLgd6Uc6NUWdhY2/g+ClYhgZyUidqKNrYi2FleooI0gloIWYiVoo4gg3IHYrowkELNxEy3MFvtgN5tJXuaRzE6yW0qSpAVUiYu2CEmAGeAukpRR4LiiKs/AYyQhNblpIVsyPZGEVE0hV8BTJCG9wJSOkQngJpKQceC6HMl5ChWHrRuYBkoB/HvgUj1PAiMBHFmBU+DFNLqEzAPLwINnQJ17BlV5oEpf0Ev/TWDNJ0SW6xyY9Qwo7dtGXWZwCWh6eE3lI+U0FyiE2Mj16ytoAHsebp/DthgQ5A1X8nQJOfQMpCGb5L5RXwUGAni7Lh8uIbfq+i18M5iJXMdITW1EIXg1DlRywOkK5EmMtHxCFoAV5SQLHcA7MKT6HAGdwIeHJ2I3gHWfELGd/SHFl9U+FZLiU36LhGajEGLjpxRftwLRhWGHbU4Owh5ePTTFnwD9+nsjA2/AjtEsz2MBvAvl4xuKU7wNvTQ9dsr9R4jvr6WJ/zcA2p+7h03qu0OU3gAAAABJRU5ErkJggg==");
                margin: 0.6rem;
                line-height: 1;
                vertical-align: middle;
            }

            .menu-item-6856:before {
                content: url("data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAbCAYAAAAZMl2nAAADoUlEQVRIiaWXW4hWVRTHf+p4SaaMISWttKys1JiohzQrwyiol0IoG4gI6yUj8iGMoqILRPYYvURFdDUyULrQBZMeQu2lzIrMFANT0zJt0Cmt/MWq9cH2zPnOp86CxWGf/9p7/8+67X2GqRynDANG5fMw8Bdw3It1NWA9wDXAZGAPsBr4MbHbgaeBjcDPwETgPOBeYFnanAPMBkYC3wFrj5VITHwMuCs3/waYDjyV4/XAnUnyq2LeRcBKoDsJXA98BAwA9yfhPmBHLZMITaEj1HfV99SJFewE9Xn1kHpWBWvpNPVP9QO1u3g/XH1c3ZDrDJo7vMJrMTAWuAHYWcH+APYBzwBb23h4E/AW8CWwv3gfOfRI4os7eSQSd6c6vc3Xhq5R5zTgofPUVW2wWemVQVg5mKluatjgFvVgTciqOiPt5tdgoxI7vyk0keUb2rg85GZgYU3IqvJtVk9fDXYIeDUT/wgpiUS276+Z3JLoGXs7kGjJ7oae8hxwahOR2KSnYfEo23lHSeTqtK+Ti4HNg94XcbpQXd8Q+0n+n8x3dMiRRep2dUINFom+S72sKVnHqfs6bDJX/aKDzcasjjos+tB9naomdF+lEVV1tLpHndwGP1v9Jxtb3dwddRUTWj30fgOmZuNqJ08CFwDzKwkZh987wOjUa4GDBfYscAqwoHbdglWP2q92dXB9fNla9ZXCNvrDG+pn6hj1dfXTYs5SdV3uUbtuObhHfbsDiZZG+HarZ+Y4nlvVsTk+Wd1b2K/Mjtt2zfL0vQ2YAKwAtmV41gAfJn43MB4Yl82vOxtUyN/p/oEcXwn8UKy9LUt/dbt4l0RmAdOAGcAZwJLEW0RuBUYAy4FJwJaiy8bR3g+8mHkQ14CbirWXAquAucALucYApVRcFC5dov6U14ETC6wv3R3H/HL1tMrcqKTv1QPqS+olFTzy6ca8YkTlPZq5NShHFqi/qK+pvcX709VP1C3qA+q5HfInGt+DmTMftzkkp6jv5wcdQWR2ds3eyoTwyOYk0Kmaqhr2D2eDq+tNI9Wv1etKIivUhTXGD6kvHyOBqi7LcNdhizKMtJj1Z4uvGsYl5tIhErm84ViYmufSf0RmZg5UjSK2v+Z9cyhEujLJx7fBI/dOivKcmaUXvwilzMlfgMMN7f5oJHrM58ATwLoa+13Rv4LIduB34KqKwRXAm0Mk0ZL4JYkL+ZgaLC7UB5r+9OLKNyW/aKgSHxwNsLd2IeBf/x1FrdoZ514AAAAASUVORK5CYII=");
                margin: 0.6rem;
                line-height: 1;
                vertical-align: middle;
            }

            .menu-item-6857:before {
                content: url("data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAXCAYAAABu8J3cAAACPElEQVRIib2Wz0sVURTHP5q8jAoqhSQycBEVakZEieLCXLRpEf0BLlpEELQIomV7icCVENomaBFCChUo2CZMMBIDrRYtop8U/YAgJIu+ceJMXIaZN8689/zCeQNvzj33O+d7zrkXSUk2otpiLL5nnf3EsA9YBgaBZ/GXVcBBYBRoBT7+D5eQjXFJUymZqobZxy9LuhLGigc+IumPpMM1JGJ2TtIHSaU0aUwS+2M8hwI/gWv+XCs2A2+B88AtW9MQLBwADgAzwKEcQX8DjTmJ/ABuABciIlGqLDPzkq7XWJLQ2rwMjoY1clrSiqRd60jEbFLSzYhIg6TnkobWmYTZgKRVSTtNkjNebG3Atxw6VwN1wBJw24i8BjYAj8sE3uoDKO+A2wt8Ab6W8emwLrKuuQrsyAjYB2wCFgsQacxYt/iPaKBXu6SNKVreL1hDFyUtrMW3PmB2FziRwNh07AbmcmbDMAt0AVuyHEMitmF9gs9+YLsHzYsFYBU4lodIGnqBl8CnAkR+eRP0VINIT0FZIjzyj6mYSG9BWUIi3Zl7edVe8hE/K6k1qOZmv6d1VjA9oxgdWV1jvT4E3PHqvhzwbPZnJRN3xa0lKyODkl4Fff8kxvahpCVJxwtkw07WOT/LSuV8bbK2A2/8DmLMbeSGOAkMA9PAO+AB8BSwo+Ez8N2dLZtNwB6P0e/ZngBOeRunws4a64p7wDa/ndnF9mzCit1OygrPZottaBuX/L1dkIzYe+AFMO9xrfXLA/gLI14bze+P7e4AAAAASUVORK5CYII=");
                margin: 0.6rem;
                line-height: 1;
                vertical-align: middle;
            }

            .menu-item-6855:before {
                content: url("data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAeCAYAAAA/xX6fAAACPklEQVRIibWWP2gUQRTGf5ezWeQ41EoOQRROkMOAXbAQQawsrrISuU4FQSVo4Z3gn8ImygkGWxFt1FRiZRpBECQIKcUihQhJbAwkUTzwkzne4mbZ3ZvZix88ln3z5vtm3vx7SAqxvZLmJP0ymzOfN8cE/oiAt8AGcNhs03yRN0vA6HqSPkqqJnxV83V9eXzFGpLWJU1ltE1ZW8OHqzJUHY1nFnE2J/K5S1ZBe1BKfWZQlIGglE7YGvVS/hNmWWtcGUewI2lJUpTy982SvshiO2WPRQ24B1wDfnqss4u5bn1qeUFFgl3gM/DKQyzGS+vTzY3ImfpBSZuSJnPas1Ia26T1PRCS0vvAU2AxYHYxFq3vg6zGHRm+k8BxoFlCLMZN4ItxzScb0jN0A+gDt4HvYwi6vreMa8uk0oIXgCowO4ZYjFnjOp8nuBu4A1wFBiPIfpsVYWBcd417iORd+gjYD5z2GH3dvmsesW+AJeDS8M+2a8u2ctP3mQmwpnG3klfbvKSZAJI9Zr7xM6YxFGxLWpFUDyDoZVzoRVY3jbb7WZB0MTBNlVGvQoY5jQXX6Q+wD/jmsQHGQQP46o7FKnDkP4thGqtuhtPAZaADfLJSIW+71+wwh+Io8AR4GK/HtKRl/cO51Bq46uyxymPZNCrpImon8MJqzb75IiuSDgHtEnfswGrZIdKvxUbqWtsFvLY0HwN+lEjnFhS9+G7nvgdWgFPbIeaQJ9gCPgDvgDOeNY0fMg7oFUkDSTe2/V6V+AvbEMaj0YUf2gAAAABJRU5ErkJggg==");
                margin: 0.6rem;
                line-height: 1;
                vertical-align: middle;
            }

            .menu-item-7498:before {
                content: url("data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAACiElEQVRIib2WS4iOYRTHf8PMmMZlTFJSJuSSECKEhVCIbIiljYWFWxZsZGExyUKSSxEbip0oJUXkLnJNKDSIJmRmXHPpp8c8n77e+d5v3pn5xr/O4nuf853f857nvOc8qGk2XK1Xb6s/zK7f6mN1jzoxLX4P2qovsB94BIwAtgNjgNqMNhTYCFQCV4DjwMA2lMRORsTdXlBHFclGVhusnlBfquPz/5MfYIj6Wt2n9iwBNGdl6lb1nToyCa5Qb6iHSghM2k71gdorH7wp/2E3WXks1C05cB/1gzqnG6E5m6U2BWY5sAx4DpwvUOFBFcBdoHfKelItwCTgd4G1y8BTYEUAL44ln6afwFKgKiP4Wwo0p2PAwvD6Deq0/5DmnAVWQyh14wf+PuMbdVWB1Vgeg/wqEiyc8UmgOiPwC7CkSLrD0ZUF8FegBmgq4rirA+DP7ZxxP+B7AD+OVdhQxPlsRmgWjQWehCFxCVhQwsDtaX5ghuKaCpwB6mKakgpZ2Qv0KrAW/NeGWZMRWhUzuzwEvQncB9YB9QWcw3ndSmkgzR2ABq0G3gAXc9/WDPWTOrobv99harM6NzkWd6gP1dpugNao9+KthCQ4zOBT6k11UAmhdeqdGLuiEDhYpXpEfaUu6iKwSl0Tp9GBGPvfellrx2yjVbHQngEHgcNFCmY2MDHvd7hrTfg7CFoLaTNwOvmnNDCxw6wEdge/FJ8NwLbESG2Jo+8ccC11u+2kq3+81Caf94hXmUZ1cmeOojx1R+kKTeAoMA6YDrzoRIwOgwfESRU0E/jQGWhQoQt9moYBV4G3wLyuQDsCngJcj9W5Ioy1rkD/KmNxhXa6vpTdrD2HavWjurSkLVT5A7COcGSu0cVOAAAAAElFTkSuQmCC");
                margin: 0.6rem;
                line-height: 1;
                vertical-align: middle;
            }

            .menu-item-6840:before {
                content: url("data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAdCAYAAABSZrcyAAACNklEQVRIieWWTYiNURjHf8OYxTSaEU3IApOPZEKzkAhJSYiilJWFJGVhYecjYmdDLJRsJDRpViLsJFEyY6ghCxtfi6nxPTPNzE+HZ3Tv251mau57Z+FfT+fe+z7v/3+f85zzP6dKpUyoArYAu4B9wMCotEm8DLFafaz2q73qgbFwjld4gXrLv2hVm9Rj6md1al7i09VzUekjdVXBs1r1vXp6NJ7qgg7MBRrG0P6NwFGgG9gDfAMuAnuBF8Av4DhwAbgHfAX6gDfAYKme33Ds6FYPqy3qXXVIfa32qFfU5+p+tSPD+EStyU57fSySNWpDidimdql96ll1iXpZHVQfqMuC9GAUkX77qG4P0XXqvPi8MiveGMlTMj1ZpLbFS4m0WT2p/lA71c0j9LIu+E6od+LPEDzrS/V8JvAU6IjvdcAOYDLwCuiN/qW8L0A7sDuiFHqAI8AzYC3QGjmHgA/Rf5LJNIbwdWBWuRxnBCwEZsT4b9rby2Q2o0VLTP+fvEk5V5pF0VartHgRJlS8egw540FdLLBhzC7iymnB1Yc3DIzgm7ez3l5O3ATmA1uBrgzvHOBh2uZ59HwpsAnYGfs5HTDpxvIu4mXkVeVReRPwE+gscMU0ns8m5iGe7Lg2bDXZ6QbgWqnEPMTfAleBNuBM+HpzwfPhFW9eqz2dkKfidCuFS4VHaqW8fflEensR/m9x48ZSCdQUaqSbTNqT34H7ce3NE4tDY8WweBqnAfUVqHwI+AT0A/wGdHcvw0HSekMAAAAASUVORK5CYII=");
                margin: 0.6rem;
                line-height: 1;
                vertical-align: middle;
            }

            .sidebar-footer > a:before {
                content: url("data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAABv0lEQVRIieWXvU8UQRiHH05CpCDBQlFiCEGiNgYLGwujCSEW/g92VBBirK6WxoqCUjqlgM6EhlJ7ogmJH42GgoagCVaggI+ZOJfcLcuyx81i4S+Z7M7nM/POu+/Mdqm/gS7SKIx1Hfhy0mjdEfoOuAzUgZUOprAO9JVq6V9dUB+rW+qqek3lFGlDvV2mX63BB14CN6KZwsyfAecTbcER1TIFO8AUcA94CHwAHlVCjqbuzzFHTZ1Uv6uv1d4SJmzb1HkKHroQzT8BDKRccBG4oW/AfkpoWXAKdf8L8B1gAxitEnwA/MqUrQGLwJsWeIFXN6cddbiEtw4U1D1XN9XRkD9i+w61VdC9Hp9h5Q86AS8BN0/RrzcEpk7As8DFNvuMAHPAi9R7XJRuqdtqPbRJDZ5XL+WUt0CrAOfF6qEstAqvztMuMA0sN9edReTazkLPCpyr/w/ccK4r8dpznHqAJye0CepvB7wQT5DZGFWypwvxCny1xMAhjH4tRY7f1V31vfpZHa8ocrWk5sw5dUb9oS6pg1WCm53rEJiPvyDh/RPwNO/akkQFs7qvflTX1b0qV5zVW2AMeAXsAT+TrRb4A5xve7qrdbcnAAAAAElFTkSuQmCC");
                margin: 0.6rem;
                line-height: 1;
                vertical-align: middle;
            }

            html {
                margin-top: 0 !important;
            }
        </style>
    </head>
    <script type="text/javascript">


        jQuery(document).ready(function() {

            console.log("inside script");



            jQuery('body#membership-site #menuToggle i.fa-bars').on('click', function () {

                console.log("after click");
                // jQuery('body#membership-site .container-fluid #menu-wrapper').css('display', 'flex');
                jQuery('body#membership-site .sidebar').slideDown();
                // jQuery('body#membership-site .menu').slideDown();
                jQuery('body#membership-site #menuToggle2').css('display', 'flex');
                jQuery('body#membership-site #menuToggle2 i.fa-times').css('display', 'flex');
                jQuery('body#membership-site #menuToggle i.fa-bars').css('display', 'none');

            });

            jQuery('body#membership-site #menuToggle2 i.fa-times').on('click', function () {
                jQuery('body#membership-site .sidebar').slideUp();
                jQuery('body#membership-site #menuToggle i.fa-bars').css('display', 'flex');
                jQuery('body#membership-site #menuToggle2 i.fa-times').css('display', 'none');
                jQuery('body#membership-site #menuToggle2').css('display', 'none');
            });

            var screen = jQuery(window);
            jQuery(screen).on('resize', function (){
                if (screen.width() >= 901) {
                    jQuery('body#membership-site .sidebar').show();
                    jQuery('body#membership-site #menuToggle2 i.fa-times').css('display', 'none');
                    jQuery('body#membership-site #menuToggle2').css('display', 'none');
                    jQuery('body#membership-site #menuToggle i.fa-bars').css('display', 'none');
                }

                if (screen.width() < 901) {
                    jQuery('body#membership-site .sidebar').hide();
                    jQuery('body#membership-site #menuToggle2 i.fa-times').css('display', 'none');
                    jQuery('body#membership-site #menuToggle2').css('display', 'none');
                    jQuery('body#membership-site #menuToggle i.fa-bars').css('display', 'flex');
                }

            });

        });
    </script>

    <body <?php body_class('no-js'); ?> id="membership-site">

        <div class="mobile-menu-button">

            <div class="logo"></div><!--logo-->

         <!--  <div class="menu-toggle">
            <button class="">
                <span></span>
                <span></span>
                <span></span>
                  Menu
            </button>
          </div> -->
            <button id="menuToggle" class="menu-toggle btn-secondary" aria-controls="primary-menu" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu">
            <i class="fas fa-bars icon-rotates"></i></button>
            <button id="menuToggle2" class="menu-toggle btn-secondary" aria-controls="primary-menu" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu"><i class="fas fa-times icon-rotates"></i></button>
        </div>

        <div class="grid_wrapper">

          <div class="sidebar">

            <div class="logo"></div><!--logo-->
            <div class="menu">
                <?php
                    $current_user = wp_get_current_user();
                    $nameArr = explode(" ", $current_user->display_name);

                    echo do_shortcode('[memb_gravatar size=90 default=https://fixyourfrontdesk.com/wp-content/uploads/2020/06/Fix-Your-Front-Desk-profile-default.jpg]');
                ?>
                <!-- <p class="text-center text-light mt-1">Hello, <?= $current_user->display_name; ?></p> -->
                <p class="text-center text-light mt-1">Hello, <?= $nameArr[0]; ?></p>

                <?php
                    wp_nav_menu([
                        'theme_location' => 'membership-menu',
                        'menu_id'        => 'membership-menu',
                        'menu_class'     => 'p-3 m-0',
                    ]);
                ?>
                <p class="sidebar-footer bg-gray d-flex align-items-center justify-content-center p-3">
                    <a href="<?php echo wp_logout_url( home_url()); ?>">
                        Logout
                    </a>
                </p>
            </div><!--menu-->

          </div><!--sidebar-->
