<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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

        return view($this->_view_.'index', compact(
            'title', 'fragment', 'dashboardLink'
        ));
    }

    public function categories() {
        $title = 'Categories';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js'.$dashboardLink.'categories.js');

        return view($this->_view_.'categories', compact(
            'title', 'fragment', 'dashboardLink', 'js'
        ));
    }

    public function supplies() {
        $title = 'Supplies';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $categories = Category::all();
        $js = asset('js'.$dashboardLink.'supplies.js');

        return view($this->_view_.'supplies', compact(
            'title', 'fragment', 'dashboardLink',
            'categories', 'js'
        ));
    }

    public function equipments() {
        $title = 'Equipments';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $categories = Category::all();
        $js = asset('js'.$dashboardLink.'equipments.js');

        return view($this->_view_.'equipments', compact(
            'title', 'fragment', 'dashboardLink',
            'categories', 'js'
        ));
    }

    public function inventory() {
        $title = 'Inventory';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js'.$dashboardLink.'inventory.js');

        return view($this->_view_.'inventory', compact(
            'title', 'fragment', 'dashboardLink', 'js'
        ));
    }

    public function requests() {
        $title = 'Requests';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';

        return view($this->_view_.'requests', compact(
            'title', 'fragment', 'dashboardLink'
        ));
    }

    public function employees() {
        $title = 'Employees';
        $fragment = $this->_fragment_;
        $dashboardLink = '/dashboard/admin/';
        $js = asset('js'.$dashboardLink.'employees.js');

        return view($this->_view_.'employees', compact(
            'title', 'fragment', 'dashboardLink', 'js'
        ));
    }
}
