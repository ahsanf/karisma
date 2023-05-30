<div class="page-titles">
    @if(isset($data['breadcrumbs']))
    <ol class="breadcrumb">
        @foreach($data['breadcrumbs'] as $key => $breadcumb)
            <li class="{{ $breadcumb['class'] }}"><a href="{{ $breadcumb['link'] }}">{{ $breadcumb['name'] }}</a></li>
        @endforeach
    </ol>
    @else
    {{ $data['page_title'] }}
    @endif
</div>
