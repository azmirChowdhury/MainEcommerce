<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ColorModel;
use App\Models\admin\SizeModel;
use App\Models\BrandModel;
use App\Models\ProductColorModel;
use App\Models\ProductImageGalleryModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DeleteFunction\ProductSizeDeleteController;
use App\Http\Controllers\Admin\DeleteFunction\Product_Color_Delete_Comtroller;
use App\Http\Controllers\Admin\DeleteFunction\product_image_delete_Controller;
use App\Http\Controllers\admin\slug_controller;
use Session;
use Image;
use Validator;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $color = ColorModel::all();
        $size = SizeModel::all();
        $data['brands'] = BrandModel::where('status', 1)->get();
        $data['categories'] = SubcategoryModel::where('status', 1)->get();
        return view('back_end.Product.add_product', ['colors' => $color, 'sizes' => $size, 'data' => $data]);
    }

    private function Validation($request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_specification' => 'required',
            'currency' => 'required',
            'sale_price' => 'required|integer',
            'product_quantity' => 'required|integer',
            'long_description' => 'required',
            'category_name' => 'required',
            'brand_name' => 'required',
            'status' => 'required|integer|max:1|min:0',
        ]);
    }

    private function Product_image_delete($id)
    {
        $product = ProductModel::find($id);
        unlink($product->product_image);
    }

    private function size_insert($request, $work, $product_id)
    {
        if ($work == 'i') {
            $size = new ProductSizeModel();
        } else {
            $size = ProductSizeModel::where('product_id', $request->id)->first();
        }
        $size->product_id = $product_id;
        $size->product_size = json_encode($request->size);
        return $size;
    }

    private function color_insert($request, $work, $product_id)
    {
        if ($work == 'i') {
            $color = new ProductColorModel();
        } else {
            $color = ProductColorModel::where('product_id', $request->id)->first();
        }
        $color->color_name = json_encode($request->color);
        $color->product_id = $product_id;
        return $color;
    }

    private function image_insert($request)
    {
        $this->validate($request, [
            'product_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
        ]);
        $random = rand(9999, 99999);
        $file = $request->file('product_image');
        $imageExtension = $file->getClientOriginalExtension();
        $directory = 'back_end/images/Product_images/';
        $image_name = $directory . $random . $request->product_name . '.' . $imageExtension;
        Image::make($file)->resize(800, 800)->save($image_name);
        return $image_name;
    }

    private function product_gallery($request)
    {
        $thisImages = $request->file('product_gallery_images');
        $jsname = array();
        $random = 1;
        $rand = rand(1000, 98457);
        foreach ($thisImages as $thisImage) {
            $image_extention = $thisImage->getClientOriginalExtension();
            $image_name = $request->product_name . '.' . $image_extention;
            $directory = 'back_end/images/gallery_product_image/';
            $name = $directory . $rand . '_' . $random . $image_name;
            Image::make($thisImage)->resize(800, 800)->save($name);
            $jsname[] = $name;
            $random++;
        }
        return $jsname;

    }

    private function product_gallery_info_insert($request, $jsname, $product_id, $work)
    {
        if ($work == 'i') {
            $image = new ProductImageGalleryModel();
        } else {
            $image = ProductImageGalleryModel::where('product_id', $request->id)->first();
        }
        $image->product_id = $product_id;
        $image->images = json_encode($jsname);
        return $image;
    }


    private function product_data_insert($request, $image_name, $work)
    {
        if ($work == 'i') {
            $model = ProductModel::all();
            $slug = app(slug_controller\SluConfier::class)->for_insert_slug($request->product_name, $model);
            $product = new ProductModel();
        } else {
            $product = ProductModel::find($request->id);
            if ($product != null) {
                $slug = app(slug_controller\SluConfier::class)->slug_Create($request->product_name, $product);
            } else {
                return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
            }
        }
        $product->product_name = $request->product_name;
        $product->slug = $slug;
        $product->product_specification = $request->product_specification;
        $product->currency = $request->currency;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->product_quantity = $request->product_quantity;
        $product->product_weight = $request->product_weight;
        $product->product_length = $request->product_length;
        $product->product_width = $request->product_width;
        $product->product_height = $request->product_height;
        $product->product_image = $image_name;
        $product->long_description = $request->long_description;
        $product->category_name = substr($request->category_name, 0, strpos($request->category_name, '='));
        $product->category_id = filter_var($request->category_name, FILTER_SANITIZE_NUMBER_INT);
        $product->brand_name = $request->brand_name;
        $product->status = $request->status;
        return $product;

    }

    public function save_product(Request $request)
    {
        $this->Validation($request);

        try {
            $work = 'i';
            $image_name = $this->image_insert($request);
            $product = $this->product_data_insert($request, $image_name, $work);
            $product->save();
            $product_id = $product->id;
            if (!empty($request->size) == true) {
                $size = $this->size_insert($request, $work, $product_id);
                $size->save();
            }
            if (!empty($request->color) == true) {
                $color = $this->color_insert($request, $work, $product_id);
                $color->save();
            }
            if (!empty($request->product_gallery_images) == true) {
                $this->validate($request, [
                    'product_gallery_images' => 'required|image|mimes:jpg,png,svg,bmp,jpeg',
                ]);
                $jsname = $this->product_gallery($request);
                $image = $this->product_gallery_info_insert($request, $jsname, $product_id, $work);
                $image->save();
            }
            return redirect('dashboard/products/add-product')->with('massage', 'Product save successful');
        } catch (Exception $e) {
            return redirect('dashboard/products/add-product')->with('err', 'Product not save');
        }

    }

    public function manage_products()
    {
        $products = ProductModel::orderBy('id', 'DESC')->get();
        return view('back_end.Product.manage_product', ['products' => $products]);
    }

    public
    function unpublished_product($id)
    {
        $product = ProductModel::find($id);
        if ($product != null) {
            $product->status = 0;
            $product->update();
        } else {
            return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
        }

        return redirect('dashboard/products/manage-products')->with('massage', 'Product ' . $product->product_name . ' Status Unpublished successful');
    }

    public
    function publish_product($id)
    {
        $product = ProductModel::find($id);
        if ($product != null) {
            $product->status = 1;
            $product->update();
        } else {
            return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
        }

        return redirect('dashboard/products/manage-products')->with('massage', 'Product ' . $product->product_name . ' Status Publish successful');
    }

    public
    function product_full_details($id)
    {
        $product = ProductModel::find($id);
        if ($product != null) {
            $size = ProductSizeModel::where('product_id', $id)->first();
            $color = ProductColorModel::where('product_id', $id)->first();
            $images = ProductImageGalleryModel::where('product_id', $id)->first();
            if (!$size == null) {
                $product['size'] = json_decode($size->product_size);
            }
            if (!$color == null) {
                $product['color'] = json_decode($color->color_name);
            }
            if (!$images == null) {
                $product['imagei'] = json_decode($images->images);
            }
        } else {
            return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
        }
        return view('back_end.Product.product_details', ['product' => $product]);
    }

    public
    function delete_product($id)
    {
        $product = ProductModel::find($id);
        if ($product != null) {
            app(product_image_delete_Controller::class)->gallery_image($id);
            $this->Product_image_delete($id);
            app(ProductSizeDeleteController::class)->product_Size_delete($id);
            app(Product_Color_Delete_Comtroller::class)->product_color_delete($id);
            $product->delete();
        } else {
            return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
        }

        return redirect('dashboard/products/manage-products')->with('massage', 'Your product delete successful');
    }

    public
    function edit_product($id)
    {
        $product = ProductModel::find($id);
        if ($product != null) {
            $size = ProductSizeModel::where('product_id', $id)->first();
            $color = ProductColorModel::where('product_id', $id)->first();
            $images = ProductImageGalleryModel::where('product_id', $id)->first();
            $product['size'] = SizeModel::all();
            $product['color'] = ColorModel::all();
            $product['brands'] = BrandModel::where('status', 1)->get();
            $product['categories'] = SubcategoryModel::where('status', 1)->get();
            if (!$size == null) {
                $product['size_product'] = json_decode($size->product_size);
            }
            if (!$color == null) {
                $product['color_product'] = json_decode($color->color_name);
            }
            if (!$images == null) {
                $product['image_product'] = json_decode($images->images);
            }
        } else {
            return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
        }
        return view('back_end.Product.edit_product', ['product' => $product]);
    }


    private
    function edit_size($request, $work, $product_id)
    {
        if (!empty($request->size) == true) {
            $find_size = ProductSizeModel::where('product_id', $request->id)->first();
            if (!$find_size == null) {
                $size = $this->size_insert($request, $work, $product_id);
                $size->update();
            } else {
                $size = $this->size_insert($request, 'i', $product_id);
                $size->save();
            }
        } else {
            app(ProductSizeDeleteController::class)->product_Size_delete($product_id);
        }

    }

    private
    function edit_color($request, $work, $product_id)
    {
        if (!empty($request->color) == true) {
            $findColor = ProductColorModel::where('product_id', $request->id)->first();
            if (!$findColor == null) {
                $color = $this->color_insert($request, $work, $product_id);
                $color->update();
            } else {
                $color = $this->color_insert($request, 'i', $product_id);
                $color->save();
            }
        } else {
            app(Product_Color_Delete_Comtroller::class)->product_color_delete($product_id);
        }

    }

    private
    function edit_gallery_image($request)
    {
        if (!empty($request->product_gallery_images == true)) {
            Validator::make($request->product_gallery_images, [
                'product_gallery_images' => 'required|image|mimes:jpg,png,svg,bmp,jpeg',
            ]);
            app(product_image_delete_Controller::class)->gallery_image($request->id);
            $jsname = $this->product_gallery($request);
            $image = $this->product_gallery_info_insert($request, $jsname, $request->id, 'i');
            $image->save();
        }
    }

    private
    function edit_singe_image($request)
    {
        $this->validate($request, [
            'product_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
        ]);
        $this->Product_image_delete($request->id);
        $image_name = $this->image_insert($request);
        return $image_name;
    }

    public
    function save_edit_product(request $request)
    {
        $this->Validation($request);
        $work = 'u';
        $product = $product = ProductModel::find($request->id);
        if ($product != null) {
            if (file_exists($request->product_image) == true) {
                $image_name = $this->edit_singe_image($request);
                $image = $image_name;
                $product = $this->product_data_insert($request, $image, $work);
                $product->update();
                $product_id = $request->id;
                $this->edit_size($request, $work, $product_id);
                $this->edit_color($request, $work, $product_id);
                $this->edit_gallery_image($request);
            } else {
                $image_name = $request->image;
                $product = $this->product_data_insert($request, $image_name, $work);
                $product->update();
                $product_id = $request->id;
                $this->edit_size($request, $work, $product_id);
                $this->edit_color($request, $work, $product_id);
                $this->edit_gallery_image($request);
            }
        } else {
            return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
        }
        return redirect('dashboard/products/manage-products')->with('massage', $request->product_name . ' Edit Successful');
    }

    public
    function stock_out_product()
    {
        $products = ProductModel::orderBy('id', 'DESC')
            ->where('product_quantity', 0)
            ->get();
        return view('back_end.Product.stock_out_product', ['products' => $products]);
    }

    public
    function product_stock_update(request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|min:0;'
        ]);
        $product = ProductModel::find($request->id);
        if ($product!=null) {
            $product->product_quantity = $request->quantity;
            $product->update();
        } else {
            return redirect('dashboard/products/manage-products')->with('massage', 'The product was deleted');
        }

        return redirect('dashboard/product/out-of-stock-product')->with('massage', 'Quantity update');

    }

}


