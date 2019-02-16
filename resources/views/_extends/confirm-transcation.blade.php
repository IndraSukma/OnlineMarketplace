<div class="modal fade" id="modalConfirmPayment{{$orders->id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header blue-gradient">
        <h5 class="modal-title" id="exampleModalLabel">
          <b class="text-white">
            Confirm Payment
          </b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <form action="{{ route('paymentOrders.store') }}" method="POST">
            <div class="card-body">
              @csrf
              <div class="row">
                <div class="form-group col col-md-12">
                  <label for="order_id">Transaction Code</label>
                  <input type="text" name="order_id" id="order_id" value="{{$orders->id}}" class="form-control{{ $errors->has('order_id') ? ' is-invalid' : '' }}" value="{{-- $address->full_name --}}" required readonly>
                  @if ($errors->has('order_id'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('order_id') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-12">
                  <label for="bank">Transfer To</label>
                  <select type="text" name="bank" id="bank" class="selectpicker form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" required>
                    <option selected disabled>Pilih Bank</option>
                    <option value="BCA">BCA</option>
                    <option value="BRI">BRI</option>
                    <option value="MANDIRI">MANDIRI</option>
                  </select>
                  @if ($errors->has('bank'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('bank') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-6">
                  <label for="paid_by">Paid By</label>
                  <input type="text" name="paid_by" id="paid_by" class="form-control{{ $errors->has('paid_by') ? ' is-invalid' : '' }}" required>
                  @if ($errors->has('paid_by'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('paid_by') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-6">
                  <label for="total_payment">Total Payment</label>
                  <input type="text" name="total_payment" id="total_payment" class="form-control{{ $errors->has('total_payment') ? ' is-invalid' : '' }}" required>
                  @if ($errors->has('total_payment'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('total_payment') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col col-md-12">
                  <label for="payment_date">Payment Date</label>
                  <input type="date" name="payment_date" id="payment_date" class="form-control{{ $errors->has('payment_date') ? ' is-invalid' : '' }}" min="{{ $year.'-01-01' }}" max="{{ $today }}" required>
                  @if ($errors->has('payment_date'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('payment_date') }}</strong>
                    </span>
                  @endif
                </div>
                <hr>

                <div class="form-group col col-md-12">
                  <a href="#" class="float-right">See Payment Method <i class="mdi mdi-comment-question-outline"></i></a>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <div class="float-right">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Discard</button>
                <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
