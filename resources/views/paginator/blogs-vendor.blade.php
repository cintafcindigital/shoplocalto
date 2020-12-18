@if ($paginator->hasPages())
    <style type="text/css"> 

        ul.blog-paginattion
        { 
            display: table;
            width: 100%;
            text-align: center;
        } 
        ul.blog-paginattion>li>a{
            width:auto;
            height:auto;
        }
        ul.blog-paginattion>li
        { 
            display: table-cell;
            border:1px solid #ddd;
            border-left:0 solid #ddd;
            padding:12px 0;
            width:20%;
            cursor: pointer;
        }
        ul.blog-paginattion>li:first-child{
            border-left:1px solid #ddd;
        }
        ul.blog-paginattion>li.last-first{
            color:#ddf;
            cursor: not-allowed;
        }
        ul.blog-paginattion>li.activated {
            cursor: not-allowed;
        }
    </style>
    <ul class="blog-paginattion">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="last-first"><i class="fa fa-backward"></i></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-backward"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="activated"><span>{{ $page }}</span></li>
                    @else
                        <li class="link-href"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-forward"></i></a></li>
        @else
            <li class="last-first"><span><i class="fa fa-forward"></i></span></li>
        @endif
    </ul>
    <script>
        $(document).ready(function(event){
            $("li.link-href").click(function(evt) {
                evt.preventDefault();
                window.location.href = $(this).find('a').attr('href');
            });
        })
    </script>
@endif