<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
          $('#payable-form').on('submit', function(e){
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
                            $("#abc").html(data.html1);
                            $('.modal').modal('show');
                        }
                            
                    }
                });
            });

            $('.suppliers_list').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.suppliersList') }}",
                    method:'GET',
                    success:function(data){
                        $("#abc").html(data.html1);
                        $('.modal').modal('show');
                    }
                })
            })

            $('.payables').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.payable') }}",
                    method:'GET',
                    success:function(data){
                        $("#abc").html(data.html1);
                        $('.modal').modal('show');
                    }
                })
            })

            $(document).on('click','.nav-link', function(){
             $("#abc").empty();
            });
    
                    
    
      })
    </script>
    
    <script>
		document.getElementById("btnPrint").onclick = function () {
            printElement(document.getElementById("printThis"));
        }

        function printElement(elem) {
            var domClone = elem.cloneNode(true);
            
            var $printSection = document.getElementById("printSection");
            
            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }
            
            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
	</script>


<script>
    
    function printDiv() {
            var contents = document.getElementById("printThis").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write(contents);
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
</script>
    
    