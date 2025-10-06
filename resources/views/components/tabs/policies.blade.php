<div class="row">
@php($index=0)
    @foreach($member->policies as $policy)
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>{{$policy->productType->productName??''}} {{$policy->productType->productTypeName??''}} {{$policy->productType->subType??''}}</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-grow-1 me-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3"><h6 class="mb-0">Status</h6>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button
                                class="btn btn-link-primary">{{$policy->status}}</button>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-grow-1 me-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3"><h6 class="mb-0">Member Number</h6></div>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button
                                class="btn btn-link-primary">{{$policy->alternativeSsbReference}}</button>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-grow-1 me-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3"><h6 class="mb-0"></h6></div>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#paymentModal{{$policy->id}}">Make
                                Payment
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="paymentModal{{$policy->id}}" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="paymentModal{{$policy->id}}Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form class="modal-content" method="POST" action="/payments">
                    @csrf
                    <input type="hidden" name="prefix" value="{{$policy->prefix}}">
                    <input type="hidden" name="currencyId"
                           value="{{$policy->productType->currency->id}}">
                    <input type="hidden" name="packageId"
                           value="{{$policy->productType->id}}">
                    <div class="modal-header"><h5 class="modal-title"
                                                  id="paymentModal{{$policy->id}}Title">Make
                            Payment
                            For {{$policy->productType->productName??''}} {{$policy->productType->productTypeName??''}} {{$policy->productType->subType??''}} </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="amount" required value="{{$premium[$index]}}">
                                    @php($index++)
                                </div>
                            </div>
                            <div class="col-sm-6" id="mobilePay">
                                <div class="mb-3">
                                    <label class="form-label">Mobile Number <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="mobileNumber"
                                           id="mobile">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment Method <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="paymentMethod"
                                            id="paymentMethod" required>
                                        <option selected disabled>Select Payment Method
                                        </option>
                                        <option value="ecocash">ECOCASH</option>
                                        {{--                                                                    <option value="onemoney">ONE MONEY</option>--}}
                                        <option value="visa">VISA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
