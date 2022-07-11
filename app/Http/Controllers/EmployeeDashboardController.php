<?php

namespace App\Http\Controllers;
use App\Models\Transaction;

class EmployeeDashboardController extends Controller
{
    protected $_view_;
    protected $_partials_;
    protected $_fragment_;
    protected $_dashboardLink_;

    protected $_totalRequests_;

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
//        $title = 'Employee Dashboard';
//        $fragment = $this->_fragment_;
//        $dashboardLink = $this->_dashboardLink_;
//        $totalRequests = count(Transaction::where(['user_id' => auth()->user()->id, 'status' => 'On Process'])->get());
//
//        return view($this->_view_.'index', compact(
//            'title', 'fragment', 'dashboardLink', 'totalRequests'
//        ));
        return redirect($this->_dashboardLink_.'requests');
    }

    public function requests() {
        $title = 'My Requests';
        $fragment = $this->_fragment_;
        $dashboardLink = $this->_dashboardLink_;
        $js = asset('js'.$dashboardLink.'requests.js');
        $totalRequests = count(Transaction::where(['user_id' => auth()->user()->id, 'status' => 'On Process'])->get());

        return view($this->_view_.'requests', compact(
            'title', 'fragment', 'dashboardLink', 'js', 'totalRequests'
        ));
    }
}
