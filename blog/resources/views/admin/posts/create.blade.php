@extends('adminlte::page')

@section('title', 'Coder free')

@section('content_header')
    <h1>Crear nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- el atributo autocomplete es para desactvar el autocompletado --}}
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('slug', 'Slug:') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug del post', 'readonly']) !!}
                </div>
                {{-- de esta manera nos da para seleccionar  --}}
                <div class="form-group">
                    {!! Form::label('category_id', 'categoria') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                </div>

                {{-- con esto nos dara la  opcion de seleccionar qeu etiqueta  pondre , ver su controlador --}}
                <div class="form-group">
                    <p class="font-weight-bold">Etiquetas</p>

                    @foreach ($tags as $tag)
                        <label class="mr-2" >
                            {!! Form::checkbox('tags[]', $tag->id, null) !!}
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>

                <div class="form-group">
                    <p class="font-weight-bold">Estado</p>
                    <label >
                        {!! Form::radio('status', 1, true) !!}
                        borrador
                    </label>
                    <label >
                        {!! Form::radio('status', 2) !!}
                        publicado
                    </label>
                </div>
{{-- ------------------------------------------------- --}}
                <div class="form-group">
                    {!! Form::label('extract', 'Extracto') !!}
                    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Cuerpo del post:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Crear post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>


    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
/* esto es para el text area trabajamos con el CKEditor */
        ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
    
@endsection