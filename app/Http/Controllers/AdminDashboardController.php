<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $dashboarLink = '/dashboard/admin/';

        return view($this->_view_.'index', compact(
            'title', 'fragment', 'dashboarLink'
        ));
    }

    public function supplies() {
        $title = 'Supplies';
        $fragment = $this->_fragment_;
        $dashboarLink = '/dashboard/admin/';

        return view($this->_view_.'supplies', compact(
            'title', 'fragment', 'dashboarLink'
        ));
    }

    public function equipments() {
        $title = 'Equipments';
        $fragment = $this->_fragment_;
        $dashboarLink = '/dashboard/admin/';

        return view($this->_view_.'equipments', compact(
            'title', 'fragment', 'dashboarLink'
        ));
    }

    public function inventory() {
        $title = 'Inventory';
        $fragment = $this->_fragment_;
        $dashboarLink = '/dashboard/admin/';

        return view($this->_view_.'inventory', compact(
            'title', 'fragment', 'dashboarLink'
        ));
    }

    public function employees() {
        $title = 'Employees';
        $fragment = $this->_fragment_;
        $dashboarLink = '/dashboard/admin/';

        return view($this->_view_.'employees', compact(
            'title', 'fragment', 'dashboarLink'
        ));
    }
}
