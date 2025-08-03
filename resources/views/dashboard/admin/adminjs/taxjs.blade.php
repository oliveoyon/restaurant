<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
          $('#add-tax-form').on('submit', function(e){
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
                                     

                                    $('#tax-table').DataTable().ajax.reload(null, false);
                                      $('#addtaxes').modal('hide');
                                      $('#addtaxes').find('form')[0].reset();
                                      toastr.success(data.msg);

                                      
                                 }
                            }
                        });
                    });
    
                  //GET ALL Districts
                   var table =  $('#tax-table').DataTable({
                         processing:true,
                         info:true,
                         ajax:"{{ route('admin.getTaxsList') }}",
                         "pageLength":5,
                         "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                         columns:[
                            //  {data:'id', name:'id'},
                             {data:'DT_RowIndex', name:'DT_RowIndex'},
                             {data:'tax_name', name:'tax_name'},
                             {data:'tax_short_name', name:'tax_short_name'},
                             {data:'tax_value_percent', name:'tax_value_percent'},
                             {data:'status', name:'status', orderable:false, searchable:false},
                             {data:'actions', name:'actions', orderable:false, searchable:false},
                         ]
                    });    
    
                    $(document).on('click','#editTaxBtn', function(){
                        var tax_id = $(this).data('id');
                        $('.editTax').find('form')[0].reset();
                        $('.editTax').find('span.error-text').text('');
                        $.post("{{ route('admin.getTaxDetails') }}",{tax_id:tax_id}, function(data){
                            //alert(data.details.version_name);
                            $('.editTax').find('input[name="uid"]').val(data.details.id);
                            $('.editTax').find('input[name="tax_name"]').val(data.details.tax_name);
                            $('.editTax').find('input[name="tax_short_name"]').val(data.details.tax_short_name);
                            $('.editTax').find('input[name="tax_value_percent"]').val(data.details.tax_value_percent);
                            $('.editTax').find('select[name="tax_status"]').val(data.details.tax_status);
                            $('.editTax').modal('show');
                        },'json');
                    });
    
                    //UPDATE Court DETAILS
                    $('#update-tax-form').on('submit', function(e){
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
                                      $('#tax-table').DataTable().ajax.reload(null, false);
                                      $('.editTax').modal('hide');
                                      $('.editTax').find('form')[0].reset();
                                      toastr.success(data.msg);
                                  }
                            }
                        });
                    });
    
    
                    //DELETE Version RECORD
                    $(document).on('click','#deleteTaxBtn', function(){
                        var tax_id = $(this).data('id');
                        var url = '<?= route("admin.deleteTax"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Tax',
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
                                  $.post(url,{tax_id:tax_id}, function(data){
                                       if(data.code == 1){
                                           $('#tax-table').DataTable().ajax.reload(null, false);
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
    
    
    