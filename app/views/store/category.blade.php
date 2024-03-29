@extends('layouts.main')

@section('promo')

<section id="promo-alt">
    <div id="promo1">
        <h1>The brand new MacBook Pro</h1>
        <p>With a special price, <span class="bold">today only!</span></p>
        <a href="#" class="secondary-btn">READ MORE</a>
        {{HTML::image('img/macbook.png', 'MacBook Pro' )}}        
    </div> <!-- End Promo1 --> 
    <div id="promo2">
        <h2>The iPhone5 is now<br> available in our store!</h2>
        <a href="">Read More {{HTML::image('img/right-arrow.gif', 'Read More' )}}</a>
        {{HTML::image('img/iphone.png', 'iPhone' )}}        
    </div> <!-- End Promo2 -->
    <div id="promo3">
    	{{HTML::image('img/thunderbolt.png', 'ThunderBolt' )}}        
        <h2>The 27"<br>Thunderbolt Display<br>Simply Stunning.</h2>
        <a href="#">Read More {{HTML::image('img/right-arrow.gif', 'Read More' )}}</a>
    </div> <!-- End Promo3 -->
</section> <!-- End promo-alt -->
@stop

@section('content')
<h2>{{$category->name}}</h2>
    <hr>
    <aside id="categories-menu">
        <h3>CATEGORIES</h3>
        <ul>
            @foreach($catnav as $cat)
                <li>
                	{{HTML::link('/store/category/'.$cat->id, $cat->name)}}
                </li>
            @endforeach
        </ul>
    </aside> <!-- End categories-menu -->
    <div id="listings">
    	@foreach($products as $product)
    <div class="product">
        <a href="/store/view/{{$product->id}}">
        	 {{HTML::image(Config::get( 'imagenes.thumb_folder').'/'.$product->image, $product->title, array(
        	 	'class' => 'feature',
        	 	'width' => '240',
        	 	'height'=>'127'
        	 	))}}      
        </a>
        <h3>
        	<a href="/store/view/{{$product->id}}">
        	{{$product->title}}
        	</a>
    	</h3>
        <p>{{$product->description}}</p>
        <h5>Availability: 
            <span class="{{Availability::displayClass($product->availability)}}">
                {{Availability::display($product->availability)}}
            </span>
        </h5>
        <p>
            {{Form::open(array('url'=>'store/addtocart'))}}
            {{Form::hidden('quantity', 1)}}
            {{Form::hidden('id', $product->id)}}
            <button type='submit' class="cart-btn">
                <span class="price">{{$product->price}}</span> 
                {{HTML::image('img/white-cart.gif', 'Add to Cart')}} 
                ADD TO CART
            </button>
            {{Form::close()}}
          </p>        
    </div>
    @endforeach
    </div> <!-- End listings -->
@stop

@section('pagination')
	<section id="pagination">
		{{$products->links()}}
	</section><!--  End pagination -->
    <hr />
@stop