{{-- <div id="modalShow" class="modal" tabindex="-1" role="dialog">
  <div class="container">
    <h4 class="h4">Showing Product : </h4>
    <div class="row justify-content-center mt-3">
      <div class="col">
        <div class="card-body">
          <div class="row">
            <div class="col col-md-4">
              <dl>
                <dt>Nama Produk</dt>
                <dd id="name">$product->name</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Stok</dt>
                <dd id="stock">$product->stock</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Jumlah Dilihat</dt>
                <dd id="views">is_null($product->views) ? 'Belum ada yang melihat.' : $product->views</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Kategori</dt>
                <dd id="category">is_null($product->category_id) ? 'Uncategorized' : $product->category->name</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Kondisi</dt>
                <dd id="condition">$product->condition</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Harga</dt>
                <dd id="price">$product->price</dd>
              </dl>
            </div>
            <div class="col">
              <dl>
                <dt>Deskripsi</dt>
                <dd id="description">$product->description</dd>
              </dl>
            </div>
            <div class="col">
              <dl>
                <dt>Ulasan</dt>
                <dd>Belum ada ulasan.</dd>
              </dl>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div> --}}

<div id="modalShow" class="modal animated fadeIn faster" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-start align-items-center border-bottom-0">
        <img alt="Thumbnail" height="40" class="thumbnail-box rounded border mr-2" style="display: none;" />
        <h3 class="modal-title" id="name">{{-- $product->name --}}</h3>
      </div>
      <div class="modal-body pt-0">
        <div class="mb-2">
          <strong class="mb-1">Gambar Produk</strong>
          <div class="row px-2">
            <div class="col-6 col-lg-3 p-2">
              <div class="image-box-static border" style="display: none;"></div>
            </div>
            <div class="col-6 col-lg-3 p-2">
              <div class="image-box-static border" style="display: none;"></div>
            </div>
            <div class="col-6 col-lg-3 p-2">
              <div class="image-box-static border" style="display: none;"></div>
            </div>
            <div class="col-6 col-lg-3 p-2">
              <div class="image-box-static border" style="display: none;"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col col-md-4">
            <dl>
              <dt>Kategori</dt>
              <dd id="category">{{-- is_null($product->category_id) ? 'Uncategorized' : $product->category->name --}}</dd>
            </dl>
          </div>
          <div class="col col-md-4">
            <dl>
              <dt>Kondisi</dt>
              <dd id="condition">{{-- $product->condition --}}</dd>
            </dl>
          </div>
          <div class="col col-md-4">
            <dl>
              <dt>Harga</dt>
              <dd id="price">{{-- $product->price --}}</dd>
            </dl>
          </div>
          <div class="col col-md-4">
            <dl>
              <dt>Berat</dt>
              <dd id="weight">{{-- $product->weight --}}</dd>
            </dl>
          </div>
          <div class="col col-md-4">
            <dl>
              <dt>Stok</dt>
              <dd id="stock">{{-- $product->stock --}}</dd>
            </dl>
          </div>
          <div class="col col-md-4">
            <dl>
              <dt>Jumlah Dilihat</dt>
              <dd id="views">{{-- is_null($product->views) ? 'Belum ada yang melihat.' : $product->views --}}</dd>
            </dl>
          </div>
          <div class="col">
            <dl>
              <dt>Deskripsi</dt>
              <dd id="description">{{-- $product->description --}}</dd>
            </dl>
          </div>
          {{-- <div class="col">
            <dl>
              <dt>Ulasan</dt>
              <dd>Belum ada ulasan.</dd>
            </dl>
          </div> --}}
        </div>
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>