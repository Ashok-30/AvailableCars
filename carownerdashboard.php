<?php 
session_start();
include('templates/ownerdashboardheader.php');
include('templates/ownersidebar.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Car Owner') {
  header('Location: login.php');
  exit();
}
?>


<div class="container-dashboard py-5">
  <div class="row" >
    <div class="col-lg-12">
      <a class="text-decoration-none" href="#">
        <div class="card p-3 shadow text-center border-0">
          <div class="card-body">
          <h1> <i class="fa fa-dashboard" aria-hidden="true"></i> Rentals</h1>
            <hr />      
          </div>
        </div>
      </a>
  </div>
  </div>
  <div class="row">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
      <a class="text-decoration-none" href="#">
        <div class="card p-3 shadow text-center border-0">
          <div class="card-body">
            <i class="fa fa-tags fa-2x" aria-hidden="true"></i>
            <hr />
            <p class="card-title lead">Rental status</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
      <a class="text-decoration-none" href="#">
        <div class="card p-3 shadow text-center border-0">
          <div class="card-body">
            <i class="fa fa-edit fa-2x" aria-hidden="true"></i>
            <hr />
            <p class="card-title lead">Listings</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
      <a class="text-decoration-none" href="addcar.php">
        <div class="card p-3 shadow text-center border-0">
          <div class="card-body">
            <i class="fa fa-automobile fa-2x" aria-hidden="true"></i>
            <hr />
            <p class="card-title lead">Add Car</p>
          </div>
        </div>
      </a>
    </div>




    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
      <a class="text-decoration-none" href="#">
        <div class="card p-3 shadow text-center border-0">
          <div class="card-body">
            <i class="fa fa-money-bill fa-2x" aria-hidden="true"></i>
            <hr />
            <p class="card-title lead">Financials</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
      <a class="text-decoration-none" href="#">
        <div class="card p-3 shadow text-center border-0">
          <div class="card-body">
            <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
            <hr />
            <p class="card-title lead">Inbox</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-2">
      <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#modelHELP">
        <div class="card p-3 shadow text-center border-0">
          <div class="card-body">
            <i class="fa fa-question fa-2x" aria-hidden="true"></i>
            <hr />
            <p class="card-title lead">Help</p>
          </div>
        </div>
      </a>
    </div>

  </div>
</div>
