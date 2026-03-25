<div style="margin-left: {{ $level * 20 }}px; border-left: 2px solid #eee; padding-left: 10px; margin-top:10px;">

    <div class="d-flex justify-content-between">
        <div>
            <strong class="{{ $reply->user->role == 'admin' ? 'text-primary' : '' }}">
                {{ $reply->user->nama }}
                {!! $reply->user->role == 'admin' ? '<span class="badge bg-info" style="font-size:10px">Admin</span>' : '' !!}
            </strong>
            <small class="text-muted">
                {{ $reply->created_at->diffForHumans() }}
            </small>
        </div>
    </div>
    <p class="mb-1">{{ $reply->message }}</p>

    <button onclick="replyComment({{ $reply->id_laporan }}, {{ $reply->id }})" class="btn btn-primary btn-sm">
        Balas
    </button>

    {{-- CHILD REPLIES --}}
    @foreach ($reply->children as $child)
        @include('admin.reports.partials.reply', [
            'reply' => $child,
            'level' => $level + 1,
        ])
    @endforeach

</div>
