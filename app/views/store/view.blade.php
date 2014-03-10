@extends('layouts.main')

@section('content')
	<div id="product-image">
		{{HTML::image(Config::get( 'imagenes.thumb_folder').'/'.$product->image, $product->title)}}		
		</div>  <!-- End product-image --> 
		<div id="product-details">
		<h1>{{$product->title}}</h1>
		<p>{{$product->description}}</p>
		<hr />              
		{{Form::open(array('url'=>'store/addtocart'))}}
		    {{Form::label('quantity','Qty')}}
		    {{Form::text('quantity', 1, array('maxlength'=>'2'))}}
		    {{Form::hidden('id', $product->id)}}		    
		    <button type ="submit" class="secondary-cart-btn">
		    	{{HTML::image('img/white-cart.gif', 'Add to Cart')}}
		         ADD TO CART                                
		    </button>
		{{Form::close()}}
		</div>  <!-- End product-details -->
		<div id="product-info">
		<p class="price">{{$product->price}}</p>
		<p>Availability: 
            <span class="{{Availability::displayClass($product->availability)}}">
                {{Availability::display($product->availability)}}
            </span></p>
		<p>Product Code: <span>{{$product->id}}</span></p>
	</div>  <!-- End product-info -->
@stop