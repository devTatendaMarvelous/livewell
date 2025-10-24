<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="card-title mb-0">Livestock Health Summary Report</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">This report summarizes overall livestock health status across all farms/districts.</p>
                            <form method="GET" class="row g-2 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label">Start date</label>
                                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">End date</label>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Purpose (optional)</label>
                                    <input type="text" name="purpose" value="{{ request('purpose') }}" class="form-control" placeholder="Reason for export">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <button type="submit" name="format" value="csv" class="btn btn-outline-secondary w-100">Download CSV</button>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <button type="submit" name="format" value="pdf" class="btn btn-outline-secondary w-100">Download PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted">Total Active Livestock Profiles</h6>
                            <h3 class="mb-0">{{ number_format($totalLivestock) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted">Current Disease Cases</h6>
                            <h3 class="mb-0">{{ number_format($currentCases) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted">Recovered Cases</h6>
                            <h3 class="mb-0">{{ number_format($recoveredCases) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted">Recovery Rate</h6>
                            <h3 class="mb-0">{{ number_format($recoveryRate, 1) }}%</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted">Mortality Rate</h6>
                            <h3 class="mb-2">{{ number_format($mortalityRate, 1) }}%</h3>
                            <p class="text-muted small mb-0">Note: Mortality inferred from diagnosis text when available.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Most Commonly Reported Symptoms</h6>
                            @if(!empty($topSymptoms))
                                <ul class="mb-0">
                                    @foreach($topSymptoms as $symptom => $count)
                                        <li>{{ ucwords(str_replace('_',' ', $symptom)) }} — {{ $count }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted mb-0">No symptom data available.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-muted mb-0">Trends & Anomalies</h6>
                                <span class="badge bg-light text-dark">Last 30 days vs previous 30 days</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 border rounded">
                                        <div class="text-muted">Cases (Last 30 days)</div>
                                        <div class="fs-4">{{ number_format($casesCurrentWindow) }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 border rounded">
                                        <div class="text-muted">Cases (Prev 30 days)</div>
                                        <div class="fs-4">{{ number_format($casesPreviousWindow) }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 border rounded">
                                        <div class="text-muted">Change</div>
                                        <div class="fs-4">
                                            @if(!is_null($trendIncreasePct))
                                                {{ $trendIncreasePct > 0 ? '+' : '' }}{{ $trendIncreasePct }}%
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Week</th>
                                        <th class="text-end">Cases</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($weekly as $w)
                                        <tr>
                                            <td>{{ $w['label'] }}</td>
                                            <td class="text-end">{{ $w['count'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Insights</h6>
                            <ul class="mb-0">
                                @foreach($insights as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Recommendations for Veterinary Officers</h6>
                            <ul class="mb-0">
                                @foreach($recommendations as $rec)
                                    <li>{{ $rec }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-master>
