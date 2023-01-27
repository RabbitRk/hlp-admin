@extends('backend.layouts.master')

@section('main-content')
<style>
  div#append_variation input[type="text"],.sku_class input[type="text"] {
    border: 1px solid #ccc;
    width: 46%;
    padding: 8px;
    margin:10px 5px;
    border: 1px solid #ccc;
    border-radius: 20px;

}
.sku_class{
  border: 1px solid #ccc;
    border-radius: 20px;
    margin:10px auto;
}
</style>

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}' {{(($product->is_featured) ? 'checked' : '')}}> Yes                        
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
        @php 
          $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
        // dd($sub_cat_info);

        @endphp
        {{-- {{$product->child_cat_id}} --}}
        <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any sub category--</option>
              
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{$product->price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{$product->discount}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="sku" class="col-form-label">SKU</label>
          <input id="sku" type="text" name="sku"  placeholder="Enter discount"  value="{{$product->sku}}" class="form-control">
          @error('sku')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
       <h2>Product Variation</h2>
          
        @php 
           $variable_product=json_decode($variable_products);  
           $get_keys_value=json_decode($variable_product[0]->variant_value);
           $get_sku_keys=json_decode($variable_product[0]->variant_sku); 
          @endphp


          <!-- For getting Keys only -->
          @foreach($get_keys_value as $key=>$varations)
            @php
               $assigned_values[]=$key; 
            @endphp
          @endforeach 

            <!-- For getting Keys only Ends -->

            <!-- Initial variation Starts -->

            <div class="dynamic_variation">
                  @foreach($variant as $variant_values) 
                      <input type="checkbox" class="{{ $variant_values->variation_value }}" @php  if(in_array($variant_values->variation_value,$assigned_values)){ echo "checked"; }  @endphp value="{{ $variant_values->variation_value }}" class="{{ $variant_values->variation_value }}" name="listof_variants[]" id="{{ $variant_values->variation_value }}">{{ $variant_values->variation_value }}
                      <div id="dynamic_div_{{$variant_values->variation_value}}" class="sku_class">
                     
                      @if(in_array($variant_values->variation_value,$assigned_values))
                    @php
                      $maim_var_values = (array) $get_keys_value;
                      $main_var_skus =  (array) $get_sku_keys; 
                    @endphp
                    <h3 class="myclass_{{ $variant_values->variation_value }}">{{ $variant_values->variation_value }}</h3> 
                    <button class="add_more_variants" id="{{ $variant_values->variation_value }}">Add More {{ $variant_values->variation_value }}</button><br>
                      @foreach($maim_var_values[$variant_values->variation_value] as $variants_enws)
                     <input type="text" class="{{ $variant_values->variation_value }}" value="{{ $variants_enws }}" name="variation_value[{{ $variant_values->variation_value }}][]">
                     @endforeach
                     @foreach($main_var_skus[$variant_values->variation_value] as $variants_skulists)
                     <input type="text" class="{{ $variant_values->variation_value }}" value="{{ $variants_skulists }}" name="variation_sku[{{ $variant_values->variation_value }}][]">
                     @endforeach

                         @endif
                      </div>
                  @endforeach
          </div>
         <!-- Initial variation checked ends -->

       
        
        </div>
        <div class="form-group">
          <label for="brand_id">Brand</label>
          <select name="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Default</option>
              <option value="new" {{(($product->condition=='new')? 'selected':'')}}>New</option>
              <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive</option>
        </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail Description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>

<script>
  var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Select any one--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
                            }
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{

            }

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
</script>
<script> 
var uniquid=0;
$(document).on('click','.dynamic_variation [type="checkbox"]',function(){

           ///console.log()
              var inc=$(this).attr("id");  
              var check_click=$(this).prop('checked'); 
             if(check_click==true){
                var sku_value='';
              var len= $(".myclass_"+inc).length; 
              // alert(len)
              if(len<=0){
                $("div#dynamic_div_"+inc).prepend("<h3 class='myclass_"+inc+"'>"+inc+"</h3>");
                $(".myclass_"+inc).after("<button id='"+inc+"' class='add_more_variants'>Add More "+inc+"</button><br/>");
              }
              sku_value = document.createElement("input");
              sku_value.setAttribute("type", 'text');
              sku_value.setAttribute("name", 'variation_value['+inc+'][]');
              sku_value.classList.add("variation_value_"+inc);
              sku_value.setAttribute("placeholder", "Variation Value");
              const variation_value= document.getElementById("dynamic_div_"+inc);
              variation_value.appendChild(sku_value); 

              var sku='';
              sku = document.createElement("input");
              sku.setAttribute("type", 'text');
              sku.setAttribute("name", 'variation_sku['+inc+'][]');
              sku.classList.add("variation_sku_"+inc);
              sku.setAttribute("placeholder", "Variation SKU");
              const sku_logics= document.getElementById("dynamic_div_"+inc);
              sku_logics.appendChild(sku);        
              uniquid++;
             }
              else{ 
                console.log("else conditions")
                $("#dynamic_div_"+inc).html("");
                $("#dynamic_div_"+inc).html("");
              }
  


});


$(document).on('click','.dynamic_variation .sku_class .add_more_variants',function(e){
  e.preventDefault();
              var variation=$(this).attr("id");
              sku_value = document.createElement("input");
              sku_value.setAttribute("type", 'text');
              sku_value.setAttribute("name", 'variation_value['+variation+'][]');
              sku_value.classList.add("variation_value_"+variation);
              sku_value.setAttribute("placeholder", "Variation Value");
              const variation_value= document.getElementById("dynamic_div_"+variation);
              variation_value.appendChild(sku_value); 

              var sku='';
              sku = document.createElement("input");
              sku.setAttribute("type", 'text');
              sku.setAttribute("name", 'variation_sku['+variation+'][]');
              sku.classList.add("variation_sku_"+variation);
              sku.setAttribute("placeholder", "Variation SKU");
              const sku_logics= document.getElementById("dynamic_div_"+variation);
              sku_logics.appendChild(sku);        
              uniquid++;

});
</script>
@endpush