@extends('/layouts/main')
@section('content')
@include('/partials/navbar')
<div class="container">

  {{-- Coluna BTN Voltar --}}
  <div class="row">
    <div class="col-12 my-4"> <a href="/"><i class="fas fa-arrow-left me-2"></i>Voltar</a></div>

    {{-- Coluna Card Form --}}
    <div class="col-12">
      <div class="card shadow bg-white rounded">
        <div class="card-header gradient text-white">
          <h2 class="card-title">
            <i class="fas fa-image mx-2"></i>
            {{isset($photo) ? 'Alterar Foto' : 'Nova Foto'}}
          </h2>
        </div>
        <div class="card-body">
          <div class="p-md-3">

            @if (isset($photo))
              <form action="/photos/{{$photo->id}}" method="POST">
              @method('PUT')
            @else
              <form action="/photos" method="POST">
            @endif
            @csrf

            <div class="row">

              {{-- Coluna da Imagem --}}
              <div class="col-lg-6">
                <div class="d-flex flex-column h-100">
                  <div
                    class="miniatura img-thumbnail d-flex flex-column justify-content-center align-items-center h-100 mt-4">
                    <i class="far fa-image"></i> <br>
                  </div>
                  <div class="form-group mt-2">
                    <div class="custom-file"> <input type="file" class="custom-file-input" id="customFile"> <label
                      class="custom-file-label" for="customFile">Nenhum arquivo selecionado</label> </div>
                    </div>
                  </div>
                </div> {{-- Fim - Coluna da Imagem --}}

                {{-- Coluna das Inputs --}}
                <div class="col-lg-6">

                  {{-- Título --}}
                  <div class="form-group"> <label for="title">Título</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"> <i class="fas fa-image"></i> </div>
                      </div> <input id="title" name="title" type="text" class="form-control"
                          required placeholder="Digite o título da sua imagem" value="{{$photo->title ?? null}}">
                    </div>
                  </div>

                    {{-- Data --}}
                  <div class="form-group"> <label for="date">Data</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"> <i class="far fa-calendar-alt"></i> </div>
                      </div> <input id="date" name="date" type="date" required class="form-control" value="{{$photo->date ?? null}}">
                    </div>
                  </div>

                    {{-- Descrição --}}
                  <div class="form-group"> <label for="description">Descrição</label> <textarea id="description"
                      name="description" cols="40" rows="5" class="form-control"
                      required placeholder="Digite uma pequena descrição da imagem">{{$photo->description ?? null}}</textarea>
                  </div>

                    {{-- Botões --}}
                  <div class="form-group d-flex">
                    <button name="submit" type="reset" class="btn btn-laranja">Limpar</button>
                    <button name="submit" type="submit" class="btn btn-primary">Salvar</button>
                  </div>
                </div> {{-- Fim - Coluna das Inputs --}}
              </div> {{-- Fim - Row --}}
            </form> {{-- Fim - Form --}}
        </div> {{-- Fim - Card Body --}}
      </div> {{-- Fim - Card --}}
    </div> {{-- Fim - Coluna Card Form --}}
  </div>{{-- Fim - Coluna BTN Voltar --}}
</div> {{-- Fim do Container --}}
  @endsection
