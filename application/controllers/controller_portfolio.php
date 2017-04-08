<?php

class ControllerPortfolio extends Controller
{
    function __construct()
    {
        $this->model = new Portfolio();
        parent::__construct();
    }

    function index()
    {
        $data = $this->model->get_data();
        $this->view->generate('portfolio_view.php', 'template_view.php', $data);
    }
}

Contact GitHub API Training Shop Blog About
© 2017 GitHub, Inc. Terms Privacy Security Status Help