<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h4>{{ number_format($overview['total'], 0, ',', '.') }}</h4>

                <p>Tổng Tiền</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h4>{{ number_format($overview['wallets'][0]['amount'], 0, ',', '.') }}</h4>

                <p>
                    {{-- <a href="{{ route('transactions', ['wallet' => $overview['wallets'][0]['id']]) }}" class="text-light"> --}}
                    <a href="#" class="text-light">
                        {{ $overview['wallets'][0]['name'] }}
                    <a>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h4>{{ number_format($overview['wallets'][1]['amount'], 0, ',', '.') }}</h4>

                <p>
                    <a href="#" class="text-dark">
                        {{ $overview['wallets'][1]['name'] }}
                    </a>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-card"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h4>{{ number_format($overview['wallets'][2]['amount'], 0, ',', '.') }}</h4>

                <p>
                    <a href="#" class="text-light">
                        {{ $overview['wallets'][2]['name'] }}
                    </a>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
        </div>
    </div>
</div>
