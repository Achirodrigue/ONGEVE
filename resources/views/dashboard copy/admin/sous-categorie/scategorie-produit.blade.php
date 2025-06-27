@extends('dashboard.admin.layout.app')
@section('body')


               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                        <h4 class="card-title flex-grow-1">All Product List</h4>

                                        <a href="product-add.html" class="btn btn-sm btn-primary">
                                             Add Product
                                        </a>

                                        <div class="dropdown">
                                             <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light"
                                                  data-bs-toggle="dropdown" aria-expanded="false">
                                                  This Month
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-end">
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Download</a>
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Export</a>
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Import</a>
                                             </div>
                                        </div>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            <th style="width: 20px;">
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck1">
                                                                      <label class="form-check-label"
                                                                           for="customCheck1"></label>
                                                                 </div>
                                                            </th>
                                                            <th>Product Name</th>
                                                            <th>Price</th>
                                                            <th>Create by</th>
                                                            <th>ID</th>
                                                            <th>Stock</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <!-- Product 1 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck2">
                                                                      <label class="form-check-label"
                                                                           for="customCheck2"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-1.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Men
                                                                           Black Slim Fit T-shirt</p>
                                                                 </div>
                                                            </td>
                                                            <td>$80 <small class="text-muted">(30% Off)</small></td>
                                                            <td>Seller</td>
                                                            <td>FS16276</td>
                                                            <td>46233</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 2 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck3">
                                                                      <label class="form-check-label"
                                                                           for="customCheck3"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-2.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Women
                                                                           Hand Bag</p>
                                                                 </div>
                                                            </td>
                                                            <td>$120 <small class="text-muted">(15% Off)</small></td>
                                                            <td>Admin</td>
                                                            <td>HB73029</td>
                                                            <td>2739</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 3 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck4">
                                                                      <label class="form-check-label"
                                                                           for="customCheck4"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-3.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Men
                                                                           Running Shoes</p>
                                                                 </div>
                                                            </td>
                                                            <td>$60 <small class="text-muted">(20% Off)</small></td>
                                                            <td>Admin</td>
                                                            <td>RS19534</td>
                                                            <td>1200</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 4 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck5">
                                                                      <label class="form-check-label"
                                                                           for="customCheck5"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-4.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Women
                                                                           Sunglasses</p>
                                                                 </div>
                                                            </td>
                                                            <td>$50 <small class="text-muted">(10% Off)</small></td>
                                                            <td>Seller</td>
                                                            <td>SG43567</td>
                                                            <td>2300</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 5 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck6">
                                                                      <label class="form-check-label"
                                                                           for="customCheck6"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-5.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Casual
                                                                           Blue Denim Jeans</p>
                                                                 </div>
                                                            </td>
                                                            <td>$70 <small class="text-muted">(25% Off)</small></td>
                                                            <td>Admin</td>
                                                            <td>DJ47261</td>
                                                            <td>1520</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 6 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck7">
                                                                      <label class="form-check-label"
                                                                           for="customCheck7"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-6.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Wireless
                                                                           Headphones</p>
                                                                 </div>
                                                            </td>
                                                            <td>$150 <small class="text-muted">(20% Off)</small></td>
                                                            <td>Seller</td>
                                                            <td>WH37284</td>
                                                            <td>5240</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 7 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck8">
                                                                      <label class="form-check-label"
                                                                           for="customCheck8"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-7.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">
                                                                           Smartwatch Series 6</p>
                                                                 </div>
                                                            </td>
                                                            <td>$200 <small class="text-muted">(25% Off)</small></td>
                                                            <td>Admin</td>
                                                            <td>SW68342</td>
                                                            <td>8420</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 8 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck9">
                                                                      <label class="form-check-label"
                                                                           for="customCheck9"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-8.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Men's
                                                                           Leather Wallet</p>
                                                                 </div>
                                                            </td>
                                                            <td>$50 <small class="text-muted">(15% Off)</small></td>
                                                            <td>Seller</td>
                                                            <td>LW98347</td>
                                                            <td>3240</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 9 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck10">
                                                                      <label class="form-check-label"
                                                                           for="customCheck10"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-9.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Women's
                                                                           Gold Necklace</p>
                                                                 </div>
                                                            </td>
                                                            <td>$500 <small class="text-muted">(10% Off)</small></td>
                                                            <td>Admin</td>
                                                            <td>GN24319</td>
                                                            <td>120</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 10 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck11">
                                                                      <label class="form-check-label"
                                                                           for="customCheck11"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-10.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Digital
                                                                           Alarm Clock</p>
                                                                 </div>
                                                            </td>
                                                            <td>$40 <small class="text-muted">(5% Off)</small></td>
                                                            <td>Seller</td>
                                                            <td>AC81234</td>
                                                            <td>820</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 11 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck12">
                                                                      <label class="form-check-label"
                                                                           for="customCheck12"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-11.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">
                                                                           Bluetooth Speaker</p>
                                                                 </div>
                                                            </td>
                                                            <td>$120 <small class="text-muted">(15% Off)</small></td>
                                                            <td>Admin</td>
                                                            <td>BS91827</td>
                                                            <td>4120</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                       <!-- Product 12 -->
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input"
                                                                           id="customCheck13">
                                                                      <label class="form-check-label"
                                                                           for="customCheck13"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div
                                                                           class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-12.png"
                                                                                alt="" class="avatar-md">
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">Fitness
                                                                           Tracker</p>
                                                                 </div>
                                                            </td>
                                                            <td>$85 <small class="text-muted">(10% Off)</small></td>
                                                            <td>Seller</td>
                                                            <td>FT61429</td>
                                                            <td>6300</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!"
                                                                           class="btn btn-light btn-sm"><iconify-icon
                                                                                icon="solar:eye-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                                icon="solar:pen-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="#!"
                                                                           class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                                class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>

                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                   <div class="card-footer border-top">
                                        <nav aria-label="Page navigation example">
                                             <ul class="pagination justify-content-end mb-0">
                                                  <li class="page-item">
                                                       <a class="page-link" href="javascript:void(0);">Previous</a>
                                                  </li>
                                                  <li class="page-item active">
                                                       <a class="page-link" href="javascript:void(0);">1</a>
                                                  </li>
                                                  <li class="page-item">
                                                       <a class="page-link" href="javascript:void(0);">2</a>
                                                  </li>
                                                  <li class="page-item">
                                                       <a class="page-link" href="javascript:void(0);">3</a>
                                                  </li>
                                                  <li class="page-item">
                                                       <a class="page-link" href="javascript:void(0);">Next</a>
                                                  </li>
                                             </ul>
                                        </nav>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->


@endsection