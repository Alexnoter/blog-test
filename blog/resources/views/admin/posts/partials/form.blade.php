<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug del post', 'readonly']) !!}

    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>
{{-- de esta manera nos da para seleccionar  --}}
<div class="form-group">
    {!! Form::label('category_id', 'categoria') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
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
    

    @error('tags')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror

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


    @error('status')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            {{-- aca nos indicaria si tuviera una imagen nos mostraria la que tiene almacenada en caso de que no se muestra el por defecto --}}
            {{-- isset verifica si lo que tenemos ahi  esta definido , es como un if--}}
            @isset ($post->image)
                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2022/04/05/20/21/jack-russell-terrier-7114378_960_720.jpg" alt="">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'imagen que se mostrar en el post') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam inventore, ipsa ad dolore in recusandae accusantium, blanditiis dolorem, cumque repellendus debitis laboriosam ratione iusto fugiat at culpa. Iure, consectetur ullam.</p>
    </div>
</div>
{{-- ------------------------------------------------- --}}
<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

    @error('extract')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo del post:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>