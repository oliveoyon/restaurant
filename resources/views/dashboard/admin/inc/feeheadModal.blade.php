<div class="modal fade editFeeHeads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('language.edit_class') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form action="{{ route('admin.updateFeeheadDetails'); }}" method="post" id="update-feehead-form">
                    @csrf
                     <input type="hidden" name="fhid">
                     
                     <div class="form-group">
                      <label for="">{{ __('language.add_fee_head') }}</label>
                      <input type="text" class="form-control" name="aca_feehead_name" placeholder="Enter Fee Head Name">
                      <span class="text-danger error-text aca_feehead_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('language.fee_head_description') }}</label>
                        <input type="text" class="form-control" name="aca_feehead_description" placeholder="Enter Fee Head Name">
                        <span class="text-danger error-text aca_feehead_description_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('language.frequency') }}</label>
                        <select name="aca_feehead_freq" id="" class="form-control">
                            <option value="">{{ __('language.select') }}</option>
                            @foreach ($frequencies as $freq)
                            <option value="{{ $freq->id }}">{{ $freq->freq_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text aca_feehead_freq_error"></span>
                    </div>
                     
                     <div class="form-group">
                        <label for="">{{ __('language.status') }}</label>
                        <select name="status" id="" class="form-control">
                            <option value="1">{{ __('language.active') }}</option>
                            <option value="0">{{ __('language.inactive') }}</option>
                        </select>
                        <span class="text-danger error-text status_error"></span>
                    </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success">সংরক্ষন করুন</button>
                     </div>
                 </form>
                
  
            </div>
        </div>
    </div>
  </div>