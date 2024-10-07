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