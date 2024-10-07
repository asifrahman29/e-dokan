<li class="nav-item">
    @if(isset($collapseId))
        {{-- Collapseable Item --}}
        <a data-bs-toggle="collapse" href="#{{ $collapseId }}">
            <i class="fas fa-{{ $icon }}"></i>
            <p>{{ $title }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="{{ $collapseId }}">
            <ul class="nav nav-collapse">
                {{ $slot }}
            </ul>
        </div>
    @else
        {{-- Non-Collapse Item --}}
        <a href="{{ $navlink }}">
            <i class="fas fa-{{ $icon }}"></i>
            <p>{{ $title }}</p>
            <span class="badge badge-{{ $color ?? 'info' }}">{{ $badge }}</span>
        </a>
    @endif
</li>
