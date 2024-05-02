@foreach($partners as $partner)
    <article class="card-border card-hover w-fit h-fit border border-lightgray rounded-[5px] shadow">
        <div>
            <img src="{{asset('storage/' . $partner->image)}}" alt="{{$partner->name}}"
                 class="w-[400px] h-[225px] object-cover rounded-t-[5px] hover:opacity-95 transition-opacity">

            <h4 class="font-medium p-2 text-center bg-lightpink">{{$partner->name}}</h4>
        </div>

    </article>
@endforeach
