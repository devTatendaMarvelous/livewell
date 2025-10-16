<div class="row">
    <div class="col-lg-4 col-xxl-3">
        <div class="card">
            <div class="card-body position-relative">

                <div class="text-center mt-3">
                    <div class="chat-avtar d-inline-flex mx-auto"><img
                            class="rounded-circle img-fluid wid-70"
                            src="../assets/images/user/avatar-5.jpg" alt="User image"></div>
                    <h5 class="mb-0">{{$member->firstName}} {{$member->lastName}}</h5>
                    <p class="text-muted text-sm">{{$member->memberId}}</p>
                    <hr class="my-3 border border-secondary-subtle">
                    <div class="row g-3">
                        <div class="col-4">
                            <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab"
                               href="#profile-2" role="tab" aria-selected="true">
                                <h5
                                    class="mb-0">{{count($member->policies)}}</h5><small
                                    class="text-muted">Policies</small>
                            </a>
                        </div>
                        <div class="col-4 border border-top-0 border-bottom-0"><h5
                                class="mb-0">
                                {{count($dependents)}}</h5><small class="text-muted">Dependents</small>
                        </div>
                        <div class="col-4"><h5 class="mb-0">1</h5><small class="text-muted">Members</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
