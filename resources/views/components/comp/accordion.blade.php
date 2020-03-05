<div id="accordion">
    @forelse ($cards as $c)

    <div class="card">
        <div class="card-header" id="heading{{ $loop->iteration }}">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
            {{$c['btn']}}
            </button>
        </h5>
        </div>
    
        <div id="collapse{{ $loop->iteration }}" class="collapse show" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
        <div class="card-body">
            {{$c['text']}}
        </div>
        </div>
    </div>  

    @empty

    <div class="card">
        <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            btn
            </button>
        </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
            text
        </div>
        </div>
    </div>   
    
    @endforelse

</div>