<h1> Lista de Products  </h1>
<ul>
    @foreach($products as $product)
    <li>{{$product->name}}</li>

        @endforeach;
</ul>