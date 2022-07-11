<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    protected $_view_;
    protected $_partials_;
    protected $_fragment_;

    public function __construct() {
        $this->_view_ = 'pages.dashboard.admin.';
        $this->_partials_ = 'partials.dashboard.admin.';
        $this->_fragment_ = [
            'sidebar' => $this->_partials_.'_sidebar',
            'topbar' => $this->_partials_.'_topbar',
        ];
    }

    public function index() {
        $title = 'Admin Dashboard';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'index', compact(
            'title', 'fragment', 'dashboardLink', 'totalRequests'
        ));
    }

    public function categories() {
        $title = 'Categories';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js'.$dashboardLink.'categories.js');
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'categories', compact(
            'title', 'fragment', 'dashboardLink', 'js', 'totalRequests'
        ));
    }

    public function supplies() {
        $title = 'Supplies';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $categories = Category::all();
        $js = asset('js'.$dashboardLink.'supplies.js');
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'supplies', compact(
            'title', 'fragment', 'dashboardLink',
            'categories', 'js', 'totalRequests'
        ));
    }

    public function equipments() {
        $title = 'Equipments';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $categories = Category::all();
        $js = asset('js'.$dashboardLink.'equipments.js');
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'equipments', compact(
            'title', 'fragment', 'dashboardLink',
            'categories', 'js', 'totalRequests'
        ));
    }

    public function inventory() {
        $title = 'Inventory';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js'.$dashboardLink.'inventory.js');
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'inventory', compact(
            'title', 'fragment', 'dashboardLink', 'js',
            'totalRequests'
        ));
    }

    public function requests() {
        $title = 'Requests';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $totalRequests = count(Transaction::where('status', 'On Process')->get());
        $js = asset('js'.$dashboardLink.'requests.js');

        return view($this->_view_.'requests', compact(
            'title', 'fragment', 'dashboardLink',
            'totalRequests', 'js'
        ));
    }

    public function employees() {
        $title = 'Employees';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js'.$dashboardLink.'employees.js');
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'employees', compact(
            'title', 'fragment', 'dashboardLink', 'js', 'totalRequests'
        ));
    }

    public function archived() {
        $title = 'Archived';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js'.$dashboardLink.'archived.js');
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'archived', compact(
            'title', 'fragment', 'dashboardLink', 'js', 'totalRequests'
        ));
    }

    public function settings() {
        $title = 'Settings';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js/dashboard/settings.js');
        $totalRequests = count(Transaction::where('status', 'On Process')->get());

        return view($this->_view_.'settings', compact(
            'title', 'fragment', 'dashboardLink', 'js', 'totalRequests'
        ));
    }
}
