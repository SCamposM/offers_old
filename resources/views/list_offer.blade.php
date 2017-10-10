<h1> Offers</h1>

@foreach ($offers as $offer)
<ul>
    <li> Name : {{ $offers -> name}}</li>
    <li> Description : {{ $offers ->description}}</li>
</ul>

@endforeach
