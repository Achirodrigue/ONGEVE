@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xxl-4">
                              <div class="card">
                                   <div class="card-body">
                                        <!-- Crossfade -->
                                        <div id="carouselExampleFade"
                                             class="carousel position-relative slide carousel-fade"
                                             data-bs-ride="carousel">
                                             <h4
                                                  class="badge bg-success text-light fs-14 z-3 m-2 py-1 px-2 position-absolute top-0 start-0">
                                                  New Arrival</h4>

                                             <div class="position-absolute top-0 end-0 m-2 z-3">
                                                  <button type="button"
                                                       class="btn btn-soft-danger p-2 d-inline-flex align-items-center justify-content-center fs-20 w-100"><iconify-icon
                                                            icon="solar:heart-broken"></iconify-icon></button>
                                             </div>
                                             <div class="carousel-inner" role="listbox">
                                                  <div class="carousel-item active">
                                                       <img src="{{ asset(Storage::url($produit->image)) }}" alt=""
                                                            class="img-fluid bg-light w-100 rounded">
                                                  </div>
                                                  <div class="carousel-item">
                                                       <img src="{{ asset(Storage::url($produit->image)) }}" alt=""
                                                            class="img-fluid bg-light w-100 rounded">
                                                  </div>
                                                  <div class="carousel-item">
                                                       <img src="{{ asset(Storage::url($produit->image)) }}" alt=""
                                                            class="img-fluid bg-light w-100 rounded">
                                                  </div>
                                                  <div class="carousel-item">
                                                       <img src="{{ asset(Storage::url($produit->image)) }}" alt=""
                                                            class="img-fluid bg-light w-100 rounded">
                                                  </div>
                                             </div>
                                             <div
                                                  class="carousel-indicators m-0 mt-2 d-lg-flex d-none position-static h-100">
                                                  <button type="button" data-bs-target="#carouselExampleFade"
                                                       data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"
                                                       class="w-auto h-auto rounded-1 bg-light border-0 active">
                                                       <img src="assets/images/product/p-1.png" class="d-block w-100"
                                                            alt="swiper-indicator-img">
                                                  </button>
                                                  <button type="button" data-bs-target="#carouselExampleFade"
                                                       data-bs-slide-to="1" aria-label="Slide 2"
                                                       class="w-auto h-auto rounded-1 bg-light border-0">
                                                       <img src="assets/images/product/p-10.png" class="d-block w-100"
                                                            alt="swiper-indicator-img">
                                                  </button>
                                                  <button type="button" data-bs-target="#carouselExampleFade"
                                                       data-bs-slide-to="2" aria-label="Slide 3"
                                                       class="w-auto h-auto rounded-1 bg-light border-0">
                                                       <img src="assets/images/product/p-13.png" class="d-block w-100"
                                                            alt="swiper-indicator-img">
                                                  </button>
                                                  <button type="button" data-bs-target="#carouselExampleFade"
                                                       data-bs-slide-to="3" aria-label="Slide 3"
                                                       class="w-auto h-auto rounded-1 bg-light border-0">
                                                       <img src="assets/images/product/p-14.png" class="d-block w-100"
                                                            alt="swiper-indicator-img">
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-xxl-8">
                              <div class="card">
                                   <div class="card-body">
                                        <p class="mb-1">
                                             <a href="#!" class="fs-24 text-dark fw-medium">{{ $produit->nom }}</a>
                                        </p>
                                        <div class="d-flex gap-2 align-items-center">
                                             <ul class="d-flex text-warning m-0 fs-20  list-unstyled">
                                                  <li>
                                                       <i class="bx bxs-star"></i>
                                                  </li>
                                                  <li>
                                                       <i class="bx bxs-star"></i>
                                                  </li>
                                                  <li>
                                                       <i class="bx bxs-star"></i>
                                                  </li>
                                                  <li>
                                                       <i class="bx bxs-star"></i>
                                                  </li>
                                                  <li>
                                                       <i class="bx bxs-star-half"></i>
                                                  </li>
                                             </ul>
                                             <p class="mb-0 fw-medium fs-18 text-dark">4.5 <span
                                                       class="text-muted fs-13">(55 Review)</span></p>
                                        </div>
                                        <h2 class="fw-medium my-3">
                                             @if($produit->promo)
                                                  {{ $produit->promo }}F 
                                                  <span class="fs-16 text-decoration-line-through">{{ strrev(wordwrap(strrev($produit->prix), 3, ' ', true)) }}F</span>
                                                  <small class="text-danger ms-2">(30%Off)</small>
                                             @else
                                                  {{ strrev(wordwrap(strrev($produit->prix), 3, ' ', true)) }}F
                                                  <small class="text-danger ms-2">(30%Off)</small>
                                             @endif
                                        </h2>
                                        <ul class="d-flex flex-column gap-2 list-unstyled fs-15 my-3">
                                             <li>
                                                  <i class='bx bx-check text-success'></i> 
                                                  Etat : @if($produit->isvalide) <span class="text-warning fw-medium">Activé</span> @else <span class="text-danger fw-medium">Désactivé</span> @endif
                                             </li>
                                             <li>
                                                  <i class='bx bx-check text-success'></i> 
                                                  Stock : @if($produit->stock) <span class="text-warning fw-medium">Disponible</span> @else <span class="text-danger fw-medium">Epuisé</span> @endif
                                             </li>
                                             <li>
                                                  <i class='bx bx-check text-success'></i> 
                                                  Promotion : @if($produit->promo) <span class="text-warning fw-medium">Ajouté</span> @else <span class="text-danger fw-medium">Aucune</span> @endif
                                             </li>
                                        </ul>

                                        <h4 class="text-dark fw-medium mt-3">Description :</h4>
                                        <div class="d-flex align-items-center mt-2">
                                             <i class="bx bxs-bookmarks text-success me-3 fs-20 mt-1"></i>
                                             <p class="mb-0"><span class="fw-medium text-dark">
                                                  @if($produit->description) {{ $produit->description }} @else Aucune description @endif
                                             </p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-lg-12">
                              <div class="card bg-light-subtle">
                                   <div class="card-body">
                                        <div class="row g-4">
                                             <div class="col-xxl-3 col-lg-6">
                                                  <div class="d-flex gap-3">
                                                       <div
                                                            class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon icon="solar:kick-scooter-bold-duotone"
                                                                 class="fs-35 text-primary"></iconify-icon>
                                                       </div>

                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Free shipping for
                                                                 all orders over $200</p>
                                                            <p class="mb-0">Only in this week</p>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-xxl-3 col-lg-6">
                                                  <div class="d-flex gap-3">
                                                       <div
                                                            class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon icon="solar:ticket-bold-duotone"
                                                                 class="fs-35 text-primary"></iconify-icon>
                                                       </div>

                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Special discounts
                                                                 for customers</p>
                                                            <p class="mb-0">Coupons up to $ 100</p>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-xxl-3 col-lg-6">
                                                  <div class="d-flex gap-3">
                                                       <div
                                                            class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon icon="solar:gift-bold-duotone"
                                                                 class="fs-35 text-primary"></iconify-icon>
                                                       </div>

                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Free gift wrapping
                                                            </p>
                                                            <p class="mb-0">With 100 letters custom note</p>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-xxl-3 col-lg-6">
                                                  <div class="d-flex gap-3">
                                                       <div
                                                            class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                            <iconify-icon
                                                                 icon="solar:headphones-round-sound-bold-duotone"
                                                                 class="fs-35 text-primary"></iconify-icon>
                                                       </div>

                                                       <div>
                                                            <p class="text-dark fw-medium fs-16 mb-1">Expert Customer
                                                                 Service</p>
                                                            <p class="mb-0">8:00 - 20:00, 7 days/wee</p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-xxl-8">
                              <div class="card">
                                   <div class="card-header text-white">
                                        <h4 class="card-title mb-0">Items Detail</h4>
                                   </div>
                                   <div class="card-body p-0">
                                        <div class="table-responsive border-bottom">
                                             <table class="table table-striped align-middle mb-0">
                                                  <tbody>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Product Dimensions</td>
                                                            <td>53.3 x 40.6 x 6.4 cm; 500 Grams</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Date First Available</td>
                                                            <td>22 September 2023</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Department</td>
                                                            <td>Men</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Manufacturer</td>
                                                            <td>Greensboro, NC 27401 Prospa-Pal</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">ASIN</td>
                                                            <td>B0CJMML118</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Item Model Number</td>
                                                            <td>1137AZ</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Country of Origin</td>
                                                            <td>U.S.A</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Manufacturer Address</td>
                                                            <td>Suite 941 89157 Baumbach Views, Gilbertmouth, TX
                                                                 31542-2135</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Packer</td>
                                                            <td>Apt. 726 80915 Hung Stream, Rowetown, WV 44364</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Importer</td>
                                                            <td>Apt. 726 80915 Hung Stream, Rowetown, WV 44364</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Item Weight</td>
                                                            <td>500 g</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Item Dimensions LxWxH</td>
                                                            <td>53.3 x 40.6 x 6.4 Centimeters</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Generic Name</td>
                                                            <td>T-Shirt</td>
                                                       </tr>
                                                       <tr>
                                                            <td class="text-dark fw-semibold">Best Sellers Rank</td>
                                                            <td>#13 in Clothing & Accessories</td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                        <div class="p-3">
                                             <a href="#!" class="text-primary text-decoration-underline">
                                                  View More Details <i class="bi bi-arrow-right align-middle"></i>
                                             </a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-xxl-4">
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Top Review From World</h4>
                                   </div>
                                   <div class="card-body">
                                        <div>
                                             <div class="d-flex gap-2">
                                                  <img src="assets/images/users/avatar-6.jpg" alt=""
                                                       class="avatar-sm rounded">
                                                  <div>
                                                       <h5 class="mb-0">Henny K. Mark</h5>
                                                  </div>
                                             </div>
                                             <div class="d-flex align-items-center gap-2 mt-3 mb-1">
                                                  <ul class="d-flex text-warning m-0 fs-20 list-unstyled">
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star-half"></i>
                                                       </li>
                                                  </ul>
                                                  <p class="fw-medium mb-0 text-dark fs-15">Excellent Quality</p>
                                             </div>

                                             <p class="mb-0 text-dark fw-medium fs-15">Reviewed in Canada on 16 November
                                                  2023
                                             </p>
                                             <p class="text-muted">Great quality! Medium thickness, good elasticity, and
                                                  no shrinkage after wash. XL size fits perfectly for a 5'10" heavy
                                                  build. Highly recommended, especially at this price.</p>
                                             <div class="mt-2">
                                                  <a href="#!" class="fs-14 me-3 text-muted"><i class='bx bx-like'></i>
                                                       Helpful</a>
                                                  <a href="#!" class="fs-14 text-muted">Report</a>
                                             </div>
                                        </div>

                                        <hr class="my-3">

                                        <div>
                                             <div class="d-flex gap-2">
                                                  <img src="assets/images/users/avatar-4.jpg" alt=""
                                                       class="avatar-sm rounded">
                                                  <div>
                                                       <h5 class="mb-0">Jorge Herry</h5>
                                                  </div>
                                             </div>
                                             <div class="d-flex align-items-center gap-2 mt-3 mb-1">
                                                  <ul class="d-flex text-warning m-0 fs-20 list-unstyled">
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star-half"></i>
                                                       </li>
                                                  </ul>
                                                  <p class="fw-medium mb-0 text-dark fs-15">Good Quality</p>
                                             </div>

                                             <p class="mb-0 text-dark fw-medium fs-15">Reviewed in U.S.A on 21 December
                                                  2023

                                             </p>
                                             <p class="text-muted mb-0">Lightweight and fits true to size. Only the
                                                  maroon color faded slightly in the first wash, but overall, very
                                                  satisfied with the purchase</p>
                                             <p class="text-muted mb-0">best rated</p>

                                             <div class="mt-2">
                                                  <a href="#!" class="fs-14 me-3 text-muted"><i class='bx bx-like'></i>
                                                       Helpful</a>
                                                  <a href="#!" class="fs-14 text-muted">Report</a>
                                             </div>
                                        </div>

                                        <hr class="my-3">

                                        <div>
                                             <div class="d-flex gap-2">
                                                  <img src="assets/images/users/avatar-6.jpg" alt=""
                                                       class="avatar-sm rounded">
                                                  <div>
                                                       <h5 class="mb-0">Henny K. Mark</h5>
                                                  </div>
                                             </div>
                                             <div class="d-flex align-items-center gap-2 mt-3 mb-1">
                                                  <ul class="d-flex text-warning m-0 fs-20 list-unstyled">
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star"></i>
                                                       </li>
                                                       <li>
                                                            <i class="bx bxs-star-half"></i>
                                                       </li>
                                                  </ul>
                                                  <p class="fw-medium mb-0 text-dark fs-15">Excellent Quality</p>
                                             </div>

                                             <p class="mb-0 text-dark fw-medium fs-15">Reviewed in Canada on 16 November
                                                  2023</p>
                                             <p class="text-muted">Comfortable and durable. Maintained its color and
                                                  shape after multiple washes. Great value for the price</p>
                                             <div class="mt-2">
                                                  <a href="#!" class="fs-14 me-3 text-muted">
                                                       <i class='bx bx-like'></i>
                                                       Helpful
                                                  </a>
                                                  <a href="#!" class="fs-14 text-muted">Report</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->


@endsection