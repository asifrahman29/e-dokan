<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-{{ $count === '0' ? 'danger' : $color }} bubble-shadow-small">
                        <i class="fas fa-{{ $icon ?: 'users' }}"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">{{ $category }}</p>
                        <h4 class="card-title">{{ $count }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  --}}
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-primary card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Visitors</p>
                            <h4 class="card-title">1,294</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="icon-pie-chart text-warning"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Number</p>
                            <h4 class="card-title">150GB</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Visitors</p>
                            <h4 class="card-title">1,294</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-{{ $card_color ?? 'default' }} card-round">
        <div class="card-body">
            <div class="row align-items-{{ $align ?? '' }}">
                @if(isset($col_icon))
                <div class="col-icon">
                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                    </div>
                </div>                    
                @else
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="icon-pie-chart text-warning"></i>
                    </div>
                </div>
                @endif
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Visitors</p>
                        <h4 class="card-title">1,294</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
