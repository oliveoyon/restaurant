<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
          $('#add-account-form').on('submit', function(e){
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
                                     

                                    $('#accounttype-table').DataTable().ajax.reload(null, false);
                                      $('#addaccounttypes').modal('hide');
                                      $('#addaccounttypes').find('form')[0].reset();
                                      toastr.success(data.msg);

                                      
                                 }
                            }
                        });
                    });
    
                  //GET ALL Districts
                   var table =  $('#accounttype-table').DataTable({
                         processing:true,
                         info:true,
                         ajax:"{{ route('admin.getAccountTypesList') }}",
                         "pageLength":15,
                         "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                         columns:[
                            //  {data:'id', name:'id'},
                             {data:'DT_RowIndex', name:'DT_RowIndex'},
                             {data:'account_head_id', name:'account_head_id'},
                             {data:'account_name', name:'account_name'},
                             {data:'status', name:'status', orderable:false, searchable:false},
                             {data:'actions', name:'actions', orderable:false, searchable:false},
                         ]
                    });    
    
                    $(document).on('click','#editAccountTypeBtn', function(){
                        var account_type_id = $(this).data('id');
                        $('.editAccountType').find('form')[0].reset();
                        $('.editAccountType').find('span.error-text').text('');
                        $.post("{{ route('admin.getAccountTypeDetails') }}",{account_type_id:account_type_id}, function(data){
                            //alert(data.details.version_name);
                            $('.editAccountType').find('input[name="uid"]').val(data.details.id);
                            $('.editAccountType').find('input[name="account_name"]').val(data.details.account_name);
                            $('.editAccountType').find('select[name="account_head_id"]').val(data.details.account_head_id);
                            $('.editAccountType').find('select[name="acctype_status"]').val(data.details.acctype_status);
                            $('.editAccountType').modal('show');
                        },'json');
                    });
    
                    //UPDATE Court DETAILS
                    $('#update-accounttype-form').on('submit', function(e){
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
                                      $('#accounttype-table').DataTable().ajax.reload(null, false);
                                      $('.editAccountType').modal('hide');
                                      $('.editAccountType').find('form')[0].reset();
                                      toastr.success(data.msg);
                                  }
                            }
                        });
                    });
    
    
                    //DELETE Version RECORD
                    $(document).on('click','#deleteAccountTypeBtn', function(){
                        var account_type_id = $(this).data('id');
                        var url = '<?= route("admin.deleteAccountType"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Account Type',
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
                                  $.post(url,{account_type_id:account_type_id}, function(data){
                                       if(data.code == 1){
                                           $('#accounttype-table').DataTable().ajax.reload(null, false);
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
    
    
    