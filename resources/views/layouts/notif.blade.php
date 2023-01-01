@if(Session::has('success'))
{{ popup(Session::get('success'),'success') }}
@endif

@if(Session::has('error'))
{{ popup(Session::get('error'),'error') }}
@endif

@if(Session::has('warning'))
{{ popup(Session::get('warning'),'warning') }}
@endif