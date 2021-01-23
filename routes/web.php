<?php

use App\Http\Controllers\BodyWoodController;
use App\Http\Controllers\BridgeBrandController;
use App\Http\Controllers\BridgeColorController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\BridgeScaleController;
use App\Http\Controllers\BridgeTypeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PickupsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomInlayController;
use App\Http\Controllers\CustomOrdersController;
use App\Http\Controllers\CustomShopGalleryImageController;
use App\Http\Controllers\DefaultsController;
use App\Http\Controllers\ElectronicController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\FinishController;
use App\Http\Controllers\FretboardRadiusController;
use App\Http\Controllers\FretboardWoodController;
use App\Http\Controllers\FretBrandController;
use App\Http\Controllers\FretsController;
use App\Http\Controllers\GuitarOptionsController;
use App\Http\Controllers\GuitarsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InlayController;
use App\Http\Controllers\NeckController;
use App\Http\Controllers\NeckShapeController;
use App\Http\Controllers\NeckTypeController;
use App\Http\Controllers\NeckWoodController;
use App\Http\Controllers\NutController;
use App\Http\Controllers\OrderRuleController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentOptionsController;
use App\Http\Controllers\PickupActiveController;
use App\Http\Controllers\PickupBrandController;
use App\Http\Controllers\PickupConfigurationController;
use App\Http\Controllers\PickupCoveringController;
use App\Http\Controllers\PickupMagnetController;
use App\Http\Controllers\PickupPositionController;
use App\Http\Controllers\PickupSelectorController;
use App\Http\Controllers\PickupTypeController;
use App\Http\Controllers\ScaleLengthController;
use App\Http\Controllers\ShapeController;
use App\Http\Controllers\StandardColorController;
use App\Http\Controllers\TopWoodController;
use App\Http\Controllers\TranslucentColorController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\TunerBrandController;
use App\Http\Controllers\TunerController;
use App\Http\Controllers\WoodController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//front-end routes
Route::get('/', [HomeController::class,'welcome'])->name('welcome');
Route::get('/WhoAreWe', [HomeController::class,'aboutus'])->name('aboutus');
Route::get('/products', [HomeController::class,'products'])->name('see.products');
Route::get('/gallery', [HomeController::class,'gallery'])->name('gallery');
Route::get('/artists', [HomeController::class,'artists'])->name('artists');

//view-single-pickup frontend
Route::get('/view/{pickupname}/{id}', [HomeController::class,'viewPickup'])->name('view.pickup');
//view all pickups frontend
Route::get('/view/pickups', [HomeController::class,'showAllPickups'])->name('view.all.pickups');

// view all guitars  of certain model
Route::get('/view/{modelName}/', [HomeController::class,'viewGuitarModel'])->name('view.guitar.model');
//view single guitar
Route::get('{modelName}/viewGuitar/{id}', [HomeController::class,'viewGuitar'])->name('view.guitar');

//custom guitar builder
Route::get('/customShop/', [HomeController::class,'customShop'])->name('guitar.build');
Route::post('/customShop/newCustomOrder', [CustomOrdersController::class,'createCustomOrder'])->name('custom.create');

//customers view their order through email button
Route::post('/viewCustomGuitar/email/{$uuid}', [CustomOrdersController::class,'viewCustomOrderButton'])->name('guitar.view.custom.order.button');

// customers view their order through modal on navigation bar
Route::get('/customShop/viewGuitarOrder/', [CustomOrdersController::class,'viewCustomOrder']);
// logout
Route::get('/customShop/viewGuitarOrder/logout', [CustomOrdersController::class,'logout']);
Route::get('/payment/done', [CustomOrdersController::class,'paymentFinished'])->name('finish.payment');

//Categories

Route::middleware(['auth:sanctum', 'verified'])->get('/category/all', [CategoryController::class,'index']
)->name('category');

Route::middleware(['auth:sanctum', 'verified'])->post('/category/create', [CategoryController::class,'create']
)->name('create.category');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/all', [ProductsController::class,'index']
)->name('products');

Route::middleware(['auth:sanctum', 'verified'])->post('/products/create', [ProductsController::class,'create']
)->name('create.product');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups', [PickupsController::class,'index']
)->name('products.pickups');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/brands', [PickupBrandController::class,'index']
)->name('pickups.brands');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/types', [PickupTypeController::class,'index']
)->name('pickups.type');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/position', [PickupPositionController::class,'index']
)->name('pickups.position');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/coverings', [PickupCoveringController::class,'index']
)->name('pickups.coverings');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/magnets', [PickupMagnetController::class,'index']
)->name('pickups.magnets');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/activepassive', [PickupActiveController::class,'index']
)->name('active.passive');

//create pickup
Route::middleware(['auth:sanctum', 'verified'])->get('/products/create/pickup', [PickupsController::class,'createPickupForm']
)->name('create.pickup.form');

Route::middleware(['auth:sanctum', 'verified'])->post('/products/create/pickup/new', [PickupsController::class,'createPickup']
)->name('create.pickup');

//create "pickup options"
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/brands/create', [PickupBrandController::class,'create']
)->name('create.pickup.brand');

Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/type/create', [PickupTypeController::class,'create']
)->name('create.pickup.type');

Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/position/create', [PickupPositionController::class,'create']
)->name('create.pickup.position');

Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/covering/create', [PickupCoveringController::class,'create']
)->name('create.pickup.covering');

Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/pickupmagnet/create', [PickupMagnetController::class,'create']
)->name('create.pickup.magnet');

Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/activepassive/create', [PickupActiveController::class,'create']
)->name('create.active.passive');



//edit "pickup options"
    //edit brands
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/brand/edit/{id}', [PickupBrandController::class,'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/brand/update/{id}', [PickupBrandController::class,'update']);

    //edit type
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/type/edit/{id}', [PickupTypeController::class,'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/type/update/{id}', [PickupTypeController::class,'update']);

    //edit position
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/position/edit/{id}', [PickupPositionController::class,'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/position/update/{id}', [PickupPositionController::class,'update']);


    //edit covering
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/covering/edit/{id}', [PickupCoveringController::class,'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/covering/update/{id}', [PickupCoveringController::class,'update']);

    //edit pickupmagnet
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/pickupmagnet/edit/{id}', [PickupMagnetController::class,'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/pickupmagnet/update/{id}', [PickupMagnetController::class,'update']);


    //edit activepassive
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/activepassive/edit/{id}', [PickupActiveController::class,'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/activepassive/update/{id}', [PickupActiveController::class,'update']);

    //edit PICKUP delete PICKUP
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/edit/{id}', [PickupsController::class,'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/update/{id}', [PickupsController::class,'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products/pickups/removeimage/{id}', [PickupsController::class,'removeImage']);

Route::middleware(['auth:sanctum','verified'])->get('/products/pickups/pickup/restore/{id}',[PickupsController::class,'restore']);

//delete option routes
    //aggregrated trash page
Route::middleware(['auth:sanctum', 'verified'])->get('/trashcan', [TrashController::class,'index'])->name('trashcan');

    //soft delete link for each pickup option
    //delete pickups
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/pickup/trash/{id}', [PickupsController::class,'trash']);
    //delete pickup type
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/type/trash/{id}', [PickupTypeController::class,'trash'])->name('trash.type');
    //delete active/passive pickup 
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/activepassive/trash/{id}', [PickupActiveController::class,'trash']);
    //delete pickup position
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/position/trash/{id}', [PickupPositionController::class,'trash']);
    //delete pickup covering
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/covering/trash/{id}', [PickupCoveringController::class,'trash']);
    //delete pickup magnet material
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/pickupmagnet/trash/{id}', [PickupMagnetController::class,'trash']);
    //delete pickup  brands
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/brand/trash/{id}', [PickupBrandController::class,'trash']);
    


//restore options routes
    //restore pickup type
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/type/restore/{id}', [PickupTypeController::class,'restore']);
    //restore pickup position
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/position/restore/{id}', [PickupPositionController::class,'restore']);
    //restore pickup covering
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/covering/restore/{id}', [PickupCoveringController::class,'restore']);
    //restore pickup magnet material
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/pickupmagnet/restore/{id}', [PickupMagnetController::class,'restore']);
    //restore active-passive pickups
Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/activepassive/restore/{id}', [PickupActiveController::class,'restore']);
    //restore pickup brands
    Route::middleware(['auth:sanctum', 'verified'])->get('/products/pickups/brand/restore/{id}', [PickupBrandController::class,'restore']);


//GUITARS

Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitars', [GuitarsController::class,'index'])->name('products.guitars');

//create guitar main page
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitars/createform', [GuitarsController::class,'getCreateForm'])->name('guitar.create.form');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitars/create', [GuitarsController::class,'create'])->name('guitar.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitars/update/{id}', [GuitarsController::class,'update'])->name('guitar.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitars/edit/{id}', [GuitarsController::class,'edit'])->name('guitar.edit');
// delete guitar
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitars/delete/{id}', [GuitarsController::class,'delete'])->name('guitar.delete');
// delete single images
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitars/removeimage/{id}', [GuitarsController::class,'removeImage']);


//guitars options

// create edit update delete guitar options

// create basic guitar shape/model
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/shape', [ShapeController::class,'index'])->name('guitar.shape');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/shape/create', [ShapeController::class,'create'])->name('shape.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/shape/edit/{id}', [ShapeController::class,'edit'])->name('shape.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/shape/update/{id}', [ShapeController::class,'update'])->name('shape.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/shape/delete/{id}', [ShapeController::class,'delete'])->name('shape.delete');

//all woods for body, neck , frets
//woods for body, frets, neck
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/wood', [WoodController::class,'index'])->name('guitar.wood');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/wood/create', [WoodController::class,'create'])->name('wood.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/wood/edit/{id}', [WoodController::class,'edit'])->name('wood.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/wood/update/{id}', [WoodController::class,'update'])->name('wood.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/wood/delete/{id}', [WoodController::class,'delete'])->name('wood.delete');

//body wood
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bodywood', [BodyWoodController::class,'index'])->name('guitar.bodywood');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bodywood/create', [BodyWoodController::class,'create'])->name('bodywood.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bodywood/edit/{id}', [BodyWoodController::class,'edit'])->name('bodywood.edit');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bodywood/update/{id}', [BodyWoodController::class,'update'])->name('bodywood.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bodywood/delete/{id}', [BodyWoodController::class,'delete'])->name('bodywood.delete');

//top wood
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/topwood', [TopWoodController::class,'index'])->name('guitar.topwood');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/topwood/create', [TopWoodController::class,'create'])->name('topwood.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/topwood/edit/{id}', [TopWoodController::class,'edit'])->name('topwood.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/topwood/update/{id}', [TopWoodController::class,'update'])->name('topwood.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/topwood/delete/{id}', [TopWoodController::class,'delete'])->name('topwood.delete');

//necks woods
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neckwood', [NeckWoodController::class,'index'])->name('guitar.neckwood');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/neckwood/create', [NeckWoodController::class,'create'])->name('neckwood.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neckwood/edit/{id}', [NeckWoodController::class,'edit'])->name('neckwood.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/neckwood/update/{id}', [NeckWoodController::class,'update'])->name('neckwood.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neckwood/delete/{id}', [NeckWoodController::class,'delete'])->name('neckwood.delete');

//neck shape controler
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neckshape', [NeckShapeController::class,'index'])->name('guitar.neckshape');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/neckshape/create', [NeckShapeController::class,'create'])->name('neckshape.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neckshape/edit/{id}', [NeckShapeController::class,'edit'])->name('neckshape.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/neckshape/update/{id}', [NeckShapeController::class,'update'])->name('neckshape.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neckshape/delete/{id}', [NeckShapeController::class,'delete'])->name('neckshape.delete');

//neck type controler
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/necktype', [NeckTypeController::class,'index'])->name('guitar.necktype');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/necktype/create', [NeckTypeController::class,'create'])->name('necktype.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/necktype/edit/{id}', [NeckTypeController::class,'edit'])->name('necktype.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/necktype/update/{id}', [NeckTypeController::class,'update'])->name('necktype.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/necktype/delete/{id}', [NeckTypeController::class,'delete'])->name('necktype.delete');

//fretboard
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretboard', [FretboardWoodController::class,'index'])->name('guitar.fretboard');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/fretboard/create', [FretboardWoodController::class,'create'])->name('fretboard.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretboard/edit/{id}', [FretboardWoodController::class,'edit'])->name('fretboard.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/fretboard/update/{id}', [FretboardWoodController::class,'update'])->name('fretboard.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretboard/delete/{id}', [FretboardWoodController::class,'delete'])->name('fretboard.delete');

//Neck final table
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neck', [NeckController::class,'index'])->name('guitar.neck');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/neck/create', [NeckController::class,'create'])->name('neck.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neck/edit/{id}', [NeckController::class,'edit'])->name('neck.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/neck/update/{id}', [NeckController::class,'update'])->name('neck.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/neck/delete/{id}', [NeckController::class,'delete'])->name('neck.delete');

//Pickup Configuration
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/pickupconfiguration', [PickupConfigurationController::class,'index'])->name('guitar.pupconfig');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/pickupconfiguration/create', [PickupConfigurationController::class,'create'])->name('pupconfig.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/pickupconfiguration/edit/{id}', [PickupConfigurationController::class,'edit'])->name('pupconfig.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/pickupconfiguration/update/{id}', [PickupConfigurationController::class,'update'])->name('pupconfig.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/pickupconfiguration/delete/{id}', [PickupConfigurationController::class,'delete'])->name('pupconfig.delete');

//Standard Color 
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/color', [StandardColorController::class,'index'])->name('guitar.color');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/color/create', [StandardColorController::class,'create'])->name('color.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/color/edit/{id}', [StandardColorController::class,'edit'])->name('color.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/color/update/{id}', [StandardColorController::class,'update'])->name('color.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/color/delete/{id}', [StandardColorController::class,'delete'])->name('color.delete');

//Translucent Color 
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/transcolor', [TranslucentColorController::class,'index'])->name('guitar.transcolor');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/transcolor/create', [TranslucentColorController::class,'create'])->name('transcolor.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/transcolor/edit/{id}', [TranslucentColorController::class,'edit'])->name('transcolor.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/transcolor/update/{id}', [TranslucentColorController::class,'update'])->name('transcolor.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/transcolor/delete/{id}', [TranslucentColorController::class,'delete'])->name('transcolor.delete');

//fretboard woods
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretboardwood', [FretboardWoodController::class,'index'])->name('guitar.fretboardwood');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/fretboardwood/create', [FretboardWoodController::class,'create'])->name('fretboardwood.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretboardwood/edit/{id}', [FretboardWoodController::class,'edit'])->name('fretboardwood.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/fretboardwood/update/{id}', [FretboardWoodController::class,'update'])->name('fretboardwood.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretboardwood/delete/{id}', [FretboardWoodController::class,'delete'])->name('fretboardwood.delete');

//pickup selector
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/pickupselector', [PickupSelectorController::class,'index'])->name('guitar.pickupselector');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/pickupselector/create', [PickupSelectorController::class,'create'])->name('pickupselector.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/pickupselector/edit/{id}', [PickupSelectorController::class,'edit'])->name('pickupselector.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/pickupselector/update/{id}', [PickupSelectorController::class,'update'])->name('pickupselector.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/pickupselector/delete/{id}', [PickupSelectorController::class,'delete'])->name('pickupselector.delete');


//guitar finishes 
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/finish', [FinishController::class,'index'])->name('guitar.finish');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/finish/create', [FinishController::class,'create'])->name('finish.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/finish/edit/{id}', [FinishController::class,'edit'])->name('finish.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/finish/update/{id}', [FinishController::class,'update'])->name('finish.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/finish/delete/{id}', [FinishController::class,'delete'])->name('finish.delete');

//guitar frets
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/frets/', [FretsController::class,'index'])->name('guitar.frets');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/frets/create', [FretsController::class,'create'])->name('frets.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/frets/edit/{id}', [FretsController::class,'edit'])->name('frets.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/frets/update/{id}', [FretsController::class,'update'])->name('frets.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/frets/delete/{id}', [FretsController::class,'delete'])->name('frets.delete');

//guitar fret radius
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/radius', [FretboardRadiusController::class,'index'])->name('guitar.radius');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/radius/create', [FretboardRadiusController::class,'create'])->name('radius.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/radius/edit/{id}', [FretboardRadiusController::class,'edit'])->name('radius.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/radius/update/{id}', [FretboardRadiusController::class,'update'])->name('radius.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/radius/delete/{id}', [FretboardRadiusController::class,'delete'])->name('radius.delete');

//guitar scale length
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/scalelength', [ScaleLengthController::class,'index'])->name('guitar.scalelength');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/scalelength/create', [ScaleLengthController::class,'create'])->name('scalelength.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/scalelength/edit/{id}', [ScaleLengthController::class,'edit'])->name('scalelength.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/scalelength/update/{id}', [ScaleLengthController::class,'update'])->name('scalelength.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/scalelength/delete/{id}', [ScaleLengthController::class,'delete'])->name('scalelength.delete');

//guitar defaults
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/defaults', [DefaultsController::class,'index'])->name('guitar.defaults');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/defaults/create', [DefaultsController::class,'create'])->name('defaults.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/defaults/edit/{id}', [DefaultsController::class,'edit'])->name('defaults.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/defaults/update/{id}', [DefaultsController::class,'update'])->name('defaults.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/defaults/delete/{id}', [DefaultsController::class,'delete'])->name('defaults.delete');

//guitar order rules for customers
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/orderrules', [OrderRuleController::class,'index'])->name('guitar.rules');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/orderrules/create', [OrderRuleController::class,'create'])->name('rules.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/orderrules/edit/{id}', [OrderRuleController::class,'edit'])->name('rules.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/orderrules/update/{id}', [OrderRuleController::class,'update'])->name('rules.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/orderrules/delete/{id}', [OrderRuleController::class,'delete'])->name('rules.delete');

//guitar gallery of image for custom shop
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/galleryimage', [CustomShopGalleryImageController::class,'index'])->name('guitar.galleryimage');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/galleryimage/create', [CustomShopGalleryImageController::class,'create'])->name('galleryimage.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/galleryimage/edit/{id}', [CustomShopGalleryImageController::class,'edit'])->name('galleryimage.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/galleryimage/update/{id}', [CustomShopGalleryImageController::class,'update'])->name('galleryimage.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/galleryimage/delete/{id}', [CustomShopGalleryImageController::class,'delete'])->name('galleryimage.delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/galleryimage/hide/{id}', [CustomShopGalleryImageController::class,'hide'])->name('galleryimage.hide');

//guitar inlay
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/inlay', [InlayController::class,'index'])->name('guitar.inlay');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/inlay/create', [InlayController::class,'create'])->name('inlay.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/inlay/edit/{id}', [InlayController::class,'edit'])->name('inlay.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/inlay/update/{id}', [InlayController::class,'update'])->name('inlay.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/inlay/delete/{id}', [InlayController::class,'delete'])->name('inlay.delete');

//custom guitar inlay
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/custominlay', [CustomInlayController::class,'index'])->name('guitar.custominlay');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/custominlay/create', [CustomInlayController::class,'create'])->name('custominlay.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/custominlay/edit/{id}', [CustomInlayController::class,'edit'])->name('custominlay.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/custominlay/update/{id}', [CustomInlayController::class,'update'])->name('custominlay.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/custominlay/delete/{id}', [CustomInlayController::class,'delete'])->name('custominlay.delete');

//pickups already done above.

//Bridge
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridge', [BridgeController::class,'index'])->name('guitar.bridge');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridge/create', [BridgeController::class,'create'])->name('bridge.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridge/edit/{id}', [BridgeController::class,'edit'])->name('bridge.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridge/update/{id}', [BridgeController::class,'update'])->name('bridge.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridge/delete/{id}', [BridgeController::class,'delete'])->name('bridge.delete');

//Bridge Type
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgetype', [BridgeTypeController::class,'index'])->name('guitar.bridgetype');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgetype/create', [BridgeTypeController::class,'create'])->name('bridgetype.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgetype/edit/{id}', [BridgeTypeController::class,'edit'])->name('bridgetype.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgetype/update/{id}', [BridgeTypeController::class,'update'])->name('bridgetype.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgetype/delete/{id}', [BridgeTypeController::class,'delete'])->name('bridgetype.delete');

//Bridge Color
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgecolor', [BridgeColorController::class,'index'])->name('guitar.bridgecolor');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgecolor/create', [BridgeColorController::class,'create'])->name('bridgecolor.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgecolor/edit/{id}', [BridgeColorController::class,'edit'])->name('bridgecolor.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgecolor/update/{id}', [BridgeColorController::class,'update'])->name('bridgecolor.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgecolor/delete/{id}', [BridgeColorController::class,'delete'])->name('bridgecolor.delete');

//Bridge Scale
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgescale', [BridgeScaleController::class,'index'])->name('guitar.bridgescale');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgescale/create', [BridgeScaleController::class,'create'])->name('bridgescale.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgescale/edit/{id}', [BridgeScaleController::class,'edit'])->name('bridgescale.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgescale/update/{id}', [BridgeScaleController::class,'update'])->name('bridgescale.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgescale/delete/{id}', [BridgeScaleController::class,'delete'])->name('bridgescale.delete');

//Electronics
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/electronics', [ElectronicController::class,'index'])->name('guitar.electronics');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/electronics/create', [ElectronicController::class,'create'])->name('electronics.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/electronics/edit/{id}', [ElectronicController::class,'edit'])->name('electronics.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/electronics/update/{id}', [ElectronicController::class,'update'])->name('electronics.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/electronics/delete/{id}', [ElectronicController::class,'delete'])->name('electronics.delete');

//Nut
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/nut', [NutController::class,'index'])->name('guitar.nut');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/nut/create', [NutController::class,'create'])->name('nut.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/nut/edit/{id}', [NutController::class,'edit'])->name('nut.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/nut/update/{id}', [NutController::class,'update'])->name('nut.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/nut/delete/{id}', [NutController::class,'delete'])->name('nut.delete');

//Tuners
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/tuners', [TunerController::class,'index'])->name('guitar.tuners');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/tuners/create', [TunerController::class,'create'])->name('tuners.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/tuners/edit/{id}', [TunerController::class,'edit'])->name('tuners.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/tuners/update/{id}', [TunerController::class,'update'])->name('tuners.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/tuners/delete/{id}', [TunerController::class,'delete'])->name('tuners.delete');

//Extras
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/extras', [ExtraController::class,'index'])->name('guitar.extras');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/extras/create', [ExtraController::class,'create'])->name('extras.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/extras/edit/{id}', [ExtraController::class,'edit'])->name('extras.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/extras/update/{id}', [ExtraController::class,'update'])->name('extras.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/extras/delete/{id}', [ExtraController::class,'delete'])->name('extras.delete');

//Brands 

//Bridge Brand
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgebrand', [BridgeBrandController::class,'index'])->name('guitar.bridgebrand');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgebrand/create', [BridgeBrandController::class,'create'])->name('bridgebrand.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgebrand/edit/{id}', [BridgeBrandController::class,'edit'])->name('bridgebrand.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgebrand/update/{id}', [BridgeBrandController::class,'update'])->name('bridgebrand.update');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/bridgebrand/removeimage/{id}', [BridgeBrandController::class,'removeImage'])->name('bridgebrand.removeimage');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/bridgebrand/delete/{id}', [BridgeBrandController::class,'delete'])->name('bridgebrand.delete');

//Tuners Brand
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/tunersbrand', [TunerBrandController::class,'index'])->name('guitar.tunersbrand');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/tunersbrand/create', [TunerBrandController::class,'create'])->name('tunersbrand.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/tunersbrand/edit/{id}', [TunerBrandController::class,'edit'])->name('tunersbrand.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/tunersbrand/removeimage/{id}', [TunerBrandController::class,'removeImage'])->name('tunersbrand.removeimage');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/tunersbrand/update/{id}', [TunerBrandController::class,'update'])->name('tunersbrand.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/tunersbrand/delete/{id}', [TunerBrandController::class,'delete'])->name('tunersbrand.delete');

//Fret Brand
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretsbrand', [FretBrandController::class,'index'])->name('guitar.fretsbrand');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/fretsbrand/create', [FretBrandController::class,'create'])->name('fretsbrand.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretsbrand/edit/{id}', [FretBrandController::class,'edit'])->name('fretsbrand.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/fretsbrand/update/{id}', [FretBrandController::class,'update'])->name('fretsbrand.update');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/fretsbrand/removeimage/{id}', [FretBrandController::class,'removeImage'])->name('fretsbrand.removeimage');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/fretsbrand/delete/{id}', [FretBrandController::class,'delete'])->name('fretsbrand.delete');

// payment options
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/paymentoptions', [PaymentOptionsController::class,'index'])->name('guitar.paymentoptions');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/paymentoptions/create', [PaymentOptionsController::class,'create'])->name('paymentoptions.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/paymentoptions/edit/{id}', [PaymentOptionsController::class,'edit'])->name('paymentoptions.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/products/guitar/paymentoptions/update/{id}', [PaymentOptionsController::class,'update'])->name('paymentoptions.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/paymentoptions/delete/{id}', [PaymentOptionsController::class,'delete'])->name('paymentoptions.delete');

//guitar options trash *not implemented*
Route::middleware(['auth:sanctum', 'verified'])->get('/products/guitar/trash', [TrashController::class,'deleteGuitarOption'])->name('guitar.trash');

// admin views user's orders
Route::middleware(['auth:sanctum', 'verified'])->get('/guitar/viewOrders', [OrdersController::class,'index'])->name('view.orders');
Route::middleware(['auth:sanctum', 'verified'])->post('/guitar/addPrice/{uuid}', [OrdersController::class,'addPrice'])->name('price.orders');
