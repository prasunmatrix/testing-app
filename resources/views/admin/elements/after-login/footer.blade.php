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
          //readURL(this);
          alert('test');
        });
        </script>  
    </body>
</html>