<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\ShipingDatatable;
use App\Http\Controllers\Controller;
use App\Model\Shiping;
use Illuminate\Http\Request;
use Storage;

class ShipingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(ShipingDatatable $trade) {
		return $trade->render('admin.shiping.index', ['title' => trans('admin.shiping')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.shiping.create', ['title' => trans('admin.add')]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store() {

		$data = $this->validate(request(),
			[
				'name_ar'      => 'required',
				'name_en'      => 'required',
				'user_id'      => 'required|numeric',
				'lat'          => 'sometimes|nullable',
				'lng'          => 'sometimes|nullable',
				'icon'         => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar'      => trans('admin.name_ar'),
				'name_en'      => trans('admin.name_en'),
				'user_id'      => trans('admin.user_id'),
				'lat'          => trans('admin.lat'),
				'lng'          => trans('admin.lng'),
				'icon'         => trans('admin.icon'),
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'shiping',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Shiping::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('shiping'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$shiping = Shiping::find($id);
		$title    = trans('admin.edit');
		return view('admin.shiping.edit', compact('shiping', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, $id) {

		$data = $this->validate(request(),
			[
				'name_ar'      => 'required',
				'name_en'      => 'required',
				'user_id'      => 'required|numeric',
				'lat'          => 'sometimes|nullable',
				'lng'          => 'sometimes|nullable',
				'icon'         => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar'      => trans('admin.name_ar'),
				'name_en'      => trans('admin.name_en'),
				'user_id'      => trans('admin.user_id'),
				'lat'          => trans('admin.lat'),
				'lng'          => trans('admin.lng'),
				'icon'         => trans('admin.icon'),
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'shiping',
					'upload_type' => 'single',
					'delete_file' => Shiping::find($id)->icon,
				]);
		}

		Shiping::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('shiping'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$shiping = Shiping::find($id);
		Storage::delete($shiping->logo);
		$shiping->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('shiping'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$shiping = Shiping::find($id);
				Storage::delete($shiping->logo);
				$shiping->delete();
			}
		} else {
			$shiping = Shiping::find(request('item'));
			Storage::delete($shiping->logo);
			$shiping->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('shiping'));
	}
}
