<div id="modalShowProduct{{$product->id}}" class="modal" tabindex="-1" role="dialog">
  <div class="container">
    <h4 class="h4">Showing Product : </h4>
    <div class="row justify-content-center mt-3">
      <div class="col">
        <div class="card-body">
          <div class="row">
            <div class="col col-md-4">
              <dl>
                <dt>Nama Produk</dt>
                <dd>{{ $product->name }}</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Stok</dt>
                <dd>{{ $product->stock }}</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Jumlah Dilihat</dt>
                <dd>{{ is_null($product->views) ? 'Belum ada yang melihat.' : $product->views }}</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Kategori</dt>
                <dd>{{ is_null($product->category_id) ? 'Uncategorized' : $product->category->name }}</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Kondisi</dt>
                <dd>{{ $product->condition }}</dd>
              </dl>
            </div>
            <div class="col col-md-4">
              <dl>
                <dt>Harga</dt>
                <dd>{{ $product->price }}</dd>
              </dl>
            </div>
            <div class="col">
              <dl>
                <dt>Deskripsi</dt>
                <dd>{{ $product->description }}</dd>
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
      </div>
    </div>
  </div>
</div>
