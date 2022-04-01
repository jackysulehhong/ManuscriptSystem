<?php
//database connection, timeout counter and navbar
include('shared/connect.php');

//include('shared/userSession.php');
include("shared/layout/header.php");

?>

<style>
.social-link {
 width: 30px;
 height: 30px;
 border: 1px solid #ddd;
 display: flex;
 align-items: center;
 justify-content: center;
 color: #666;
 border-radius: 50%;
 transition: all 0.3s;
 font-size: 0.9rem;
}

.social-link:hover,
.social-link:focus {
 background: #ddd;
 text-decoration: none;
 color: #555;
}
</style>

<div class="bg-light">
 <div class="container py-5">
  <div class="row h-100 align-items-center py-5">
   <div class="col-lg-6">
    <h1 class="display-4">About SBC Shuttle Bus Central</h1>
    <p class="lead text-muted mb-0">SBC Shuttle Bus Central is an shuttle bus company born in 1948. As one
     of the
     leading
     shuttle bus companies, our goal is to enhance people's living standards. We believe that confidence
     drives every journey. Our goal is not only to be a payer, but also a truly unique partner,
     encouraging you to go further and providing support for every step of your life.</p>

   </div>
   <div class="col-lg-6 d-none d-lg-block"><img
     src="https://res.cloudinary.com/mhmd/image/upload/v1556834136/illus_kftyh4.png" alt="" class="img-fluid"></div>
  </div>
 </div>
</div>

<div class="bg-white py-5">
 <div class="container py-5">
  <div class="row align-items-center mb-5">
   <div class="col-lg-6 order-2 order-lg-1"><i class="fa fa-bar-chart fa-2x mb-3 text-primary"></i>
    <h2 class="font-weight-light">Corporate Profile</h2>
    <p class="font-italic text-muted mb-4">SBC Shuttle Bus Central is a leading shuttle bus service in
     Malaysia,
     where we have been
     privileged to do business since 1948.</p>
    <a href="#" class="btn btn-light px-5 rounded-pill shadow-sm">Learn More</a>
   </div>
   <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img
     src="https://res.cloudinary.com/mhmd/image/upload/v1556834139/img-1_e25nvh.jpg" alt=""
     class="img-fluid mb-4 mb-lg-0"></div>
  </div>
  <div class="row align-items-center">
   <div class="col-lg-5 px-5 mx-auto"><img
     src="https://res.cloudinary.com/mhmd/image/upload/v1556834136/img-2_vdgqgn.jpg" alt=""
     class="img-fluid mb-4 mb-lg-0"></div>
   <div class="col-lg-6"><i class="fa fa-leaf fa-2x mb-3 text-primary"></i>
    <h2 class="font-weight-light">SBC Shuttle Bus Central Around Malaysia</h2>
    <p class="font-italic text-muted mb-4">Part of the SBC Shuttle Bus Central Group, the largest
     independent
     publicly
     listed pan-Asian life shuttle bus service group, SBC Shuttle Bus Central. has the financial
     strength,
     experience, service
     centre network and a well-trained team of more than 2,000 employees to serve our 3.9 million
     customers nationwide.</p><a href="#" class="btn btn-light px-5 rounded-pill shadow-sm">Learn
     More</a>
   </div>
  </div>
 </div>
</div>

<div class="bg-light py-5">
 <div class="container py-5">
  <div class="row mb-4">
   <div class="col-12">
    <h2 class="display-4 font-weight-light">Our team</h2>
    <p class="font-italic text-muted">Our people are the foundation of our success and the drivers of our
     promise to help Malaysians can make their travel more easier.</p>
   </div>
  </div>

  <div class="row text-center">
   <div class="col-md-6 mb-5">
    <div class="bg-white rounded shadow-sm py-5 px-4"><img
      src="https://res.cloudinary.com/mhmd/image/upload/v1556834130/avatar-3_hzlize.png" alt="" width="100"
      class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
     <h5 class="mb-0">Muhammad Adam Bin Yazid</h5><span class="small text-uppercase text-muted">Project
      Manager</span>
     <ul class="social mb-0 list-inline mt-3">
      <li class="list-inline-item"><a href="mailto:may997@uowmail.edu.au" class="social-link"><i
         class="fas fa-envelope"></i></a></li>
     </ul>
    </div>
   </div>

   <!-- Team item-->
   <div class="col-md-6 mb-5">
    <div class="bg-white rounded shadow-sm py-5 px-4"><img
      src="https://res.cloudinary.com/mhmd/image/upload/v1556834130/avatar-3_hzlize.png" alt="" width="100"
      class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
     <h5 class="mb-0">Cheah Shao Qi</h5><span class="small text-uppercase text-muted">Lead
      Programmer</span>
     <ul class="social mb-0 list-inline mt-3">
      <li class="list-inline-item"><a href="mailto:sqc992@uowmail.edu.au" class="social-link"><i
         class="fas fa-envelope"></i></a></li>
     </ul>
    </div>
   </div>
   <!-- End-->

   <!-- Team item-->
   <div class="col-md-6 mb-5">
    <div class="bg-white rounded shadow-sm py-5 px-4"><img
      src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-2_f8dowd.png" alt="" width="100"
      class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
     <h5 class="mb-0">Yap Kah Wee</h5><span class="small text-uppercase text-muted">Junior
      Programmer</span>
     <ul class="social mb-0 list-inline mt-3">
      <li class="list-inline-item"><a href="mailto:kwy341@uowmail.edu.au" class="social-link"><i
         class="fas fa-envelope"></i></a></li>
     </ul>
    </div>
   </div>
   <!-- End-->

   <!-- Team item-->
   <div class="col-md-6 mb-5">
    <div class="bg-white rounded shadow-sm py-5 px-4"><img
      src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-1_s02nlg.png" alt="" width="100"
      class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
     <h5 class="mb-0">Jacky Su Leh Hong</h5><span class="small text-uppercase text-muted">Junior
      Programmer and Designer</span>
     <ul class="social mb-0 list-inline mt-3">
      <li class="list-inline-item"><a href="mailto:lhs860@uowmail.edu.au" class="social-link"><i
         class="fas fa-envelope"></i></a></li>
     </ul>
    </div>
   </div>


   <!-- End-->

  </div>
 </div>
</div>

<?php
include("shared/layout/footer.php");