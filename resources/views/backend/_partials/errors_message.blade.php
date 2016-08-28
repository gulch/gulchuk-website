@if (isset($message))
    <div class="ui icon warning message">
        <i class="warning sign icon"></i>
        <div class="content">
            {{ $message }}
        </div>
    </div>
@endif