<?php

namespace App\Http\Controllers;
use App\Models\ActivePassive;
use App\Models\Bridge;
use App\Models\BridgeBrand;
use App\Models\BridgeType;
use App\Models\CustomInlay;
use App\Models\Electronic;
use App\Models\Extra;
use App\Models\Finish;
use App\Models\Fret;
use App\Models\FretboardRadius;
use App\Models\FretBrand;
use App\Models\Guitar;
use App\Models\Inlay;
use App\Models\MagnetMaterial;
use App\Models\Neck;
use App\Models\NeckShape;
use App\Models\PickupBrand;
use App\Models\PickupCovering;
use App\Models\PickupType;
use App\Models\PickupPosition;
use App\Models\Pickup;
use App\Models\Wood;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index(){
        $trashed_actives=ActivePassive::onlyTrashed()->latest()->paginate(5);
        $trashed_magnets=MagnetMaterial::onlyTrashed()->latest()->paginate(5);
        $trashed_coverings=PickupCovering::onlyTrashed()->latest()->paginate(5);
        $trashed_types=PickupType::onlyTrashed()->latest()->paginate(5);
        $trashed_positions=PickupPosition::onlyTrashed()->latest()->paginate(5);
        $trashed_brands=PickupBrand::onlyTrashed()->latest()->paginate(5);
        $trashed_pickups=Pickup::onlyTrashed()->latest()->paginate(5);

        return view('admin.products.options.trash',compact('trashed_actives','trashed_magnets','trashed_coverings','trashed_types','trashed_positions','trashed_brands','trashed_pickups'));
    }
}
