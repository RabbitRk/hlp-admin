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
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes                        
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
       
        <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach --}}
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{old('discount')}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
            <label for="sku_id">SKU</label>
            <input type="text" class="form-control" name="sku" id="sku">
        </div>

        <div class="form-group">
          <label for="">
          Select Variable product or simple product ? <span class="text-danger">*</span>
          </label>
          <br>
       <select name="check_variable" class="form-control" id="variable_product">
        <option value="">Select</option>
        <option value="0">Simple Product</option>
        <option value="1">Variable Product</option>
       </select>
        @error('check_variable')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group variable_show">
          <h2>Product Variation</h2>
          <!-- <button class="add_variation btn btn-primary" id="add_variation">Add Variation</button> -->
         
          <div class="dynamic_variation">
          @foreach($variant as $variant_keys)
                <input type="checkbox" value="{{ $variant_keys->variation_value }}" class="{{ $variant_keys->variation_value }}" name="listof_variants[]" id="{{ $variant_keys->variation_value }}">{{ $variant_keys->variation_value }}
          @endforeach 
          @foreach($variant as $variant_keys)
          <div id="dynamic_div_{{$variant_keys->variation_value}}" class="sku_class"></div>
          @endforeach 
          </div> 
          <div class="append_variation" id="append_variation">
          </div> 

        </div>
      

        <div class="form-group">
          <label for="brand_id">Brand</label>
          {{-- {{$brands}} --}}

          <select name="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}">{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
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
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    // $('select').selectpicker();

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
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
  })
</script>

<script> 
$(document).ready(function(){
  $(".variable_show").hide();
  $("#variable_product").change(function(){
    if($(this).val()==1){
      $(".variable_show").show();
    }
    else 
    {
      $(".variable_show").hide();
    }
  })
});

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

// to add variation logic
//    document.getElementById("add_variation").onclick = function() {myFunction(event)};
//             var a=1;
//             function myFunction(event){
//               event.preventDefault();
//               var para='';
//               para = document.createElement("input");
//               para.setAttribute("type", 'text');
//               para.classList.add("mystyle"+a);
//               para.setAttribute("placeholder", "Variation Name");
//               para.setAttribute("name", 'variation_key[]');
//               const addelements= document.getElementById("append_variation");
             
//               addelements.appendChild(para); 

//               var create_btn='';
//               create_btn = document.createElement("input");
//               create_btn.setAttribute("type", 'button');
//               create_btn.setAttribute("Value", 'Variation Values');
//               create_btn.classList.add("variation"+a);
//               //create_btn.classList.add("btn-primary");
//               create_btn. setAttribute('id',"variation"+a);
              
//               const addelements_btn= document.getElementById("append_variation");
//               addelements_btn.appendChild(create_btn); 
//             // // for creating input elements ends 
//             a++;
//             } 
// // to add variation logic 



//   $(document).on('click','.append_variation [type="button"]',function(){
              
//               var inc=$(this).attr("id"); 
//               var ddd= $("#"+inc).attr("name"); 
//               console.log(inc);
//               console.log(ddd);
//               return false;

//               var sku_value='';
//               sku_value = document.createElement("input");
//               sku_value.setAttribute("type", 'text');
//               sku_value.setAttribute("name", 'variation_value_'+inc+'[]');
//               sku_value.classList.add("variation_value_"+inc);
//               sku_value.setAttribute("placeholder", "Variation Value");
//               const variation_value= document.getElementById("append_variation");
//               variation_value.appendChild(sku_value); 

//               var sku='';
//               sku = document.createElement("input");
//               sku.setAttribute("type", 'text');
//               sku.setAttribute("name", 'variation_sku_'+inc+'[]');
//               sku.classList.add("variation_sku_"+inc);
//               sku.setAttribute("placeholder", "Variation SKU");
//               const sku_logics= document.getElementById("append_variation");
//               sku_logics.appendChild(sku);               
// });

</script>
@endpush