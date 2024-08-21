<div class="row">    
    <div class="col-xs-12 col-sm-12 col-md-4 text-left">
        
            <strong>PERMISSIONS</strong>
            @if(!empty($rolePermissions))
                <ol>
                    @foreach($rolePermissions as $v)
                        <li>{{ $v->name }}</li>
                    @endforeach
                </ol>
            @endif
        
    </div>
</div>