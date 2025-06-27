    <!-- Quickview Modal -->
    <div class="modal fade quickview-modal" id="addProduitPanierTrois{{ $produit->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12 mb-767">
                            <div class="single-pro-img single-pro-img-no-sidebar">
                                <div class="single-product-scroll">
                                    <div class="single-slide zoom-image-hover">
                                        <img class="img-responsive" src="{{ asset(Storage::url($produit->image)) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="gi-quick-title">
                                    <a href="#">
                                    {{ $produit->nom }}
                                    </a>
                                </h5>
                                <div class="gi-quickview-rating">
                                    <i class="gicon gi-star fill"></i>
                                    <i class="gicon gi-star fill"></i>
                                    <i class="gicon gi-star fill"></i>
                                    <i class="gicon gi-star fill"></i>
                                    <i class="gicon gi-star"></i>
                                </div>

                                <div class="gi-quickview-desc">{{ $produit->description }}</div>
                                <div class="gi-quickview-price">
                                    @if($produit->promo)
                                        <span class="new-price">{{ $produit->promo }} F</span>
                                        <span class="old-price">{{ $produit->prix }} F</span>
                                    @else
                                        <span class="new-price">{{ $produit->prix }} F</span>
                                    @endif
                                </div>

                                <!-- <div class="gi-pro-variation">
                                    <div class="gi-pro-variation-inner gi-pro-variation-size gi-pro-size">
                                        <div class="gi-pro-variation-content">
                                            <ul class="gi-opt-size">
                                                <li class="active"><a href="javascript:void(0)" class="gi-opt-sz"
                                                        data-tooltip="Small">250g</a></li>
                                                <li><a href="javascript:void(0)" class="gi-opt-sz"
                                                        data-tooltip="Medium">500g</a></li>
                                                <li><a href="javascript:void(0)" class="gi-opt-sz"
                                                        data-tooltip="Large">1kg</a></li>
                                                <li><a href="javascript:void(0)" class="gi-opt-sz"
                                                        data-tooltip="Extra Large">2kg</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->

                                @if($produit->stock || $produit->qtyStock >= 1)
                                    <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                        @csrf
                                        <div class="gi-quickview-qty">
                                            <div class="qty-plus-minus">
                                                <input class="qty-input" type="number" name="quantite" value="1" min="1" max="{{ $produit->qtyStock }}" required>
                                                @error('quantite') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="gi-quickview-cart ">
                                                <button class="gi-btn-1"><i class="fi-rr-shopping-basket"></i> Ajouter au panier</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quickview Modal end -->
