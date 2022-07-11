    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/admin/js/scripts.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/admin/plugins/summernote/summernote-lite.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/admin/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/admin/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{asset('assets/admin/js/datatables-simple-demo.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
      $(function () {
        // Summernote
        $('.textarea').summernote({
          placeholder: 'Hello stand alone ui',
          tabsize: 2,
          height: 150,
          // toolbar: [
          //   ['style', ['style']],
          //   ['font', ['bold', 'underline', 'clear']],
          //   ['color', ['color']],
          //   ['para', ['ul', 'ol', 'paragraph']],
          //   ['table', ['table']],
          //   ['insert', ['link', 'picture', 'video']],
          //   ['view', ['fullscreen', 'codeview', 'help']]
          // ]
        });
      })
      $("#galley_images").change(function() {
        readURL(this);
        //alert('test');
      });
      function readURL(input) {
        let filesArray = input.files;
        //console.log(filesArray);
        if (filesArray && filesArray.length > 0) {
          for(i = 0;i < filesArray.length; i++ ){
            var reader = new FileReader();
            reader.onload = function(e) {
              $('.homeImages').append('<div id="imageDiv20" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_image[]" value="Y" ></div></div></div></div></div>');
            }
            reader.readAsDataURL(filesArray[i]);
          }
        }
      }
      $(document).on('click','.deletemedia',function(e){
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Do you want to delete the media ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
        .then((trueResponse ) => {
          if (trueResponse) {
            let  imageDivId = $(this).attr('data-id');
            if(imageDivId != 0){
              
              var fdata = new FormData();
              fdata.append("_token","{{ csrf_token() }}");
              fdata.append("encryptId",$(this).attr('data-encrypt'));

              $.ajax({
                  type: "POST",
                  contentType: false,
                  processData: false, 
                  url: "{{ route('admin.gallery_image_delete') }}",
                  data: fdata,
                  success: function(response)
                  {
                      if(response.has_error == 0){
                          // $(document).Toasts('create', {
                          //         class: 'bg-info', 
                          //         title: 'Success',
                          //         body: response.msg,
                          //         delay: 3000,
                          //         autohide:true
                          // });
                          toastr.success(response.msg);
                          // alert(imageDivId);
                          $('#imageDiv'+imageDivId+'').remove();
                      } else {
                          // $(document).Toasts('create', {
                          //         class: 'bg-danger', 
                          //         title: 'Error',
                          //         body: response.msg,
                          //         delay: 3000,
                          //         autohide:true
                          // });
                          toastr.error(response.msg);
                      }
                  }
              });
            } else{
              $(this).parent().parent().parent().parent().remove();
              $(document).Toasts('create', {
                                  class: 'bg-info', 
                                  title: 'Success',
                                  body: "Successfully Removed.",
                                  delay: 3000,
                                  autohide:true
                          });
            }
              
          } 
        });    
      });
    </script>  
  </body>
</html>