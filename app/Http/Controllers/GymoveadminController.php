<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class GymoveadminController extends Controller
{

	    // Dashboard
    public function dashboard_1()
    {


        $data['page_title'] = 'Dashboard';
        $data['page_description'] = 'Some description for the page';
        $data['logo'] = "images/logo.png";
        $data['logoText'] = "images/logo-text.png";
        $active="active";
        $event_class="schedule-event";
        $button_class="btn-primary";
        $data['action'] = [__FUNCTION__];

        return view('dashboard.index', compact('data','active','event_class','button_class'));
    }

     // Ajax Featured Menu List
    public function featured_menu_list()
    {
        return view('dashboard.featured_menu_list');
    }

    // Workout Statistic
    public function workout_statistic()
    {

        $data['page_title'] = 'Workout Statistic';
        $data['page_description'] = 'Some description for the page';
        $data['logo'] = "images/logo.png";
        $data['logoText'] = "images/logo-text.png";

        $data['action'] = [__FUNCTION__];

        return view('dashboard.workout_statistic', compact('data'));
    }

	     // Workoutplan
    public function workoutplan()
    {
        $data['page_title'] = 'Workout Plan';
        $data['page_description'] = 'Some description for the page';
        $data['logo'] = "images/logo.png";
        $data['logoText'] = "images/logo-text.png";

        $data['action'] = [__FUNCTION__];

        return view('dashboard.workoutplan', compact('data'));
    }
	    // Distance Map
    public function distance_map()
    {
        $data['page_title'] = 'Distance Map';
        $data['page_description'] = 'Some description for the page';
        $data['logo'] = "images/logo.png";
        $data['logoText'] = "images/logo-text.png";

        $data['action'] = [__FUNCTION__];

        return view('dashboard.distance_map', compact('data'));
    }

     // Ajax Recent Activities
    public function recent_activities()
    {
        return view('dashboard.recent_activities');
    }
	    // Food Menu
    public function food_menu()
    {
        $data['page_title'] = 'Statistics';
        $data['page_description'] = 'Some description for the page';
        $data['logo'] = "images/logo.png";
        $data['logoText'] = "images/logo-text.png";

        $data['action'] = [__FUNCTION__];

        return view('dashboard.food_menu', compact('data'));
    }

     // Ajax Food Menu List
    public function food_menu_list()
    {
        return view('dashboard.food_menu_list');
    }

     // Ajax Trending Ingridients
    public function trending_ingridients()
    {
        return view('dashboard.trending_ingridients');
    }
	    // Personal Record
    public function personal_record()
    {
        $data['page_title'] = 'Companies';
        $data['page_description'] = 'Some description for the page';
        $data['logo'] = "images/logo.png";
        $data['logoText'] = "images/logo-text.png";

        $data['action'] = [__FUNCTION__];

        return view('dashboard.personal_record', compact('data'));
    }
	    // Calender
    public function app_calender()
    {
        $data['page_title'] = 'Calender';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('app.calender', compact('data'));
    }

	    // Profile
    public function app_profile()
    {
        $data['page_title'] = 'Profile';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('app.profile', compact('data'));
    }
	    // Post Details
    public function post_details()
    {
        $data['page_title'] = 'Post Details';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('app.post_details', compact('data'));
    }

	    // Chart Chartist
    public function chart_chartist()
    {
        $data['page_title'] = 'Chart Chartist';
        $data['page_description'] = 'Some description for the page';
        $data['action'] = [__FUNCTION__];

        return view('chart.chartist', compact('data'));
    }

	    // Chart Chartjs
    public function chart_chartjs()
    {
        $data['page_title'] = 'Chart Chartjs';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('chart.chartjs', compact('data'));
    }

	    // Chart Flot
    public function chart_flot()
    {
        $data['page_title'] = 'Chart Flot';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('chart.flot', compact('data'));
    }

	    // Chart Morris
    public function chart_morris()
    {
        $data['page_title'] = 'Chart Morris';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('chart.morris', compact('data'));
    }

	    // Chart Peity
    public function chart_peity()
    {
        $data['page_title'] = 'Chart Peity';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('chart.peity', compact('data'));
    }

	    // Chart Sparkline
    public function chart_sparkline()
    {
        $data['page_title'] = 'Chart Sparkline';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('chart.sparkline', compact('data'));
    }

	    // Ecommerce Checkout
    public function ecom_checkout()
    {
        $data['page_title'] = 'Checkout';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('ecom.checkout', compact('data'));
    }

	    // Ecommerce Customers
    public function ecom_customers()
    {
        $data['page_title'] = 'Ecom Customers';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ecom.customers', compact('data'));
    }

	    // Ecommerce Invoice
    public function ecom_invoice()
    {
        $data['page_title'] = 'Invoice';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ecom.invoice', compact('data'));
    }

	    // Ecommerce Product Detail
    public function ecom_product_detail()
    {
        $data['page_title'] = 'Product Detail';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ecom.productdetail', compact('data'));
    }

	    // Ecommerce Product Grid
    public function ecom_product_grid()
    {
        $data['page_title'] = 'Product Grid';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ecom.productgrid', compact('data'));
    }

	    // Ecommerce Product List
    public function ecom_product_list()
    {
        $data['page_title'] = 'Product List';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ecom.productlist', compact('data'));
    }

	    // Ecommerce Product Order
    public function ecom_product_order()
    {
        $data['page_title'] = 'Product Order';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ecom.productorder', compact('data'));
    }

	    // Email Compose
    public function email_compose()
    {
        $data['page_title'] = 'Compose';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('message.compose', compact('data'));
    }

	    // Email Inbox
    public function email_inbox()
    {
        $data['page_title'] = 'Inbox';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('message.inbox', compact('data'));
    }

	    // Email Read
    public function email_read()
    {
        $data['page_title'] = 'Read';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('message.read', compact('data'));
    }

	    // Form Editor Summernote
    public function form_editor_summernote()
    {
        $data['page_title'] = 'Summernote Editor';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('form.editorsummernote', compact('data'));
	}

	    // Form Element
    public function form_element()
    {
        $data['page_title'] = 'Form Element';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('form.element', compact('data'));
    }

	    // Form Pickers
    public function form_pickers()
    {
        $data['page_title'] = 'Form Pickers';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('form.pickers', compact('data'));
    }

	    // Form Validation Jquery
    public function form_validation_jquery()
    {
        $data['page_title'] = 'Form Validation';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('form.validationjquery', compact('data'));
    }

	    // Form Wizard
    public function form_wizard()
    {
        $data['page_title'] = 'Form Wizard';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('form.wizard', compact('data'));
    }


	    // Map Jqvmap
    public function map_jqvmap()
    {
        $data['page_title'] = 'Map Jqvmap';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('map.jqvmap', compact('data'));
    }

	    // Page Error 400
    public function page_error_400()
    {
        $data['page_title'] = 'Page Error 400';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('page.error400', compact('data'));
    }

	    // Page Error 403
    public function page_error_403()
    {
        $data['page_title'] = 'Page Error 403';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('page.error403', compact('data'));
    }

	    // Page Error 404
    public function page_error_404()
    {
        $data['page_title'] = 'Page Error 404';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('page.error404', compact('data'));
    }

	    // Page Error 500
    public function page_error_500()
    {
        $data['page_title'] = 'Page Error 500';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('page.error500', compact('data'));
    }

	    // Page Error 503
    public function page_error_503()
    {
        $data['page_title'] = 'Page Error 503';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('page.error503', compact('data'));
    }

	    // Page Forgot Password
    public function page_forgot_password()
    {
        $data['page_title'] = 'Page Forgot Password';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('page.forgot_password', compact('data'));
    }

	    // Page Lock Screen
    public function page_lock_screen()
    {
        $data['page_title'] = 'Page Lock Screen';
        $data['page_description'] = 'Some description for the page';

        $data['action'] = [__FUNCTION__];

        return view('page.lockscreen', compact('data'));
    }

	    // Page Login
    public function page_login()
    {
        $data['page_title'] = 'Page Login';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('page.login', compact('data'));
    }

	    // Page Register
    public function page_register()
    {
        $data['page_title'] = 'Page Register';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('page.register', compact('data'));
    }

	    // Table Bootstrap Basic
    public function table_bootstrap_basic()
    {
        $data['page_title'] = 'Table Basic';
        $data['page_description'] = 'Some description for the page';
        $data['action'] = [__FUNCTION__];
        return view('table.bootstrapbasic', compact('data'));
    }

	    // Table Datatable Basic
    public function table_datatable_basic()
    {
        $data['page_title'] = 'Table Datatable';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('table.datatablebasic', compact('data'));
    }
	    // UC Nestable.
    public function uc_nestable()
    {
        $data['page_title'] = 'Nestable';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('uc.nestable', compact('data'));
    }
	    // UC Lightgallery.
    public function uc_lightgallery()
    {
        $data['page_title'] = 'Lightgallery';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('uc.lightgallery', compact('data'));
    }

	    // UC NoUi Slider
    public function uc_noui_slider()
    {
        $data['page_title'] = 'Noui Slider';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('uc.nouislider', compact('data'));
    }

	    // UC Select2
    public function uc_select2()
    {
        $data['page_title'] = 'Select2';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('uc.select2', compact('data'));
    }

	    // UC Sweetalert
    public function uc_sweetalert()
    {
        $data['page_title'] = 'Sweetalert';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('uc.sweetalert', compact('data'));
    }

	    // UC Toastr
    public function uc_toastr()
    {
        $data['page_title'] = 'Toastr';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('uc.toastr', compact('data'));
    }

	    // Ui Accordion
    public function ui_accordion()
    {
        $data['page_title'] = 'Accordion';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.accordion', compact('data'));
    }

	    // Ui Alert
    public function ui_alert()
    {
        $data['page_title'] = 'Alert';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.alert', compact('data'));
    }

	    // Ui Badge
    public function ui_badge()
    {
        $data['page_title'] = 'Badge';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.badge', compact('data'));
    }

	    // Ui Button
    public function ui_button()
    {
        $data['page_title'] = 'Button';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.button', compact('data'));
    }

	    // Ui Button Group
    public function ui_button_group()
    {
        $data['page_title'] = 'Button Group';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.buttongroup', compact('data'));
    }

	    // Ui Card
    public function ui_card()
    {
        $data['page_title'] = 'Card';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.card', compact('data'));
    }

	    // Ui Carousel
    public function ui_carousel()
    {
        $data['page_title'] = 'Carousel';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.carousel', compact('data'));
    }

	    // Ui Dropdown
    public function ui_dropdown()
    {
        $data['page_title'] = 'Dropdown';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.dropdown', compact('data'));
    }

	    // Ui Grid
    public function ui_grid()
    {
        $data['page_title'] = 'Grid';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.grid', compact('data'));
    }

	    // Ui List Group
    public function ui_list_group()
    {
        $data['page_title'] = 'List Group';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.listgroup', compact('data'));
    }

	    // Ui Media Object
    public function ui_media_object()
    {
        $data['page_title'] = 'Media Object';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.mediaobject', compact('data'));
    }

	    // Ui Modal
    public function ui_modal()
    {
        $data['page_title'] = 'Modal';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.modal', compact('data'));
    }

	    // Ui Pagination
    public function ui_pagination()
    {
        $data['page_title'] = 'Pagination';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.pagination', compact('data'));
    }

	    // Ui Popover
    public function ui_popover()
    {
        $data['page_title'] = 'Popover';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.popover', compact('data'));
    }

	    // Ui Progressbar
    public function ui_progressbar()
    {
        $data['page_title'] = 'Progressbar';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.progressbar', compact('data'));
    }

	    // Ui Tab
    public function ui_tab()
    {
        $data['page_title'] = 'Tab';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.tab', compact('data'));
    }


	    // Ui Typography
    public function ui_typography()
    {
        $data['page_title'] = 'Typography';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('ui.typography', compact('data'));
    }

	    // Widget Basic
    public function widget_basic()
    {
        $data['page_title'] = 'Widget';
        $data['page_description'] = 'Some description for the page';

		$data['action'] = [__FUNCTION__];

        return view('widget.widget_basic', compact('data'));
    }
}
