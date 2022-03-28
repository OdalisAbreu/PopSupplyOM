<?php

use Illuminate\Database\Seeder;
use App\Product; 
use App\Category; 
use App\ProductImage; 

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //model factories
        //factory(Product::class)->make(); //crea objetos
        //factory(ProductImage::class, 200)->create(); //crea objetos y ademas lo guarda en database

       /*
       factory(Category::class, 5)->create(); //creamos y guardamos 5 categorias
        factory(Product::class, 100)->create(); //creamos y guardamos 100 productos
     	factory(ProductImage::class, 200)->create(); //creamos y guardamos 200 images
        */
        
        //Llenado aleatorio
       /* $categories = factory(Category::class, 4)->create(); //creamos y guardamos 5 categorias
        $categories->each(function ($c) { //iteramos c/categoria
            $products = factory(Product::class, 5)->make(); //generamos 20 productos
            $c->products()->saveMany($products); //asociamos los 20 productos a c/categoria guardando en  DB

            $products->each(function ($p){ //iteramos cada producto
                $images = factory(ProductImage::class, 3)->make(); //creamos 5 imagenes
                $p->images()->saveMany($images); //a c/producto le asociamos las 5 imagenes y guardamos en DB

            });
        });*/

        DB::table('products')->insert([
        [
            'name' =>'4DRC V4 Drone con cámara HD 1080p para adultos y niños, Quadcopter plegable con gran angular',
            'description' => 'Imágenes y vídeos de 1080p y función FPV: mejora la cámara dual',
            'long_description' => 'Imágenes y vídeos de 1080p y función FPV: mejora la cámara dual, cambia el ángulo de visión arbitrariamente. Incluye ángulo ajustable, que captura vídeo de alta calidad y fotos aéreas claras. Puedes ver lo que tu dron ve desde el smartphone, disfruta de una alimentación de vídeo en directo desde 262.5 ft de distancia con transmisión FPV.',
            'price' => '2800',
            'Category_id'=>'1'
        ],
        [
            'name' =>'SANROCK U52 FPV Drone con cámara para niños y adultos, WiFi en vivo vídeo drones, RC Drone Quadcopter',
            'description' => 'Cámara HD y dron WiFi FPV: cámara HD de 720P integrada con ángulo ajustable de 90',
            'long_description' => 'Cámara HD y dron WiFi FPV: cámara HD de 720P integrada con ángulo ajustable de 90 ° FOV, transmisión en tiempo real, puedes ver la vista en primera persona en tiempo real en la aplicación. Los clips de vídeo se guardan automáticamente en la tarjeta Micro SD. Puedes editar imágenes HD y cargarlas directamente a las redes sociales desde tu iPhone o iPad.',
            'price' => '3800',
            'Category_id'=>'1'
        ],
        [
            'name' =>'Force1 Scoot XL - Drones de mano para niños - Flying Ball Drone, Kids Drone, Flying Toys para niños y niñas (azul)',
            'description' => 'Dron Scoot más grande para niños: el dron Scoot XL operado',
            'long_description' => 'Dron Scoot más grande para niños: el dron Scoot XL operado a mano es la versión XL del dron Scoot original; este juguete de bola voladora cuenta con una luz LED gigante que parpadea en rojo brillante, azul y verde',
            'price' => '2500',
            'Category_id'=>'1'
        ],
        [
            'name' =>'Amazon Essentials paquete de 2 camisetas de manga corta para hombre, cuello redondo, ajuste ceñido',
            'description' => 'Sólidos: 100% algodón; jaspeados: 60% algodón, 40% poliéster.',
            'long_description' => 'Sólidos: 100% algodón; jaspeados: 60% algodón, 40% poliéster. Importado. Lavar a máquina. Este paquete de 2 camisetas clásicas y ligeras cuenta con una confección de algodón y un cuello redondo sin etiquetas para una comodidad diaria',
            'price' => '800',
            'Category_id'=>'2'
        ],
        [
            'name' =>'On The Spot Tees A-Team Mr T. Camiseta de regalo',
            'description' => 'Muy bueno con algondon y todo el asunto',
            'long_description' => 'Descripcion Larga',
            'price' => '280',
            'Category_id'=>'2'
        ],
        [
            'name' =>'Cant Hear You Im Gaming Headset Gráfico Video Juegos Gamer Regalo Divertido Camiseta',
            'description' => 'Corte increíble: Fiel a la talla',
            'long_description' => 'Corte increíble: Fiel a la talla, tiene un gran ajuste y sensación al tacto. Lavar la prenda al revés con agua fría. Esta camiseta tiene una gran apariencia y un corte genial. Esta camiseta graciosa para hombre tiene un gran corte y es ideal para niños, adolescentes y adultos. Perfecto para el jugador de computadora en casa. Cant Hear You Im Gaming. Es un gran regalo para alguien especial Esta camiseta de jugador es perfecta para el adolescente en el hogar que nunca puede oírte.',
            'price' => '750',
            'Category_id'=>'2'
        ],
        [
            'name' =>'Facebook',
            'description' => 'Facebook',
            'long_description' => '',
            'price' => '2800',
            'Category_id'=>'3'
        ],
        [
            'name' =>'Instagram',
            'description' => 'Instagram',
            'long_description' => '',
            'price' => '2800',
            'Category_id'=>'3'
        ],
        [
            'name' =>'WhatsApp',
            'description' => 'WhatsApp',
            'long_description' => '',
            'price' => '2800',
            'Category_id'=>'3'
        ]
        ]);

    }
}
