	<?php

	class ProductsController extends BaseController {

		public function __construct ()
		{
			parent::__construct();
			$this->beforeFilter('csrf', array('on'=>'post'));
			$this->beforeFilter('admin');
		}

		public function getIndex()
		{	
			$categories = array();
			foreach (Category::all() as $category) {
				$categories[$category->id] = $category->name;
			}
			return View::make('products.index')
					->with('products', Product::all())
					->with('categories', $categories);
		}

		public function postCreate()
		{
			$validator = Validator::make(Input::all(), Product::$rules);

			if($validator->passes()){
				$product = new Product;
				      $image = Input::file('image');

	                  $filename = $image->getClientOriginalName();     
						//Usamos php raso ya que la API symfony no produce un pathinfo
						$filename = pathinfo($filename, PATHINFO_FILENAME); 

						//hacemos una version amigable de la aplicación, en una aplicación real 
						//se debe verificar que el nombre sea unico     
						$fullname = Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();     
						//subimos la imagen primero al folder de uploads, luego      
						//hacemos el thumbnail de la imagen    
						$upload = $image->move(Config::get( 'imagenes.upload_folder'),
						$fullname);     
						//usando la libreria de Image que subimos en composer dev     
						Image::make(Config::get( 'imagenes.upload_folder').'/'.$fullname)       
						->resize(Config::get( 'imagenes.thumb_width'), Config::get( 'imagenes.thumb_height'))       
						->save(Config::get( 'imagenes.thumb_folder').'/'.$fullname);     
						//If the file is now uploaded, we show an error message       
						//to the user, else we add a new column to the database       
						//and show the success message     
						if($upload) {       
						//con la imagen subida añadimos una columna a la base de datos
						//conservando el id 
						$product->category_id = Input::get('category_id');
				$product->title = Input::get('title');
				$product->description = Input::get('description');
				$product->price = Input::get('price');      
						

				
				$product->image = $fullname;
				$product->save();

				return Redirect::to('admin/products/index')
						->with('message', 'Product Created!');
					}
			}

			return Redirect::to('admin/products/index')
						->with('message', 'Something went wrong!')
						->withErrors($validator)
						->withInput();
		}

		public function postDestroy()
		{
			$product = Product::find(Input::get('id'));

			if($product){
				 File::delete(Config::get('imagenes.upload_folder').'/'.$product->image);
							 File::delete(Config::get('imagenes.thumb_folder').'/'.$product->image);
				$product->delete();

				return Redirect::to('admin/products/index')
						->with('message', 'Product Deleted!');

			}

			return Redirect::to('admin/products/index')
						->with('message', 'Something went wrong, please try again!');
		}

		public function postToggleAvailability(){
			$product = Product::find(Input::get('id'));
			if ($product) {			
				$product->availability = Input::get('availability');
				$product->save();

				return Redirect::to('admin/products/index')
						->with('message', 'Product updated');

			}
			return Redirect::to('admin/products/index')
						->with('message', 'Invalid Product');
		}
	}