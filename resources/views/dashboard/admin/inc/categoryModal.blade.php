<div class="modal fade editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('language.edit_category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
            <div class="modal-body">
                 <form action="{{ route('admin.updateCategoryDetails'); }}" enctype="multipart/form-data" method="post" id="update-category-form">
                    @csrf
                     <input type="hidden" name="cid">
                     <div class="form-group">
                      <label for="">{{ __('language.category_name') }}</label>
                      <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name">
                      <span class="text-danger error-text category_name_error"></span>
                    </div>
                     
                    <div class="form-group">
                        <label for="">{{ __('language.status') }}</label>
                        <select name="category_status" id="" class="form-control">
                            <option value="1">{{ __('language.active') }}</option>
                            <option value="0">{{ __('language.inactive') }}</option>
                        </select>
                        <span class="text-danger error-text category_status_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('language.category_image') }} <button type="button" id="clearInputFile" class="btn btn-danger btn-sm">Clear</button></label>
                        <input type="file" class="form-control" name="category_img_update">
                        <span class="text-danger error-text category_img_update_error"></span>
                    </div>

                    <div class="img-holder-update"></div>  

                     <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success">{{ __('language.update') }}</button>
                     </div>
                 </form>
                
  
            </div>
        </div>
    </div>
  </div>