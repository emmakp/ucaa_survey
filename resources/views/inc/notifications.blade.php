@if($patients)    
<li class="media dropdown-item">
    <span class="success"><i class="ti-user"></i></span>
    <div class="media-body">
        <a href="{{ route('patients.pt_bd') }}">
            @if ($patients > 1)
                <p><strong>{{ $patients }}</strong> patients have their <strong>birthdays today</strong></p>
            @else
                <p><strong>{{ $patients }}</strong> patient has their <strong>birthday today</strong></p>
            @endif
        </a>
    </div>
    <span class="notify-time">{{ $notification }}</span>
</li>
@endif

@if($drugs)
<li class="media dropdown-item">
    <span class="primary"><i class="ti-shopping-cart"></i></span>
    <div class="media-body">
        <a href="{{ route('drug.usedup') }}">
            @if ($drugs > 1)
                <p><strong>{{ $drugs }}</strong> drugs are out of <strong>Stock</strong></p>
            @else
                <p><strong>{{ $drugs }}</strong> drug is out of <strong>Stock</strong></p>
            @endif
        </a>
    </div>
    <span class="notify-time">{{ $notification }}</span>
</li>
@endif

@if($items)
<li class="media dropdown-item">
    <span class="primary"><i class="ti-shopping-cart"></i></span>
    <div class="media-body">
        <a href="{{ route('item.usedup') }}">
            @if ($items > 1)
                <p><strong>{{ $items }}</strong> items are out of <strong>Stock</strong></p>    
            @else
                <p><strong>{{ $items }}</strong> item is out of <strong>Stock</strong></p>
            @endif
            
        </a>
    </div>
    <span class="notify-time">{{ $notification }}</span>
</li>
@endif

@if($none)
<li class="media dropdown-item">
    <span class="danger"><i class="ti-bookmark"></i></span>
    <div class="media-body">
        <a href="#">
            <p><strong>No</strong> available notifations.
            </p>
        </a>
    </div>
    <span class="notify-time">0:00 am</span>
</li>
@endif