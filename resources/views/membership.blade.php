@extends('layouts.base', ['title' => 'Moje členské'])
@section('content')
<!-- Point Table Section Start -->
@php
$percents = ($membership->total > 0 ? ceil(($membership->amount / $membership->total) * 100) : 0);
@endphp
<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content responsive-event-center">
            <h3 class="title-bg">Zaplatené členské</h3>
            <p class="payed-text">
                Zaplatené <span class="payed">{{ $membership->amount }} €</span> z <span
                    class="{{ ($membership->amount < $membership->total ? 'total-to-pay' : 'payed') }}">{{ $membership->total }}
                    €</span>
            </p>
            <div class="payed-bar">
                <div class="payed-bar-yet" style="width: {{ $percents }}%"><span
                        class="payed-word-responsive">Zaplatené</span>{{ $percents }}%</div>
            </div>
            @if ($membership->note)
            <p class="membership-admin-comment">
                <i class="fa fa-info"></i>
                {{ $membership->note }}
            </p>
            @endif
        </div>
    </div>
</div>
<!-- Point Table Section End -->

@push('scripts')
<script>
    const payedBarYet = document.querySelector(".payed-bar-yet");
const payedWordResponsive = document.querySelector(".payed-word-responsive");
if(payedBarYet.offsetWidth < "120"){
    payedWordResponsive.style.display = "none";
} else {
    payedWordResponsive.style.display = "initial";
}

</script>
@endpush
@endsection