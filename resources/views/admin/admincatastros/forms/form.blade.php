@if (Session::has('message'))
    <div class="text-danger">
        {{Session::get('message')}}
    </div>
@endif
@if (Session::has('status'))
    <div class="text-danger">
        {{Session::get('status')}}
    </div>
@endif


<div class="row">

    <div class="col-xs-12 col-md-12">
        <div class="form-group">
            {{ Form::label('estado', 'Estado', ['class' => 'label_form']) }}
            {{ Form::select('estado', array('1' => 'Habilitado','0' => 'Inhabilitado'),$admincatastro->estado=='1'?'1':'0',['class' => 'form-control']) }}
            @if($errors->has('estado'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('estado')}}</div>
            @endif
        </div>
    </div>
</div>
<div class="row">

    <div class="col-xs-12 col-md-12">
        <div class="form-group">
            {{ Form::label('email', 'Correo Electronico', ['class' => 'label_form']) }}
            {{ Form::email('email', isset($admincatastro)?$admincatastro->email:'', array('class' => 'form-control')) }}
            @if($errors->has('email'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('email')}}</div>
            @endif
            @if(Session::has('msg'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{Session::get('msg')}}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xs-12 col-md-12">
        <div class="form-group">
            {{ Form::label('PERS_varDNI', 'Encargado', ['class' => 'label_form']) }}
            <select class="form-control" id="PERS_varDNI" name="PERS_varDNI">                            
                            @foreach($personas as $persona)
                                @if(isset($admincatastro))
                                    
                                        @if($admincatastro->PERS_varDNI==$persona->PERS_varDNI)
                                        <option value="{{$persona->PERS_varDNI}}" selected="">{{$persona->PERS_varApPaterno}} {{$persona->PERS_varApMaterno}}, {{$persona->PERS_varNombres}}</option>
                                        @else
                                        <option value="{{$persona->PERS_varDNI}}">{{$persona->PERS_varApPaterno}} {{$persona->PERS_varApMaterno}}, {{$persona->PERS_varNombres}}</option>
                                        @endif
                                    
                                @else
                                <option value="{{$persona->PERS_varDNI}}">{{$persona->PERS_varApPaterno}} {{$persona->PERS_varApMaterno}}, {{$persona->PERS_varNombres}}</option>
                                @endif
                            @endforeach
            </select>
            @if($errors->has('PERS_varDNI'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('PERS_varDNI')}}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="action">Save
                Guardar
            </button>
        </div>
    </div>
</div>