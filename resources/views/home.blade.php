{{--@dd($member->policies[0])--}}
<x-master>

    <section class="pc-container">
        <div class="pc-content">
    <div class="mt-5">
<h3>Welcome, {{ auth()->user()->name }}!</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Livestock</h5>
                    <p class="card-text fs-2">{{ $totalLivestock }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Vets</h5>
                    <p class="card-text fs-2">{{ $totalVets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Farmers</h5>
                    <p class="card-text fs-2">{{ $totalFarmers }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
        </div>
    </section>
</x-master>
