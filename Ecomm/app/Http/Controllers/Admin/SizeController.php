<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;
use App\DataTables\SizesDatatable;
use App\Http\Controllers\Controller;
use App\Model\Size;
use Illuminate\Http\Request;
use Storage;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizesDatatable $size) {
        return $size->render('admin.sizes.index', ['title' => trans('admin.sizes')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.sizes.create', ['title' => trans('admin.add')]);
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
                'name_ar'       => 'required',
                'name_en'       => 'required',
                'department_id' => 'required|numeric',
                'is_public'     => 'required|in:yes,no',
            ], [], [
                'name_ar'           => trans('admin.name_ar'),
                'name_en'           => trans('admin.name_en'),
                'Size'              => trans('admin.mobile'),
                'department_id'     => trans('admin.department_id'),
                'is_public'         => trans('admin.department_id'),
        ]);

        Size::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('sizes'));
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
        $size   = Size::find($id);
        $title    = trans('admin.edit');
        return view('admin.sizes.edit', compact('size', 'title'));
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
                'name_ar'       => 'required',
                'name_en'       => 'required',
                'department_id' => 'required|numeric',
                'is_public'     => 'required|in:yes,no',
            ], [], [
                'name_ar'           => trans('admin.name_ar'),
                'name_en'           => trans('admin.name_en'),
                'Size'              => trans('admin.mobile'),
                'department_id'     => trans('admin.department_id'),
                'is_public'         => trans('admin.department_id'),
        ]);

        Size::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('sizes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $Size = Size::find($id);
        Storage::delete($Size->logo);
        $Size->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('sizes'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $Size = Size::find($id);
                Storage::delete($Size->logo);
                $Size->delete();
            }
        } else {
            $Size = Size::find(request('item'));
            Storage::delete($Size->logo);
            $Size->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('sizes'));
    }
}
