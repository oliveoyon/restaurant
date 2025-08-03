<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
          $('#add-feehead-form').on('submit', function(e){
                        e.preventDefault();
                        var form = this;
                        $.ajax({
                            url:$(form).attr('action'),
                            method:$(form).attr('method'),
                            data:new FormData(form),
                            processData:false,
                            dataType:'json',
                            contentType:false,
                            beforeSend:function(){
                                 $(form).find('span.error-text').text('');
                            },
                            success:function(data){
                                 if(data.code == 0){
                                       $.each(data.error, function(prefix, val){
                                           $(form).find('span.'+prefix+'_error').text(val[0]);
                                       });
                                 }else{
                                     $(form)[0].reset();
                                      //alert(data.msg);
                                    $('#feehead-table').DataTable().ajax.reload(null, false);
                                    $('#addfeehead').modal('hide');
                                    toastr.success(data.msg);
                                 }
                            }
                        });
                    });
    
                  //GET ALL Districts
                   var table =  $('#feehead-table').DataTable({
                         processing:true,
                         info:true,
                         ajax:"{{ route('admin.getFeeHeadList') }}",
                         "pageLength":10,
                         "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                         columns:[
                            //  {data:'id', name:'id'},
                             {data:'DT_RowIndex', name:'DT_RowIndex'},
                             {data:'aca_feehead_name', name:'aca_feehead_name'},
                             {data:'aca_feehead_description', name:'aca_feehead_description'},
                             {data:'aca_feehead_freq', name:'aca_feehead_freq'},
                             {data:'no_of_installment', name:'no_of_installment'},
                             {data:'status', name:'status', orderable:false, searchable:false},
                             {data:'actions', name:'actions', orderable:false, searchable:false},
                         ]
                    });    
    
                    $(document).on('click','#editFeeheadBtn', function(){
                        var feehead_id = $(this).data('id');
                        //alert(feehead_id);
                        $('.editFeeHeads').find('form')[0].reset();
                        $('.editFeeHeads').find('span.error-text').text('');
                        $.post("{{ route('admin.getFeeheadDetails') }}",{feehead_id:feehead_id}, function(data){
                            //alert(data.details.aca_feehead_name);
                            $('.editFeeHeads').find('input[name="fhid"]').val(data.details.id);
                            
                            $('.editFeeHeads').find('input[name="aca_feehead_name"]').val(data.details.aca_feehead_name);
                            $('.editFeeHeads').find('input[name="aca_feehead_description"]').val(data.details.aca_feehead_description);
                            $('.editFeeHeads').find('select[name="aca_feehead_freq"]').val(data.details.aca_feehead_freq);
                            $('.editFeeHeads').find('select[name="status"]').val(data.details.status);
                            $('.editFeeHeads').modal('show');
                        },'json');
                    });
                    
    
                    
                    $('#update-feehead-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend: function(){
                             $(form).find('span.error-text').text('');
                        },
                        success: function(data){
                              if(data.code == 0){
                                  $.each(data.error, function(prefix, val){
                                      $(form).find('span.'+prefix+'_error').text(val[0]);
                                  });
                              }else{
                                  $('#feehead-table').DataTable().ajax.reload(null, false);
                                  $('.editFeeHeads').modal('hide');
                                  $('.editFeeHeads').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                                }
                            });
                        });
    
    
                    //DELETE Version RECORD
                    $(document).on('click','#deleteFeeheadBtn', function(){
                        var feehead_id = $(this).data('id');
                        var url = '<?= route("admin.deleteFeehead"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Fee Head',
                             showCancelButton:true,
                             showCloseButton:true,
                             cancelButtonText:'Cancel',
                             confirmButtonText:'Yes, Delete',
                             cancelButtonColor:'#d33',
                             confirmButtonColor:'#556ee6',
                             width:300,
                             allowOutsideClick:false
                        }).then(function(result){
                              if(result.value){
                                  $.post(url,{feehead_id:feehead_id}, function(data){
                                       if(data.code == 1){
                                           $('#feehead-table').DataTable().ajax.reload(null, false);
                                           toastr.success(data.msg);
                                       }else{
                                           toastr.error(data.msg);
                                       }
                                  },'json');
                              }
                        });
                    });
    
                    
    
                    
    
      })
    </script>