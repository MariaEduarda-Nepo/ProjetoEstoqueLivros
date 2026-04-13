<div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="padding:8px 14px;border-radius:8px;background:#f0f0f0;color:#bbb;font-size:13px;font-weight:600;">← Anterior</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:8px 14px;border-radius:8px;background:white;border:1.5px solid #e0e0e0;color:#333;font-size:13px;font-weight:600;text-decoration:none;">← Anterior</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:8px 6px;color:#aaa;font-size:13px;">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:8px 14px;border-radius:8px;background:#CB102E;color:white;font-size:13px;font-weight:700;">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:8px 14px;border-radius:8px;background:white;border:1.5px solid #e0e0e0;color:#333;font-size:13px;font-weight:600;text-decoration:none;">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:8px 14px;border-radius:8px;background:white;border:1.5px solid #e0e0e0;color:#333;font-size:13px;font-weight:600;text-decoration:none;">Próximo →</a>
    @else
        <span style="padding:8px 14px;border-radius:8px;background:#f0f0f0;color:#bbb;font-size:13px;font-weight:600;">Próximo →</span>
    @endif

    <span style="font-size:12px;color:#aaa;margin-left:8px;">
        {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} de {{ $paginator->total() }}
    </span>
</div>
