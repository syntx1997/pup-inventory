<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    protected $_view_;
    protected $_partials_;
    protected $_fragment_;
    protected $_dashboardLink_;

    public function __construct() {
        $this->_view_ = 'pages.dashboard.employee.';
        $this->_partials_ = 'partials.dashboard.employee.';
        $this->_dashboardLink_ = '/dashboard/employee/';
        $this->_fragment_ = [
            'sidebar' => $this->_partials_.'_sidebar',
            'topbar' => $this->_partials_.'_topbar',
        ];
    }

    public function index() {
        $title = 'Employee Dashboard';
        $fragment = $this->_fragment_;
        $dashboardLink = $this->_dashboardLink_;

        return view($this->_view_.'index', compact(
            'title', 'fragment', 'dashboardLink'
        ));
    }
}
