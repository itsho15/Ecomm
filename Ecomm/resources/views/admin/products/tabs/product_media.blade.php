@push('js')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script type="text/javascript">
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		
		$('#dropzonefileUpload').dropzone({
			url:"{{ aurl('upload/image/'.$product->id ) }}",
			pramName:'file',
			uploadMultiple:false,
			maxFiles:15,
			maxFilesSize:2, //mb
			acceptedFiles:'image/*',
			dictDefaultMessage:'اضفط هنا لرفع الملفات',
			dictRemoveFile:'{{ trans('admin.delete') }}',
			params:{
				_token:'{{ csrf_token() }}',
			},
			addRemoveLinks:true,
			removedfile:function(file){
				
				$.ajax({
					dataType:'json',
					type:'post',
					url:'{{ aurl('delete/image' ) }}',
					data:{ _token:'{{ csrf_token() }}' , id: file.FileId }
				});
			var fmock;
			return (fmock = file.previewElement ) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
			},
			init:function(){
				 
				@foreach($product->files()->get() as $file)
				var mock = { FileId:'{{ $file->id }}' ,name:'{{ $file->name }}',size:'{{ $file->size }}', type:'{{ $file->mime_type }}' };
				this.emit('addedfile',mock);
				this.options.thumbnail.call(this,mock, '{{ Storage::url($file->full_file) }}' );
				@endforeach

				this.on('sending',function(file,xhr,formData){
					formData.append('Fid','');
					file.Fid = '';
				});

				this.on('success',function(file,response){
					file.Fid = response.id;
				});
			}

		});
	});
</script>
@endpush

<div id="product_media" class="tab-pane fade">
    <h3>{{ trans('admin.product_media') }}</h3>
     <div class="dropzone" id="dropzonefileUpload" > </div>     
</div>