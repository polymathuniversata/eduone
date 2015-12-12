@if (! empty(session('message')))
    <header class="row" id="messages">    
        <div class="alert alert-warning col-md-12">
            {!! session('message') !!}
        </div>
    </header>
@endif