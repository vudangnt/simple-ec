@if (isset($images) && collect($images)->count())
<div class="row row-cols-4">
    @foreach ($images as $img)
        <div class="col">
            <img src="{{images($img->image)}}" alt="{{$img->name}}" class="img-thumbnail">
            <div class="w-100"></div>
            <button type="button" class="btn btn-danger mt-3 delete-img" data-url="{{route('backend.images.destroy', ['image' => $img->id])}}">Del</button>
        </div>
    @endforeach
</div>

@endif
@push('script')
    <script>
        $(function() {
            $(document).on('click', '.delete-img', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.post({
                    type: 'DELETE',
                    url: $this.data('url')
                }).done(function (data) {
                    $this.parents('.col').remove();
                });
            })
        })
    </script>
@endpush
